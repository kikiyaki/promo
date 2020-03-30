<?php

namespace User;

interface User
{
    /**
     * Add user with $id to current user
     *
     * Return true if success
     * Else return false
     *
     * @param $id
     * @return bool
     */
    public function append($id);

    /**
     * Unlock current user
     *
     * Return true if user has reached necessary number users for him
     * Else return false
     *
     * @return bool
     */
    public function unlock();

    /**
     * User info
     *
     * @return array
     */
    public function info();

    /**
     * Check unique user key
     *
     * @param string $key
     * @return bool
     */
    public function checkKey($key);
}