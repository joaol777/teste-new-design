<?php
session_start(); 
require_once 'system/config.php';
require_once 'system/database.php';

// Verifica se o formulário foi colocado certinho 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitiza e valida os dados
    $resPostId = intval($_POST['resPostId']);
    $resAutor = trim($_POST['resAutor']);
    $resConteudo = trim($_POST['resConteudo']);

    if (empty($resAutor) || empty($resConteudo)) {
        echo "Todos os campos são obrigatórios.";
        exit;
    }

    // Prepara os dados para serem botados
    $dadosResposta = [
        'resPostId' => $resPostId,
        'resAutor' => htmlspecialchars($resAutor),
        'resConteudo' => htmlspecialchars($resConteudo)
    ];

    // bota a resposta no banco de dados
    if (DBCreate('Resposta', $dadosResposta)) {
        header("Location: exibe.php?id={$resPostId}");
        exit;
    } else {
        echo "Erro ao enviar a resposta. Tente novamente mais tarde.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
