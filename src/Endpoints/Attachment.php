<?php

namespace Innovaat\Topdesk\Endpoints;

trait Attachment
{
    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Attachments-GetIncidentAttachmentsByIncidentId
     * @param $id
     * @param array $query
     * @return
     */
    public function getIncidentAttachmentsbyIncidentId($id, $query = [])
    {
        return $this->request('GET', "api/incidents/id/{$id}/attachments", [], $query);
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Attachments-GetIncidentAttachmentsByIncidentNumber
     * @param $number
     * @param array $query
     * @return
     */
    public function getIncidentAttachmentsbyIncidentNumber($number, $query = [])
    {
        return $this->request('GET', "api/incidents/number/{$number}/attachments", [], $query);
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Attachments-UploadFileToIncidentById
     * @param $id
     * @param $path
     * @param $name
     * @return
     */
    public function uploadIncidentAttachmentByIncidentId($id, $path, $name)
    {
        return $this->request('POST', "api/incidents/id/${id}/attachments", [], [], [
            'multipart' => [
                [
                    'name' => 'file',
                    'contents' => fopen($path, 'r'),
                    'filename' => $name
                ]
            ]
        ]);
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Attachments-UploadFileToIncidentByNumber
     * @param $number
     * @param $path
     * @param $name
     * @return
     */
    public function uploadIncidentAttachmentByIncidentNumber($number, $path, $name)
    {
        return $this->client->request('POST', "api/incidents/number/${number}/attachments", [], [], [
            'multipart' => [
                [
                    'name' => 'file',
                    'contents' => fopen($path, 'r'),
                    'filename' => $name
                ]
            ]
        ]);
    }

    /**
     * @see https://developers.topdesk.com/documentation/index.html#api-Attachments-DownloadAttachment
     * @param $id
     * @param $attachmentId
     * @return
     */
    public function downloadIncidentAttachmentByIncidentId($id, $attachmentId)
    {
        return $this->request('GET', "api/incidents/id/${id}/attachments/${attachmentId}/download",
            [], [], [], false);
    }
}
