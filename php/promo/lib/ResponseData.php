<?php

namespace promo;

use Exception;

/**
 * Response JSON data
 */
class ResponseData
{
    private $arrayResponse = [
        'data' => [],
        'status' => null
    ];

    // Allowed status values
    const SUCCESS = 'SUCCESS';
    const ERROR = 'ERROR';
    const NOT_FOUND = 'NOT_FOUND';


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
     * Set response status
     *
     * @param $value
     */
    public function setStatus($value)
    {
        $this->arrayResponse['status'] = $value;
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