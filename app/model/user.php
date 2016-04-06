<?php
namespace Model;

class User extends \Model
{

    /**
     * Generates and set the password_hash value
     * @param  string $password
     */
    function setPassword($password) {
        $this->password_hash = password_hash($password, PASSWORD_DEFAULT);
    }

}
