<?php
// Exibir erros para debug
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Permitir requisições apenas via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Método não permitido
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'Método não permitido. Use POST.']);
    exit;
}

// Dados de conexão
$servername = "localhost";
$username = "root";
$password = "";
$database = "agendamentos_db";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexão
if ($conn->connect_error) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => "Conexão falhou: " . $conn->connect_error]);
    exit;
}

// Receber dados JSON do fetch()
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Verificar se os dados estão completos
if (!$data || !isset($data['nome'], $data['email'], $data['data'], $data['horario'])) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => "Dados inválidos."]);
    exit;
}

// Extrair os dados
$nome = $data['nome'];
$email = $data['email'];
$data_consulta = $data['data'];
$horario_consulta = $data['horario'];

// Preparar e executar o INSERT
$sql = "INSERT INTO consultas (nome, email, data_consulta, horario_consulta)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => "Erro na preparação da consulta: " . $conn->error]);
    exit;
}

$stmt->bind_param("ssss", $nome, $email, $data_consulta, $horario_consulta);

header('Content-Type: application/json');

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => "Consulta agendada com sucesso!"]);
} else {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => "Erro ao agendar: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
