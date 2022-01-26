<?php

namespace DevHokage\HubspotAPI\Resources;

use DevHokage\HubspotAPI\Core\Resource;

/**
* @method static $this get(int|string $objectId, int|string $definitionId) 
* @method $this get(int|string $objectId, int|string $definitionId) 
* @method static $this create(array $requestBody) 
* @method $this create(array $requestBody) 
* @method static $this delete() 
* @method $this delete() 
* @method static $this batchCreate(array $requestBody) 
* @method $this batchCreate(array $requestBody) 
* @method static $this batchDelete(array $requestBody) 
* @method $this batchDelete(array $requestBody) 
 */
class CrmAssociation extends Resource
{
    protected $resource = "crm-associations";
}
