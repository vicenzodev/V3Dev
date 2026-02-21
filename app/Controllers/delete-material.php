<?php
// delete_material.php
header('Content-Type: application/json'); // Avisa que vai retornar JSON
require_once '../Config/config.php'; // Sua conexão com banco

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Código de erro "Método não permitido"
    echo json_encode(['status' => 'error', 'message' => 'Método inválido. Use POST.']);
    exit;
}

// Pega os dados enviados pelo Javascript
$input = json_decode(file_get_contents('php://input'), true);
$id = $input['id'] ?? null;

if ($id) {
    Material::deleteMaterial($id);
    echo json_encode(['status' => 'success', 'message' => 'Material excluído!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID não fornecido.']);
}
?>