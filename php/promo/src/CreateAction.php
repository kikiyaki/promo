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
        $query =
<<<SQL
INSERT INTO users (data)
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

        $this->responseData->setStatus(ResponseData::SUCCESS);
        $this->responseData->setData('NEW_USER_ID', $newUserId);
        return $this->responseData->stringify();
    }
}
