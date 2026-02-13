<?php

class Contact {

    private $conn;
    private $table = "contacts";

    public $name;
    public $email;
    public $message;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {

        $query = "INSERT INTO " . $this->table . "
                  SET name=:name, email=:email, message=:message";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->message = htmlspecialchars(strip_tags($this->message));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":message", $this->message);

        return $stmt->execute();
    }
}
