<?php
    session_start();
    include ("../config/config.php");
    $objEvents=new \Classes\ClassEvents();
    
    $title=filter_input(INPUT_POST,'title',FILTER_DEFAULT);
    $description=filter_input(INPUT_POST,'description',FILTER_DEFAULT);
    $start=filter_input(INPUT_POST,'start',FILTER_DEFAULT);
    $end=filter_input(INPUT_POST,'end',FILTER_DEFAULT);
    $profissional = filter_input(INPUT_POST,'profissional', FILTER_DEFAULT);

    if(empty($title) || empty($description) || empty($start) || empty($end) || empty($profissional)){
        $_SESSION['erro'] = " <p style='color: red;'>Preencha todos os campos!</p>";
        header("Location: ../add.php");
        exit();
    }else{
        $objEvents->creatEvent(0, $title, $description,'blue', $start, $end,$profissional);
    }
?>