<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyBuddy - Home</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../sitecss/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>

<body class="pt-0 m-0 border-0 bd-example bg-light">
 <header> 
   
    <nav class="navbar navbar-expand-lg soft-brown">
        <div class="container-fluid">
          <a class="navbar-brand title h1 ms-3 me-5" href="index.html">StudyBuddy</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse mr-auto mb-2 mb-lg-0" id="navbarSupportedContent">
            <form class="d-flex ms-auto mx-auto src-50" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <img src="../imgs/lupalupa.png" width="30" height="35" class="d-inline-block align-top" alt="logo">
            </form>
          </div>
          <div class="ms-auto me-3">
            <a href="#"><img src="../imgs/Profile-PNG.png" width="50" height="50" class="d-inline-block align-top" alt="profile"></a>
          </div>
        </div>
      </nav>

      <main>
        <div class="row">
            <nav class="col-md-2 sidebar-color">
                <ul class="nav flex-column">
                    <?php
                    $subjects = ["Português", "Matemática", "Biologia", "Português", "Matemática", "Biologia", 
                                 "Português", "Matemática", "Biologia", "Português", "Matemática", "Biologia", 
                                 "Matemática", "Biologia"];
                    foreach ($subjects as $subject) {
                        echo "<li class='nav-item'><a class='nav-link' href='#'>$subject</a></li>";
                    }
                    ?>
                    <li class="nav-item">
                        <span class="nav-link disabled">Disabled</span>
                    </li>
                </ul>
            </nav>
            <section class="col-md-9">
                <div class="post-card">
                    <div class="post-card-header">
                        <h2 class="h5 mb-0">Dica de Estudo: Matemática</h2>
                    </div>
                    <div class="post-card-body">
                        <p>Ao estudar equações, tente visualizar o problema. Desenhe diagramas ou use objetos para representar as variáveis. Isso pode ajudar a entender melhor o conceito.</p>
                    </div>
                    <div class="post-card-footer">
                        <button class="btn btn-sm btn-outline-primary me-2"><i class="bi bi-hand-thumbs-up"></i> Curtir</button>
                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-chat"></i> Comentar</button>
                    </div>
                </div>

                <div class="post-card">
                    <div class="post-card-header">
                        <h2 class="h5 mb-0">Pergunta: Literatura Brasileira</h2>
                    </div>
                    <div class="post-card-body">
                        <p>Alguém pode me explicar a importância de Machado de Assis para a literatura brasileira? Estou tendo dificuldades em entender seu impacto.</p>
                    </div>
                    <div class="post-card-footer">
                        <button class="btn btn-sm btn-outline-primary me-2"><i class="bi bi-hand-thumbs-up"></i> Curtir</button>
                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-chat"></i> Comentar</button>
                    </div>
                </div>

                <div class="post-card">
                    <div class="post-card-header">
                        <h2 class="h5 mb-0">Recurso: Vídeo-aula de Química</h2>
                    </div>
                    <div class="post-card-body">
                        <p>Encontrei este vídeo incrível explicando a tabela periódica. É muito didático e fácil de entender. Confira: <a href="#">link para o vídeo</a></p>
                    </div>
                    <div class="post-card-footer">
                        <button class="btn btn-sm btn-outline-primary me-2"><i class="bi bi-hand-thumbs-up"></i> Curtir</button>
                        <button class="btn btn-sm btn-outline-secondary"><i class="bi bi-chat"></i> Comentar</button>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer class="w-100 soft-brown p-5 jooj">
              <p class="title me-5">StudyBuddy</p>
              </ul>
              <ul class="mb-lg-0"> 
                <li class="ms-auto">
                  <a class="nav-font" href="#">Entrar</a>
                </li>
                <li class="ms-auto">
                  <a class="nav-font" href="#">Cadastrar-se</a>
                </li>
              </ul>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
   <script src="../bootstrap/js/bootstrap.bundle.js"></script>
  </header>
</body> 
</html>


