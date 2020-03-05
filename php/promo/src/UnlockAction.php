<?php

namespace promo;

use User\UserStd;
use Exception;

/**
 * Checks if user reach required 'forMe' users count
 *
 * @param 'id' user id
 * @return [ ... , 'data' => [ 'unlock' => '1' ] , ... ]
 * 1 - true, 0 - false
 */
class UnlockAction extends ActionStd
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