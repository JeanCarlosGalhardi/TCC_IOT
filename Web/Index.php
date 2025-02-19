<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php header("Refresh: 5");?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoramento</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="scripts.js"></script>
</head>

<body>    
    <h1> Monitoramento </h1>
    <div class="container">
        <div class="box1">
            <h2> Gráfico de Leituras</h2>    
            <canvas id="graficoVolume"></canvas>   
        </div>
        <div class="box2">
            <button id="button"> 
                <?php  echo '<b>Última Leitura: '; include 'ultimaleitura.php'; echo ' cm </b>'; ?>
            </button> <br>
            <div class="box3">
                <h2> Nível Total (%) </h2> 
                <?php include("indicador.php"); ?>
            </div>
            <br>
            <div class="box4">
                <h2> Informações sobre o Clima </h2> 
                <?php include("PrevisaoTempo.php"); ?>
            </div>
        </div>
    <br>
</div>        
    <script>
        window.onload = function() {
            carregarDados();
            atualizaCor(<?php  echo ''; include 'ultimaleitura.php'; ?>);
            atualizaIcone(weatherData.weather[0].description);
        };
    </script>
</body>
</html>
