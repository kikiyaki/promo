<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/MyPDO.php';

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

echo $return['id'];


/*
$q = "SELECT * FROM users;";

echo '<pre>';
print_r($pdo->query($q)->fetchAll());
echo '</pre>';
*/

