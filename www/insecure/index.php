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
