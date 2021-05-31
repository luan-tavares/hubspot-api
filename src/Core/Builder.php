<?php

namespace DevHokage\HubspotAPI\Core;

use DevHokage\HubspotAPI\Core\Interfaces\ResourceInterface;
use DevHokage\HubspotAPI\Request\Builder as RequestBuilder;
use ReflectionClass;
use stdClass;

class Builder
{
    private $request;

    /**
     * @var string|null
     */
    private $resource;
 

    public function __construct(ResourceInterface $resourceObject)
    {
        $this->resource = get_class($resourceObject);
        $this->request = new RequestBuilder($resourceObject);
    }

    public function __call($method, $parameters)
    {
        $return = $this->request->{$method}(...$parameters);

        if ($return instanceof RequestBuilder) {
            return $this;
        }

        return $return;
    }
}
