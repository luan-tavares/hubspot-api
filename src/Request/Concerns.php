<?php

namespace DevHokage\HubspotAPI\Request;

use Exception;

trait Concerns
{
    use \DevHokage\HubspotAPI\Request\Concerns\Get;
    use \DevHokage\HubspotAPI\Request\Concerns\Post;
    use \DevHokage\HubspotAPI\Request\Concerns\Put;
    use \DevHokage\HubspotAPI\Request\Concerns\Delete;
    use \DevHokage\HubspotAPI\Request\Concerns\Patch;

    /**
     * @var array|null
     */
    private $body;

    /**
     * @var array|null
     */
    private $header;

    /**
     * @var string|null
     */
    private $httpMethod;

    private function curlBody($data = null): Builder
    {
        if ($this->httpMethod === "GET") {
            throw new Exception("GET Method haven't body", 1);
        }

        $this->body= (empty($data))?(null):($data);


        return $this;
    }

    private function makeCurl()
    {
        $params = [
            "uri" => $this->makeURI(),
            "body" => $this->body,
            "header" => $this->header,
            "method" => $this->httpMethod,
        ];

        //dd($params);

        $this->reset();

        return Curl::connect($params);
    }

    private function useFormUrlencoded(array $values)
    {
        if (!$values) {
            return $this;
        }
          
        $this->addOrChangeHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
  
        $this->body = http_build_query($values);
  
        return $this;
    }

    private function addOrChangeHeader($name, $value)
    {
        $this->header[$name] = $value;

        return $this;
    }

    public function oAuth(string $oAuth)
    {
        $this->header["Authorization"] = "Bearer {$oAuth}";

        return $this;
    }

    private function reset()
    {
        $this->header = self::HUBSPOT_DEFAULT_HEADER;
        $this->httpMethod = self::HUBSPOT_DEFAULT_HTTP_METHOD;
        $this->body = null;
        $this->uriQueries = [
            "limit" => self::HUBSPOT_DEFAULT_LIMIT,
        ];
    }
}
