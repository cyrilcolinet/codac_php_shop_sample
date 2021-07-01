<?php

require_once dirname(__FILE__) . '/../DatabaseConnection.php';
require_once dirname(__FILE__) . '/abstracts/AModel.php';

/**
 * Class User
 */
class User extends AModel {

    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $password;

    /**
     * User constructor.
     * @param $newUser
     */
    public function __construct($newUser) {
        $this->id = $newUser['id'];
        $this->firstName = $newUser['first_name'];
        $this->lastName = $newUser['last_name'];
        $this->email = $newUser['email'];
        $this->password = $newUser['password'];
    }

    /**
     * Create model in database
     * @return User
     */
    public static function create($firstName, $lastName, $email, $password) {
        $database = DatabaseConnection::getInstance();
        $hash = md5($password);
        try {
            $database->insert(
                "INSERT INTO users (first_name, last_name, email, password) VALUES (:first, :last, :email, :pass)",
                array(
                    ':first' => $firstName,
                    ':last' => $lastName,
                    ':email' => $email,
                    ':pass' => $hash
                )
            );
        } catch (PDOException $err) {
            return null;
        }

        $user = $database->findOne(
            "SELECT * FROM users WHERE email = :email AND password = :pass",
            array(
                ':email' => $email,
                ':pass' => $hash,
            )
        );
        var_dump($user);
        return new User($user);
    }

    /**
     * Get model in database
     * @param $id
     * @return User
     */
    public static function getById($id = null) {
        $database = DatabaseConnection::getInstance();
        $user = $database->findOne("SELECT * FROM users WHERE id = :id", array(':id' => $id));
        var_dump($user);
        return new User($user);
    }

    /**
     * Get all users
     * @return array
     */
    public static function getAll() {
        $database = DatabaseConnection::getInstance();
        $dbUsers = $database->find("SELECT * FROM users");
        $users = array();

        foreach ($dbUsers as $dbUser)
            array_push($users, new User($dbUser));
        return $users;
    }

    /**
     * Delete current user
     */
    public function delete() {

    }

}
