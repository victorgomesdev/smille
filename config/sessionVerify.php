<?php

if(!isset($_SESSION["profissional"])){
    header("Location: login.php");
    exit();
}

?>