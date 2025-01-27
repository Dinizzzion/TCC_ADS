<?php
require_once 'conexao.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        if (empty($id)) {
            echo json_encode(['error' => 'ID não fornecido.']);
            exit;
        }

        try {
            $query = "SELECT COUNT(*) FROM atendimentos WHERE id_usuario = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            if ($count > 0) {
                echo json_encode(['error' => 'Não é possível remover o usuário porque o mesmo possui atendimentos cadastrados.']);
            } else {
                $query = "DELETE FROM usuarios WHERE id = :id";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    echo json_encode(['success' => 'Usuário removido com sucesso!']);
                } else {
                    echo json_encode(['error' => 'Erro ao remover o usuário.']);
                }
            }
        } catch (PDOException $e) {
            echo json_encode(['error' => 'Erro na consulta: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['error' => 'ID não fornecido.']);
    }
} else {
    echo json_encode(['error' => 'Método de requisição inválido.']);
}
?>
