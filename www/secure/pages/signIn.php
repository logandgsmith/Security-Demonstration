<!DOCTYPE html>
<html>
    <h1>Welcome to the Sign In page!</h1>
    <form id="form">
        <label for="email">Email: </label>
        <input id="email" name="email" type="text"/>
        <label for="password">Password: </label>
        <input id="password" name="password" type="password"/>
    </form>
    <button onclick="onClick()">
    Sign in
    </button>
    <script>
        function onClick() {
            let form = document.getElementById("form");

            fetch(('../authenticate.php?email=' + form.email.value + '&password=' + form.password.value), {credentials: 'same-origin'})
            .then((resp) => resp.json())
            .then((response) => {
                if(response && response.token) {
                    document.cookie = ('token=' + response.token);
                
                alert("You are now signed in.");
                } else {
                    alert("error");
                    console.log(response);
                }
            }).catch(
                (err) => {
                    console.log(err);
                }
            );
        }
    </script>
</html>