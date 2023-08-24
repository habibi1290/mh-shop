<?php

namespace Mh\Shop\Model;

class Login {
    protected string $username;
    protected string $password;

    public function setUserName(string $username):void {
        $this->username  = $username;
    }

    public function getUserName():string{
        return $this->username;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getPassword():string{
        return $this->password;
    }

}
