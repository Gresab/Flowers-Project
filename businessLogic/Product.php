<?php

class Product{
    private $name;
    private $price;
    private $description;
    private $quantity;
    private $image;

    public function __construct($name, $price, $description,$quantity, $image){
        $this->name=$name;
        $this->price = $price;
        $this->description=$description;
        $this->quantity=$quantity;
        $this->image=$image;
    }

    public function getname(){
        return $this->name;
    }

    public function getPrice(){
        return $this->price;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getQuantity(){
        return $this->quantity;
    }
    public function getImage(){
        return $this->image;
    }
}