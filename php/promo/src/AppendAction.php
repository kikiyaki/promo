<?php


namespace promo;


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

        return $return['id'];
    }
}