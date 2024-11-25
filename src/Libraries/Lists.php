<?php

declare(strict_types=1);

namespace ActiveCampaignV3\Libraries;

use ActiveCampaignV3\Utils\Api;
use ActiveCampaignV3\Helpers\Strings;

class Lists extends Api
{
    public function add(string $list_id, int $contact_id)
    {
        $apiData = [
            "list" => $list_id,
            "contact" => $contact_id,
            "status" => 1
        ];

        return $this->_post('contactLists', ['contactList' => $apiData]);
    }

    public function delete(string $list_id, int $contact_id)
    {
        $apiData = [
            "list" => $list_id,
            "contact" => $contact_id,
            "status" => 2
        ];

        return $this->_post('contactLists', ['contactList' => $apiData]);
    }

    public function all(): object
    {
        return $this->_get('lists');
    }

    public function create(string $name, string $senderUrl, string $reminder = null)
    {
        $apiData = [
            "name" => $name,
            "stringid" => Strings::toKebabCase($name),
            "sender_url" => $senderUrl,
            "sender_reminder" => $reminder ?? "You are added automatically when you purchased a product."
        ];

        return $this->_post('lists', ['list' => $apiData]);
    }
}
