<?php

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

    /*Establish DB connection for any given case*/
    $conn = DataManager::getInstance()->getConnection();
    if(!$conn || $conn->connect_error) error("Failed to connect to database. :(");

    function generateToken(){
        $strong = false;
        $token = bin2hex(openssl_random_pseudo_bytes(256, $strong));
        if(!$strong){
            error("Could not securely generate a session token. Aborting.");
        }
        return $token;
    }

    function createAccount($email, $password, $passwordConfirm) {
        global $conn;
        if(DataManager::getInstance()->doesAccountExist($email)){
            error("Account already exists.");
        }
        if($password != $passwordConfirm) error("Passwords don't match.");
        $password = "pepper1234" . $password; //Global pepper
        $statement = $conn->prepare("INSERT INTO users (email, password_hash, token) VALUES (?, ?, ?)");
        $token = generateToken();
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $statement->bind_param("sss", $email, $passwordHash, $token);
        if(!$statement->execute()){
            error("Failed to create account -- please try again");
        }
        exit(json_encode(array('token' => $token)));
    }

    function login($email, $password){
        $password = "pepper1234" . $password;
        global $conn;
        $statement = $conn->prepare("SELECT email, password_hash FROM users WHERE email = ? LIMIT 1");
        $statement->bind_param("s", $email);
        if(!$statement->execute()) error();
        $result = $statement->get_result();
        if(!$result || !$result->num_rows) error("Invalid email address or password.");
        $result = $result->fetch_assoc();
        $passwordHash = $result['password_hash'];
        if(!password_verify($password, $passwordHash)) error("Invalid email address or password.");
        $newToken = generateToken();
        $statement = $conn->prepare("UPDATE users set token = ? where email = ?");
        if(!$statement->bind_param("ss", $newToken, $email)) error("An internal or external error occurred while performing this operation.");
        if(!$statement->execute()) error("An internal or external error occurred while performing this operation.");
        exit(json_encode(array('token' => $newToken)));
    }

    /*Create account*/
    if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordConfirm'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordConfirm = $_POST['passwordConfirm'];
        createAccount($email, $password, $passwordConfirm);
    } else if(isset($_GET['email']) && isset($_GET['password'])){
        $email = $_GET['email'];
        $password = $_GET['password'];
        login($email, $password);
    } else {
        error("Invalid request.");
    }

?>
