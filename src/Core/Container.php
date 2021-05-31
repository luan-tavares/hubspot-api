<?php

namespace DevHokage\HubspotAPI\Core;

use DevHokage\HubspotAPI\Core\Interfaces\ResourceInterface;
use stdClass;

abstract class Container
{
    private static $resourcesList;
    
    public static $resourceSchema = [];

    private static $apiKey;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private static function schema(ResourceInterface $resourceObject): stdClass
    {
        if (!isset(self::$resourceSchema[get_class($resourceObject)])) {
            self::$resourceSchema[get_class($resourceObject)] = new stdClass;
            $schema = &self::$resourceSchema[get_class($resourceObject)];
            $schema->map =  json_decode(file_get_contents(__DIR__."/schemas/". $resourceObject->getResource() .".json"), true);
            $schema->builder = new Builder($resourceObject);
        }

        return self::$resourceSchema[get_class($resourceObject)];
    }

    public static function getBuilder(ResourceInterface $resourceObject): Builder
    {
        return self::schema($resourceObject)->builder;
    }


    public static function getMap(ResourceInterface $resourceObject): array
    {
        return self::schema($resourceObject)->map;
    }

    public static function resources()
    {
        if (!self::$resourcesList) {
            self::$resourcesList = self::readPath("schemas");
        }

        return self::$resourcesList;
    }

    private static function readPath(string $dir)
    {
        try {
            $dir = dir(__DIR__ ."/". $dir);
        } catch (Exception $e) {
            throw new Exception("Dir \"{$dir}\" not exists.");
        }
        $files = [];
        while ($file = $dir->read()) {
            if ($file !=="." and $file !== ".." and pathinfo($file)["extension"] == "json") {
                $files[] = str_replace(".". pathinfo($file)["extension"], "", $file);
            }
        }
        $dir->close();

        return $files;
    }

    public static function hapikey(string $value=null): ?string
    {
        if ($value) {
            self::$apiKey = $value;

            return self::$apiKey;
        }

        if (self::$apiKey) {
            return self::$apiKey;
        }

        return null;
    }
}
