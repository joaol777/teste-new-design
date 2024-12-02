<?php
require_once "back/conexao.php";

$gmail = ""; 
$form = []; // Inicializa o array $form

// Conexão com o banco de dados para buscar as tags
$conexao = novaConexao();
$sqlTags = "SELECT tagNome FROM tbl_Tags";
$stmtTags = $conexao->prepare($sqlTags);
$stmtTags->execute();
$tags = $stmtTags->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // pega os dados do formulário
    $nome = trim($_POST["usuNome"]);
    $email = trim($_POST["usuEmail"]);
    $senha = trim($_POST["usuSenha"]);
    $dataNascimento = $_POST["usuDataNascimento"];
    $descricao = trim($_POST["usuDescricao"]); // Nova descrição

    // Verifica se o e-mail já está cadastrado no banco
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

        // Insere os dados no banco de dados, incluindo a descrição
        $sql = "INSERT INTO tblUsuario (usuNome, usuEmail, usuSenha, usuDataNascimento, usuDataCadastro, usuImagem, usuDescricao) 
                VALUES (:nome, :email, :senha, :dataNascimento, NOW(), :imagem, :descricao)";
        $stmt = $conexao->prepare($sql);

        // Faz o bind dos valores
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
        $stmt->bindParam(':dataNascimento', $dataNascimento, PDO::PARAM_STR);
        $stmt->bindParam(':imagem', $imagemNome, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR); // Bind da descrição

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
      <img src="undraw_Teacher_re_sico(2).png" alt="TENTE NOVAMENTE!">
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
            <label for="descricao">Descrição:</label>
            <input id="descricao" placeholder="Digite uma breve descrição sobre você" name="usuDescricao" rows="4" required>
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
</html>

<style>
@import url('https://fonts.cdnfonts.com/css/falling-sky');

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  background-color: #212529;
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
  background-color: #2b3035;
  padding: 1rem;
}

.formImage img {
  width: 40rem;
}

.form {
  width: 50%;
display: flex;
  justify-content: center;
  align-items: left;
  flex-direction: column;
  background-color: #343A40;
  padding: 3rem;
}

.form input {
  margin: 0.5rem 0;
}

.form textarea {
  margin: 0.5rem 0;
}

.form button {
  margin: 0.3rem 0;
}

.title {
  display: flex;
  justify-content: center;
  align-items: start;
  font-family: 'Falling Sky', sans-serif;   
  color: #FFFFFF;
}

.title h1 {
  font-size: 2rem;
} 

.loginButton button {
  width: 100%;
  border: 1px solid #000000;
  background-color: #212529;
  padding: 1px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 20px;
  font-family: 'Falling Sky', sans-serif;                                                
}

.confirmButton button {
  width: 100%;
  border: 1px solid black;
  background-color: #212529;
  color: #FFFFFF;
  padding: 1px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 20px;
  font-family: 'Falling Sky', sans-serif;                                              
  cursor: pointer;
}

.loginButton a {
  text-decoration: none;
  font-weight: 10px;
  color: #FFFFFF;
}

.inputGroup {
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.inputBox {
  display: flex;
  flex-direction: column;
  border-radius: 10px;
}

.inputGroup label {
  font-size: 20px;
  color: #FFFFFF;
  font-family: 'Bree Serif', sans-serif;
}

.inputBox input {
  margin: 1px;
  padding: 1px;
  border-radius: 5px;
  height: 35px;
}

.inputBox ::placeholder {
  font-family: 'Bree Serif', sans-serif;
  font-size: 15px;
}

.inputBox input:focus-visible {
  border: 1px solid #090d0a;
  border-radius: 3px;
  outline: none;
}

.buttonContainer {
  margin-top: 30px;
}

@media screen and (max-width: 1255px) {
  .formImage {
    display: none;
  }

  .container {
    width: 50%;
  }

  .form {
    width: 100%;
    height: 100%;
  }
}

@media screen and (max-width: 1064px) {
  .container {
    height: 90%;
    width: 90%; 
}

 .inputGroup {
    flex-direction: column; 
}

  .title p{
margin-top: 60px;
font-size: 2rem;
}

.buttonContainer{
  margin: 1rem;
}
}


@media screen and (max-width: 1024px) {
  .container {
      flex-direction: column; 
      height: 85%; 
  }

  .formImage {
      width: 100%; 
      display: none; 
  }

  .form {
      width: 100%; 
      padding: 2rem; 
  }

  .title h1 {
      font-size: 3.5rem; 
  }
}

@media screen and (max-width: 991px) {
  .container {
      flex-direction: column; 
      height: 85%; 
  }
}

@media screen and (max-width: 767px) {
  .container{
      width: 85%;
      height: 87%;
      display: flex;
      align-items: center;
      justify-content: center;
  }

    .inputGroup label,
    .inputBox input {
      width: 100%;
        height: 100%; 
    }

    .loginButton button,
    .confirmButton button {
        font-size: 1.2rem; 
    }
    
    .form{
      height: 100%;
    }

    .title h1 {
        font-size: 3.2rem;
    }
  
    .confirmButton button, .loginButton button{
      max-height: 80%;
    }
}

@media screen and (max-width: 575px){
  .container{
    width: 87%;
    height: 83%;
  }
  
  .title {
    font-size: 1rem;
    justify-content: center;
    align-items: center;
    text-align: center;
  }
  
  .form {
    width: 100%;
  }
  
  .inputBox {
    max-width: 110%;
  }
}

@media screen and (max-height: 896px){
  .container {
    width: 90%;
    height: 65%;
  }

  .inputGroup label,
    .inputBox input {
      width: 100%;
        height: 100%; 
    }

    .loginButton button,
    .confirmButton button {
        font-size: 1.2rem; 
    }
    
    .form{
      height: 100%;
    }

    .title h1 {
        font-size: 3.2rem;
    }
  
    .confirmButton button, .loginButton button{
      max-height: 80%;
    }
}

@media screen and (max-height: 932px){
  .container {
    width: 90%;
    height: 65%;
  }

  .title h1 {
    font-size: 3rem;
    margin-top: 0.5rem;
}
}

@media screen and (max-height: 740px){
  .title h1 {
    font-size: 2.5rem;
    margin-top: 0.5rem;
}
}

@media screen and (max-height: 915px){
  .container {
    width: 80%;
    height: 80%;
  }
  
  .title h1 {
    font-size: 2.7rem;
    margin-top: 1rem;
}
}
</style>
</html>
