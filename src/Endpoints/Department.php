<?php

namespace Innovaat\Topdesk\Endpoints;

trait Department
{
    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Departments/getDepartments
     */
    public function getListOfDepartments($query = []) {
        return $this->request('GET', '', [], $query);
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=supporting-files#/Departments/createDepartment
     */
    public function createDepartment($params)
    {
        return $this->request('POST', '', $params);
    }
}