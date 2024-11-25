<?php
ob_start(); // Inicia o buffer de saída
session_start();
require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["usuEmail"]);
    $password = trim($_POST["usuSenha"]);

    $conexao = novaConexao();

    $sql = "SELECT * FROM tblUsuario WHERE usuEmail = :username";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($password === $usuario['usuSenha']) {
            $_SESSION["username"] = $username;
            header('Location: ../poster/index.php');
            exit; // Muito importante para garantir que o script pare
        } else {
            echo "Senha incorreta!";
        }
    } else {
        header("Location: ../"); // Redireciona para a página inicial
        exit;
    }
} else {
    header("Location: ../index.php");
    exit;
}

ob_end_flush(); // Encerra o buffer de saída
?>
