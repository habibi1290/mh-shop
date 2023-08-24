<?php

namespace Mh\Shop\Repository;
use PDO;
use Exception;
class ProductRepository extends AbstractRepository
{
    public function getProducts(): mixed
    {
        $stmt = $this->connection->query('SELECT * FROM `products`');
        if ($stmt == false) {
            throw new Exception('Query failed');
        }

        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'Mh\Shop\Model\Product');

        if ($result == false) {
            throw new Exception('Fetch failed');
        }

        return $result;
    }

    public function delete(int $id): mixed
    {
        //prepare gibt eine Anweisung Object zurück.
        $stmt = $this->connection->prepare('DELETE FROM `products` WHERE id=:id');
        $stmt->bindValue(':id',$id);
        return $stmt->execute();
    }

    public function getProductsExceptOneById(int $id):  mixed
    {
        $stmt = $this->connection->prepare('SELECT * FROM `products` WHERE `id`!=:id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Mh\Shop\Model\Product');
        return $stmt->fetchAll();
    }

    //Eine suche die nach ID sucht
    public function get(int $id): mixed
    {
        $stmt = $this->connection->prepare('SELECT * FROM `products` WHERE `id`=?');
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Mh\Shop\Model\Product');
        return $stmt->fetch();
    }

    public function update(int $id, string $name, string $description): mixed
    {
        $stmt = $this->connection->prepare('UPDATE `products` SET `name` = :name, `description` = :description WHERE `id` = :id');
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':description', $description);
        return $stmt->execute();
    }
}

