<?php
session_start();
include_once('conexao.php');
require_once 'dompdf/autoload.inc.php';

if (!isset($_SESSION['autenticado'])) {
    header('Location: index.html');
    exit;
}

use Dompdf\Dompdf;

$inicio_mes = date('Y-m-01');
$fim_mes = date('Y-m-t');
$id_assistente = $_SESSION['id_assistente'];

if ($id_assistente == 1) {
    $sql = "SELECT a.protocolo, a.assunto, a.data, a.descricao, u.nome AS nome_usuario, s.nome AS nome_assistente 
            FROM atendimentos a
            INNER JOIN usuarios u ON a.id_usuario = u.id
            INNER JOIN assistentes s ON a.id_assistente = s.id
            WHERE a.data BETWEEN :inicio_mes AND :fim_mes
            ORDER BY a.data ASC";
} else {
    $sql = "SELECT a.protocolo, a.assunto, a.data, a.descricao, u.nome AS nome_usuario, s.nome AS nome_assistente 
            FROM atendimentos a
            INNER JOIN usuarios u ON a.id_usuario = u.id
            INNER JOIN assistentes s ON a.id_assistente = s.id
            WHERE a.data BETWEEN :inicio_mes AND :fim_mes
            AND a.id_assistente = :id_assistente
            ORDER BY a.data ASC";
}

$stmt = $db->prepare($sql);
$stmt->bindParam(':inicio_mes', $inicio_mes);
$stmt->bindParam(':fim_mes', $fim_mes);

if ($id_assistente != 1) {
    $stmt->bindParam(':id_assistente', $id_assistente);
}

$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($data) {
    $logoPath = 'assets/img/kaiadmin/Logo_SPAAS.png';
    $logoBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
    
    $conteudo_pdf = "<!DOCTYPE html>";
    $conteudo_pdf .= "<html lang='pt-br'>";
    $conteudo_pdf .= "<head>";
    $conteudo_pdf .= "<meta http-equiv='X-UA-Compatible' content='IE=edge' charset='UTF-8' />";
    $conteudo_pdf .= "<title>Relatório Mensal</title>";
    $conteudo_pdf .= "<style>
        body { font-family: Arial, sans-serif; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .logo { width: 150px; }
        h1 { font-size: 20px; color: #4CAF50; text-align: center; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; color: #333; }
        .table tr:nth-child(even) { background-color: #f9f9f9; }
    </style>";
    $conteudo_pdf .= "</head>";
    $conteudo_pdf .= "<body>";
    
    $conteudo_pdf .= "<div class='header'>
                        <img src='" . $logoBase64 . "' class='logo' alt='Logo'>
                        <h1>Relatório Mensal de Atendimentos</h1>
                      </div>";
    
    $conteudo_pdf .= "<table class='table'>
                        <thead>
                          <tr>
                            <th>Protocolo</th>
                            <th>Assunto</th>
                            <th>Data</th>
                            <th>Usuário</th>
                            <th>Assistente</th>
                            <th>Descrição</th>
                          </tr>
                        </thead>
                        <tbody>";

    foreach ($data as $row) {
        $conteudo_pdf .= "<tr>";
        $conteudo_pdf .= "<td>" . htmlspecialchars($row['protocolo']) . "</td>";
        $conteudo_pdf .= "<td>" . htmlspecialchars($row['assunto']) . "</td>";
        $conteudo_pdf .= "<td>" . date('d/m/Y', strtotime($row['data'])) . "</td>";
        $conteudo_pdf .= "<td>" . htmlspecialchars($row['nome_usuario']) . "</td>";
        $conteudo_pdf .= "<td>" . htmlspecialchars($row['nome_assistente']) . "</td>";
        $conteudo_pdf .= "<td>" . htmlspecialchars($row['descricao']) . "</td>";
        $conteudo_pdf .= "</tr>";
    }

    $conteudo_pdf .= "</tbody></table>";
    $conteudo_pdf .= "</body></html>";

    $dompdf = new Dompdf();
    $dompdf->loadHtml($conteudo_pdf);

    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();

    $dompdf->stream("Relatorio_Mensal_" . date('Y-m') . ".pdf");
} else {
    $dompdf = new Dompdf();
    $dompdf->loadHtml("<h3>Nenhum atendimento lançado este mês</h3>");
    
    $dompdf->setPaper('A4', 'portrait');
    
    $dompdf->render();
    
    $dompdf->stream("Relatorio_Mensal_" . date('m') . ".pdf");
}
?>
