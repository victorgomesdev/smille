<?php
    session_start();
    include ("../config/config.php");
    $objEvents=new \Classes\ClassEvents();
    $id=filter_input(INPUT_POST,'id',FILTER_DEFAULT);
    $title=filter_input(INPUT_POST,'title',FILTER_DEFAULT);
    $description=filter_input(INPUT_POST,'description',FILTER_DEFAULT);
    $color=filter_input(INPUT_POST,'color',FILTER_DEFAULT);
    $start=filter_input(INPUT_POST,'start',FILTER_DEFAULT);
    $end=filter_input(INPUT_POST,'end',FILTER_DEFAULT);
    

   
    $objEvents->updateEvent($id, $title, $description, $color, $start, $end);
    
?>