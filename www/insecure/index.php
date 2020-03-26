<!DOCTYPE html>
<html>
    <h1>Terrible Bank (TM)</h1>
    <h1>Welcome to the landing page for our secure app!</h1>

    <button id="signIn">Sign In</button>
    <script>
        var btn = document.getElementById('signIn');
        btn.addEventListener('click', function () {
            document.location.href = './pages/signIn.php';
        });
    </script>

    <br><br>

    <button id="signUp">Sign Up</button>
    <script>
        var btn = document.getElementById('signUp');
        btn.addEventListener('click', function () {
            document.location.href = './pages/signUp.php';
        });
    </script>

    <br><br>

    <button id="dashboard">Dashboard</button>
    <script>
        var btn = document.getElementById('dashboard');
        btn.addEventListener('click', function () {
            document.location.href = './pages/dashboard.php';
        });
    </script>

</html>
