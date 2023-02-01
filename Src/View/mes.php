<?php

/** 
 * Author: Tiago César da Silva Lopes
 * Description: Homepage
 * Date: 01/02/23
 */

require_once "Recursos/Navegacao.php";
require_once "conexao.php";

//Variáveis
$nomeMes = $_POST['nomeMes'];
$ano = $_POST['ano'];
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $_POST['nomeMes']; ?> de <?php echo $_POST['ano']; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="../../Assets/Css/Content.css" />
  <link rel="stylesheet" href="../../Assets/Css/Footer.css" />
</head>

<body>

<?php
 if ($nomeMes == "" || $ano == ""){
  ?>
    <div class="px-4 py-5 my-5 text-center">
    <img class="d-block mx-auto mb-4" src="../../Assets/img/error.png" alt="" width="72" height="70">
    
    <h1 class="display-5 fw-bold">Error de ano</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Por favor, digite um ano e mês válido na tela inicial.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a href="home.php" class="btn btn-primary btn-lg px-4 gap-3" > Voltar</a>
      </div>
    </div>
  </div>
  <?php
 } else {
  ?>
  <div class="px-4 py-5 my-5 text-center">
    <img class="d-block mx-auto mb-4" src="../../Assets/img/dia 15.png" alt="" width="72" height="70">
    
    <h1 class="display-5 fw-bold">Primeira quinzena</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Registre os gastos entre o dia 01 até o dia 19, que são os dias da entrada de salário da casa.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
        <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button>
      </div>
    </div>
  </div>

  <div class="px-4 py-5 my-5 text-center">
    <img class="d-block mx-auto mb-4" src="../../Assets/img/dia 30.png" alt="" width="72" height="70">
    <h1 class="display-5 fw-bold">Segunda quinzena</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Registre os gastos entre o dia 20 até dia 04 do próximo mês, antes de começar uma nova quinzena.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Primary button</button>
        <button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button>
      </div>
    </div>
  </div>
  <?php
 }
?>














  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>