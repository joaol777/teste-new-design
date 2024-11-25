<?php
session_start(); 
	require_once '../system/config.php';
	require_once '../system/database.php';

	if (!isset($_GET['id']) || empty($_GET['id']))
		header('Location: index.php');
	else {
		$id 	= DBEscape(strip_tags(trim($_GET['id'])));
		$post 	= DBRead('posts', "WHERE id = '{$id}' LIMIT 1");

		if (!$post)
			header('Location: index.php');
		else
			$post = $post[0];
	}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>Editar Postagem : <?php echo $post['titulo']; ?></title>
	<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
	<script>tinymce.init({selector:'textarea'});</script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #444;
            text-align: center;
        }

        hr {
            border: 0;
            height: 1px;
            background: #ddd;
            margin: 20px 0;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
        }

        form input[type="text"], form textarea, form select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        form input[type="submit"] {
            background: #28a745;
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
            background: #218838;
        }

        .error {
            color: #d9534f;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }

        .success {
            color: #28a745;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
	
	<h2>
		Editar Postagem | <a href="index.php" title="Voltar">Voltar</a>
	</h2>
	<hr>

	<?php
		
		if(isset($_POST['salvar'])){
		$form['titulo'] 	= DBEscape(strip_tags(trim($_POST['titulo'])));
		$form['autor'] 	= DBEscape(strip_tags(trim($_POST['autor'])));
		$form['status'] 	= DBEscape(strip_tags(trim($_POST['status'])));
		$form['data']		= date('Y-m-d H:i:s');
		$form['conteudo'] 	= str_replace('\r\n', "\n", DBEscape(trim($_POST['conteudo'])));
		$form = DBEscape($form);

		if (empty($form['titulo']))
			echo '<p class="error">Preencha o campo Título.</p>';
		else if (empty($form['autor']))
			echo '<p class="error">Preencha o campo Autor.</p>';
		else if (empty($form['status']) && $form['status'] != '0')
			echo '<p class="error">Preencha o campo status.</p>';
		else if (empty($form['conteudo']))
			echo '<p class="error">Preencha o campo conteúdo.</p>';
		else{

			$dbCheck = DBRead('posts', "WHERE titulo = '". $form['titulo'] ."' AND id != '{$id}'");
			if ($dbCheck)
				echo '<p class="error">Desculpe, mas já existe uma postagem com este título.</p>';
			else {

				if (DBUpdate('posts', $form, "id = '{$id}'")){
					echo '<p class="success">Sua postagem foi editada com sucesso!</p>';
					$post = DBRead('posts', "WHERE id = '{$id}' LIMIT 1");
					$post = $post[0];
				}
				else
					echo '<p class="error">Desculpe, ocorreu um erro...</p>';
			}
		}

		echo '<hr>';
	}
	?>

	<form action="" method="post">

		<p>
			<label for="titulo">Titulo</label>
			<input type="text" id="titulo" name="titulo" value="<?php echo $post['titulo']; ?>">
		</p>

		<p>
			<label for="autor">Autor</label>
			<input type="text" id="autor" name="autor" value="<?php echo $post['autor']; ?>">
		</p>

		<p>
			<label for="status">Status</label>
			
			<select id="status" name="status">
				<?php if ($post['status']): ?>
				<option value="1" selected>Ativo</option>
				<option value="0">Inativo</option>
				<?php else: ?>
				<option value="1">Ativo</option>
				<option value="0" selected>Inativo</option>
				<?php endif; ?>
			</select>
		</p>

		<p>
			<label for="conteudo">Conteúdo</label>
			<textarea id="conteudo" name="conteudo" cols="50" rows="15"><?php echo $post['conteudo']; ?></textarea>
		</p>

		<input type="submit" name="salvar" value="Salvar">
		
	</form>

</body>
</html>
