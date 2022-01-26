<?php

namespace DevHokage\HubspotAPI\Resources;

use DevHokage\HubspotAPI\Core\Resource;

/**
* @method static $this getAll() 
* @method $this getAll() 
* @method static $this get(int|string $property) 
* @method $this get(int|string $property) 
* @method static $this create(array $requestBody) 
* @method $this create(array $requestBody) 
* @method static $this update(int|string $property, array $requestBody) 
* @method $this update(int|string $property, array $requestBody) 
* @method static $this delete(int|string $property) 
* @method $this delete(int|string $property) 
* @method static $this getAllGroups() 
* @method $this getAllGroups() 
* @method static $this createGroup(array $requestBody) 
* @method $this createGroup(array $requestBody) 
* @method static $this updateGroup(int|string $group, array $requestBody) 
* @method $this updateGroup(int|string $group, array $requestBody) 
* @method static $this deleteGroup(int|string $group) 
* @method $this deleteGroup(int|string $group) 
 */
class CompanyProperty extends Resource
{
    protected $resource = "companies-properties";
}
