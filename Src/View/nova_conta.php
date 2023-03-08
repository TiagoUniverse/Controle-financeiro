

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Assets//Css//login.css">
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

        <?php

if (isset($_POST['status_criacao'])){
  echo "criou";
}
?>

    
        <div class="login-form">
          <form action="nova_conta.php" method="post">
            <input type="hidden" name="status_criacao" value="CRIANDO CONTA">
            <p>Digite um e-mail para acesso</p>
            <input type="email" placeholder="E-mail">
            <p>Digite a sua senha</p>
            <input type="password" placeholder="Senha">

            <button type="submit">Criar conta</button>

          </form>
        </div>
    
      </div>
      </div>
  </div>
    
</body>
</html>