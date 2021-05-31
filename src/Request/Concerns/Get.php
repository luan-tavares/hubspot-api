<?php

namespace DevHokage\HubspotAPI\Request\Concerns;

use DevHokage\HubspotAPI\Core\Interfaces\ResourceInterface;

trait Get
{
    private function get(): ResourceInterface
    {
        $response = $this->makeCurl();

        return $this->resource->setResponse($response);
    }

    private function batchGetContacts(): ResourceInterface
    {
        if (count(func_get_args()) < 1) {
            throw new Exception("Arguments number must be 1 or more", 1);
        }
        foreach (func_get_args() as $argument) {
            $this->uriQueries["vids"][] = $argument;
        }
        $response = $this->makeCurl();

        return $this->resource->setResponse($response);
    }

    private function batchGetContactsByEmail(): ResourceInterface
    {
        if (count(func_get_args()) < 1) {
            throw new Exception("Arguments number must be 1 or more", 1);
        }
        foreach (func_get_args() as $argument) {
            $this->uriQueries["emails"][] = $argument;
        }
        $response = $this->makeCurl();

        return $this->resource->setResponse($response);
    }

    private function batchGetLists(): ResourceInterface
    {
        if (count(func_get_args()) < 1) {
            throw new Exception("Arguments number must be 1 or more", 1);
        }
        foreach (func_get_args() as $argument) {
            $this->uriQueries["listId"][] = $argument;
        }
        $response = $this->makeCurl();

        return $this->resource->setResponse($response);
    }
}
