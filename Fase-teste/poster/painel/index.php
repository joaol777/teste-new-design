<?php
	require_once '../system/config.php';
	require_once '../system/database.php';

	if (isset($_GET['action']) && isset($_GET['id']) && !empty($_GET['action']) && !empty($_GET['id'])) {
		$id = DBEscape(strip_tags(trim($_GET['id'])));
		switch ($_GET['action']) {
			case 1:
				DBUpdate('posts', array('status' => 1), "id = '{$id}'");
				break;
			case 2:
				DBUpdate('posts', array('status' => 0), "id = '{$id}'");
				break;
			case 3:
				DBDelete('posts', "id = '{$id}'");
				break;
		}
		header('Location: index.php');
	}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>Gerenciar Postagens</title>
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

        a {
            color: #007bff;
            text-decoration: none;
            margin-right: 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        .post {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .post p {
            margin-bottom: 10px;
            font-size: 14px;
        }

        .post a {
            font-size: 14px;
        }

        .post .content {
            margin-top: 10px;
            font-size: 16px;
            color: #555;
        }
    </style>
</head>

<body>
	
	<h2>
		Gerenciar Postagens | <a href="add-post.php" title="Adicionar">Adicionar</a> | <a href="../index.php" title="Adicionar">Voltar</a>
	</h2>

	<?php
		$posts = DBRead('posts', 'ORDER BY data DESC');

		if (!$posts)
			echo '<h2>Nenhuma postagem encontrada!</h2>';
		else 
			foreach ($posts as $post):
	?>

	<div class="post">
		<h2><?php echo $post['titulo']; ?></h2>

		<p>
			por <b><?php echo $post['autor']; ?></b>
			em <b><?php echo date('d/m/Y', strtotime($post['data'])); ?></b> |
			Visitas <b><?php echo $post['visitas']; ?></b>
		</p>

		<p class="content">
			<?php echo nl2br($post['conteudo']); ?>
		</p>

		<p>
			<?php 
				if (!$post['status'])
					echo '<a href="?action=1&&id='. $post['id'] .'" title="Ativar">Ativar</a>';
				else
					echo '<a href="?action=2&&id='. $post['id'] .'" title="Desativar">Desativar</a>';
			?>
			<a href="edit-post.php?id=<?php echo $post['id']; ?>" title="Editar">Editar</a>
			<a href="?action=3&&id=<?php echo $post['id']; ?>" title="Deletar">Deletar</a>
		</p>
		
	</div>

	<?php endforeach; ?>
</body>
</html>
