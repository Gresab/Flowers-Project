<?php

require_once "Database.php";

class ProductMapper extends DatabaseConfig
{
    private $connection;
    private $query;

    public function __construct()
    {
        $this->connection = $this->getConnection();
    }

    public function insertProduct($product)
    {
        $this->query = "insert into products (name, price, description, quantity, image, ) 
            values (:name, :price, :description, :quantity, :image)";
        $statement = $this->connection->prepare($this->query);
        $name = $product->getName();
        $price = $product->getPrice();
        $description = $product->getDescription();
        $quantity = $product->getQuantity();
        $image = $product->getImage();
        $statement->bindParam(":name", $name);
        $statement->bindParam(":price", $price);
        $statement->bindParam(":description", $description);
        $statement->bindParam(":quantity", $quantity);
        $statement->bindParam(":image", $image);
        $statement->execute();
        return true;
    }

    public function getAllProducts()
    {
        $this->query = "select * from products order by id desc";
        $statement = $this->connection->prepare($this->query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getRecentProducts()
    {
        $this->query = "select * from (select * from products order by id desc limit 8)var1 order by id desc";
        $statement = $this->connection->prepare($this->query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getProductsById($id)
    {
        $this->query = "select * from products where id=:id";
        $statement = $this->connection->prepare($this->query);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    public function deleteProduct($id)
    {
        $this->query = "delete from products where id=:id";
        $statement = $this->connection->prepare($this->query);
        $statement->bindParam(":id", $id);
        $statement->execute();
    }

    public function updateProduct($id, $name, $price, $description, $quantity)
    {
        $this->query = "update products set name=:name, price=:price, description=:desc, quantity=:quantity where id=:id";
        $statement = $this->connection->prepare($this->query);
        $statement->bindParam(":name", $name);
        $statement->bindParam(":price", $price);
        $statement->bindParam(":desc", $description);
        $statement->bindParam(":quantity", $quantity);
        $statement->bindParam(":id", $id);
        $statement->execute();
    }

    public function promoteProduct($id)
    {
        $this->query = "update products set show=1 where id=:id";
        $statement = $this->connection->prepare($this->query);
        $statement->bindParam(":id", $id);
        $statement->execute();
    }

    public function demoteProduct($id)
    {
        $this->query = "update products set show=0 where id=:id";
        $statement = $this->connection->prepare($this->query);
        $statement->bindParam(":id", $id);
        $statement->execute();
    }

    public function getPromotedProducts()
    {
        $this->query = "select * from products where show=1";
        $statement = $this->connection->prepare($this->query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
