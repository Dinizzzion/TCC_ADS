<?php
session_start();
include_once("conexao.php");

$id_assistente = $_SESSION['id_assistente'];

if ($id_assistente == 1) {
    $sql = "SELECT a.protocolo, a.assunto, a.data, u.nome as nome_usuario, s.local, s.nome as nome_assistente 
            FROM atendimentos a
            INNER JOIN usuarios u ON a.id_usuario = u.id
            INNER JOIN assistentes s ON a.id_assistente = s.id";
    $stmt = $db->prepare($sql);
} else {
    $sqlSetor = "SELECT local FROM assistentes WHERE id = :id_assistente";
    $stmtSetor = $db->prepare($sqlSetor);
    $stmtSetor->bindParam(':id_assistente', $id_assistente);
    $stmtSetor->execute();

    if ($stmtSetor->rowCount() > 0) {
        $rowSetor = $stmtSetor->fetch(PDO::FETCH_ASSOC);
        $local_assistente = $rowSetor['local'];

        $sql = "SELECT a.protocolo, a.assunto, a.data, u.nome as nome_usuario, s.local, s.nome as nome_assistente 
                FROM atendimentos a
                INNER JOIN usuarios u ON a.id_usuario = u.id
                INNER JOIN assistentes s ON a.id_assistente = s.id
                WHERE s.local = :local";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':local', $local_assistente);
    } else {
        echo json_encode(['data' => []]);
        exit;
    }
}

$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($data as &$row) {
    if (isset($row['data'])) {
        $row['data'] = date('d/m/Y', strtotime($row['data']));
    }
}

if (empty($data)) {
    $data = ['data' => []];
} else {
    $data = ['data' => $data];
}

header('Content-Type: application/json');
echo json_encode($data);
?>
