<?php
session_start();
require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["usuEmail"]);
    $password = trim($_POST["usuSenha"]);

    //  o que está sendo enviado
    var_dump($username, $password);

    $conexao = novaConexao();

    $sql = "SELECT * FROM tblUsuario WHERE usuEmail = :username";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($password === $usuario['usuSenha']) {
            $_SESSION['minhaVariavel'] = 'Olá, mundo!';
            $_SESSION["username"] = $username;
            header("Location: ../poster/index.php");
            exit;
        } else {
            echo "Senha incorreta!";
        }
    } else {
      header("Location:../");
    }
} else {
    header("Location: login.php");
    exit;
}

?>
