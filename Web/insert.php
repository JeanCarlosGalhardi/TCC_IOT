<?php
header('Content-Type: application/json');

$host = 'localhost'; // ou o IP do seu servidor
$dbname = 'banco';
$user = 'postgres';
$password = '123456';

$datetime = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
$datahora = $datetime->format('Y-m-d H:i:s');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id_sensor']) && isset($data['valor'])) {
    try {
        $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO nivel (datahora, id_sensor, valor) VALUES (:datahora, :id_sensor, :valor)");
        $stmt->bindParam(':datahora', $datahora);
        $stmt->bindParam(':id_sensor', $data['id_sensor']);
        $stmt->bindParam(':valor', $data['valor']);
        $stmt->execute();

        echo json_encode(["status" => "success"]);
    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Dados incompletos"]);
}
?>
