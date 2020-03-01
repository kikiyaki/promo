<?php


namespace promo;


use User\UserStd;

class UnlockAction implements Action
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
        $userId = $this->GET['id'];
        $user = new UserStd($userId);
        if ($user->unlock()) {
            return 'success';
        } else {
            return 'error';
        }
    }
}