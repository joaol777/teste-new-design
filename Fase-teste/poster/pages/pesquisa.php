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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyBuddy - Home</title>
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">
    <style>
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 200px;
            background-color: #343a40;
            padding-top: 20px;
            overflow-x: hidden;
        }

        .content {
            margin-left: 220px;
            padding: 10px;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #000;
            color: white;
            text-align: center;
            padding: 10px;
        }

        .content-footer-space {
            margin-bottom: 80px;
        }
    </style>
</head>
<body class="bg-dark text-light">

<!-- Navbar superior -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand h1 ms-3" href="index.php">StudyBuddy</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex mx-auto w-50" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light" type="submit"><i class="bi bi-search"></i></button>
            </form>
            
            <?php
            if (isset($usuNome)) {
                echo '<p class="text-light">Olá, ' . htmlspecialchars($usuNome) .'!</p>';
            } else {
                echo '<p class="text-light">Usuário não logado.</p>';
            }
            ?>

            <?php
            ////////////////////////////////////////////////////////////////////////////////////////////////////////
            // Verifica se a imagem existe
            $imagemPath = "../img/img-perfil/" . htmlspecialchars($usuImagem);
            if (file_exists($imagemPath)) {
                echo '<a href="../pages/perfil.php"><img src="' . $imagemPath . '" width="40" height="40" class="rounded-circle" alt="profile"></a>';
            } else {
                echo '<a href="../pages/perfil.php"><img src="img/defalt.png" width="40" height="40" class="rounded-circle" alt="default profile"></a>';
            }
          //////////////////////////////////////////////////////////////////////////////////////////////////////////////
          
            ?>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 sidebar py-4">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-light" href="../index.php"><i class="bi bi-house-door"></i> studybuddy</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="../index.php"><i class="bi bi-house-door"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#"><i class="bi bi-graph-up"></i> Popular</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#"><i class="bi bi-search"></i> Explore</a>
                </li>
                <li class="nav-item mt-4">
                    <button class="btn btn-outline-light w-100" onclick="window.location.href='../painel/add-post.php'; return false;">Criar Postagem</button>
                </li>
                <li class="nav-item mt-2">
                    <button class="btn btn-outline-light w-100" onclick="window.location.href='../painel/edit-post.php'; return false;">Editar Postagem</button>
                </li>
            </ul>
        </nav>

        <!-- Conteúdo principal -->
        <main class="col-md-10 content">
            <div class="container mt-3">
                <?php
                // Supondo que você tenha uma função DBRead para buscar os posts
                $posts = DBRead('posts', "WHERE status = 1 AND tag = '6' ORDER BY data DESC");

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
                            <a href="../exibe.php?id=<?php echo $post['id']; ?>" class="text-light">
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
    </div>
</div>

<!-- Footer fixo -->
<footer>
    <p>StudyBuddy &copy; 2024</p>
    <ul class="list-inline">
        <li class="list-inline-item"><a href="#" class="text-light">Entrar</a></li>
        <li class="list-inline-item"><a href="#" class="text-light">Cadastrar-se</a></li>
    </ul>
</footer>

<script src="../bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>
