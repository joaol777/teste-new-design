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
	    <img src="undraw_Studying_re_deca (2).png" alt="TENTE NOVAMENTE!">
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
<style>@import url('https://fonts.cdnfonts.com/css/falling-sky');

* {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      background-color:  #212529;
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
  
    .title {
	display: flex;
	justify-content: center;
  margin-top: 30px;
	font-family: 'Falling Sky', sans-serif;  
	color: #FFFFFF;
  }
  
   .title h1 {
    font-size: 2rem;
  }

.inputGroup {
	display: flex;
	flex-direction: column;
	justify-content: center;
	font-weight: bold;
  font-family: 'Bree Serif', sans-serif;
  }
  
  .inputGroup label {
	font-size: 20px;
	color: #FFFFFF;
	font-family: 'Bree Serif', sans-serif;
  }

  .inputBox {
	display: flex;
	flex-direction: column;
	border-radius: 10px;
  }
  
   .inputBox input {
	margin: 1px;
	padding: 1px;
	border: 1px solid #090d0a;
	border-radius: 5px;
	box-shadow: 1px 1px 5px #090d0a;
	height: 35px;
  }

  .inputBox::placeholder {
  font-family: 'Bree Serif', sans-serif;
  font-size: 15px;
	color: #090d0a;
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
	border: 1px solid #000000;
	background-color: #212529;
	color: #FFFFFF;
	padding: 1px;
	border-radius: 5px;
	cursor: pointer;
	margin-top: 3px;
	font-size: 20px;
	font-family: 'Falling Sky', sans-serif;  										  
  }

  .confirmButton button {
	width: 100%;
	margin: 1px;
  border: 1px solid #000000;
  background-color: #212529;
  color: #FFFFFF;
	padding: 1px;
	border-radius: 5px;
	cursor: pointer;
	margin-top: 5px;
	font-size: 20px;
  font-family: 'Falling Sky', sans-serif;  							  
  }

  .confirmButton button a {
	text-decoration: none;
	font-weight: 10px;
	color:#FFFFFF;
  }

  .registerButton button a {
	text-decoration: none;
	font-weight: 10px;
	color: #FFFFFF;
  }

  .forgotPasswordLink a {
	margin: 1px;
	padding: 1px;
	margin-bottom: 30px;
	text-decoration: none;
  color: #FFFFFF;
	font-size: 20px;
	font-weight: bold;
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
      height: 100%;
    }
  }

@media screen and (max-width: 1064px) {
    .container {
        height: 70%;
        width: 65%; 
    }

    .inputGroup {
        flex-direction: column; 
    }
	
	.title p{
	font-size: 2rem;
	}
    
    .forgotPasswordLink a{
        font-size: 1.2rem;
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
        font-size: 3.5rem; 
    }
}


@media screen and (max-width: 768px) {
  .container{
      width: 100%;
      height: 75%;
      display: flex;
      align-items: center;
      justify-content: center;
  }

      .inputGroup label,
    .inputBox input {
        font-size: 1.2rem; 
        width: 100%; 
    }

    .loginButton button,
    .confirmButton button {
        font-size: 1.5rem; 
    }
    
    .form{
      height: 100%;
    }

    .title h1 {
        font-size: 3rem;
    }

    .forgotPasswordLink a {
        font-size: 1rem;
        margin-bottom: 1rem ;
    }
  
    .confirmButton button, .loginButton button{
      max-height: 80%;
    }
}

@media screen and (max-width: 575px){
   .container{
     width: 85%;
   }
   
   .title {
     font-size: 2.5rem;
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
</style>
</html>