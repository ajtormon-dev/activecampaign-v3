<?php

declare(strict_types=1);

namespace ActiveCampaignV3\Libraries;

use ActiveCampaignV3\Utils\Api;

class Tags extends Api
{
    public function create(array $data)
    {
        // Required. Set by default
        $data['tagType'] = $data['tagType'] ?? 'contact';

        $apiData = ["tag" => $data];

        return $this->_post('tags', $apiData);
    }

    public function retrieve(int $id)
    {
        return $this->_get('tags/' . $id);
    }

    public function update(array $data)
    {
        $apiData = ["tag" => $data];

        return $this->_put('tags', $apiData);
    }

    public function delete(int $id)
    {
        return $this->_delete('tags/' . $id);
    }

    public function list(array $params)
    {
        return $this->_get('tags', $params);
    }
}
