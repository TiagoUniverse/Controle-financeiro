<?php

/** 
 * Author: Tiago César da Silva Lopes
 * Description: Homepage
 * Date: 25/01/23
 */

require_once "Recursos/Navegacao.php";
require_once "conexao.php";

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="../../Assets/Css/Content.css" />
</head>

<body>

  <div class="row g-0 text-center" style="background-color: green;">
    <div class="col-sm-6 col-md-1 filtro
    ">
    <form method="POST" action="home.php">
        <input type="number" name="ano" min="1900" max="2099" step="1" value="<?php if (isset($_POST['ano'])) echo $_POST['ano']; ?>" />
        <button type="submit"> Pesquisar</button>
      </form>
    </div>
    <div class="col-6 col-md-1" style="background-color: violet;">
      <form method="POST" action="home.php">
        <button type="submit"> Limpar filtro</button>
      </form>
    </div>
  </div>


  <?php
  if (isset($_POST['ano']) != null) {
  ?>
    <div class="container px-4 text-center">
      <div class="row gx-5">
        <div class="box">Janeiro</div>
        <div class="box">Janeiro</div>
        <div class="box">Janeiro</div>
        <div class="box">Janeiro</div>
        <div class="box">Janeiro</div>
        <div class="box">Janeiro</div>
        <div class="box">Janeiro</div>
        <div class="box">Janeiro</div>
        <div class="box">Janeiro</div>
        <div class="box">Janeiro</div>
        <div class="box">Janeiro</div>
        <div class="box">Janeiro</div>
      </div>
    </div>
  <?php
  }
  ?>











  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>