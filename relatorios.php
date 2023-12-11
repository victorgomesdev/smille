<?php
include("config/init.php");
include("config/sessionVerify.php");
include("config/config.php"); ?>

<?php include(DIRREQ . "smille/lib/html/header.php"); ?>
<!DOCTYPE html>
<html lang="pt-BR" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatorios</title>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" integrity="sha512-NmLkDIU1C/C88wi324HBc+S2kLhi08PN5GDeUVVVC/BVt/9Izdsc9SVeVfA1UZbY3sHUlDSyRXhCzHfr6hmPPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="lib/css/styles.css">
</head>

<body>



    <div class="container">
        <div class="state-select">
            <div class="state-select-toggle">
                <span class="state-select-toggle__state-selected">Consultas Mês</span>
                <i class="fas fa-chevron-down state-select-toggle__icon"></i>
            </div>
            <div class="state-select-list">
                <input type="text" placeholder="Procurar Mês.." class="state-select-list__search">
                <ul>
                    <li class="state-select-list__item" data-id="consulta mês=true">Janeiro</li>
                    <li class="state-select-list__item" data-id="uf=02">Feverreiro</li>
                    <li class="state-select-list__item" data-id="uf=03">Março</li>
                    <li class="state-select-list__item" data-id="uf=04">Abril</li>
                    <li class="state-select-list__item" data-id="uf=05">maio</li>
                    <li class="state-select-list__item" data-id="uf=06">junho</li>
                    <li class="state-select-list__item" data-id="uf=07">julho</li>
                    <li class="state-select-list__item" data-id="uf=08">Agosto</li>
                    <li class="state-select-list__item" data-id="uf=09">Setembro</li>
                    <li class="state-select-list__item" data-id="uf=10">Outubro</li>
                    <li class="state-select-list__item" data-id="uf=11">Novembro</li>
                    <li class="state-select-list__item" data-id="uf=12">Dezembro</li>

                </ul>
            </div>
        </div>

        <section class="status">
            <div class="status__icon status__icon--confirmed">
                <i class="fas fa-check"></i>
            </div>
            <div class="info">
                <span class="info__total info__total--confirmed" id="agendadasTotal"></span>
                <h2 class="info__label">Agendadas</h2>
            </div>
        </section>

        <section class="status">
            <div class="status__icon status__icon--deaths">
                <i class="far fa-calendar-check"></i>
            </div>
            <div class="info">
                <span class="info__total info__total--deaths" id="confirmadasTotal"></span>
                <h2 class="info__label">Confirmadas</h2>
            </div>
        </section>

        <section class="status">
            <div class="status__icon status__icon--canceladas">
                <i class="far fa-calendar-times"></i>
            </div>
            <div class="info">
                <span class="info__total info__total--canceladas" id="canceladosTotal"></span>
                <h2 class="info__label">Canceladas</h2>
            </div>
        </section>

        <section class="status">
            <div class=" status__icon status__icon--faltas">
                <i class="fas fa-window-close"></i>
            </div>
            <div class="info">
                <span class="info__total info__total--faltas" id="faltasTotal"></span>
                <h2 class="info__label">Faltas</h2>
            </div>
        </section>

        <section class="data-box data-box--30">
            <h2 class="data-box__header">
                Gráfico de <?php echo $_SESSION['profissional']['nome']; ?>
            </h2>
            <div class="data-box__body"></div>
            <div id="chart"></div>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {
                    packages: ['corechart']
                })
                google.charts.setOnLoadCallback(drawChart)

                function drawChart() {
                    const container = document.querySelector('#chart');
                    const agendadasTotalElement = document.getElementById('agendadasTotal');
                    const confirmadasTotalElement = document.getElementById('confirmadasTotal');
                    const canceladosTotalElement =document.getElementById('canceladosTotal');
                    const faltasTotalElement =document.getElementById('faltasTotal');

                    fetch('controllers/ControllerRelatorios.php')
                        .then(response => response.json())
                        .then(data => {
                            const agendadosCount = data.agendados.rowCount;
                            const confirmadosCount = data.confirmados.rowCount;
                            const canceladosCount = data.cancelados.rowCount;
                            const faltasCount = data.faltas.rowCount;

                            
                            agendadasTotalElement.textContent = agendadosCount;
                            confirmadasTotalElement.textContent = confirmadosCount;
                            canceladosTotalElement.textContent =canceladosCount;
                            faltasTotalElement.textContent = faltasCount;

                            // Construa o array de dados para o gráfico
                            const chartData = [
                                ['Consultas', 'Quantidade'],
                                ['Agendadas', agendadosCount],
                                ['Confirmadas', confirmadosCount],
                                ['Cancelados', canceladosCount],
                                ['Faltas', faltasCount],
                            ];

                            const chartDataTable = google.visualization.arrayToDataTable(chartData);
                            const options = {
                            title: 'Relatório',
                            height: 300,
                            width: 600,
                            colors: ['#4285F4', '#34A853', 'yellow', 'red'],
                            pieSliceText: 'percentage', 
                            pieSliceTextStyle: {
                                color: 'black' 
                                }   
                            };

                            const chart = new google.visualization.PieChart(container);
                            chart.draw(chartDataTable, options);
                        })
                        .catch(error => console.error('Erro ao obter dados:', error));
                }
            </script>
        </section>




    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.27.3/apexcharts.min.js" integrity="sha512-nKTh1Ik8Kzbrxo9A6xOBtEbzdNYcjI4Pr5XE88sNJQk87sY8mBlUfh61lYm0i710r5mGcIZ9tWSwORQbQ4plQQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/apexcharts-pt-br.js"></script>
    <script src="js/apiCovid.js"></script>
    <script src="lib/js/scripts.js"></script>
</body>

</html>