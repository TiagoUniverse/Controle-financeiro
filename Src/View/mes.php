<?php

/**
 * ╔═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════╗
 * ║                                               CONTROLE FINANCEIRO                                                 ║
 * ║  ┌─────────────────────────────────────────────────────────────────────────────────────────────────────────────┐  ║
 * ║  │ @description: Homepage of a specific month and year                                                         │  ║
 * ║  | @dir: View                                                                                                  │  ║
 * ║  │ @author: Tiago César da Silva Lopes                                                                         │  ║
 * ║  │ @date: 01/02/23                                                                                             │  ║
 * ║  └─────────────────────────────────────────────────────────────────────────────────────────────────────────────┘  ║
 * ║═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════║
 */

require_once "conexao.php";

//Variáveis
if (isset($_POST['nomeMes'])) {
  $_SESSION['nomeMes'] = $_POST['nomeMes'];
}


if (isset($_POST['statusMes'])) {
  $_SESSION['statusMes'] = $_POST['statusMes'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../../Assets//Css//styles.css" rel="stylesheet">
  <link href="../../Assets//Css//dropdown.css" rel="stylesheet">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
  <title><?php echo $_SESSION['nomeMes']; ?> de <?php echo $_SESSION['ano']; ?></title>
</head>

<body>
  <?php require_once "Recursos/Navegacao.php"; ?>
  <a href="home.php" class="voltar-menu">Voltar</a>
  <?php
  if ($_SESSION['nomeMes'] == "" || $_SESSION['ano'] == "") {
  ?>
    <div class="px-4 py-5 my-5 text-center">
      <img class="d-block mx-auto mb-4" src="../../Assets/img/error.png" alt="" width="72" height="70">

      <h1 class="display-5 fw-bold">Error de ano</h1>
      <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Por favor, digite um ano e mês válido na tela inicial.</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
          <a href="home.php" class="btn btn-primary btn-lg px-4 gap-3"> Voltar</a>
        </div>
      </div>
    </div>
  <?php
  } else {
  ?>
    <main class='main-Mes'>
      <div class="main-mes-itens">
        <h2><?php echo "Poupança de " . $_SESSION['ano'];  ?></h2>
        <p>Registre o dinheiro guardado nas economias.</p>
        <button>Registrar poupanças</button>
      </div>
      <div class="main-mes-itens">
        <img src="../../Assets/img/dia 15.png" alt="a calendar with the number 15" width="42" height="40" >
        <h2>Despensas: Primeira quinzena</h2>
        <p>Registre os gastos entre o dia 05 até o dia 19, que são os dias da entrada de salário da casa.</p>
        <button>Registrar despensas</button>
      </div>
      <div class="main-mes-itens">
        <img src="../../Assets/img/dia 30.png" alt="a calendar with the number 30" width="42" height="40" >
        <h2>Despensas: Segunda quinzena</h2>
        <p>Registre os gastos entre o dia 20 até dia 04 do próximo mês, antes de começar uma nova quinzena.</p>
        <button>Registrar despensas</button>
      </div>
    </main>
  <?php
  }
  ?>
</body>

</html>