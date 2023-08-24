<?php

namespace Mh\Shop\Repository;
use PDO;

class CategoryProductRepository extends AbstractRepository
{

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
        $stmt = $this->connection->prepare('SELECT * FROM `category` WHERE id=?');
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Mh\Shop\Model\Category');
        return $stmt->fetch();
    }

    public function prepareCategoryProductRelation(int $category_id): mixed
    {
        $stmt = $this->connection->prepare('DELETE FROM `category_product` WHERE category_id = :category_id');
        $stmt->bindValue(':category_id', $category_id);
        return $stmt->execute();
    }

    public function prepareProductCategoryRelation(int $product_id): mixed
    {
        $stmt = $this->connection->prepare('DELETE FROM `category_product` WHERE product_id = :product_id');
        $stmt->bindValue(':product_id', $product_id);
        return $stmt->execute();
    }

    public function insert(int $categoryId, int $productId): mixed
    {
        $stmt = $this->connection->prepare('INSERT INTO category_product SET category_id = :category_id, product_id = :product_id');
        $stmt->bindValue(':category_id', $categoryId);
        $stmt->bindValue(':product_id', $productId);
        return $stmt->execute();
    }

    public function categoryBelongToProduct(int $productId): mixed
    {
        $stmt = $this->connection->prepare('SELECT * FROM category JOIN category_product ON category.id = category_product.category_id WHERE product_id = :product_id');
        $stmt->bindValue(':product_id', $productId);
        $stmt->execute();
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
}

