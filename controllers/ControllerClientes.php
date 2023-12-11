<?php
    include ("../config/config.php");
    $objCadastrar=new \Classes\ClassCadastrar();
    echo $objCadastrar->cadastroClientes();
?>