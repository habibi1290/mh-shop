<?php
namespace Mh\Shop\Model;

class Category {
    protected int $id;
    protected string $name;
    protected int $parent_id;


    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getId():int{
        return $this->id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getName():string{
        return $this->name;
    }

    public function setParentId(int $parent_id): void {
        $this->parent_id = $parent_id;
    }

    public function getParentId():int{
        return $this->parent_id;
    }

}
