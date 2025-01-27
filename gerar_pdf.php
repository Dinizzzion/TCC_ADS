<?php
session_start();
include_once('conexao.php');
require_once 'dompdf/autoload.inc.php';

if (!isset($_SESSION['autenticado'])) {
    header('Location: index.html');
    exit;
}

use Dompdf\Dompdf;

$id_assistente = $_SESSION['id_assistente'];
$protocolo = $_GET['protocolo'];

if ($id_assistente == 1) {
    $sql = "SELECT a.protocolo, a.assunto, a.data, a.descricao, u.nome AS nome_usuario, s.local, s.nome AS nome_assistente 
            FROM atendimentos a
            INNER JOIN usuarios u ON a.id_usuario = u.id
            INNER JOIN assistentes s ON a.id_assistente = s.id
            WHERE a.protocolo = :protocolo";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':protocolo', $protocolo);
} else {
    $sqlSetor = "SELECT local FROM assistentes WHERE id = :id_assistente";
    $stmtSetor = $db->prepare($sqlSetor);
    $stmtSetor->bindParam(':id_assistente', $id_assistente);
    $stmtSetor->execute();

    if ($stmtSetor->rowCount() > 0) {
        $rowSetor = $stmtSetor->fetch(PDO::FETCH_ASSOC);
        $local_assistente = $rowSetor['local'];

        $sql = "SELECT a.protocolo, a.assunto, a.data, a.descricao, u.nome AS nome_usuario, s.local, s.nome AS nome_assistente 
                FROM atendimentos a
                INNER JOIN usuarios u ON a.id_usuario = u.id
                INNER JOIN assistentes s ON a.id_assistente = s.id
                WHERE a.protocolo = :protocolo AND s.local = :local";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':protocolo', $protocolo);
        $stmt->bindParam(':local', $local_assistente);
    } else {
        echo json_encode(['error' => 'Assistente não encontrado']);
        exit;
    }
}

$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if ($data) {
    $data['data'] = date('d/m/Y', strtotime($data['data']));
    $logoPath = 'assets/img/kaiadmin/Logo_SPAAS.png';
    $logoBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));

    $conteudo_pdf = "<!DOCTYPE html>";
    $conteudo_pdf .= "<html lang='pt-br'>";
    $conteudo_pdf .= "<head>";
    $conteudo_pdf .= "<meta charset='UTF-8' />";
    $conteudo_pdf .= "<title>Relatório de Atendimento Detalhado</title>";
    $conteudo_pdf .= "<style>
        body { font-family: Arial, sans-serif; color: #333; padding: 20px; }
        header { text-align: center; padding-bottom: 20px; border-bottom: 2px solid #2E86C1; margin-bottom: 20px; }
        header img { width: 120px; margin-bottom: 10px; }
        h1 { color: #2E86C1; text-align: center; font-size: 24px; }
        .content { margin-top: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table, .table th, .table td { border: 1px solid #ddd; padding: 10px; }
        .table th { background-color: #f2f2f2; font-weight: bold; text-align: left; }
        .table td { vertical-align: top; }
        .info { font-size: 14px; margin: 5px 0; }
    </style>";
    $conteudo_pdf .= "</head>";
    $conteudo_pdf .= "<body>";
    $conteudo_pdf .= "<header><img src='" . $logoBase64 . "' alt='Logo'><h1>Relatório de Atendimento Detalhado</h1></header>";
    $conteudo_pdf .= "<div class='content'>";
    $conteudo_pdf .= "<table class='table'>";
    $conteudo_pdf .= "<tr><th>Protocolo</th><td>" . htmlspecialchars($data['protocolo']) . "</td></tr>";
    $conteudo_pdf .= "<tr><th>Assunto</th><td>" . htmlspecialchars($data['assunto']) . "</td></tr>";
    $conteudo_pdf .= "<tr><th>Data</th><td>" . htmlspecialchars($data['data']) . "</td></tr>";
    $conteudo_pdf .= "<tr><th>Assistente</th><td>" . htmlspecialchars($data['nome_assistente']) . "</td></tr>";
    $conteudo_pdf .= "<tr><th>Usuário</th><td>" . htmlspecialchars($data['nome_usuario']) . "</td></tr>";
    $conteudo_pdf .= "<tr><th>Descrição</th><td>" . htmlspecialchars($data['descricao']) . "</td></tr>";
    $conteudo_pdf .= "</table>";
    $conteudo_pdf .= "</div>";
    $conteudo_pdf .= "</body></html>";

    $dompdf = new Dompdf();
    $dompdf->loadHtml($conteudo_pdf);

    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();

    $dompdf->stream("Atendimento_" . $data['protocolo'] . ".pdf");
} else {
    echo json_encode(['error' => 'Atendimento não encontrado']);
}
?>
