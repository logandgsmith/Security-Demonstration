<?php
    require_once('../include/DataManager.php');

    /*Convert JSON input into PHP-readable input*/
    $data = json_decode(file_get_contents("php://input"));
    if($data){
        foreach($data as $key => $val){
            $_POST[$key] = $val;
        }
    }

    function error($reason = "An internal error occurred while preforming this operation"){
        header('Content-Type: application/json');
        $obj = new stdClass();
        $obj->error = $reason;
        exit(json_encode($obj));
    }

    if(!isset($_COOKIE['token'])) exit("You must be signed in to view this page.");


    $conn = DataManager::getInstance()->getConnection();
    if(!$conn) error("Could not connect to database.");
    $statement = $conn->prepare("SELECT balance FROM users WHERE token = ?");
    if(!$statement) error();
    if(!$statement->bind_param("s", $_COOKIE['token'])) error();
    if(!$statement->execute()) error();
    $result = $statement->get_result();
    if(!$result || $result->num_rows != 1) error();
    $result = $result->fetch_assoc();
    $balance = $result['balance'];



?>


<h1>Welcome to your user dashboard!</h1>
<h2>Your balance: <?php echo("$" . $balance) ?> </h2>
<form method="post" action="../transfer.php">
    <label for="recipient"> Recipient's email: </label>
    <input id="recipient" name="recipient" type="email"/>
    <label for="amount"> Amount (in dollars): </label>
    <input id="amount" name="amount" type="text"/>
    <label for="message"> Message : </label>
    <input id="message" name="message" type="text"/>
    <input type="submit" value="Transfer funds"></input>
</form>
<h2>Recent transfers</h2>
<div id="transfers">
</div>
<script>

        fetch('../transfer.php', {credentials: 'same-origin'})
        .then((resp) => resp.json())
        .then((response) => {
            response.forEach(
                (element) => {
                    let transfers = document.getElementById("transfers")
                    transfers.innerHTML += ('<p> Sender:' + element.sender + '</p>');
                    transfers.innerHTML += ('<p> Amount:' + element.amount + '</p>');
                    transfers.innerHTML += ('<p> Message:' + element.message + '</p>');
                    transfers.innerHTML += "<hr>";
                }
            );
        }).catch(
            (err) => {
                console.log(err);
            }
        );
        


</script>
