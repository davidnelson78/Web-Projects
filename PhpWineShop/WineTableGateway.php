<?php

class WineTableGateway {

    private $connection;

    public function __construct($c) {
        $this->connection = $c;
    }

    public function getWines() {

        $sqlQuery = "SELECT * FROM wines";

        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute();

        if (!$status) {
            die("could not retrieve wines");
        }

        return $statement;
    }

    public function getWinesByWineryId($wineryId) {

        $sqlQuery = "SELECT w.*, w.wine as wineryName
            FROM wines w
            LEFT JOIN winerys w on w.id = :w.winery_id
            WHERE w.winery_id = :wineryId";

        $params = array(
            'wineryId' => $wineryId
        );

        $statement = $this->connection->prepare($sqlQuery);
        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve wines");
        }

        return $statement;
    }

    public function getWineById($id) {
        // execute a query to get the user with the specified id
        $sqlQuery = "SELECT w.*, wnr.name AS wineryName
                 FROM wines w
                 LEFT JOIN winery wnr ON w.winery_id
                 WHERE w.id = :id";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "id" => $id
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not retrieve wine");
        }

        return $statement;
    }

    public function insertWine($w, $d, $y, $te, $t) {
        $sqlQuery = "INSERT INTO wines 
                 (wine, description, year, temperature, type)
                 VALUES (wine, description, year, temperature, type)";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "wine" => $w,
            "description" => $d,
            "year" => $y,
            "temperature" => $te,
            "type" => $t
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("could not insert wine");
        }

        $id = $this->connection->lastInsertId();

        return $id;
    }

    public function deletewine($id) {
        $sqlQuery = "DELETE FROM wines WHERE id = :id";

        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "id" => $id
        );

        $status = $statement->execute($params);

        if (!$status) {
            die("Could not delete wine");
        }

        return ($statement->rowCount() == 1);
    }

    public function updateWine($w, $d, $y, $te, $t) {
        $sqlQuery = "UPDATE wines 
            SET 
                wine = wine,
                description = description,
                year = year,
                temperature = temperature,
                type = type
            WHERE
                id = id";


        $statement = $this->connection->prepare($sqlQuery);
        $params = array(
            "wine" => $w,
            "description" => $d,
            "year" => $y,
            "temperature" => $te,
            "type" => $t,
        );

        $status = $statement->execute($params);

        return ($statement->rowCount() == 1);
    }

}
