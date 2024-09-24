<?php
// Definir os parâmetros da conexão
$host = "localhost";
$port = "5432";
$dbname = "banco";
$user = "postgres";
$password = "123456";

// Estabelecer a conexão
$conexao = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Verificando a conexão
if (!$conexao) {
    die("Erro: Não foi possível conectar ao banco de dados.\n");
}

// Definindo a consulta SQL
$query = "SELECT to_char(datahora, 'dd/mm/yyyy hh24:mi') AS data_formatada, id_sensor, valor FROM nivel ORDER BY datahora;";

// Executando a consulta
$resultado = pg_query($conexao, $query);

// Verificando se houve erro na execução da consulta
if (!$resultado) {
    die("Erro: Não foi possível executar a consulta.\n");
}

// Inicializando arrays para armazenar labels e dados
$labels = [];
$dadosValores = [];

// Iterando sobre os resultados e armazenando-os
while ($linha = pg_fetch_assoc($resultado)) {
    $labels[] = $linha['data_formatada']; 
    $dadosValores[] = $linha['valor']; 
}

// Preparando os dados para o gráfico
$dados = [
    'labels' => $labels,  // Labels dinâmicos baseados na data
    'datasets' => [[
        'label' => 'Centímetros',
        'backgroundColor' => 'rgba(255, 255, 255, 0.2)',
        'borderColor' => 'rgba(75, 192, 192, 1)',
        'borderWidth' => 1,
        'data' => $dadosValores,  // Dados dos valores consultados
    ]]
];

// Definindo o cabeçalho JSON
header('Content-Type: application/json');

// Retornando os dados em formato JSON
echo json_encode($dados);

// Liberando o resultado e fechando a conexão
pg_free_result($resultado);
pg_close($conexao);
?>