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
        CURLOPT_MAXREDIRS => -1,
        //CURLOPT_NOPROGRESS => false,
        CURLOPT_POSTFIELDS     => null,
        CURLOPT_TIMEOUT => 0,
    ];
    private const JSON_ENCODE = JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;

    private static $curl;

    private static $params;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function connect(array $params): ?string
    {
        self::$params = $params;

        self::$curl = self::CURL_PARAMS;
        
        self::resolveHeader()::resolveMethod()::resolveBody();
  
        $request = curl_init($params['uri']);
  
        foreach (self::$curl as $index => $value) {
            curl_setopt($request, $index, $value);
        }

        $response = curl_exec($request);

        curl_close($request);
  
        return $response;
    }

    private static function resolveBody()
    {
        $body = self::$params['body'];

        if (!$body) {
            unset(self::$curl[CURLOPT_POSTFIELDS]);

            return __CLASS__;
        }

        if (is_array($body) && !(@self::$params['header']['Content-Type'] === 'multipart/form-data')) {
            $body = json_encode($body, self::JSON_ENCODE);
        }
        self::$curl[CURLOPT_POSTFIELDS] = $body;

        return __CLASS__;
    }
  
    private static function resolveMethod()
    {
        $method = self::$params['method'];

        self::$curl[CURLOPT_CUSTOMREQUEST] = $method;

        return __CLASS__;
    }
  
    private static function resolveHeader()
    {
        $header = self::$params['header'];

        $resolveHeader = [];
        foreach ($header as $name => $value) {
            $resolveHeader[] = "{$name}: {$value}";
        }
        self::$curl[CURLOPT_HTTPHEADER] = $resolveHeader;

        return __CLASS__;
    }
}
