<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="./img/undraw_knowledge_re_5v9l.svg">
	<link href="https://fonts.cdnfonts.com/css/labor-union" rel="stylesheet">
	<link href="https://fonts.cdnfonts.com/css/medula-one" rel="stylesheet">
	<title>StudyBuddy - Login</title>
</head>
<body>
    <div class="container">
      <div class="formImage">
	    <img src="undraw_knowledge_re_5v9l.png" alt="TENTE NOVAMENTE!">
	  </div>
	  
	  <div class="form">
        <form action="back/verificar.php" method="POST">
		  <div class="title">
		    <h1>Faça o seu login</h1>
		  </div>
		  
		  <div class="inputGroup">
		    <div class="inputBox">
			  <label for="senha">E-mail:</label>
			   <input id="username" type="text" placeholder="Digite seu E-mail" name="usuEmail" size="40" required></input>
		    </div>
		    
		  <div class="inputBox">
		    <label for="senha">Senha:</label>
			<input id="senha" type="password" placeholder="Digite sua senha" name="usuSenha" size="40" required></input>
		  </div>
		  </div>
		  
		  <div class="py-3">
		   <div class="py-1">
		    <div class="forgotPasswordLink">
			  <a href="#">Esqueceu sua senha?</a>
			  </div>
		    </div>


				  <div class="py-1">
          <div class="confirmButton">
  <button type="submit">Entrar</button>
</div>
</form> 



             <div class="buttonContainer">
             <div class="py-1">
             <div class="registerButton">
  <button onclick="window.location.href='cadastro.php'; return false;">Não possui uma conta? Crie</button>
</div>


					</div>
				  </div>
			   </div>
			</div>
		  </div>

		
	</div>
</body>
<style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body{
   background: rgb(138, 87, 55);
   background: linear-gradient(90deg, rgba(138, 87, 55, 1) 40%, rgba(89, 45, 29, 1) 100%);
   width: 100%;
   height: 100vh;
   display: flex;
   justify-content: center;
   align-items: center;
}

.container{
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
    width: 28rem;
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

.title{
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
  
  .inputGroup {
    display: flex;
    flex-direction: column;
    justify-content: center;
    font-family: 'labor-union', sans-serif;
  	margin-bottom: 20px;
  }

  .inputGroup label {
    font-size: 25px;
    color: #592D1D;
  }

  .inputBox {
    display: flex;
    flex-direction: column;
    border-radius: 10px;
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
  
  .registerButton button {
    width: 100%;
    margin: 1px;
    border: 1px solid black;
    background-color: #BF9673;
    color: #592D1D;
    padding: 1px;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 3px;
    font-size: 20px;
    font-family: 'labor-union', sans-serif;
  }
  
  .confirmButton button {
    width: 100%;
    margin: 1px;
    border: 1px solid black;
    background-color: #BF9673;
    color: #592D1D;
    padding: 1px;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 5px;
    font-size: 20px;
    font-family: 'labor-union', sans-serif;
    cursor: pointer;
  }
  
   .confirmButton button a {
    text-decoration: none;
    font-weight: 10px;
    color:#592D1D;
  }

  .confirmButton button:hover {
    background-color: #f2edeb;
    color:#592D1D;
    transition: 0.5s;
  }
  
  .registerButton button a {
    text-decoration: none;
    font-weight: 10px;
    color:#592D1D;
  }

  .registerButton button:hover {
    background-color: #f2edeb;
    color: #bf9673;
    transition: 0.5s;
  }
  
  
  .forgotPasswordLink a{
  margin: 1px;
  padding: 1px;
  margin-bottom: 20px;
  text-decoration: none;
  color: #592D1D;
  font-weight: 10px;
  font-size: 20px;
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
	
	.title a{
	margin-top: 60px;
	font-size: 2rem;
	}
}


@media screen and (max-width: 1024px) {
    .container {
        flex-direction: column; 
        height: auto; 
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
        font-size: 2rem; 
    }
}


@media screen and (max-width: 768px) {
    .inputGroup label,
    .inputBox input {
        font-size: 1rem; 
        margin-top: 10px; 
    }

    .registerButton a,
    .confirmButton button {
        font-size: 1rem; 
        padding: 0.75rem; 
    }

    .title h1 {
        font-size: 1.5rem;
    }

    .forgotPasswordLink a {
        font-size: 1rem;
    }

    .inputGroup {
        margin-bottom: 2rem;
    }
}



</style>
</html>