<?php

namespace promo;

use User\UserStd;
use Exception;

/**
 * Add user1 to user2`s 'forMe' list
 * and user2 to user1`s 'me' list
 *
 * @param 'user_code' added user id
 * @param 'for_user_code'
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
        $userCode = $this->GET['user_code'];
        $forUserCode = $this->GET['for_user_code'];

        $promoCode = new PromoCode();
        $userId = $promoCode->idByCode($userCode);
        $forUserId = $promoCode->idByCode($forUserCode);

        $appendedUser = new UserStd($userId);
        $user = new UserStd($forUserId);

        try {
            if ($user->append($userId)) {
                $this->responseData->setStatus(ResponseData::SUCCESS);
            } else {
                $this->responseData->setStatus(ResponseData::ERROR);
            }
        } catch (Exception $e) {
            $this->responseData->setStatus(ResponseData::ERROR);
        }

        return $this->responseData->stringify();
    }
}