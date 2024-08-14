<?php

require_once 'vendor/autoload.php';

use ActiveCampaignV3\ActiveCampaign;

$accountName = 'eocoder1722517373';
$apikey = 'b6b049ad12f295b5b81fad14985d3e0fa339e4e82013e6be4f02e742f06175b127fa10e5';

$activeCampaign = new ActiveCampaign($accountName, $apikey);

// $contact = $activeCampaign->contacts()->create([
//     'email' => 'test@example.com'
// ]);

$tag = $activeCampaign->tags()->list([
    "search" => "test"
]);



echo "<pre>"; var_dump($tag); echo "</pre>";