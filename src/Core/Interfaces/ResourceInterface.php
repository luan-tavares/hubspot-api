<?php

namespace DevHokage\HubspotAPI\Core\Interfaces;

use DevHokage\HubspotAPI\Core\Builder;

interface ResourceInterface
{
    public function toArray(): ?array;
    public function toJson(): ?string;
    public function getResource(): string;
    public function setResponse(string $response): ResourceInterface;
    public function setAction(string $action): Builder;
    public function setDocumentation(string $documentation): Builder;
}
