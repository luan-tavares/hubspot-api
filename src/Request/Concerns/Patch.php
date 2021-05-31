<?php

namespace DevHokage\HubspotAPI\Request\Concerns;

use DevHokage\HubspotAPI\Core\Interfaces\ResourceInterface;

trait Patch
{
    private function patch(): ResourceInterface
    {
        $this->httpMethod = "PATCH";
        $response = $this->curlBody(@func_get_args()[0])->makeCurl();

        return $this->resource->setResponse($response);
    }
}
