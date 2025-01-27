<?php
session_start();
include_once("conexao.php");

$id_assistente =  $_SESSION['autenticado'] = true;

if ($id_assistente == true) {
    $sql = "SELECT * FROM usuarios";
    $stmt = $db->prepare($sql);
} else {
    echo json_encode(['error' => 'Usuários não encontrados']);
    exit;
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
