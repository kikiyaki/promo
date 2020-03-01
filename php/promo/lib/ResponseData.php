<?php

namespace promo;

use Exception;

/**
 * Response JSON data
 */
class ResponseData
{
    private $arrayResponse = ['data' => []];


    /**
     * Set responded data value
     *
     * @param string $key
     * @param string $value
     */
    public function setData($key, $value)
    {
        $this->arrayResponse['data'][$key] = $value;
    }


    /**
     * Json encoded response
     *
     * @return string
     */
    public function stringify()
    {
        $stringifyResponse = json_encode($this->arrayResponse);
        if (!$stringifyResponse) {
            throw new Exception('Error while json encoding');
        }
        return $stringifyResponse;
    }
}