<?php

namespace DevHokage\HubspotAPI\Request;

class Uri
{
    private $uri;
    
    public function __construct(?string $hapikey, array $uriQueries)
    {
        $this->uri = $this->setUriQuery($hapikey, $uriQueries);
    }

    public function __toString()
    {
        return $this->uri;
    }

    private function setUriQuery(?string $hapikey, array $uriQueries): string
    {
        $query = "?";

        if ($hapikey) {
            $query .= "hapikey=". $hapikey;
        }

        if (empty($uriQueries)) {
            return $query;
        }
  
        $query .= "&".http_build_query($uriQueries);

        if (isset($uriQueries["properties"]) && is_array($uriQueries["properties"])) {
            foreach ($uriQueries["properties"] as $property) {
                $query .= "&property=" . $property;
            }
        }

        if (isset($uriQueries["vids"])) {
            foreach ($uriQueries["vids"] as $property) {
                $query .= "&vid=" . $property;
            }
        }

        if (isset($uriQueries["emails"])) {
            foreach ($uriQueries["emails"] as $property) {
                $query .= "&email=" . $property;
            }
        }
  




        return preg_replace("/%5B[0-9]+%5D/i", "", $query);
    }
}
