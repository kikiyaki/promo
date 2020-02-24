<?php


namespace User;


use promo\MyPDO;

/**
 * Base user
 */
class UserStd implements User
{
    private $id;
    private $pdo;

    public function __construct($id, $pdo = null)
    {
        $this->id = $id;
        $this->pdo = $pdo ? $pdo : new MyPDO();
    }


    public function append($id)
    {
        if ($id == $this->id) {
            return false;
        }

        $query = "SELECT data
                 FROM users
                 WHERE id=$this->id";
        $user = $this->pdo->query($query)->fetch();
        if (!$user) {
            return false;
        }

        $data = json_decode($user['data'], true);
        $forMe = $data['forMe'];
        // Check if already there is id in current user`s list forMe
        if (in_array($id, $forMe)) {
            return false;
        }

        $forMe[] = $id;
        $data['forMe'] = $forMe;
        $dataJSON = json_encode($data);

        $query = "UPDATE users
                 SET data='$dataJSON'
                 WHERE id=$this->id";
        $this->pdo->exec($query);
        return true;
    }


    public function unlock()
    {
        // @todo implement method
        return true;
    }
}
