<?php

header('Content-Type: application/json');

require_once '../Config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Recebe os dados brutos ou via $_POST
        $material_id = $_POST['material_id'] ?? 0;
        $qmu = (float) ($_POST['qmu'] ?? 0);
        $tempo = (float) ($_POST['tempo'] ?? 0);
        $markup = (float) ($_POST['markup'] ?? 0);

        // Validação básica
        if ($material_id == 0) {
            echo json_encode(['erro' => 'Selecione um material']);
            exit;
        }

        // --- LÓGICA DE CÁLCULO (Baseada no seu código) ---
        
        $custos = Custo::getAllCusto();
        $tempoTrabalhoMensal = 600; 
        
        // Busca info do material
        $materialUsado = Material::getMaterialById($material_id);
        
        // Custo do Material (Regra de 3: (Qtd Usada * Preço) / Peso Total)
        // Nota: Assumindo que $custo é numérico, usamos +=
        $custoTotal = 0;
        if ($materialUsado['peso'] > 0) {
            $custoTotal += ($qmu * $materialUsado['custo']) / $materialUsado['peso'];
        }

        // Custo Operacional (Custos fixos por hora)
        $hoje = date('Y-m-d'); // Formato correto para comparação
        
        foreach($custos as $value){
            // Verifica se o custo está ativo/vigente
            // Nota: Corrigi a lógica dos parênteses e da data
            $ativoPermanente = ($value['data_inicio'] == '0000-00-00' && $value['data_final'] == '0000-00-00');
            $ativoPorData = ($value['data_inicio'] <= $hoje && $value['data_final'] >= $hoje);

            if($ativoPermanente || $ativoPorData){
                $custoTotal += ($tempo * $value['custo']) / $tempoTrabalhoMensal; 
            }
        }

        // Calibrando desperdício (15%)
        $custoTotal = $custoTotal * 1.15;

        // Calculando Preço Final
        $precoFinal = $custoTotal * $markup;

        // Retorna JSON para o JavaScript
        echo json_encode([
            'sucesso' => true,
            'custo' => number_format($custoTotal, 2, '.', ''), // Formata para 2 casas decimais
            'preco' => number_format($precoFinal, 2, '.', '')
        ]);

    } catch (Exception $e) {
        echo json_encode(['sucesso' => false, 'erro' => $e->getMessage()]);
    }
}
?>