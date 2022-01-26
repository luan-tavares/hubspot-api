<?php

namespace DevHokage\HubspotAPI\Resources;

use DevHokage\HubspotAPI\Core\Resource;

/**
 * @method static $this getAll()
 * @method $this getAll()
 * @method static $this getById(int|string $contactId)
 * @method $this getById(int|string $contactId)
 */
class ContactV3 extends Resource
{
    protected $resource = 'contacts-v3';
}
