<?php
session_start();
unset($_SESSION['profissional']);
header("Location: login.php");
?>