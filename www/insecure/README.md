# How to exploit the insecure version

## XSS

When sending a message with a money transfer, the server will not sanitize the message when it sends it to the client. 

## CSRF

Disable the webserver headers that prohibit CSRF and then run malicious javascript no an external site

## SQL Injection

When singing up, the email field is vulnerable to SQL injection. The server checks the database to see if the email exists before checking that the email address is valid. This check does not use prepared statements. The SQL query uses single quotes, so use those for the SQLi. 

## IDOR

The money transfer feature is slightly different for the insecure version of the app. You can optionally provide the "sender" param when sending money in the insecure version, which allows you to make a transfer on someone else's behalf.