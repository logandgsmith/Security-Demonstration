<?php

    /*SET UP*/

    require_once('include/DataManager.php');

    /*Convert JSON input into PHP-readable input*/
    $data = json_decode(file_get_contents("php://input"));
    if($data){
        foreach($data as $key => $val){
            $_POST[$key] = $val;
        }
    }

    header('Content-Type: application/json');

    function error($reason = "An internal error occurred while preforming this operation"){
        $obj = new stdClass();
        $obj->error = $reason;
        exit(json_encode($obj));
    }

    if(!isset($_COOKIE['token'])) error("You must be signed in to perform this operation.");

    /*Establish DB connection for any given case*/
    $conn = DataManager::getInstance()->getConnection();
    if(!$conn || $conn->connect_error) error("Failed to connect to database. :(");

    /*FUNCTIONS*/
    function transfer($recipient, $amount){
        global $conn;
        //Make sure recipient exists...
        if(!DataManager::getInstance()->doesAccountExist($recipient)) error("The intended recipient does not exist.");
        //type cast input
        $amount = floatval($amount);
        //Make sure sender has sufficient funds
        $statement = $conn->prepare("SELECT balance FROM users WHERE token = ?");
        if(!$statement) error();
        if(!$statement->bind_param("s", $_COOKIE['token'])) error();
        if(!$statement->execute()) error();
        $result = $statement->get_result();
        if(!$result || $result->num_rows <= 0) error();
        $result = $result->fetch_assoc();
        if($result['balance'] < $amount) error("Insufficient funds");
        //Deduct balance from sender
        $oldBalance = $result['balance'];
        $statement = $conn->prepare("UPDATE users SET balance = ? WHERE token = ?");
        if(!$statement) error();
        $newBalance = ($oldBalance - $amount);
        if(!$statement->bind_param("ds", $newBalance, $_COOKIE['token'])) error();
        if(!$statement->execute()) error();
        //Add balance to recipient.
        $statement = $conn->prepare("UPDATE users SET balance = balance + ? WHERE email = ?");
        if(!$statement) error();
        if(!$statement->bind_param("ds", $amount, $recipient));
        if(!$statement->execute()) error();

    }

    if(isset($_POST['recipient']) && isset($_POST['amount'])){
        $recipient = $_POST['recipient'];
        $amount = $_POST['amount'];
        transfer($recipient, $amount);
    } else {
        error("Invalid request");
    }



?>