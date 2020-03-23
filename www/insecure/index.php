<?php
$redirectUnfiltered = $_SERVER['REQUEST_URI'];
$redirect = explode('?', $redirectUnfiltered)[0];

switch ($redirect) {
    case '/'  :
    case ''   :
        require __DIR__ . '/pages/home.php';
        break;
    case '/signin' :
        require __DIR__ . '/pages/signIn.php';
        break;
    case '/signup' :
        require __DIR__ . '/pages/signUp.php';
        break;
    case '/dashboard' :
        require __DIR__ . '/pages/dashboard.php';
        break;
    default:
        require __DIR__ . '/pages/404.php';
        break;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            input, label {
                display: block;
            }
        </style>
    </head>
    <body>
        <h1>Terrible Bank (TM)</h1>
        <b>Sign up</b>
        <form method="post" action="authenticate.php">
            <label for="email"> Email: </label>
            <input id="email" name="email" type="email"/>
            <label for="password"> Password: </label>
            <input id="password" name="password" type="password"/>
            <label for="passwordConfirm"> Confirm password: </label>
            <input id="passwordConfirm" name="passwordConfirm" type="password"/>
            <input type="submit" value="Sign up"/>
        </form>
        <hr>
        <form method="post" action="transfer.php">
            <label for="recipient"> Recipient's email: </label>
            <input id="recipient" name="recipient" type="email"/>
            <label for="amount"> Amount (in dollars): </label>
            <input id="amount" name="amount" type="text"/>
            <label for="message"> Message: </label>
            <input id="message" name="message" type="text"/>
            <label for="sender"> Sender: </label>
            <input id="sender" name="sender" type="text"/>
            <input type="submit" value="Transfer funds"></input>
        </form>
        <hr>
        <button><a href="transfer.php">Click to see the funds you've recieved.</a></button>
    </body>
</html>

