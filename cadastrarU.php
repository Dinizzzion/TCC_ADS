<?php
include_once("conexao.php");

$response = ['status' => 'error', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $datanasc = $_POST['datanasc'];
    $telefone = $_POST['telefone'];

    $sql = "INSERT INTO usuarios (nome, cpf, endereco, datanasc, telefone) VALUES (:nome, :cpf, :endereco, :datanasc, :telefone)";
    $stmt = $db->prepare($sql);

    try {
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":endereco", $endereco);
        $stmt->bindParam(":datanasc", $datanasc);
        $stmt->bindParam(":telefone", $telefone);
        
        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Usuário cadastrado com sucesso!';
        } else {
            $response['message'] = 'Erro ao cadastrar usuário.';
        }
    } catch (PDOException $e) {
        $response['message'] = "Erro ao executar no banco de dados: " . $e->getMessage();
    }
} else {
    $response['message'] = "Requisição inválida.";
}

echo json_encode($response);
