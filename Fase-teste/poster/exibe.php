<?php
session_start();
require_once 'system/config.php';
require_once 'system/database.php';

// Verifica se o ID está definido certinho
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: index.php');
    exit;
}
$id = DBEscape(strip_tags(trim($_GET['id'])));
$post = DBRead('posts', "WHERE id = '{$id}' LIMIT 1");

if ($post) {
    $post = $post[0];
    // Atualiza o contador de visitas
    $upVisitas = array(
        'visitas' => $post['visitas'] + 1
    );
    DBUpdate('posts', $upVisitas, "id = '{$id}'");
} else {
    $post = null; //  $post como null se não houver postagem
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?php echo (!$post) ? 'Erro 404!' : htmlspecialchars($post['titulo']); ?></title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #343a40;
            color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 32px;
            color: #f4f4f4;
            text-align: center;
            margin: 20px 0;
        }

        .post-content {
            background: #212529;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-size: 18px;
            line-height: 1.6;
            color: #f4f4f4;
            margin: 20px auto;
            padding: 20px;
            max-width: 800px;
        }

        .post-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 10px;
        }

        .resposta {
            background: #212529;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 10px;
            margin-bottom: 10px;
        }

        .resposta p {
            margin: 5px 0;
        }

        footer {
            background-color: #000;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        /* Aumentando a margem à esquerda para o conteúdo principal */
        main {
            margin-left: 250px; /* Aumentar este valor para trazer mais à direita */
            padding: 20px;      /* padding superior e inferior */
        }

        .content {
            margin-top: 70px; /* espaço para o navbar */
        }
    </style>
</head>

<body>

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
            <a href="#"><img src="../imgs/Profile-PNG.png" width="40" height="40" class="rounded-circle" alt="profile"></a>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 sidebar py-4" style="position: fixed; height: 100%; background-color: #343a40;">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-light" href="index.php"><i class="bi bi-house-door"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#"><i class="bi bi-graph-up"></i> Popular</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#"><i class="bi bi-search"></i> Explore</a>
                </li>
                <li class="nav-item mt-4">
                    <button class="btn btn-outline-light w-100" onclick="window.location.href='painel/add-post.php'; return false;">Criar Postagem</button>
                </li>
                <li class="nav-item mt-2">
                    <button class="btn btn-outline-light w-100" onclick="window.location.href='painel/edit-post.php'; return false;">Editar Postagem</button>
                </li>
            </ul>
        </nav>

        <!-- Conteúdo principal -->
        <main class="col-md-10 content">
            <h1>
                <?php echo (!$post) ? 'Erro 404!' : htmlspecialchars($post['titulo']); ?> | <a href="index.php" class="text-light">Voltar</a>
            </h1>

            <?php if ($post): ?>
                <div class="post-content">
                    <div class="post-meta">
                        por <b><?php echo htmlspecialchars($post['autor']); ?></b>
                        em <b><?php echo date('d/m/Y', strtotime($post['data'])) ?></b> |
                        Visitas <b><?php echo $post['visitas']; ?></b>
                    </div>
                    <div class="post-text">
                        <?php echo nl2br(htmlspecialchars($post['conteudo'])); ?>
                    </div>
                    <?php if (!empty($post['imagem'])): ?>
                        <img src="img/img-post/<?php echo htmlspecialchars($post['imagem']); ?>" alt="Imagem da postagem">
                    <?php endif; ?>
                </div>

                <hr>

                <?php
                $postId = $_GET['id'];
                $respostas = DBRead('Resposta', "WHERE resPostId = {$postId} ORDER BY resData ASC");

                if ($respostas):
                    foreach ($respostas as $resposta):
                ?>
                    <div class="resposta">
                        <p><strong><?php echo htmlspecialchars($resposta['resAutor']); ?></strong> em <?php echo date('d/m/Y H:i', strtotime($resposta['resData'])); ?></p>
                        <p><?php echo nl2br(htmlspecialchars($resposta['resConteudo'])); ?></p>
                        <hr>
                    </div>
                <?php
                    endforeach;
                else:
                    echo "<p>Sem respostas ainda. Seja o primeiro a responder!</p>";
                endif;
                ?>

                <h3>Deixe uma Resposta</h3>
                <form action="adicionar_resposta.php" method="post">
                    <input type="hidden" name="resPostId" value="<?php echo htmlspecialchars($postId); ?>">
                    <input type="hidden" name="resAutor" value="<?php echo htmlspecialchars($_SESSION['username']); ?>">
                    <p>
                        <label for="resConteudo">Resposta:</label><br>
                        <textarea name="resConteudo" id="resConteudo" rows="5" required></textarea>
                    </p>
                    <p>
                        <button type="submit" class="btn btn-primary">Enviar Resposta</button>
                    </p>
                </form>

            <?php else: ?>
                <div class="error">Postagem não encontrada!</div>
            <?php endif; ?>
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
