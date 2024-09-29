<?php

declare(strict_types=1);

namespace ActiveCampaignV3;

use ActiveCampaignV3\Libraries\Fields;
use ActiveCampaignV3\Libraries\Contacts;
use ActiveCampaignV3\Libraries\Tags;
use ActiveCampaignV3\Libraries\Lists;

class ActiveCampaign
{
    const API_VERSION = '3';

    private static $apiUrl;
    private static $apiKey;
    private static $accountName;

    private static $contacts, $tags, $fields, $lists; 

    public function __construct(string $accountName, string $apiKey)
    {
        self::$accountName = $accountName;
        self::$apiKey      = $apiKey;
        
        self::$apiUrl = 'https://' . self::$accountName . '.api-us1.com/api/' . self::API_VERSION . '/';
    }

    public function setUrl($url)
    {
        self::$apiUrl = 'https://' . $url . '/api/' . self::API_VERSION . '/';
    }

    public function contacts(): Contacts
    {
        return $this->__getLibrary('Contacts');
    }

    public function tags(): Tags
    {
        return $this->__getLibrary('Tags');
    }
    public function fields(): Fields
    {
        return $this->__getLibrary('Fields');
    }

    public function lists(): Lists
    {
        return $this->__getLibrary('Lists');
    }

    private function __getLibrary(string $libraryName): object
    {
        $propertyName = strtolower($libraryName);
        if (!isset(self::${$propertyName})) {
            $className = "ActiveCampaignV3\\Libraries\\{$libraryName}";
            self::${$propertyName} = new $className(self::$apiUrl, self::$apiKey);
        }
        return self::${$propertyName};
    }

    private function __generateEndpoint(string $endpoint): string
    {
        return self::$apiUrl . $endpoint;
    }
}
