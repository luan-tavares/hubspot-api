<?php

if (!function_exists("hubspot")) {
    function hubspot(string $resourceName): DevHokage\HubspotAPI\Core\Interfaces\ResourceInterface
    {
        return (new DevHokage\HubspotAPI\Core\Resource($resourceName));
    }
}

if (!function_exists("hubspotKey")) {
    function hubspotKey($hapikey): void
    {
        DevHokage\HubspotAPI\Core\Resource::hapikey($hapikey);
    }
}
