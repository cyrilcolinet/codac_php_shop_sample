<?php

require_once dirname(__FILE__) . '/../DatabaseConnection.php';

/**
 * Class User
 */
class User {

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
            $database->execute(
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
        return new User($user);
    }

    /**
     * Get user in database from given id
     *
     * @param $id int ID of user
     * @return User
     */
    public static function findById($id = null) {
        $database = DatabaseConnection::getInstance();
        $user = $database->findOne("SELECT * FROM users WHERE id = :id", array(':id' => $id));
        if (is_bool($user) && !$user)
            return null;
        return new User($user);
    }

    /**
     * Get all users and convert data to User object
     *
     * @return User[] List of users
     */
    public static function getAll() {
        $database = DatabaseConnection::getInstance();
        $dbUsers = $database->find("SELECT * FROM users");
        $users = array();

        // Convert array of string into User class
        foreach ($dbUsers as $dbUser)
            array_push($users, new User($dbUser));
        return $users;
    }

    /**
     * Update user information
     * Password cannot be updated
     *
     * @param $newValues array Values to update
     * @return boolean True id successfully updated and false otherwise
     */
    public function edit($newValues) {
        $this->firstName = isset($newValues['firstName']) ? $newValues['firstName'] : $this->firstName;
        $this->lastName = isset($newValues['lastName']) ? $newValues['lastName'] : $this->lastName;
        $this->email = isset($newValues['email']) ? $newValues['email'] : $this->email;

        // Perform query
        $database = DatabaseConnection::getInstance();
        try {
            $database->execute(
                "UPDATE users SET first_name = :first, last_name = :last, email = :email WHERE id = :id",
                array(
                    ':first' => $this->firstName,
                    ':last' => $this->lastName,
                    ':email' => $this->email,
                    ':id' => $this->id, // id of user to edit
                )
            );

            return true;
        } catch (PDOException $err) {
            return false;
        }
    }

    /**
     * Delete current user
     *
     * @return boolean True if success, false otherwise
     */
    public function delete() {
        $database = DatabaseConnection::getInstance();
        try {
            $database->execute("DELETE FROM users WHERE id = :id", [':id' => $this->id]);
            return true;
        } catch (PDOException $err) {
            return false;
        }
    }

}
