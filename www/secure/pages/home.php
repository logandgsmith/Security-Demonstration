<html>
    <h1>Shitty Bank (TM)</h1>
    <h1>Welcome to the landing page for our secure app!</h1>

    <button id="signIn">Sign In</button>
    <script>
        var btn = document.getElementById('signIn');
        btn.addEventListener('click', function () {
            document.location.href = '<?php echo 'signin'; ?>';
        });
    </script>

    <br><br>

    <button id="signUp">Sign Up</button>
    <script>
        var btn = document.getElementById('signUp');
        btn.addEventListener('click', function () {
            document.location.href = '<?php echo 'signup'; ?>';
        });
    </script>

</html>
