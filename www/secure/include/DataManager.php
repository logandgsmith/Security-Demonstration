<?php

    class DataManager {

        private static $instance = NULL;

        private final function __construct(){

        }

        public function getConnection(){
            return new mysqli("security-testing-uf:us-east1:mysql-phase-1", "thirstybois", "ExtremeThirst", "thirstybois");
        }

        public static function getInstance(){
            if(static::$instance == NULL){
                static::$instance = new DataManager();
                return static::$instance;
            } else {
                return static::$instance;
            }
        }

        function doesAccountExist($email){
            $conn = DataManager::getInstance()->getConnection();
            if(!$conn) return false;
            if(!$statement = $conn->prepare("SELECT email FROM users WHERE email = ?")) error();
            if(!$statement->bind_param("s", $email)) error();
            if(!$statement->execute()) error();
            $result = $statement->get_result();
            if(!$result) error();
            return ($result->num_rows >= 1);
        }
        

    }

?>