<?php

namespace promo;

class MyPDO extends \PDO
{

    public function __construct()
    {
        $host = 'pgsql';
        $db = 'promo';
        $user = 'promo';
        $pass = 'promo';

        $dsn = "pgsql:host=$host;dbname=$db";

        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];

        parent::__construct($dsn, $user, $pass, $options);
    }
}