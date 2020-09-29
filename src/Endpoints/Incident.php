<?php

namespace Innovaat\Topdesk\Endpoints;

trait Incident
{
    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-CreateIncident
     * @param $params
     * @return
     */
    public function createIncident($params)
    {
        return $this->requestIncident('POST', '/', $params);
    }

    private function requestIncident($method, $uri = '', $json = [], $query = [])
    {
        return $this->request($method, "api/incidents{$uri}", $json, $query);
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-GetIncidentById
     * @param $id
     * @return
     */
    public function getIncidentById($id)
    {
        return $this->requestIncident('GET', "/id/${id}");
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-GetIncidentByNumber
     * @param $number
     * @return
     */
    public function getIncidentByNumber($number)
    {
        return $this->requestIncident('GET', "/number/${number}");
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-GetListOfIncidents
     * @param array $query
     * @return
     */
    public function getListOfIncidents($query = [])
    {
        return $this->requestIncident('GET', '', [], $query);
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-EscalateIncidentById
     * @param $id
     * @return
     */
    public function escalateIncidentById($id)
    {
        return $this->requestIncident('PUT', "/id/${id}/escalate");
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-EscalateIncidentByNumber
     * @param $number
     * @return
     */
    public function escalateIncidentByNumber($number)
    {
        return $this->requestIncident('PUT', "/number/${number}/escalate");
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-DeescalateIncidentById
     * @param $id
     * @return
     */
    public function deescalateIncidentById($id)
    {
        return $this->requestIncident('PUT', "/id/${id}/deescalate");
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-DeescalateIncidentByNumber
     * @param $number
     * @return
     */
    public function deescalateIncidentByNumber($number)
    {
        return $this->requestIncident('PUT', "/number/${number}/deescalate");
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-GetIncidentRequestsByIncidentId
     * @param $id
     * @param array $query
     * @return
     */
    public function getIncidentRequestsByIncidentId($id, $query = [])
    {
        return $this->requestIncident('GET', "/id/${id}/requests", [], $query);
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-GetIncidentRequestsByIncidentNumber
     * @param $number
     * @param array $query
     * @return
     */
    public function getIncidentRequestsByIncidentNumber($number, $query = [])
    {
        return $this->requestIncident('GET', "/number/${number}/requests", [], $query);
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-GetIncidentActionsByIncidentId
     * @param $id
     * @param array $query
     * @return
     */
    public function getIncidentActionsByIncidentId($id, $query = [])
    {
        return $this->requestIncident('GET', "/id/${id}/actions", [], $query);
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-GetIncidentActionsByIncidentNumber
     * @param $number
     * @param array $query
     * @return
     */
    public function getIncidentActionsByIncidentNumber($number, $query = [])
    {
        return $this->requestIncident('GET', "/number/${number}/actions", [], $query);
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-RetrieveTimeSpentOnIncidentById
     * @param $id
     * @return
     */
    public function getIncidentTimespentByIncidentId($id)
    {
        return $this->requestIncident('GET', "/id/${id}/timespent");
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-RetrieveTimeSpentOnIncidentByNumber
     * @param $number
     * @return
     */
    public function getIncidentTimespentByIncidentNumber($number)
    {
        return $this->requestIncident('GET', "/number/${number}/timespent");
    }
}