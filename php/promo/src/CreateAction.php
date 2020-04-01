<?php

namespace promo;

/**
 * Create new user action
 *
 * @noparam
 * @return [ ... , 'data' => [ 'NEW_USER_CODE' => NEW_USER_CODE ], ... ]
 */
class CreateAction extends ActionStd
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
        $query =
<<<SQL
INSERT INTO users (data, key)
    VALUES
    ('
        {
        "my":{},
        "forMe":{}
         }
    ')
    RETURNING id;
SQL;

        $pdo = new MyPDO();
        $return = $pdo->query($query)->fetch();
        $newUserId = $return['id'];
        $newUserCode = $this->promoCode->codeById($newUserId);

        $this->responseData->setStatus(ResponseData::SUCCESS);
        $this->responseData->setData('NEW_USER_CODE', $newUserCode);

        return $this->responseData->stringify();
    }
}
