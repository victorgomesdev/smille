<?php
    include ("../config/config.php");
    $objEvents=new \Classes\ClassLogin();
    echo $objEvents->login();
?>