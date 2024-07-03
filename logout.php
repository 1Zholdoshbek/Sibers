<?php
session_start();
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    unset($_SESSION['admin']);
    header('Location: index.php');
}
?>

