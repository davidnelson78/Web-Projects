<?php

class Connection {

    private static $connection = NULL;

    public static function getInstance() {
        if (Connection::$connection === NULL) {
            // connect to the database
            $host = "mca.matc.edu";
            $database = "phpnelsod21";
            $username = "phpnelsod21";
            $password = "0238353";
            $dsn = "mysql:host=" . $host . ";dbname=" . $database;
            Connection::$connection = new PDO($dsn, $username, $password);
            if (!Connection::$connection) {
                die("Could not connect to database");
            }
        }
        return Connection::$connection;
    }

}
