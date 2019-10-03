<?php

namespace Innovaat\Topdesk\Endpoints;

trait Incident
{
    private function requestIncident($method, $uri = '', $json = [], $query = [])
    {
        return $this->request($method, "api/incidents{$uri}", $json, $query);
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-CreateIncident
     */
    public function createIncident($params)
    {
        return $this->requestIncident('POST', '/', $params);
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-GetIncidentById
     */
    public function getIncidentById($id)
    {
        return $this->requestIncident('GET', "/id/${id}");
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-GetIncidentByNumber
     */
    public function getIncidentByNumber($number)
    {
        return $this->requestIncident('GET', "/number/${number}");
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-GetListOfIncidents
     */
    public function getListOfIncidents($query = [])
    {
        return $this->requestIncident('GET', '', [], $query);
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-EscalateIncidentById
     */
    public function escalateIncidentById($id)
    {
        return $this->requestIncident('PUT', "/id/${id}/escalate");
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-EscalateIncidentByNumber
     */
    public function escalateIncidentByNumber($number)
    {
        return $this->requestIncident('PUT', "/number/${number}/escalate");
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-DeescalateIncidentById
     */
    public function deescalateIncidentById($id)
    {
        return $this->requestIncident('PUT', "/id/${id}/deescalate");
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-DeescalateIncidentByNumber
     */
    public function deescalateIncidentByNumber($number)
    {
        return $this->requestIncident('PUT', "/number/${number}/deescalate");
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-GetIncidentRequestsByIncidentId
     */
    public function getIncidentRequestsByIncidentId($id, $query = []) {
        return $this->requestIncident('GET', "/id/${id}/requests", [], $query);
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-GetIncidentRequestsByIncidentNumber
     */
    public function getIncidentRequestsByIncidentNumber($number, $query = []) {
        return $this->requestIncident('GET', "/number/${number}/requests", [], $query);
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-GetIncidentActionsByIncidentId
     */
    public function getIncidentActionsByIncidentId($id, $query = []) {
        return $this->requestIncident('GET', "/id/${id}/actions", [], $query);
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-GetIncidentActionsByIncidentNumber
     */
    public function getIncidentActionsByIncidentNumber($number, $query = []) {
        return $this->requestIncident('GET', "/number/${number}/actions", [], $query);
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-RetrieveTimeSpentOnIncidentById
     */
    public function getIncidentTimespentByIncidentId($id) {
        return $this->requestIncident('GET', "/id/${id}/timespent");
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Incident-RetrieveTimeSpentOnIncidentByNumber
     */
    public function getIncidentTimespentByIncidentNumber($number) {
        return $this->requestIncident('GET', "/number/${number}/timespent");
    }
}