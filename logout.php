<?php
if(isset($_COOKIE['username'])) {
    setcookie("username", $_COOKIE["username"], time() - 1);
    header('Location: Main.php');
    exit();
} 
?>