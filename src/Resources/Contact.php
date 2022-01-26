<?php

namespace DevHokage\HubspotAPI\Resources;

use DevHokage\HubspotAPI\Core\Resource;

/**
* @method static $this getAll() 
* @method $this getAll() 
* @method static $this getById(int|string $vid) 
* @method $this getById(int|string $vid) 
* @method static $this getByEmail(int|string $email) 
* @method $this getByEmail(int|string $email) 
* @method static $this getRecentlyUpdated() 
* @method $this getRecentlyUpdated() 
* @method static $this getRecentlyCreated() 
* @method $this getRecentlyCreated() 
* @method static $this getBatchById(array $requestBody) 
* @method $this getBatchById(array $requestBody) 
* @method static $this getBatchByEmail(array $requestBody) 
* @method $this getBatchByEmail(array $requestBody) 
* @method static $this create(array $requestBody) 
* @method $this create(array $requestBody) 
* @method static $this updateById(int|string $vid, array $requestBody) 
* @method $this updateById(int|string $vid, array $requestBody) 
* @method static $this updateByEmail(int|string $email, array $requestBody) 
* @method $this updateByEmail(int|string $email, array $requestBody) 
* @method static $this createOrUpdate(int|string $email, array $requestBody) 
* @method $this createOrUpdate(int|string $email, array $requestBody) 
* @method static $this batchCreateOrUpdate(array $requestBody) 
* @method $this batchCreateOrUpdate(array $requestBody) 
* @method static $this delete(int|string $vid) 
* @method $this delete(int|string $vid) 
* @method static $this merge(int|string $vId, array $requestBody) 
* @method $this merge(int|string $vId, array $requestBody) 
 */
class Contact extends Resource
{
    protected $resource = "contacts";
}
