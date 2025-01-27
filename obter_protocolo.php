<?php
require_once 'conexao.php';

header('Content-Type: application/json');

if (isset($_GET['protocolo'])) {
    $protocolo = $_GET['protocolo'];

    $query = "SELECT * FROM atendimentos WHERE protocolo = :protocolo";
    try {
        $stmt = $db->prepare($query);
        $stmt->bindParam(':protocolo', $protocolo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $assistente = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($assistente);
        } else {
            echo json_encode(['error' => 'Atendimento não encontrado.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erro na consulta: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Protocolo não fornecido.']);
}

?>
