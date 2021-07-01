<?php

/**
 * Class DatabaseConnection
 */
class DatabaseConnection {

    private static $_instance = null;

    protected $connection;

    private $host = "127.0.0.1";
    private $user = "root";
    private $password = "rootpwd";
    private $database = "shop_test";

    /**
     * DatabaseConnection constructor.
     */
    public function __construct() {
        try {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password);
        } catch (PDOException $err) {
            var_dump($err);
            die($err->getMessage());
        }
    }

    /**
     * Find and return multiple values
     * @param $query
     * @param $values
     * @return array
     */
    public function find($query, $values = array()) {
        $statement = $this->connection->prepare($query);
        $statement->execute($values);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Find and return only one value
     * @param $query
     * @param $values
     * @return mixed
     */
    public function findOne($query, $values = array()) {
        $statement = $this->connection->prepare($query);
        $statement->execute($values);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Insert into database query
     * @param $query
     * @param $values
     */
    public function insert($query, $values) {
        $this->execute($query, $values);
    }

    /**
     * Execute query
     * @param $query
     * @param $values
     */
    public function execute($query, $values) {
        $statement = $this->connection->prepare($query);
        $statement->execute($values);
    }

    /**
     * Get instance of class
     * @return DatabaseConnection|null
     */
    public static function getInstance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new DatabaseConnection();
        }
        return self::$_instance;
    }
}
