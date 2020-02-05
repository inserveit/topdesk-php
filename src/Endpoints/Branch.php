<?php

namespace Innovaat\Topdesk\Endpoints;

trait Branch
{
    private function requestBranch($method, $uri = '', $json = [], $query = [])
    {
        return $this->request($method, "api/branches{$uri}", $json, $query);
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Branches/retrieveBranches
     */
    public function getListOfBranches($query = [])
    {
        return $this->requestBranch('GET', '', [], $query);
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Branches/createBranch
     */
    public function createBranch($params)
    {
        return $this->requestBranch('POST', '', $params);
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Branches/getExtendedBranchById
     */
    public function getBranchById($id)
    {
        return $this->requestBranch('GET', "/id/{$id}");
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Branches/putBranch
     */
    public function updateBranchById($id, $params)
    {
        return $this->requestBranch('PUT', "/id/{$id}", $params);
    }
}