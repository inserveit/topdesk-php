<?php

namespace Innovaat\Topdesk\Endpoints;

trait Asset
{
    /**
     * @see https://developers.topdesk.com/explorer/?page=assets#/Assets/getAssets
     */
    public function getListOfAssets($query = [])
    {
        return $this->request('GET', 'api/assetmgmt/assets', [], $query);
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=assets#/Assets/create
     */
    public function createAsset($params = [])
    {
        return $this->request('POST', 'api/assetmgmt/assets', $params);
    }

    /**
     * @see https://developers.topdesk.com/explorer/?page=assets#/Assets/getAssetById
     */
    public function getAssetById($id)
    {
        return $this->request('GET', "api/assetmgmt/assets/${id}");
    }
}
