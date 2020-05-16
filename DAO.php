<?php
class DAO{
    private $table;
    private $connection;

    function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    function delete($pk){
        try {
            $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE pk = ?");
            $statement->execute([$pk]);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    function fetch($pk) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE pk = ?");
            $statement->execute([$pk]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $this->create($result);

        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
}

?>
