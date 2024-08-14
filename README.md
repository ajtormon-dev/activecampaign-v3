# activecampaign-v3

A PHP library for interacting with the ActiveCampaign API v3.

## Installation

You can install this package via Composer:

```bash
composer require ajtormon-dev/activecampaign-v3
```

## Usage
```php
use AjtormonDev\ActiveCampaign;

$apiKey = 'your-api-key';
$apiUrl = 'https://your-account.api-us1.com';

$ac = new ActiveCampaign($apiKey, $apiUrl);

// Example API call
$response = $ac->contacts()->retrieve();
```

## License
This project is licensed under the MIT License. See the LICENSE file for details.

## Author
ajtormon-dev

## Support
If you encounter any problems or have any questions, please open an issue on the GitHub repository.