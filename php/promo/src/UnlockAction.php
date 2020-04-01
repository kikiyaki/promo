<?php

namespace promo;

use User\UserStd;
use Exception;

/**
 * Checks if user reach required 'forMe' users count
 *
 * @param 'user_code' unique user code
 * @return [ ... , 'data' => [ 'unlock' => '1' ] , ... ]
 * 1 - true, 0 - false
 */
class UnlockAction extends ActionStd
{
    private $GET;
    private $responseData;
    private $promoCode;

    public function __construct($GET = null, $responseData = null, $promoCode = null)
    {
        $this->GET = $GET ? $GET : $_GET;
        $this->responseData = $responseData ? $responseData : new ResponseData();
        $this->promoCode = $promoCode ? $promoCode : new PromoCode();
    }

    public function handle()
    {
        $userCode = $this->GET['user_code'];
        $userId = $this->promoCode->idByCode($userCode);
        $user = new UserStd($userId);

        try {
            $this->responseData->setStatus(ResponseData::SUCCESS);
            if ($user->unlock()) {
                $this->responseData->setData('unlock', true);
            } else {
                $this->responseData->setData('unlock', false);
            }
        } catch (Exception $e) {
            $this->responseData->setStatus(ResponseData::ERROR);
        }

        return $this->responseData->stringify();
    }
}