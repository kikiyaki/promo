<?php


namespace promo;


use User\UserStd;

class UnlockAction implements Action
{
    private $GET;

    public function __construct($GET = null)
    {
        $this->GET = $GET ? $GET : $_GET;
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