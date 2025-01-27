<?php
session_start();
include_once("conexao.php");

$response = ['status' => 'error', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_assistente = $_SESSION['id_assistente'];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $cress = $_POST["cress"];
    $matricula = $_POST["matricula"];
    $senha = $_POST['senha'];

    $caminho_arquivo = '';

    try {
        $sql = "SELECT nome, email, cress, matricula, senha, foto FROM assistentes WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(":id", $id_assistente);
        $stmt->execute();
        $dados_atual = $stmt->fetch(PDO::FETCH_ASSOC);

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
                    $response['message'] = 'Falha ao mover o arquivo.';
                    echo json_encode($response);
                    exit;
                }
            } else {
                $response['message'] = 'Tipo de arquivo não permitido. Apenas JPG, JPEG e PNG são aceitos.';
                echo json_encode($response);
                exit;
            }
        }

        $campos = [];
        $params = [":id" => $id_assistente];

        $campos[] = " nome = :nome";
        $params[":nome"] = !empty($nome) ? $nome : $dados_atual['nome'];

        $campos[] = " email = :email";
        $params[":email"] = !empty($email) ? $email : $dados_atual['email'];

        $campos[] = " cress = :cress";
        $params[":cress"] = !empty($cress) ? $cress : $dados_atual['cress'];

        $campos[] = " matricula = :matricula";
        $params[":matricula"] = !empty($matricula) ? $matricula : $dados_atual['matricula'];

        if (!empty($senha)) {
            $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
            $campos[] = " senha = :senha";
            $params[":senha"] = $senha_criptografada;
        } else {
            $params[":senha"] = $dados_atual['senha'];
            if (!in_array(" senha = :senha", $campos)) {
                $campos[] = " senha = :senha";
            }
        }

        if (!empty($caminho_arquivo)) {
            $campos[] = " foto = :foto";
            $params[":foto"] = $caminho_arquivo;
        } else {
            $params[":foto"] = $dados_atual['foto'];
            if (!in_array(" foto = :foto", $campos)) {
                $campos[] = " foto = :foto";
            }
        }

        $sql = "UPDATE assistentes SET " . implode(", ", $campos) . " WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute($params);

        if ($stmt->rowCount() > 0) {
            $db->commit();
            $response['status'] = 'success';
            $response['message'] = 'Perfil atualizado com sucesso!';
            $_SESSION['nome_usuario'] = $params[":nome"];
            $_SESSION['email_usuario'] = $params[":email"];
            $_SESSION['cress_usuario'] = $params[":cress"];
            $_SESSION['matricula_usuario'] = $params[":matricula"];
            $_SESSION['foto_usuario'] = $params[":foto"];
        } else {
            $db->rollBack();
            $response['message'] = 'Nenhuma alteração foi feita.';
        }
    } catch (PDOException $e) {
        $db->rollBack();
        $response['message'] = "Erro ao executar no banco de dados: " . $e->getMessage();
    }

    echo json_encode($response);
}
