<?php

require_once "conexao.php";

require_once "../Model/Usuario_repositorio.php";
use model\Usuario_repositorio;

$Usuario_repositorio = new Usuario_repositorio();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../Assets//Css//login.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <title>Criar conta</title>
</head>

<body>
  <div class="parent clearfix">
    <div class="bg-illustration">
      <img src="https://i.ibb.co/Pcg0Pk1/logo.png" alt="logo">

      <div class="burger-btn">
        <span></span>
        <span></span>
        <span></span>
      </div>

    </div>

    <div class="login">
      <div class="container">
        <h1>Controle<br />monetário: criar conta</h1>

        <a href="login.php"> Voltar</a>

        <?php

        if (isset($_POST['status_criacao'])) {
          $mensagemVermelha = true;
          
          if ()

        }
        ?>


        <div class="login-form">
          <form action="nova_conta.php" method="post">
            <input type="hidden" name="status_criacao" value="CRIANDO CONTA">
            <p>Digite o seu nome</p>
            <input type="text" placeholder="Nome:" name="nome">
            <p>Digite um e-mail para acesso</p>
            <input type="email" placeholder="E-mail" name="email">
            <p>Digite a sua senha</p>
            <input type="password" placeholder="Senha" name="senha">

            <button type="submit">Criar conta</button>

          </form>
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>