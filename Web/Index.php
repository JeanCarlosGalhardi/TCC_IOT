<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoramento</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="width: 100%;">
        <canvas id="graficoVolume"></canvas>
    </div>

    <script>
        // Função para buscar dados do gráfico via PHP
        async function carregarDados() {
            const response = await fetch('dados.php');
            const data = await response.json();
            
            const ctx = document.getElementById('graficoVolume').getContext('2d');
            new Chart(ctx, {
                type: 'line', 
                data: data, // Dados vindos do PHP
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // Chama a função ao carregar a página
        carregarDados();
    </script>
</body>
</html>
