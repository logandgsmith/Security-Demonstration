<?php

    class DataManager {

        private static $instance = NULL;

        private final function __construct(){

        }

        public function getConnection(){
            return new mysqli("127.0.0.1", "thirstybois", "ExtremeThirst", "thirstybois");
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
            $sql = "SELECT email FROM users WHERE email = '$email'";
            $result = $conn->query($sql);
            if(!$result) {
                var_dump($sql);
                error();
            }
            return ($result->num_rows >= 1);
        }
        

    }

?>