<?php
namespace Mh\Shop\Model;

class Cart {

    protected string $name;
    protected string $lastName;
    protected string $email;
    protected string $password;
    protected string $street;
    protected int $houseNumber;
    protected string $postalCode;
    protected string $telefonNo;





    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getLastName():string
    {
        return $this->lastName;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail():string
    {
        return $this->email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPassword():string
    {
        return $this->password;
    }

    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    public function getStreet():string
    {
        return $this->street;
    }

    public function setHouseNumber(int $houseNumber): void
    {
        $this->houseNumber = $houseNumber;
    }

    public function getHouseNumber():int
    {
        return $this->houseNumber;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getPostalCode():string
    {
        return $this->postalCode;
    }

    public function setTelefonNo(string $telefonNo): void
    {
        $this->telefonNo = $telefonNo;
    }

    public function getTelefonNo():string
    {
        return $this->telefonNo;
    }

}