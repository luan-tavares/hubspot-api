<?php

namespace DevHokage\HubspotAPI\Request\Concerns;

use DevHokage\HubspotAPI\Core\Interfaces\ResourceInterface;
use Exception;

trait Post
{
    private function createOrUpdate(): ResourceInterface
    {
        $this->httpMethod = "POST";
        
        $response = $this->curlBody(@func_get_args()[0])->makeCurl();

        return $this->resource->setResponse($response);
    }
}
