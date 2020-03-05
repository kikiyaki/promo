<?php

namespace promo;

/**
 * @return [ ... , 'status' => 'WRONG_KEY' , ... ]
 */
class WrongKeyAction implements Action
{
    private $GET;
    private $responseData;

    public function __construct($GET = null, $responseData = null)
    {
        $this->GET = $GET ? $GET : $_GET;
        $this->responseData = $responseData ? $responseData : new ResponseData();
    }

    public function handle()
    {
        $this->responseData->setStatus(ResponseData::WRONG_KEY);
        return $this->responseData->stringify();
    }
}