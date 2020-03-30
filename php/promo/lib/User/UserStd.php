<?php

namespace User;

use promo\MyPDO;
use Exception;

/**
 * Base user
 */
class UserStd implements User
{
    private $id;
    private $pdo;
    const FOR_ME_THRESHOLD = 1;
    const MAX_APPEND_NUMBER = 1;

    public function __construct($id, $pdo = null)
    {
        $this->id = $id;
        $this->pdo = $pdo ? $pdo : new MyPDO();
    }


    /**
     * Add user id to this user`s 'forMe' list
     * and this user to with id user 'me' list
     *
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function append($id)
    {
        if ($id == $this->id) {
            return false;
        }
        // Check user
        $query = "SELECT data
                 FROM users
                 WHERE id=$this->id";
        $user = $this->pdo->query($query)->fetch();
        if (!$user) {
            throw new Exception('No such user');
        }
        $data = json_decode($user['data'], true);
        $forMe = $data['forMe'];
        // Check if already there is id in current user`s list forMe
        if (in_array($id, $forMe)) {
            return false;
        }

        // Check appended user
        $queryAppended = "SELECT data
                 FROM users
                 WHERE id=$id";
        $appendedUser = $this->pdo->query($queryAppended)->fetch();
        if (!$appendedUser) {
            throw new Exception('No such appended user');
        }
        $appendedUserData = json_decode($appendedUser['data'], true);
        $appendedMy = $appendedUserData['my'];
        if (count($appendedMy) >= self::MAX_APPEND_NUMBER) {
            return false;
        }

        // Append
        $forMe[] = $id;
        $data['forMe'] = $forMe;
        $dataJSON = json_encode($data);
        $query = "UPDATE users
                 SET data='$dataJSON'
                 WHERE id=$this->id";
        $this->pdo->exec($query);

        $appendedMy[] = $this->id;
        $appendedUserData['my'] = $appendedMy;
        $appendedUserDataJSON = json_encode($appendedUserData);
        $queryAppended = "UPDATE users
                 SET data='$appendedUserDataJSON'
                 WHERE id=$id";
        $this->pdo->exec($queryAppended);

        return true;
    }


    public function unlock()
    {
        $query = "SELECT data
                 FROM users
                 WHERE id=$this->id";
        $user = $this->pdo->query($query)->fetch();
        if (!$user) {
            throw new Exception('No such user');
        }

        $user = json_decode($user['data'], true);
        $forMeIds = $user['forMe'];
        if (count($forMeIds) >= self::FOR_ME_THRESHOLD) {
            return true;
        } else {
            return false;
        }
    }


    public function info()
    {
        $userInfo = $this->pdo->query("SELECT * FROM users
                                    WHERE id=$this->id")->fetch();
        if (!$userInfo) {
            throw new Exception('No such user');
        }
        return $userInfo;
    }


    public function checkKey($key)
    {
        $userInfo = $this->info();

        if ($userInfo['key'] === $key) {
            return true;
        } else {
            return false;
        }
    }
}
