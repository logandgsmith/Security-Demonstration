# How to exploit the insecure version

## XSS

When sending a message with a money transfer, the server will not sanitize the message when it sends it to the client. 

## Sensitive data exposure

Looking up transaction history doesn't require user authentication. oops! You can submit a GET request to /transfer.php?email=_____ and see anyone's transaction history so long as you're signed in to the website.

## SQL Injection

When singing up, the email field is vulnerable to SQL injection. The server checks the database to see if the email exists before checking that the email address is valid. This check does not use prepared statements. The SQL query uses single quotes, so use those for the SQLi. 

## IDOR

The money transfer feature is slightly different for the insecure version of the app. You can optionally provide the "sender" param when sending money in the insecure version, which allows you to make a transfer on someone else's behalf.