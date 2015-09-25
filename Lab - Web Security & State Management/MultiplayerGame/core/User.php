<?php
namespace Core;

class User 
{
    private $id;
    private $username;
    private $password;
    private $gold;
    private $food;
    
    const GOLD_DEFAULT = 1500;
    const FOOD_DEFAULT = 1500;

    public function __construct($username, $password, $id = null, $gold = null, $food = null) 
    {
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setId($id);
        $this->setGold($gold);
        $this->setFood($food);
    }
    
    function getId() 
    {
        return $this->id;
    }

    function getUsername() 
    {
        return $this->username;
    }

    function getPassword() 
    {
        return $this->password;
    }

    function getGold() 
    {
        return $this->gold;
    }

    function getFood() 
    {
        return $this->food;
    }
    
    function setId($id) 
    {
        $this->id = $id;
    }

    function setUsername($username) 
    {
        $this->username = $username;
        return $this;
    }

    function setPassword($password) 
    {
        $this->password = $password;
        return $this;
    }

    function setGold($gold) 
    {
        $this->gold = $gold;
        return $this;
    }

    function setFood($food) 
    {
        $this->food = $food;
        return $this;
    }
}