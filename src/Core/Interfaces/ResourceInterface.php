<?php

namespace DevHokage\HubspotAPI\Core\Interfaces;

use DevHokage\HubspotAPI\Core\Builder;
use stdClass;

interface ResourceInterface
{
    public function toArray(): ?array;
    public function getResource(): string;
    public function setResponse(string $response): ResourceInterface;
    public function data(): ?stdClass;
    public function setAction(string $action): Builder;
    public function setDocumentation(string $documentation): Builder;
}
