<?php

namespace DevHokage\HubspotAPI\Core;

use DevHokage\HubspotAPI\Core\Interfaces\ResourceInterface;
use Exception;
use stdClass;

class Resource implements ResourceInterface
{
    protected $resource;
    
    private $action;
    
    private $documentation;
    
    private $rawResponse;

    public function __construct(string $resource= null)
    {
        if (static::class !== self::class) {
            return;
        }

        if (!in_array($resource, Container::resources())) {
            throw new Exception("\"{$resource}\" is not a valid resource. Valid Resources: \"". implode("\",\"", Container::resourcers()) ."\"", 1);
        }
        $this->resource = $resource;
    }

    public function __set($property, $value)
    {
    }

    public function __get($property)
    {
    }
    
    public function __isset($property)
    {
    }

    public function __call($method, $parameters)
    {
        return Container::getBuilder($this)->{$method}(...$parameters);
    }

    public static function __callStatic($method, $parameters)
    {
        return call_user_func_array([(new static), $method], $parameters);
    }

    /**
     * Get $data
     *
     * @return stdClass|null
     */
    public function data(): ?stdClass
    {
        return $this->data;
    }

    public function getResource(): string
    {
        return $this->resource;
    }

    public function setResponse(string $response): ResourceInterface
    {
        $this->rawResponse = $response;

        return $this;
    }

    public function toArray(): ?array
    {
        if ($this->rawResponse) {
            return json_decode($this->rawResponse, true);
        }

        return null;
    }

    public function setAction(string $action): Builder
    {
        $this->action = $action;

        return Container::getBuilder($this);
    }

    public function setDocumentation(string $documentation): Builder
    {
        $this->documentation = $documentation;

        return Container::getBuilder($this);
    }

    public static function hapikey(string $hapikey): void
    {
        Container::hapikey($hapikey);
    }
}
