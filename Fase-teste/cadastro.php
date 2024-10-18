<?php
require_once "back/conexao.php";
$gmail = ""; 
$form = []; // Inicializa o array $form

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // pega os dados do formulário
    $nome = trim($_POST["usuNome"]);
    $email = trim($_POST["usuEmail"]);
    $senha = trim($_POST["usuSenha"]);
    $dataNascimento = $_POST["usuDataNascimento"];

    // Verifica se o e-mail já está cadastrado no banco
    $conexao = novaConexao();
    $sqlVerifica = "SELECT * FROM tblUsuario WHERE usuEmail = :email";
    $stmt = $conexao->prepare($sqlVerifica);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $gmail = "Gmail já cadastrado";
    } else {
        // Processa o upload da imagem
        $imagemNome = null;
        if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
            $imagemTemp = $_FILES['imagem']['tmp_name'];
            $imagemNome = basename($_FILES['imagem']['name']);
            $imagemDestino = __DIR__ . '/poster/img/img-perfil/' . $imagemNome;

            if (!move_uploaded_file($imagemTemp, $imagemDestino)) {
                echo "<div class='error'>Falha ao enviar a imagem.</div>";
            }
        }

        // Insere os dados no banco de dados
        $sql = "INSERT INTO tblUsuario (usuNome, usuEmail, usuSenha, usuDataNascimento, usuDataCadastro, usuImagem) 
                VALUES (:nome, :email, :senha, :dataNascimento, NOW(), :imagem)";
        $stmt = $conexao->prepare($sql);

        // Faz o bind dos valores
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->bindParam(':dataNascimento', $dataNascimento, PDO::PARAM_STR);
        $stmt->bindParam(':imagem', $imagemNome, PDO::PARAM_STR); // Armazena o nome da imagem

        if ($stmt->execute()) {
            echo "Cadastro realizado com sucesso!";
            header("Location: index.php");
            exit;
        } else {
            echo "Erro ao cadastrar!";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <link href="https://fonts.cdnfonts.com/css/labor-union" rel="stylesheet">
  <link href="https://fonts.cdnfonts.com/css/medula-one" rel="stylesheet">
  <title>StudyBuddy - Cadastro</title>
</head>
<body>
  <div class="container">
    <div class="formImage">
      <img src="undraw_Teacher_re_sico.png" alt="TENTE NOVAMENTE!">
    </div>

    <div class="form">
      <form method="post" action="" enctype="multipart/form-data"> <!-- Adicionado enctype para upload -->
        <div class="title">
          <h1>Cadastra-se</h1>
        </div>

        <div class="inputGroup">
          <div class="inputBox">
            <label for="nome">Nome de Usuário:</label>
            <input id="nome" type="text" placeholder="Digite seu Nome de Usuário" name="usuNome" size="40" required>
          </div>

          <div class="inputBox">
            <label for="email">E-mail:</label>
            <input id="email" type="email" placeholder="Digite seu E-mail" name="usuEmail" size="40" required>
          </div>

          <div class="inputBox">
            <label for="senha">Senha:</label>
            <input id="senha" type="password" placeholder="Digite sua Senha" name="usuSenha" size="40" required>
          </div>

          <div class="inputBox">
            <label for="dataNascimento">Data de nascimento:</label>
            <input id="dataNascimento" type="date" size="40" name="usuDataNascimento" required>
          </div>

          <div class="inputBox">
            <label for="imagem">Imagem</label>
            <input type="file" name="imagem" id="imagem" required> <!-- Tornar obrigatório -->
          </div>
        </div>
        <?php echo $gmail; ?>
        <div class="py-1">
          <div class="loginButton">
            <button><a href="index.php">Já possui conta? Entre</a></button>
          </div>

          <div class="confirmButton">
            <button type="submit">Cadastrar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>

<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    background: rgb(138, 87, 55);
    background: linear-gradient(90deg, rgba(138, 87, 55, 1) 40%, rgba(89, 45, 29, 1) 100%);
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .container {
    width: 80%;
    height: 80vh;
    display: flex;
    border-radius: 10px;
  }

  .formImage {
    width: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f2edeb;
    padding: 1rem;
  }

  .formImage img {
    width: 31rem;
  }

  .form {
    width: 50%;
    display: flex;
    justify-content: center;
    align-items: left;
    flex-direction: column;
    background-color: #e9dcd5;
    padding: 3rem;
  }

  .form input,
  .form textarea,
  .form button {
    margin: 0.5rem 0;
  }

  .title {
    margin-top: 30px;
    display: flex;
    justify-content: center;
    align-items: start;
    font-family: 'Medula One', sans-serif;
    color: #592D1D;
  }

  .title h1 {
    font-size: 60px;
  }

  .loginButton button {
    width: 100%;
    justify-content: 'center';
    align-items: 'center';
    border: 1px solid black;
    background-color: #BF9673;
    color: #592D1D;
    padding: 1px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 20px;
    font-family: 'labor-union', sans-serif;
  }

  .confirmButton button {
    width: 100%;
    border: 1px solid black;
    margin-bottom: 30px;
    background-color: #BF9673;
    padding: 1px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 20px;
    font-family: 'labor-union';
    cursor: pointer;
  }

  .confirmButton button a {
    text-decoration: none;
    font-weight: 10px;
    color: #592D1D;
  }

  .confirmButton button:hover {
    background-color: #f2edeb;
    color: #8c9538;
    transition: 0.5s;
  }

  .loginButton button:hover {
    background-color: #f2edeb;
    color: #592D1D;
    transition: 0.5s;
  }

  .inputGroup {
    display: flex;
    flex-direction: column;
    justify-content: center;
    font-family: 'labor-union', sans-serif;
  }

  .inputBox {
    display: flex;
    flex-direction: column;
    border-radius: 10px;
  }

  .inputGroup label {
    font-size: 20px;
    color: #592D1D;
  }

  .inputBox input {
    margin: 1px;
    padding: 1px;
    border: 1px solid '#090d0a';
    border-radius: 5px;
    box-shadow: 1px 1px 5px '#090d0a';
    height: 35px;
  }

  .inputBox::placeholder {
    font-family: 'labor-union';
    font-size: 15px;
    color: '#090d0a';
  }

  .inputBox input:hover {
    background-color: #f2edeb;
  }

  .inputBox input:focus-visible {
    border: 1px solid '#090d0a';
    border-radius: 3px;
    outline: none;
  }

  .buttonContainer {
    margin-top: 30px;
  }

  @media screen and (max-width: 1330px) {
    .formImage {
      display: none;
    }

    .container {
      width: 50%;
    }

    .form {
      width: 100%;
    }
  }

  @media screen and (max-width: 1064px) {
    .container {
      height: auto;
      width: 90%;
    }

    .inputGroup {
      flex-direction: column;
      padding: 2rem;
    }
  }
</style>
</html>
