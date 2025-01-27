<?php
session_start();
include_once("conexao.php");

$response = ['status' => 'error', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST["nome"];
    $local = $_POST["local"];
    $funcao = $_POST["funcao"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $cpf = $_POST["cpf"];
    $cress = $_POST["cress"];
    $matricula = $_POST["matricula"];

    $caminho_arquivo = 'assets/img/kaiadmin/default.png';

    try {
        $db->beginTransaction();
        if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === UPLOAD_ERR_OK) {
            $tipo_arquivo = $_FILES["foto"]["type"];
            $tipos_permitidos = ['image/jpeg', 'image/png'];

            if (in_array($tipo_arquivo, $tipos_permitidos)) {
                $pasta_destino = "assets/img/kaiadmin/";

                if (!is_dir($pasta_destino)) {
                    mkdir($pasta_destino, 0755, true);
                }

                $nome_arquivo = uniqid() . '_' . basename($_FILES["foto"]["name"]);
                $caminho_arquivo = $pasta_destino . $nome_arquivo;

                if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $caminho_arquivo)) {
                    $db->rollBack();
                    $response['message'] = 'Falha ao mover o arquivo.';
                    echo json_encode($response);
                    exit;
                }
            } else {
                $db->rollBack();
                $response['message'] = 'Tipo de arquivo não permitido. Apenas JPG, JPEG e PNG são aceitos.';
                echo json_encode($response);
                exit;
            }
        }

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "INSERT INTO assistentes (nome, local, funcao, email, senha, cpf, cress, matricula, foto) VALUES (:nome, :local, :funcao, :email, :senha, :cpf, :cress, :matricula, :foto)";
        $stmt = $db->prepare($sql);

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":local", $local);
        $stmt->bindParam(":funcao", $funcao);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":senha", $senha_hash);
        $stmt->bindParam(":cpf", $cpf);
        $stmt->bindParam(":cress", $cress);
        $stmt->bindParam(":matricula", $matricula);
        $stmt->bindParam(":foto", $caminho_arquivo);

        if ($stmt->execute()) {
            $db->commit();
            $response['status'] = 'success';
            $response['message'] = 'Usuário cadastrado com sucesso!';
        } else {
            $db->rollBack();
            $erro = $stmt->errorInfo();
            $response['message'] = 'Erro ao cadastrar usuário.';
        }
    } catch (PDOException $e) {
        $db->rollBack();
        $response['message'] = "Erro ao executar no banco de dados: " . $e->getMessage();
    }

    echo json_encode($response);
}
