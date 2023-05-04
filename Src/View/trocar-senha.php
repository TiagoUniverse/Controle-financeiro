<?php

/**
 * ╔═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════╗
 * ║                                               CONTROLE FINANCEIRO                                                 ║
 * ║  ┌─────────────────────────────────────────────────────────────────────────────────────────────────────────────┐  ║
 * ║  │ @description: Register of all money spent                                                                   │  ║
 * ║  | @dir: View                                                                                                  │  ║
 * ║  │ @author: Tiago César da Silva Lopes                                                                         │  ║
 * ║  │ @date: 02/02/23                                                                                             │  ║
 * ║  └─────────────────────────────────────────────────────────────────────────────────────────────────────────────┘  ║
 * ║═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════║
 */

require_once "conexao.php";
require_once "Recursos/Navegacao.php";

/*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │                                Usuario's section                                                              │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

require_once "../Model/Usuario_repositorio.php";

use model\Usuario_repositorio;

require_once "../Model/Usuario.php";

use model\Usuario;

$Usuario = new Usuario();
$Usuario_repositorio = new Usuario_repositorio();

/*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │                                Function's section                                                             │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

if (isset($_POST['status_alteracao']) && $_POST['status_alteracao'] == "ALTERANDO A SENHA") {

  $mensagemVermelha = true;

  if ($_POST['senha'] != $_POST['repitaSenha']) {
    $mensagem = "Informe senhas iguais!";
  } else {

    $return = $Usuario_repositorio->alterar_senha($_POST['senha'], $_SESSION['user_id'], $pdo);

    if ($return) {
      $mensagem = "Alteração de senha com sucesso!";
      $mensagemVermelha = false;
    } else {
      $mensagem = "Falha na alteração de senha! Por favor, tente novamente.";
    }
  }

  // Mensagem do resultado
  if ($mensagemVermelha) {
    echo "<div class='mensagem-alertDanger'> ";
  } else {
    echo "<div class='mensagem-alertSucess'> ";
  }
  echo $mensagem;
  echo "</div>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" type="x-icon" href="../../Assets/img/calendario.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../../Assets//Css//styles.css" rel="stylesheet">
  <link href="../../Assets//Css//dropdown.css" rel="stylesheet">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
  <title>Alteração de senha</title>
</head>

<body>
  <?php require_once "Recursos/Navegacao.php"; ?>
  <a href="home.php" class="voltar-menu">Voltar</a>
  <div class="Senha-group">
    <main class="main-Senha">
      <h2>Trocar senha</h2>
      <form action="trocar-senha.php" method="post">
        <input type="hidden" name="status_alteracao" value="ALTERANDO A SENHA">
        <label>• Senha:</label><input type="password" name="senha" required>
        <label>• Repita a senha:</label><input type="password" name="repitaSenha" required>
        <button type="submit">Alterar a senha</button>
      </form>
    </main>
  </div>


</body>

</html>