<?php
namespace Mh\Shop\Repository;
use PDO;
use Exception;



class CartRepository extends AbstractRepository
{
    public function getIdAndSaveInSession(int $productId): mixed
    {
        return $_SESSION['cart'][$productId] = (array_key_exists($productId, $_SESSION['cart'])) ? (int)$_SESSION['cart'][$productId]++ : 1;
    }

    public function insertToDb(string $name, string $lastName, string $email, string $password, string $street, int $houseNumber, string $postalCode, string $telefonNumber): mixed
    {
        $stmt = $this->connection->prepare('INSERT INTO users(name, lastname, email, password, street, housenumber, postalcode, telefonnumber) VALUES (:name, :lastname, :email, :password, :street, :housenumber, :postalcode, :telefonnumber)');
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':lastname', $lastName);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
        $stmt->bindValue(':street', $street);
        $stmt->bindValue(':housenumber', $houseNumber);
        $stmt->bindValue(':postalcode', $postalCode);
        $stmt->bindValue(':telefonnumber', $telefonNumber);
        return $stmt->execute();

    }
    public function getUsers(): mixed
    {
        $stmt = $this->connection->query('SELECT * FROM `users`');

        if ($stmt == false) {
            throw new Exception('Query failed');
        }

        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'Mh\Shop\Model\Cart');

        if ($result == false) {
            throw new Exception('Fetch failed');
        }

        return $result;
    }

    public function checkIfEmailExist(string $email): mixed
    {
        $stmt = $this->connection->prepare('SELECT COUNT(*) FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $count =  $stmt->fetchColumn();
        return $count > 0;
    }
}

