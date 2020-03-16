# ThirstyBois Docs

**For all operations**, if an error is thrown, the response object will use the following format:

```js
    {
        error: <string>
    }
```

## Create Account

Target: /authenticate.php
Method: POST
Description: Creates account, saves to database, and returns session token.
Params:

```js
    {
        email: <string>,
        password: <string>,
        passwordConfirm: <string>
    }
```

Response: 

```js
    {
        token: <string>
    }
```

## Log in
Target: /authenticate.php
Method: GET
Description: Using the provided credentials, changes the user's server-side session token and then sends it back to the client.

Params:

```js
    {
        email: <string>
        password: <string>
    }
```

Response:

```js
    {
        token: <string>
    }
```

## Transfer funds

Target: /transfer.php
Method: POST
Description: After logging in, transfer money from your account to the account of the person with the specificied email.

Params:

```js
    {
        email: <string>,
        amount: <string> //type-casted server side
    }
```

Response: No response object on success, check for "OK" status. 

