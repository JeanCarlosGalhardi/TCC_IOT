<?php
header('Content-Type: application/json');

$host = 'localhost'; // ou o IP do seu servidor
$dbname = 'banco';
$user = 'postgres';
$password = '123456';
$datahora = '2024-09-23 09:00:00'; 

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['datahora']) && isset($data['id_sensor']) && isset($data['valor'])) {
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
