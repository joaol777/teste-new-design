<?php
session_start(); 
	require '../system/config.php';
	require '../system/database.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>Adicionar Categoria</title>
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

        form input[type="text"], form textarea {
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

	<h2>Adicionar Categoria</h2>
	<hr>

	<?php 
		if (isset($_POST['cadastro'])){
			$form['titulo'] = DBEscape(strip_tags(trim($_POST['titulo'])));
			$form['descricao'] = DBEscape(strip_tags(trim($_POST['descricao'])));
			$form['data'] = date('Y-m-d H:i:s');
			
			if (empty($form['titulo']))
				echo '<p class="error">Preencha o campo título!</p>';
			else if (empty($form['descricao']))
				echo '<p class="error">Preencha o campo descrição!</p>';
			else {

				$check = DBRead('categorias', "WHERE titulo = '". $form['titulo'] ."'");
				if ($check)
					echo '<p class="error">Desculpe, categoria já existe!</p>';
				else {

					if (DBCreate('categorias', $form))
						echo '<p class="success">Categoria cadastrada com sucesso!</p>';
					else
						echo '<p class="error">Desculpe, ocorreu um erro!</p>';
				}
			}

			echo '<hr>';
		}
	?>

	<form action="" method="post">
		
		<p>
			<label for="titulo">Titulo</label>
			<input type="text" id="titulo" name="titulo">
		</p>

		<p>
			<label for="descricao">Descrição</label>
			<textarea id="descricao" name="descricao" cols="30" rows="15"></textarea>
		</p>

		<input type="submit" name="cadastro" value="Cadastrar">

	</form>
	
</body>
</html>
