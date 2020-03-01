<?php

namespace promo;

/**
 * @return [ ... , 'status' => 'NOT_FOUND' , ... ]
 */
class NotFoundAction implements Action
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
        $this->responseData->setStatus(ResponseData::NOT_FOUND);
        return $this->responseData->stringify();
    }
}