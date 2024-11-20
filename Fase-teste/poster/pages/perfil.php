<?php
session_start(); // Sessão deve ser iniciada antes de qualquer saída HTML

require_once '../system/config.php';
require_once '../system/database.php';
require_once '../../back/conexao.php';

if (!isset($_SESSION['username'])) {
    // Caso o usuário não esteja logado, redireciona para a página de login
    header("Location: ../index.php");
    exit;
}

$usuGmail = $_SESSION['username'];

try {
    // Estabelece a conexão com o banco de dados
    $conexao = novaConexao();
    
    // Consulta segura usando parâmetros preparados
    $sql = "SELECT * FROM tblUsuario WHERE usuEmail = :email";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':email', $usuGmail, PDO::PARAM_STR);
    $stmt->execute();

    // Busca os dados do usuário
    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        $usuNome = $usuario['usuNome'];
        $usuNascimento = $usuario['usuDataNascimento'];
        $usuImagem = $usuario['usuImagem'];
		$usuDescricao = $usuario['usuDescricao'];
    } else {
        echo '<p class="text-light">Usuário não encontrado.</p>';
        exit;
    }
} catch (PDOException $e) {
    // Exibe uma mensagem de erro se a conexão falhar
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="./img/undraw_Profile_pic_re_iwgo.png">
	<link href="https://fonts.cdnfonts.com/css/labor-union" rel="stylesheet">
	<link href="https://fonts.cdnfonts.com/css/medula-one" rel="stylesheet">
	<link href="https://fonts.cdnfonts.com/css/bree-serif-2" rel="stylesheet">
	<link rel="text/css" href="css/perfil.css">
	<link rel="stylesheet" type="text/css" href="perfil.css"/>
	<title>StudyBuddy - Página de Perfil</title>
</head>

<body>
	<div class="HeaderContainer">
		<header class="NavbarHeader">
			<nav class="navbar navbar-light bg-faded">
				<h5 class="titlePerfil">Seja bem vindo, TESTE!</h5>
				<!-- OBS.N°1: Utilizar SESSION para implementar o nome do usuario-->
				<div class="IndexButton">
					<button><a href="index.php">Voltar para a página inicial</a></button>
				</div>
			</nav>
		</header>
	</div>
	<div class="MainContainer">
		<div class="card">
			<div class="row">
				<div class="col-12 col-md-6">
					<div class="PerfilIntroductionContainer">
						<section>
							<div class="column">
								<div class="PerfilImage">
									<?php
									
											$imagemPath = "../img/img-perfil/" . htmlspecialchars($usuImagem);
										if (file_exists($imagemPath)) {
											echo '<a href="../pages/perfil.php"><img src="' . $imagemPath . '" width="40" height="40" class="rounded-circle" alt="profile"></a>';
										} else {
											echo '<a href="../pages/perfil.php"><img src="img/defalt.png" width="40" height="40" class="rounded-circle" alt="default profile"></a>';
										}
										?>
								</div>
								<div class="PerfilIntroduction">
								  <div class="Information">
									<div class="PerfilUsername">	
										<?php
									 echo '<p ">Olá, ' . htmlspecialchars($usuNome) . '</p>';
									   ?>
									</div>
									<div class="PerfilEmail">
									<?php
									 echo '<p ">Gmail: ' . htmlspecialchars($usuGmail) . '</p>';
									   ?>
									</div>
									<div class="PerfilBirthday">
									<?php
									 echo '<p ">Data de nascimento: ' . htmlspecialchars($usuNascimento) . '</p>';
									   ?>									</div>
								  </div>
									<div class="EditButton">
										<button><a href="">Editar</a></button>
								 </div>	
									
							</div>
						</section>
					</div>
				</div>
				<div class="col-12 col-md-6">
					<div class="PerfilInformationContainer">
						<section>
							<div class="column2">
								<div class="DescriptionContainer">
									<div class="subTitle">
										<h6 class="subtitleDescription">Descrição</h6>
									</div>
									<div class="cardDescription overflow-y-auto">
										<div class="ContainerDescriptionArea">
										<?php
									
									 echo '<text class="descriptionArea" class="swal2-input" rows="3" cols="63" name="usuDescrição">' .  htmlspecialchars($usuDescricao) .'</text>';
									   ?>												
									</div>
								</div>

								<div class="HistoricoContainer">
									<div class="subTitle">
										<h6 class="subtitleHistoric">Histórico</h6>
									</div>
									<div class="cardHistoric overflow-y-auto">
									<main class="col-md-10 content">
            <div class="container mt-3">
                <?php
                // Supondo que você tenha uma função DBRead para buscar os posts
                $posts = DBRead('posts', "WHERE status = 1 AND autor = '{$usuGmail}' ORDER BY data DESC");

                if (!$posts):
                ?>
                    <div class="post-card bg-secondary text-light p-3 mb-4 rounded">
                        <p>Nenhuma postagem encontrada!</p>
                    </div>
                <?php else:
                    foreach ($posts as $post):
                ?>
                    <div class="post-card bg-secondary text-light p-3 mb-4 rounded">
                        <h5>
                            <a href="exibe.php?id=<?php echo $post['id']; ?>" class="text-light">
                                <?php echo htmlspecialchars($post['titulo']); ?>
                            </a>
                        </h5>
                        <p class="mb-1"><?php echo strip_tags($post['conteudo']); ?></p>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-sm btn-outline-light me-2"><i class="bi bi-hand-thumbs-up"></i> Curtir</button>
                            <button class="btn btn-sm btn-outline-light" onclick="window.location.href='../exibe.php?id=<?php echo $post['id']; ?>'; return false;"><i class="bi bi-chat-left"></i> Comentar</button>
                        </div>
                    </div>
                <?php endforeach;
                endif;
                ?>
            </div>
            <div class="content-footer-space"></div>
        </main>
										<div>



										</div>
									</div>
								</div>
							</div>
						</section>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>