<?php

declare(strict_types=1);

namespace ActiveCampaignV3\Helpers;

class Strings
{
    public static function toKebabCase(string $input): string {
        // Remove leading/trailing whitespace
        $input = trim($input);
    
        // Convert non-alphanumeric characters to spaces
        $input = preg_replace('/[^a-zA-Z0-9]+/', ' ', $input);
    
        // Convert to lowercase
        $input = strtolower($input);
    
        // Replace spaces with dashes
        $kebabCase = preg_replace('/\s+/', '-', $input);
    
        return $kebabCase;
    }
}