<?php
session_start();
include_once('conexao.php');

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cpf = $_POST['cpf'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM assistentes WHERE cpf = :cpf";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            //if ($senha == $row['senha']){
            if (password_verify($senha, $row['senha'])) {
                if (!empty($row['foto'])) {
                    $_SESSION['foto_usuario'] = $row['foto'];
                } else {
                    $_SESSION['foto_usuario'] = 'assets/img/kaiadmin/default.png'; 
                }
                $_SESSION['autenticado'] = true;
                $_SESSION['id_assistente'] = $row['id'];
                $_SESSION['nome_usuario'] = $row['nome'];
                $_SESSION['email_usuario'] = $row['email'];
                $_SESSION['cpf_usuario'] = $row['cpf'];
                $_SESSION['cress_usuario'] = $row['cress'];
                $_SESSION['local_usuario'] = $row['local'];
                $_SESSION['atendimentos_usuario'] = $row['atendimentos'];
                $_SESSION['funcao_usuario'] = $row['funcao'];
                $_SESSION['matricula_usuario'] = $row['matricula'];
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Credenciais validadas, redirecionando...',
                    'redirect' => 'index.php',
                ]);
                exit;
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'CPF ou senha incorretos.',
                ]);
                exit;
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Usuário não encontrado.',
            ]);
            exit;
        }
    }
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Erro ao conectar ao banco de dados: ' . $e->getMessage(),
    ]);
    exit;
}
?>
