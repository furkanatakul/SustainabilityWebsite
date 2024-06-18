<?php
include 'config.php';
$username = htmlspecialchars(trim($_POST['username']));
$password =  htmlspecialchars(trim($_POST['password']));
$queryResult = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$password'");
$verified = mysqli_num_rows($queryResult) > 0;

if ($verified) {
    setcookie('username', $username);
    header('Location: LoggedIn.php');
    exit();
} else {
    header('Location: LoginPage.php');
    exit();
}
?>