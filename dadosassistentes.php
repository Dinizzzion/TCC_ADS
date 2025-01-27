<?php
session_start();
include_once("conexao.php");

$id_assistente = $_SESSION['id_assistente'];

if ($id_assistente == 1) {
    $sql = "SELECT id, nome, local, funcao FROM assistentes";
    $stmt = $db->prepare($sql);
} else {
    $sqlSetor = "SELECT local FROM assistentes WHERE id = :id_assistente";
    $stmtSetor = $db->prepare($sqlSetor);
    $stmtSetor->bindParam(':id_assistente', $id_assistente);
    $stmtSetor->execute();

    if ($stmtSetor->rowCount() > 0) {
        $rowSetor = $stmtSetor->fetch(PDO::FETCH_ASSOC);
        $local_assistente = $rowSetor['local'];

        $sql = "SELECT id, nome, local, funcao, cress, atendimentos, matricula 
                FROM assistentes 
                WHERE local = :local";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':local', $local_assistente);
    } else {
        echo json_encode(['error' => 'Setor do assistente não encontrado']);
        exit;
    }
}

$stmt->execute();

$data = [];
if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
} else {
    $data = ['error' => 'Nenhum resultado encontrado'];
}

header('Content-Type: application/json');
echo json_encode($data);
?>
