<?php
    include ("../config/config.php");
    $objRelatorio = new \Classes\ClassRelatorios();

    $agendados = json_decode($objRelatorio->agendados(), true);
    $confirmados = json_decode($objRelatorio->confirmados(), true);
    $cancelados = json_decode($objRelatorio->cancelados(), true);
    $faltas = json_decode($objRelatorio->faltas(), true);

    $result = [
        'agendados' => $agendados,
        'confirmados' => $confirmados,
        'cancelados' => $cancelados,
        'faltas' => $faltas
    ];

    echo json_encode($result);
?>
