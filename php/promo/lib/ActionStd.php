<?php

namespace promo;

/**
 * Implements key check
 *
 * If key is correct, run user handle() function,
 * else give WrongKeyAction
 *
 * @param 'key'
 */
abstract class ActionStd implements Action
{
    public function run()
    {
        // Check key
        if (isset($_GET['key'])) {
            $key = $_GET['key'];
            if ($key === Config::KEY) {
                return $this->handle();
            }
        }
        return (new WrongKeyAction())->handle();
    }

    abstract function handle();
}