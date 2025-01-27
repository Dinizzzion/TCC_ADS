<?php
require_once 'conexao.php';

header('Content-Type: application/json');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM usuarios WHERE id = :id";
    
    try {
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $assistente = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($assistente);
        } else {
            echo json_encode(['error' => 'Usuário não encontrado.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erro na consulta: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'ID não fornecido.']);
}

?>
