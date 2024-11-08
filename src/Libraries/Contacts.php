<?php

declare(strict_types=1);

namespace ActiveCampaignV3\Libraries;

use ActiveCampaignV3\Utils\Api;

class Contacts extends Api
{
    public function create(array $data)
    {
        $apiData = ["contact" => $data];

        return $this->_post('contacts', $apiData);
    }

    public function retrieve(int $id)
    {
        return $this->_get('contacts/' . $id);
    }

    public function search(array $filter)
    {
        return $this->_get('contacts', $filter);
    }

    public function addTag(array $data)
    {
        $apiData = ["contactTag" => $data];

        return $this->_post('contactTags', $apiData);
    }

    public function removeTag(int $id)
    {
        return $this->_delete('contactTags/' . $id);
    }

    public function contactTags(int $id): object
    {
        return $this->_get('contacts/' .$id . '/contactTags');
    }
}
