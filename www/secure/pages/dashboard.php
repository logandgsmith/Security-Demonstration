<h1>Welcome to your user dashboard!</h1>
<form method="post" action="transfer.php">
    <label for="recipient"> Recipient's email: </label>
    <input id="recipient" name="recipient" type="email"/>
    <label for="amount"> Amount (in dollars): </label>
    <input id="amount" name="amount" type="text"/>
    <label for="message"> Message: </label>
    <input id="message" name="message" type="text"/>
    
    <input type="submit" value="Transfer funds"></input>
</form>
