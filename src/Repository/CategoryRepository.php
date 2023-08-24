<?php

namespace Mh\Shop\Repository;
use PDO;
use Exception;

class CategoryRepository extends AbstractRepository
{ //setFetchMode() = Setze den Standard fetch modus für die Anweisung.
    //PDO::FETCH_CLASS = Um Daten aus der Tabelle (Product) auszuwählen und die Spalten den Eigenschaften ein Product Objekt zuzuordnen,
    // kann man den PDO::FETCH_CLASS verwenden.
    public function getCategories(): mixed
    {
        $stmt = $this->connection->query('SELECT * FROM `category`');

        if ($stmt == false) {
            throw new Exception('Query failed');
        }

        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'Mh\Shop\Model\Category');

        if ($result == false) {
            throw new Exception('Fetch failed');
        }

        return $result;
    }

    public function delete(int $id): mixed
    {
        //prepare gibt eine Anweisung Object zurück.
        $stmt = $this->connection->prepare('DELETE FROM `category` WHERE id=:id');
        $stmt->bindValue(':id',$id);
        return $stmt->execute();
    }

    //Eine suche die nach ID sucht
    public function get(int $id): mixed
    {
        $stmt = $this->connection->prepare('SELECT * FROM `category` WHERE `id`=?');
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Mh\Shop\Model\Category');
        return $stmt->fetch();
    }

    public function getCategoriesExceptOneById(int $id): mixed
    {
        $stmt = $this->connection->prepare('SELECT * FROM `category` WHERE `id`!=:id');
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Mh\Shop\Model\Category');
        return $stmt->fetchAll();
    }

    public function update(int $id, string $name, int $parent_id): mixed
    {
        $stmt = $this->connection->prepare('UPDATE `category` SET `name` = :name, `parent_id` = :parent_id WHERE `id` = :id');
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':parent_id', $parent_id);
        return $stmt->execute();

    }

    public function getSameCategoryWithIdAndParentId(): mixed
    {
        $stmt = $this->connection->query('SELECT * FROM category WHERE parent_id in (SELECT id FROM category)');
        if ($stmt == false) {
            throw new Exception('Query failed');
        }

        $result = $stmt->fetchAll(PDO::FETCH_CLASS, 'Mh\Shop\Model\Category');

        if ($result == false) {
            throw new Exception('Fetch failed');
        }

        return $result;
    }
}
