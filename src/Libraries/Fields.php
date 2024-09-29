<?php

declare(strict_types=1);

namespace ActiveCampaignV3\Libraries;

use ActiveCampaignV3\Utils\Api;

class Fields extends Api
{
    public function all()
    {
        return $this->_get('fields');
    }
}
