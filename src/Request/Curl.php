<?php

namespace DevHokage\HubspotAPI\Request;

abstract class Curl
{
    private const CURL_PARAMS = [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_HTTPHEADER     => null,
        CURLOPT_CUSTOMREQUEST  => null,
        CURLOPT_POSTFIELDS     => null,
    ];
    private const JSON_ENCODE = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;

    private static $curl;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function connect(array $params): ?string
    {
        self::$curl = self::CURL_PARAMS;
        
        self::resolveHeader($params['header'])
        ::resolveMethod($params['method'])
        ::resolveBody($params['body']);
  
        $request = curl_init($params['uri']);
  
        foreach (self::$curl as $index => $value) {
            curl_setopt($request, $index, $value);
        }

        $response = curl_exec($request);

        curl_close($request);
  
        return $response;
    }

    private static function resolveBody($body)
    {
        if (!$body) {
            unset(self::$curl[CURLOPT_POSTFIELDS]);

            return __CLASS__;
        }

        if (is_array($body)) {
            $body = json_encode($body, self::JSON_ENCODE);
        }
        self::$curl[CURLOPT_POSTFIELDS] = $body;

        return __CLASS__;
    }
  
    private static function resolveMethod($method)
    {
        self::$curl[CURLOPT_CUSTOMREQUEST] = $method;

        return __CLASS__;
    }
  
    private static function resolveHeader(array $header)
    {
        $resolveHeader = [];
        foreach ($header as $name => $value) {
            $resolveHeader[] = "{$name}: {$value}";
        }
        self::$curl[CURLOPT_HTTPHEADER] = $resolveHeader;

        return __CLASS__;
    }
}