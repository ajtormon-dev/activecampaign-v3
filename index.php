<?php

#require_once 'vendor/autoload.php';
require_once 'src/autoload.php';

use ActiveCampaignV3\ActiveCampaign;

$accountName = 'accountname';
$apikey = 'apikey';

$activeCampaign = new ActiveCampaign($accountName, $apikey);

$response = $activeCampaign->lists()->all();

echo "<pre>"; var_dump($response); echo "</pre>";