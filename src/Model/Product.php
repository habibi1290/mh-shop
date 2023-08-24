<?php
namespace Mh\Shop\Model;

class Product
{
    protected int $id;
    protected int $articleId;
    protected string $name;
    protected string $description;
    protected int $manufacturerId;
    protected int $stock;
    protected bool $is_online;
    protected float $price;
    protected float $totalPrice;
    //private $property;

    /*public function setId($id) {
        $this->id = $id;
    }

    public function getId():int {
        return $this->id;
    }

    public function setArticleId($articleId) {
        $this->articleId = $articleId;
    }

    public function getArticleId():int {
        return $this->articleId;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getName():string {
        return $this->name;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getDescription():string {
        return $this->description;
    }

    public function setManufacturerId($manufacturerId) {
        $this->manufacturerId = $manufacturerId;
    }

    public function getManufacturerId():int {
        return $this->manufacturerId;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }

    public function getStock():int {
        return $this->stock;
    }

    public function setIsOnline($is_online) {
        $this->is_online = $is_online;
    }

    public function getIsOnline():bool {
        return $this->is_online;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getPrice():float {
        return $this->price;
    }

    public function setTotalPrice($totalPrice) {
        $this->price = $totalPrice;
    }

    public function getTotalPrice():float {
        return $this->totalPrice;
    }
}*/
    //protected $property;

    //zugriff auf eigenschaften der klasse über setter und getter methode, ohne diese explizit zu definieren
   /* public function __call(string $method, array $args)
    {
        $property = lcfirst(substr($method, 3));
        if (strpos($method, 'get') === 0 && property_exists($this, $property)) {
            return $this->$property;
        } elseif (strpos($method, 'set') === 0 && property_exists($this, $property)) {
            $this->$property = $args[0];
        } else {
            throw new \BadMethodCallException("Method {$method} does not exist.");
        }
    }
}*/

    /**
     * @param string $method
     * @param array<mixed> $args
     * @return mixed
     */
    public function __call(string $method, array $args = []): mixed
    {
        $property = lcfirst(substr($method, 3));
        if (strpos($method, 'get') === 0 && property_exists($this, $property)) {
            return $this->$property;
        } elseif (strpos($method, 'set') === 0 && property_exists($this, $property)) {
            $setterMethod = 'set' . ucfirst($property);
            if (method_exists($this, $setterMethod)) {
                $this->$setterMethod($args[0]);
            } else {
                throw new \BadMethodCallException("Setter method for property {$property} does not exist.");
            }
        }
        throw new \BadMethodCallException("Method {$method} does not exist.");
    }
}


    /*public function __call(string $method, array $args)
    {
        $property = lcfirst(substr($method, 3));
        if (strpos($method, 'get') === 0 && property_exists($this, $property)) {
            return $this->$property;
        } elseif (strpos($method, 'set') === 0 && property_exists($this, $property)) {
            $setterMethod = 'set' . ucfirst($property);
            if (method_exists($this, $setterMethod)) {
                // Überprüfe, ob die Setter-Methode `protected` ist
                $reflectionMethod = new ReflectionMethod($this, $setterMethod);
                if ($reflectionMethod->isProtected()) {
                    $this->$setterMethod($args[0]);
                    return;
                }
            }
        }
        throw new \BadMethodCallException("Method {$method} does not exist or is not accessible.");
    }
}*/






