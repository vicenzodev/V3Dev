<?php
header('Content-Type: application/json');
require_once '../Config/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Método inválido. Use POST.']);
    exit;
}

// Pega os dados enviados pelo Javascript
$input = json_decode(file_get_contents('php://input'), true);
$id = $input['id'] ?? null;

if ($id) {
    Custo::deleteCusto($id);
    echo json_encode(['status' => 'success', 'message' => 'Custo excluído!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID não fornecido.']);
}
?>