<?php

namespace Innovaat\Topdesk\Endpoints;

trait Person
{
    private function requestPerson($method, $uri = '', $json = [], $query = [])
    {
        return $this->request($method, "api/persons{$uri}", $json, $query);
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Persons/retrievePersons
     */
    public function getListOfPersons($query = [])
    {
        return $this->requestPerson('GET', '', [], $query);
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Persons/createPerson
     */
    public function createPerson($params)
    {
        return $this->requestPerson('POST', '', $params);
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Persons/getPersonById
     */
    public function getPersonById($id)
    {
        return $this->requestPerson('GET', "/id/{$id}");
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Persons/putPersonById
     */
    public function updatePersonById($id, $params)
    {
        return $this->requestPerson('PUT', "/id/{$id}", $params);
    }
}