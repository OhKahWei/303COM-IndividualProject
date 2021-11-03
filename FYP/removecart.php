<?php
session_start();
$ID = $_GET['id'];


unset($_SESSION['cart'][$ID]);
header("Location: cart.php");
$_SESSION['cart'] = array_values($_SESSION['cart']);

?>
