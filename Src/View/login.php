<?php

 /**
 * ╔═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════╗
 * ║                                               CONTROLE FINANCEIRO                                                 ║
 * ║  ┌─────────────────────────────────────────────────────────────────────────────────────────────────────────────┐  ║
 * ║  │ @description: Login                                                                                         │  ║
 * ║  | @dir: View                                                                                                  │  ║
 * ║  │ @author: Tiago César da Silva Lopes                                                                         │  ║
 * ║  │ @date: 09/03/23                                                                                             │  ║
 * ║  └─────────────────────────────────────────────────────────────────────────────────────────────────────────────┘  ║
 * ║═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════║
 */

 require_once "conexao.php";
 require_once "../Model/Usuario_repositorio.php";

use model\Usuario_repositorio;

$Usuario_repositorio = new Usuario_repositorio();

if (isset ($_POST['status_login'])){
  $return = $Usuario_repositorio->login($_POST['email'] , $_POST['senha'] , $pdo);

  if ($return){
    echo "Logando!";
  } else {
    echo "FALHA NO LOGIN";
  }

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../../Assets//Css//login.css">
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
        <h1>Controle<br />monetário</h1>

        <div class="login-form" style="margin-top:90px">
          <form action="login.php" method="post">
            <input type="hidden" name="status_login" value="FAZENDO LOGIN">
            <input type="email" placeholder="E-mail" name="email" required>
            <input type="password" placeholder="Senha" name="senha" required>

            <div class="forget-pass">
              <a href="nova_conta.php">Criar Conta</a>
            </div>

            <button type="submit">Acessar</button>

          </form>
        </div>

      </div>
    </div>
  </div>

</body>

</html>