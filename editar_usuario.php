<?php
require_once 'conexao.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $datanasc = $_POST['datanasc'];
    $telefone = $_POST['telefone'];

    $query = "UPDATE usuarios SET 
                nome = :nome, 
                cpf = :cpf,
                endereco = :endereco, 
                datanasc = :datanasc, 
                telefone = :telefone
              WHERE id = :id";

    try {
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':endereco', $endereco);
        $stmt->bindParam(':datanasc', $datanasc);
        $stmt->bindParam(':telefone', $telefone);

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
