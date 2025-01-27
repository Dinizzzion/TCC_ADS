<?php
require_once 'conexao.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $local = $_POST['local'];
    $funcao = $_POST['funcao'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $cress = $_POST['cress'];
    $matricula = $_POST['matricula'];

    $query = "UPDATE assistentes SET 
                nome = :nome, 
                local = :local, 
                funcao = :funcao, 
                email = :email, 
                cpf = :cpf, 
                cress = :cress, 
                matricula = :matricula 
              WHERE id = :id";

    try {
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':local', $local);
        $stmt->bindParam(':funcao', $funcao);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':cress', $cress);
        $stmt->bindParam(':matricula', $matricula);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => 'Dados atualizados com sucesso!']);
        } else {
            echo json_encode(['error' => 'Erro ao atualizar os dados.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erro na consulta: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Método de requisição inválido.']);
}
?>
