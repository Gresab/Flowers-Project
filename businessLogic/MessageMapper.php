<?php 

require_once "Database.php";

class MessageMapper extends DatabaseConfig {
    private $connection;
    private $query;

    public function __construct(){
        $this->connection = $this->getConnection();
    }

    public function insertMessage($name, $lastname, $email, $msg){
        $this->query = "insert into messages (name, lastname, email, message) values (:name, :lastname, :email, :message)";
        $statement = $this->connection->prepare($this->query);
        $statement->bindParam(":name", $name);
        $statement->bindParam(":lastname", $lastname);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":message", $msg);
        $statement->execute();
    }

    public function getAllMessages(){
        $this->query = "select * from messages order by id desc";
        $statement = $this->connection->prepare($this->query);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getMessageById($id){
        $this->query = "select * from messages where id=:id";
        $statement = $this->connection->prepare($this->query);
        $statement->bindParam(":id", $id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function deleteMessage($id){
        $this->query = "delete from messages where id=:id";
        $statement = $this->connection->prepare($this->query);
        $statement->bindParam(":id", $id);
        $statement->execute();
    }

}