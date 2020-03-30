<?php

namespace promo;

/**
 * Create new user action
 *
 * @noparam
 * @return [ ... , 'data' => [ 'user_id' => NEW_USER_ID ], ... ]
 */
class CreateAction extends ActionStd
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
        $randomKey = hash('sha256', rand(0, 999999999));

        $query =
<<<SQL
INSERT INTO users (data, key)
    VALUES
    ('
        {
        "my":{},
        "forMe":{}
         }
    ',
     '$randomKey')
    RETURNING id, key;
SQL;

        $pdo = new MyPDO();
        $return = $pdo->query($query)->fetch();
        $newUserId = $return['id'];
        $newUserKey = $return['key'];

        $this->responseData->setStatus(ResponseData::SUCCESS);
        $this->responseData->setData('NEW_USER_ID', $newUserId);
        $this->responseData->setData('NEW_USER_KEY', $newUserKey);

        return $this->responseData->stringify();
    }
}
