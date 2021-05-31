<?php

namespace DevHokage\HubspotAPI\Request\Concerns;

use DevHokage\HubspotAPI\Core\Interfaces\ResourceInterface;

trait Put
{
    private function update(): ResourceInterface
    {
        $this->httpMethod = "PUT";
        $response = $this->curlBody(@func_get_args()[0])->makeCurl();

        return $this->resource->setResponse($response);
    }
}
