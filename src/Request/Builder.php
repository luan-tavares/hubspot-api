<?php

namespace DevHokage\HubspotAPI\Request;

use DevHokage\HubspotAPI\Core\Container;
use DevHokage\HubspotAPI\Core\Interfaces\ResourceInterface;
use DevHokage\HubspotAPI\Request\Concerns;
use DevHokage\HubspotAPI\Request\Uri;
use Exception;

class Builder
{
    use Concerns;
    
    private const HUBSPOT_BASE_URL = "https://api.hubapi.com";
    private const HUBSPOT_GET_LIMIT = 250;
    private const HUBSPOT_BATCH_LIMIT = 100;

    private const HUBSPOT_DEFAULT_LIMIT = 20;
    private const HUBSPOT_DEFAULT_HEADER = ['Content-Type'=>'application/json'];
    private const HUBSPOT_DEFAULT_HTTP_METHOD = "GET";

    
    private $map;

    private $callMethod;
    
    private $resource;
    
    /**
     * @var string
     */
    private $endpoint;


    private $uriQueries;

     

    public function __construct(ResourceInterface $resource)
    {
        $resourceMap = Container::getMap($resource);
        $this->resource = $resource;
        $this->map = $resourceMap;
        $version = "";

        if (@$resourceMap["version"]) {
            $version = "/". $resourceMap["version"];
        }
        $this->endpoint = self::HUBSPOT_BASE_URL . "/". $resourceMap["resource"] . $version;
        $this->reset();
    }

    public function __call($method, $params)
    {
        if (array_key_exists($method, $this->map["methods"])) {
            return $this->callMethodByMap($method, $params);
        }

        throw new Exception("{$method} does not exist.", 1);
    }

    private function callMethodByMap($method, $params)
    {
        $this->callMethod = $this->map["methods"][$method];
        $this->resource->setAction($method);

        if (isset($this->callMethod["documentation"])) {
            $this->resource->setDocumentation($this->callMethod["documentation"]);
        }
        $this->uriPath = $this->callMethod["path"];
        preg_match_all("/{(.*?)}/", $this->uriPath, $matches, PREG_PATTERN_ORDER);

        if ($matches[1]) {
            foreach ($matches[1] as $match) {
                $this->uriPath = str_replace("{{$match}}", $params[0], $this->uriPath);

                array_shift($params);
            }
        }

        return $this->{$this->callMethod["action"]}(...$params);
    }

    private function makeURI()
    {
        if (!$this->uriPath) {
            throw new Exception("Invalid call", 1);
        }

        $hapikey = (isset($this->header["Authorization"])?(null):(Container::hapikey()));

        return $this->endpoint ."/". $this->uriPath . (new Uri($hapikey, $this->uriQueries));
    }

    public function limit(int $limit): Builder
    {
        $this->uriQueries["limit"] = $limit;

        return $this;
    }

    public function offset($hubspotId): Builder
    {
        $this->uriQueries["offset"] = $hubspotId;

        return $this;
    }

    public function vidOffset($hubspotId): Builder
    {
        $this->uriQueries["vidOffset"] = $hubspotId;

        return $this;
    }

    public function timeOffset($hubspotId): Builder
    {
        $this->uriQueries["timeOffset"] = $hubspotId;

        return $this;
    }

    public function properties($properties): Builder
    {
        $this->uriQueries["properties"] = $properties;

        return $this;
    }

    public function associations($associations): Builder
    {
        $this->uriQueries["associations"] = $associations;

        return $this;
    }

    public function after(string $after): Builder
    {
        $this->uriQueries["after"] = $after;

        return $this;
    }

    public function count(int $count): Builder
    {
        $this->uriQueries["count"] = $count;

        return $this;
    }

    public function addQuery(string $name, $value): Builder
    {
        $this->uriQueries[$name] = $value;

        return $this;
    }

    public function showProperties()
    {
        if (func_get_args()<1) {
            return $this;
        }
        $this->uriQueries["properties"] = [];
        foreach (func_get_args() as $argument) {
            $this->uriQueries["properties"][] = $argument;
        }

        return $this;
    }
}
