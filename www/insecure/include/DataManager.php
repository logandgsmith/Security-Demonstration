<?php

    class DataManager {

        private static $instance = NULL;

        private final function __construct(){

        }

        public function getConnection(){
            return new mysqli("localhost", "thirstybois", "ExtremeThirst", "thirstybois"); //security-testing-uf:us-east1:mysql-phase-1
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
            $result = $conn->query("SELECT email FROM users WHERE email = '$email'");
            if(!$result) error();
            return ($result->num_rows >= 1);
        }
        

    }

?>