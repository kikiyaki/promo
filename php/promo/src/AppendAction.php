<?php

namespace promo;

use User\UserStd;

class AppendAction implements Action
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
        $userId = $this->GET['userId'];
        $forUserId = $this->GET['forUserId'];

        $user = new UserStd($forUserId);
        if ($user->append($userId)) {
            $response = 'success';
        } else {
            $response = 'error';
        }
        return $response;
    }
}