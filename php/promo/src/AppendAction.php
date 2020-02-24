<?php


namespace promo;


use User\UserStd;

class AppendAction implements Action
{
    private $GET;


    public function __construct($GET = null)
    {
        $this->GET = $GET ? $GET : $_GET;
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