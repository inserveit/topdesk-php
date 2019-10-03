# topdesk-php
[![Latest Stable Version](https://poser.pugx.org/innovaat/topdesk-api/v/stable)](https://packagist.org/packages/innovaat/topdesk-api)
[![Total Downloads](https://poser.pugx.org/innovaat/topdesk-api/downloads)](https://packagist.org/packages/innovaat/topdesk-api)
[![License](https://poser.pugx.org/innovaat/topdesk-api/license)](https://packagist.org/packages/innovaat/topdesk-api)

A PHP wrapper for the TOPdesk API.

## Installation
```
composer require innovaat/topdesk-api
```

## Guide
Our TOPdesk API implementation contains the following features:
- Simple login using application passwords (recommended) or tokens (legacy).
- Automatic retry functionionality that retries requests when connection errors or status codes >= 500 occur.
 We have experienced various instabilities with the TOPdesk API, and hopefully this minimizes these shortcomings. 
- Direct function calls for much used api endpoints (`createIncident($params)`, `getIncidentById($id)`,
`getListOfIncidents()`, `escalateIncidentById($id)`, `deescalateIncidentById($id)`, `getListOfDepartments()`,
`createDepartment($params)`, `getListOfBranches()`, `createBranch($params)` among others).
- Easy syntax for all other endpoints using `$api->request($method, $uri, $json = [], $query = [])`.

```php
// Create a new API instance, endpoint should end on "/tas/".
$api = new \Innovaat\Topdesk\Api('https://partnerships.topdesk.net/tas/');
```

Call either `useLogin` or `useApplicationPassword` depending on your authentication choice:

```php
// RECOMMENDED
$api->useApplicationPassword('yourusername', 'ipsal-a7aid-6ybuq-ucjwg-axt4i');
```

```php
// LEGACY LOGIN WITH TOKEN
$api->useLogin('yourusername', 'yourpassword', function($token) {
    // Callback function that receives a single parameter `$token` for you to persist.
    // It should return the persisted token as well.
    if($token) {
        file_put_contents('token.txt', $token);
    }
    return file_exists('token.txt') ? file_get_contents('token.txt') : null;
});
```

Now your API should be ready to use:
```php
$incidents = $api->getListOfIncidents([
    'start' => 0,
    'page_size' => 10
]);

foreach($incidents as $incident) {
    var_dump($incident['number']);
}
```

Many requests have been implemented as direct functions of the API. However, not all of them have been implemented.
For manual API requests, use the `request()` function:
```php
$api->request('GET', 'api/incidents/call_types', [
    // Optional array to be sent as JSON body (for POST/PUT requests).
], [
    // Optional (search) query parameters, see API documentation for supported values.
], [
    // Optional parameters for the Guzzle request itself.
    // @see http://docs.guzzlephp.org/en/stable/request-options.html
])
```

## Documentation
- https://developers.topdesk.com/documentation/index.html
- https://developers.topdesk.com/explorer/?page=supporting-files
- https://developers.topdesk.com/explorer/?page=assets
