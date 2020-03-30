<?php

namespace promo;

use User\UserStd;
use Exception;

/**
 * Add user1 to user2`s 'forMe' list
 * and user2 to user1`s 'me' list
 *
 * @param 'userId' added user id
 * @param 'forUserId'
 * @return [ ... , 'status' => 'STATUS' , ... ]
 */
class AppendAction extends ActionStd
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
        $userKey = $this->GET['key'];

        $appendedUser = new UserStd($userId);
        $user = new UserStd($forUserId);

        try {
            if ($appendedUser->checkKey($userKey)) {
                if ($user->append($userId)) {
                    $this->responseData->setStatus(ResponseData::SUCCESS);
                } else {
                    $this->responseData->setStatus(ResponseData::ERROR);
                }
            } else {
                $this->responseData->setStatus(ResponseData::WRONG_KEY);
            }
        } catch (Exception $e) {
            $this->responseData->setStatus(ResponseData::ERROR);
        }

        return $this->responseData->stringify();
    }
}