<?php
session_start();
session_unset();
session_destroy();

if(isset($_GET['url'])) {
    $redireciona = $_GET['url'];
    header("Location: index.html");
} else {
    echo "Erro ao sair.";
}
sleep(2);
exit;
?>
