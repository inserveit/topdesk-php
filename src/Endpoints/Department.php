<?php

namespace Innovaat\Topdesk\Endpoints;

trait Department
{
    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Departments/getDepartments
     * @param array $query
     * @return
     */
    public function getListOfDepartments($query = [])
    {
        return $this->request('GET', '', [], $query);
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Departments/createDepartment
     * @param $params
     * @return
     */
    public function createDepartment($params)
    {
        return $this->request('POST', '', $params);
    }
}