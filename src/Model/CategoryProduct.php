<?php
namespace Mh\Shop\Model;

class CategoryProduct {
    protected int $category_id;
    protected int $product_id;

    public function setCategoryId(int $category_id): void {
        $this->category_id  = $category_id;
    }

    public function getCategoryId():int{
        return $this->category_id;
    }

    public function setProductId(int $product_id): void {
        $this->product_id  = $product_id;
    }

    public function getProductId():int{
        return $this->product_id;
    }

}
