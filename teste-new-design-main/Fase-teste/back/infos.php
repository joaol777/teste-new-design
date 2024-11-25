<?php
session_start(); // Coloque isso em um único arquivo que seja incluído no início de todas as suas páginas
require_once "conexao.php";
$conexao = novaConexao();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["usuEmail"]);
    $password = trim($_POST["usuSenha"]); // Para validação futura.

    // Verificação simples para garantir que os campos não estejam vazios
    if (empty($username) || empty($password)) {
        echo "Por favor, preencha todos os campos.";
        exit;
    }

    // Atualizando a consulta para remover a data de nascimento
    $sql = "SELECT usuNome, usuImagem, usuModerador FROM tblUsuario WHERE usuEmail = :username";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        $usuNome = $usuario['usuNome'];
        $usuImagem = $usuario['usuImagem'];
        $usuModerador = $usuario['usuModerador'];

        // Exibindo as informações do usuário
        echo "Email: " . htmlspecialchars($username) . "<br>";
        echo "Nome: " . htmlspecialchars($usuNome) . "<br>";
        echo "Imagem: <img src='" . htmlspecialchars($usuImagem) . "' alt='Imagem do usuário'><br>";
        echo "Moderador: " . ($usuModerador ? 'Sim' : 'Não') . "<br>";

        // Aqui você pode armazenar as informações na sessão se necessário
        $_SESSION["usuNome"] = $usuNome;
        $_SESSION["usuImagem"] = $usuImagem;
        $_SESSION["usuModerador"] = $usuModerador;

        // Redirecionar após exibir as informações
        header("Location: verificar.php");
        exit;
    } else {
        echo "Usuário não encontrado.";
    }
} else {
    echo "Método de requisição não é POST.";
    echo "Email: " . htmlspecialchars($username); // Debug: mostre o email
}
?>
