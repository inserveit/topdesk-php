<?php

namespace Innovaat\Topdesk;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Exception\ConnectException;
use Innovaat\Topdesk\Endpoints\Attachment;
use Innovaat\Topdesk\Endpoints\Branch;
use Innovaat\Topdesk\Endpoints\Department;
use Innovaat\Topdesk\Endpoints\Incident;
use Innovaat\Topdesk\Endpoints\Person;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Api
{
    use Incident, Branch, Department, Person, Attachment;

    /** @var string */
    protected $endpoint;

    /** @var array */
    protected $auth;

    /** @var Client */
    protected $client;

    /** @var integer */
    protected $retries;

    const CONNECT_OPERATOR = 'operator';
    const CONNECT_PERSON = 'person';

    const TYPE_LOGIN = 1;
    const TYPE_APPLICATION_PASSWORD = 2;

    /**
     * Create an instance for the TOPdesk API.
     * @param string $endpoint Your API endpoint, that should end on "/tas/".
     * @param integer $retries Number of retries for failed requests.
     * @param array $guzzleOptions Optional options to be passed to the Guzzle Client constructor.
     */
    public function __construct($endpoint = 'https://partnerships.topdesk.net/tas/', $retries = 5, $guzzleOptions = [])
    {
        $this->endpoint = $endpoint;
        $this->retries = $retries;

        $this->client = new Client(array_merge([
            'base_uri' => $this->endpoint,
        ], $guzzleOptions));

        /** @var HandlerStack $handler */
        $handler = $this->client->getConfig('handler');
        $handler->unshift($this->retryMiddleware());
        $handler->unshift($this->tokenMiddleware());
    }

    /**
     * Login using an application password. This is the preferred way to login, since a stateless header is added
     * on each request and your account password is not used.
     * @howto TOPdesk login -> My Settings -> Application passwords -> Add
     * @param string $username
     * @param string $applicationPassword
     * @return $this
     */
    public function useApplicationPassword($username, $applicationPassword)
    {
        $this->auth = [
            'auth_type' => self::TYPE_APPLICATION_PASSWORD,
            'username' => $username,
            'password' => $applicationPassword
        ];
        return $this;
    }

    /**
     * Login regularly using username/password combination.
     * @param $username
     * @param $password
     * @param callable $tokenCallback Pass a callback function that receives a `$token` as its only parameter, which you
     * then need to persist in your own logic, so subsequent calls can use that token. The function needs to return your
     * `token` as well.
     * @param string $type The type you wish to login as. Either 'operator' (default)  or 'person'.
     * @return $this
     */
    public function useLogin($username, $password, callable $tokenCallback, $type = self::CONNECT_OPERATOR)
    {
        $this->auth = [
            'auth_type' => self::TYPE_LOGIN,
            'url' => $type === self::CONNECT_OPERATOR ? 'api/login/operator' : 'api/login/person',
            'callback' => $tokenCallback,
            'username' => $username,
            'password' => $password
        ];
        return $this;
    }

    /**
     * Middleware: Adds correct authorization headers.
     * @return callable
     */
    private function tokenMiddleware()
    {
        return Middleware::mapRequest(function (RequestInterface $request) {
            $auth = $this->auth;
            if (!$auth) {
                throw new TopdeskException('You need to call "useApplicationPassword" or "useLogin" first.');
            }
            if ($auth['auth_type'] === self::TYPE_APPLICATION_PASSWORD) {
                return $request->withHeader('authorization', 'Basic ' . base64_encode($auth['username'] . ':' . $auth['password']));
            } else {
                $tokenCallback = $auth['callback'];
                if (strpos($request->getUri()->getPath(), 'api/login') === false) {
                    if (!$tokenCallback(null)) {
                        // No token yet. Authenticate.
                        $response = $this->client->request('GET', $auth['url'], [
                            'auth' => [$auth['username'], $auth['password']]
                        ]);
                        // Send token to callback so it can be saved.
                        $tokenCallback((string)$response->getBody());
                    }
                    return $request->withHeader('authorization', 'TOKEN id="' . $tokenCallback(null) . '"');
                }
            }
            return $request;
        });
    }

    /**
     * Middleware: Retry API request on failed connections or server exceptions, up to a max of RETRIES.
     * @return callable
     */
    private function retryMiddleware()
    {
        return Middleware::retry(function ($retries, RequestInterface $request, ResponseInterface $response = null, RequestException $exception = null) {
            // Limit the number of retries.
            if ($retries >= $this->retries) {
                return false;
            }

            // Retry connection exceptions.
            if ($exception instanceof ConnectException || $exception instanceof ServerException) {
                return true;
            }

            return false;
        });
    }

    /**
     * Shorthand function to create requests with JSON body and query parameters.
     * @param $method
     * @param string $uri
     * @param array $json
     * @param array $query
     * @param array $options
     * @return mixed|ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($method, $uri = '', array $json = [], array $query = [], array $options = [])
    {
        $response = $this->client->request($method, $uri, array_merge([
            'json' => $json,
            'query' => $query
        ], $options));

        return json_decode((string)$response->getBody(), true);
    }
}
