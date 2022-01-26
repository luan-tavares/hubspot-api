<?php

namespace DevHokage\HubspotAPI\Resources;

use DevHokage\HubspotAPI\Core\Resource;

/**
* @method static $this getAll(int|string $objectType) 
* @method $this getAll(int|string $objectType) 
* @method static $this get(int|string $objectType, int|string $propertyName) 
* @method $this get(int|string $objectType, int|string $propertyName) 
* @method static $this create(int|string $objectType, array $requestBody) 
* @method $this create(int|string $objectType, array $requestBody) 
* @method static $this update(int|string $objectType, int|string $propertyName, array $requestBody) 
* @method $this update(int|string $objectType, int|string $propertyName, array $requestBody) 
* @method static $this archive(int|string $objectType, int|string $propertyName) 
* @method $this archive(int|string $objectType, int|string $propertyName) 
* @method static $this batchArchive(int|string $objectType, array $requestBody) 
* @method $this batchArchive(int|string $objectType, array $requestBody) 
* @method static $this batchCreate(int|string $objectType, array $requestBody) 
* @method $this batchCreate(int|string $objectType, array $requestBody) 
* @method static $this batchGet(int|string $objectType, array $requestBody) 
* @method $this batchGet(int|string $objectType, array $requestBody) 
* @method static $this getAllGroups(int|string $objectType) 
* @method $this getAllGroups(int|string $objectType) 
* @method static $this getGroup(int|string $objectType, int|string $groupName) 
* @method $this getGroup(int|string $objectType, int|string $groupName) 
* @method static $this createGroup(int|string $objectType, array $requestBody) 
* @method $this createGroup(int|string $objectType, array $requestBody) 
* @method static $this updateGroup(int|string $objectType, int|string $groupName, array $requestBody) 
* @method $this updateGroup(int|string $objectType, int|string $groupName, array $requestBody) 
* @method static $this archiveGroup(int|string $objectType, int|string $groupName) 
* @method $this archiveGroup(int|string $objectType, int|string $groupName) 
 */
class CrmPropertyV3 extends Resource
{
    protected $resource = "crm-properties-v3";
}
