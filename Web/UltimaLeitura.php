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
$queryUltimaLeitura = "SELECT valor FROM nivel ORDER BY datahora DESC LIMIT 1;";

// Executando a consulta
$resultadoUltimaLeitura = pg_query($conexao, $queryUltimaLeitura);


// Recuperando o resultado
$row = pg_fetch_assoc($resultadoUltimaLeitura);

// Verificando se a consulta retornou algum dado
if ($row) {
    echo $row['valor'];
} else {
    echo "Nenhum dado encontrado.";
}

// Liberando o resultado e fechando a conexão
pg_free_result($resultadoUltimaLeitura);
pg_close($conexao);
?>
