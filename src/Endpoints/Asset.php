<?php

namespace Innovaat\Topdesk\Endpoints;

trait Asset
{
    /**
     * @see https://developers.topdesk.com/explorer/?page=assets#/Assets/getAssets
     * @param array $query
     * @return
     */
    public function getListOfAssets($query = [])
    {
        return $this->request('GET', 'api/assetmgmt/assets', [], $query);
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=assets#/Assets/create
     * @param array $params
     * @return
     */
    public function createAsset($params = [])
    {
        return $this->request('POST', 'api/assetmgmt/assets', $params);
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=assets#/Assets/getAssetById
     * @param $id
     * @return
     */
    public function getAssetById($id)
    {
        return $this->request('GET', "api/assetmgmt/assets/${id}");
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=assets#/assignments/getAssignments
     * @param $id
     * @return
     */
    public function getAssetAssignments($id)
    {
        return $this->request('GET', "api/assetmgmt/assets/${id}/assignments");
    }
}
