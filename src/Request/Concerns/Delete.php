<?php

namespace DevHokage\HubspotAPI\Request\Concerns;

use DevHokage\HubspotAPI\Core\Interfaces\ResourceInterface;
use Exception;

trait Delete
{
    private function delete(): ResourceInterface
    {
        $this->httpMethod = "DELETE";
        $response = $this->makeCurl();
        return $this->resource->setResponse($response);
    }
}
