<?php

class UserTableGateway {

    private $connection;

    public function __construct($c) {
        $this->connection = $c;
    }

    public function getUserByUsername($username) {
        $sqlQuery = "SELECT * FROM users WHERE username = :username";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "username" => $username
        );

        $statues = $statement->execute($params);

        if (!$statues) {
            die("could not retrieve users");
        }

        return $statement;
    }

    public function insertUser($username, $password) {
        $sqlInsert = "INSERT INTO users (username, password) VALUES (username, password)";

        $statment = $this->connection->prepare($sqlInsert);

        $params = array(
            "username" => $username, "password" => $password
        );

        $status = $statment->execute($params);

        if (!$status) {
            die("could not insert new user");
        }
    }

}
