<?php
require '../system/config.php';
require '../system/database.php';
session_start();
$nome_uso = $_SESSION['username'] ?? 'Anônimo'; // Verificação de sessão
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Postagem</title>
    <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
    <script>tinymce.init({selector:'textarea'});</script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #fff;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #fff;
        }

        hr {
            border: 0;
            height: 1px;
            background: #444;
            margin: 20px 0;
        }

        form {
            background: #333;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        form p {
            margin-bottom: 15px;
        }

        form label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #fff;
        }

        form input[type="text"], form textarea, form select {
            width: 100%;
            padding: 10px;
            border: 1px solid #555;
            border-radius: 5px;
            font-size: 16px;
            background-color: #222;
            color: #fff;
            box-sizing: border-box;
        }

        form input[type="submit"] {
            background: #444;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 10px;
        }

        form input[type="submit"]:hover {
            background: #555;
        }

        .error, .success {
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }

        .error {
            color: #d9534f;
        }

        .success {
            color: #28a745;
        }

        a {
            color: #ccc;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <h2>Adicionar Postagem | <a href="../index.php" title="Voltar">Voltar</a></h2>
    <hr>

    <?php
    if(isset($_POST['publicar'])) {
        $form['titulo']   = DBEscape(strip_tags(trim($_POST['titulo'])));
        $form['autor']    = DBEscape(strip_tags(trim($_POST['autor'])));
        $form['status']   = DBEscape(strip_tags(trim($_POST['status'])));
        $form['data']     = date('Y-m-d H:i:s');
        $form['conteudo'] = str_replace('\r\n', "\n", DBEscape(trim($_POST['conteudo'])));
        $form = DBEscape($form);

        if (empty($form['titulo'])) {
            echo "<div class='error'>Preencha o campo Título.</div>";
        } elseif (empty($form['autor'])) {
            echo "<div class='error'>Preencha o campo Autor.</div>";
        } elseif (!isset($form['status']) || $form['status'] === '') {
            echo "<div class='error'>Preencha o campo Status.</div>";
        } elseif (empty($form['conteudo'])) {
            echo "<div class='error'>Preencha o campo Conteúdo.</div>";
        } else {
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
                $imagemTemp = $_FILES['imagem']['tmp_name'];
                $imagemNome = basename($_FILES['imagem']['name']);
                $imagemDestino = __DIR__ . '/../img/img-post/' . $imagemNome;

                if (move_uploaded_file($imagemTemp, $imagemDestino)) {
                    $form['imagem'] = $imagemNome;
                } else {
                    echo "<div class='error'>Falha ao enviar a imagem.</div>";
                    $form['imagem'] = ''; 
                }
            } else {
                $form['imagem'] = ''; 
            }

            if (DBCreate('posts', $form)) {
                echo "<div class='success'>Sua postagem foi enviada com sucesso!</div>";
            } else {
                echo "<div class='error'>Desculpe, ocorreu um erro ao enviar sua postagem...</div>";
            }
        }

        echo '<hr>';
    }
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <p>
            <label for="titulo">Título</label>
            <input type="text" name="titulo" id="titulo">
        </p>

        <p>
            <input type="hidden" name="autor" value="<?php echo htmlspecialchars($nome_uso); ?>">
        </p>

        <p>
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="1" selected>Ativo</option>
                <option value="0">Inativo</option>
            </select>
        </p>

        <p>
            <label for="conteudo">Conteúdo</label>
            <textarea name="conteudo" id="conteudo" cols="50" rows="15"></textarea>
        </p>

        <p>
            <label for="imagem">Imagem</label>
            <input type="file" name="imagem" id="imagem">
        </p>

        <input type="submit" name="publicar" value="Publicar">
    </form>

</body>
</html>
