<?php
session_start();
include_once("conexao.php");


$response = ['status' => 'error', 'message' => ''];

if (isset($_SESSION['id_assistente'])) {
    $id_assistente = $_SESSION['id_assistente'];

    $assunto = htmlspecialchars($_POST['assunto']);
    $data = date('Y-m-d', strtotime($_POST['data']));
    $descricao = strip_tags($_POST['descricao']);
    $id_usuario = (int)$_POST['id_usuario'];

    try {
        $db->beginTransaction();

        $sql = "INSERT INTO atendimentos (assunto, data, descricao, id_assistente, id_usuario) 
                VALUES (:assunto, :data, :descricao, :id_assistente, :id_usuario)";
        $stmt = $db->prepare($sql);

        // Bind dos parâmetros
        $stmt->bindParam(":assunto", $assunto);
        $stmt->bindParam(":data", $data);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":id_assistente", $id_assistente);
        $stmt->bindParam(":id_usuario", $id_usuario);

        if ($stmt->execute()) {
            $protocolo = $db->lastInsertId();
            $sql_update = "UPDATE assistentes SET atendimentos = atendimentos + 1 WHERE id = :id_assistente";
            $stmt_update = $db->prepare($sql_update);
            $stmt_update->bindParam(':id_assistente', $id_assistente);
            $stmt_update->execute();
            $db->commit();
            
            $response['status'] = 'success';
            $response['message'] = 'Atendimento cadastrado com sucesso! <br> Protocolo Nº: ' . $protocolo;
        } else {
            $db->rollBack();
            $erro = $stmt->errorInfo();
            $response['message'] = 'Erro ao cadastrar atendimento.';
        }
    } catch (PDOException $e) {
        $db->rollBack();
        $response['message'] = "Erro ao executar no banco de dados: " . $e->getMessage();
    }
} else {
    $response['message'] = "Requisição inválida.";
}

echo json_encode($response);
