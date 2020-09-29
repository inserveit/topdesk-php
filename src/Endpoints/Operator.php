<?php

namespace Innovaat\Topdesk\Endpoints;

trait Operator
{
    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Operators/retrieveOperators
     * @param array $query
     * @return
     */
    public function getListOfOperators($query = [])
    {
        return $this->requestOperator('GET', '', [], $query);
    }

    private function requestOperator($method, $uri = '', $json = [], $query = [])
    {
        return $this->request($method, "api/operators{$uri}", $json, $query);
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Operators/createOperator
     * @param $params
     * @return
     */
    public function createOperator($params)
    {
        return $this->requestOperator('POST', '', $params);
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Operators/getOperatorById
     * @param $id
     * @return
     */
    public function getOperatorById($id)
    {
        return $this->requestOperator('GET', "/id/{$id}");
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Operators/updateOperatorById
     * @param $id
     * @param $params
     * @return
     */
    public function updateOperatorById($id, $params)
    {
        return $this->requestOperator('PUT', "/id/{$id}", $params);
    }
}