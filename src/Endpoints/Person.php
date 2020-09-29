<?php

namespace Innovaat\Topdesk\Endpoints;

trait Person
{
    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Persons/retrievePersons
     * @param array $query
     * @return
     */
    public function getListOfPersons($query = [])
    {
        return $this->requestPerson('GET', '', [], $query);
    }

    private function requestPerson($method, $uri = '', $json = [], $query = [])
    {
        return $this->request($method, "api/persons{$uri}", $json, $query);
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Persons/createPerson
     * @param $params
     * @return
     */
    public function createPerson($params)
    {
        return $this->requestPerson('POST', '', $params);
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Persons/getPersonById
     * @param $id
     * @return
     */
    public function getPersonById($id)
    {
        return $this->requestPerson('GET', "/id/{$id}");
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Persons/putPersonById
     * @param $id
     * @param $params
     * @return
     */
    public function updatePersonById($id, $params)
    {
        return $this->requestPerson('PUT', "/id/{$id}", $params);
    }
}