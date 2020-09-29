<?php

namespace Innovaat\Topdesk\Endpoints;

trait Branch
{
    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Branches/retrieveBranches
     * @param array $query
     * @return
     */
    public function getListOfBranches($query = [])
    {
        return $this->requestBranch('GET', '', [], $query);
    }

    private function requestBranch($method, $uri = '', $json = [], $query = [])
    {
        return $this->request($method, "api/branches{$uri}", $json, $query);
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Branches/createBranch
     * @param $params
     * @return
     */
    public function createBranch($params)
    {
        return $this->requestBranch('POST', '', $params);
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Branches/getExtendedBranchById
     * @param $id
     * @param $query
     * @return
     */
    public function getBranchById($id, $query)
    {
        return $this->requestBranch('GET', "/id/{$id}", [], $query);
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Branches/putBranch
     * @param $id
     * @param $params
     * @return
     */
    public function updateBranchById($id, $params)
    {
        return $this->requestBranch('PUT', "/id/{$id}", $params);
    }
}