<?php

namespace Mh\Shop\Repository;
use PDO;

class LoginRepository extends AbstractRepository
{

    protected function ensureSession(): void{
        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function handleLogin(string $email, string $password): mixed
    {
        $stmt = $this->connection->prepare('SELECT * FROM `users` WHERE `email` = :email');
        $stmt->bindValue(':email', $email);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Mh\Shop\Model\Login');
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user !== false && password_verify($password, $user->getPassword())) {
        $this->ensureSession();
        session_regenerate_id();
        $_SESSION['adminLogin'] = $email;
        $_SESSION['adminLoginTimestamp'] = time();
        return true;
        } else {
            echo 'Passwort oder Email falsch';
            return false;
        }
    }

    public function logout(): bool
    {
        $this->ensureSession();
        unset($_SESSION['adminLogin']);
        return true;
    }

}