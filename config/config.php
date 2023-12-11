<?php

    #Caminhos absolutos
    $dirInt="";

    define('DIRPAGE', "http://{$_SERVER['HTTP_HOST']}/{$dirInt}");
    $bar=(substr($_SERVER['DOCUMENT_ROOT'],-1)=='/')?"":"/";
    define('DIRREQ', "{$_SERVER['DOCUMENT_ROOT']}{$bar}{$dirInt}");


    #Banco de Dados

    define('HOST', 'Localhost');
    define('DB', 'smille');
    define('USER', 'root');
    define('PASS', '');

    #Incluir arquivos

    include(DIRREQ.'smille/lib/composer/vendor/autoload.php');
?>