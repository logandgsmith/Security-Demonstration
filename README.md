# ThirstyBois Docs

For all operations, if an error is thrown, the response object will use the following format:

```js
    {
        error: <string>
    }
```

## Create Account

Target: /authenticate.php
Method: POST
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
