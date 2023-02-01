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
  <link rel="stylesheet" href="../../Assets/Css/Footer.css" />
</head>

<body>




  <div class="container px-4 text-center">
    <div class="row gx-5">
      <div class="col">
        <div class="p-3 filtro">
          <form method="POST" action="home.php">
            <input type="number" name="ano" min="1900" max="2099" step="1" value="<?php echo  date('Y'); ?> " />
            <button type="submit" class="btn btn-primary">Pesquisar</button>
          </form>
        </div>
      </div>
      <div class="col">
        <div class="p-3">
          <form method="POST" action="home.php">
            <button type="submit" class="btn btn-secondary limparFiltro">Limpar filtro</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <?php
  if (isset($_POST['ano']) != null) {
  ?>
    <div class="container px-4 text-center">
      <h1><?php echo $_POST['ano']; ?> </h1>
      <div class="row gx-5">

          <div class="box">
           <form action="mes.php" method="post">
              <?php
              $NomeMes = "Janeiro";
              ?>
              <input type="hidden" value="<?php echo $NomeMes; ?>" name="nomeMes">
              <input type="hidden" value="<?php echo $_POST['ano']; ?>" name="ano">
              <button type="submit" class="btn btn-primary"><?php echo $NomeMes; ?></button>
           </form>
          </div>
          <div class="box">
           <form action="mes.php" method="post">
              <?php
              $NomeMes = "Fevereiro";
              ?>
              <input type="hidden" value="<?php echo $NomeMes; ?>" name="nomeMes">
              <input type="hidden" value="<?php echo $_POST['ano']; ?>" name="ano">
              <button type="submit" class="btn btn-primary"><?php echo $NomeMes; ?></button>
           </form>
          </div>
          <div class="box">
           <form action="mes.php" method="post">
              <?php
              $NomeMes = "Março";
              ?>
              <input type="hidden" value="<?php echo $NomeMes; ?>" name="nomeMes">
              <input type="hidden" value="<?php echo $_POST['ano']; ?>" name="ano">
              <button type="submit" class="btn btn-primary"><?php echo $NomeMes; ?></button>
           </form>
          </div>
          <div class="box">
           <form action="mes.php" method="post">
              <?php
              $NomeMes = "Abril";
              ?>
              <input type="hidden" value="<?php echo $NomeMes; ?>" name="nomeMes">
              <input type="hidden" value="<?php echo $_POST['ano']; ?>" name="ano">
              <button type="submit" class="btn btn-primary"><?php echo $NomeMes; ?></button>
           </form>
          </div>
          <div class="box">
           <form action="mes.php" method="post">
              <?php
              $NomeMes = "Maio";
              ?>
              <input type="hidden" value="<?php echo $NomeMes; ?>" name="nomeMes">
              <input type="hidden" value="<?php echo $_POST['ano']; ?>" name="ano">
              <button type="submit" class="btn btn-primary"><?php echo $NomeMes; ?></button>
           </form>
          </div>
          <div class="box">
           <form action="mes.php" method="post">
              <?php
              $NomeMes = "Junho";
              ?>
              <input type="hidden" value="<?php echo $NomeMes; ?>" name="nomeMes">
              <input type="hidden" value="<?php echo $_POST['ano']; ?>" name="ano">
              <button type="submit" class="btn btn-primary"><?php echo $NomeMes; ?></button>
           </form>
          </div>
          <div class="box">
           <form action="mes.php" method="post">
              <?php
              $NomeMes = "Julho";
              ?>
              <input type="hidden" value="<?php echo $NomeMes; ?>" name="nomeMes">
              <input type="hidden" value="<?php echo $_POST['ano']; ?>" name="ano">
              <button type="submit" class="btn btn-primary"><?php echo $NomeMes; ?></button>
           </form>
          </div>
          <div class="box">
           <form action="mes.php" method="post">
              <?php
              $NomeMes = "Agosto";
              ?>
              <input type="hidden" value="<?php echo $NomeMes; ?>" name="nomeMes">
              <input type="hidden" value="<?php echo $_POST['ano']; ?>" name="ano">
              <button type="submit" class="btn btn-primary"><?php echo $NomeMes; ?></button>
           </form>
          </div>
          <div class="box">
           <form action="mes.php" method="post">
              <?php
              $NomeMes = "Setembro";
              ?>
              <input type="hidden" value="<?php echo $NomeMes; ?>" name="nomeMes">
              <input type="hidden" value="<?php echo $_POST['ano']; ?>" name="ano">
              <button type="submit" class="btn btn-primary"><?php echo $NomeMes; ?></button>
           </form>
          </div>
          <div class="box">
           <form action="mes.php" method="post">
              <?php
              $NomeMes = "Outubro";
              ?>
              <input type="hidden" value="<?php echo $NomeMes; ?>" name="nomeMes">
              <input type="hidden" value="<?php echo $_POST['ano']; ?>" name="ano">
              <button type="submit" class="btn btn-primary"><?php echo $NomeMes; ?></button>
           </form>
          </div>
          <div class="box">
           <form action="mes.php" method="post">
              <?php
              $NomeMes = "Novembro";
              ?>
              <input type="hidden" value="<?php echo $NomeMes; ?>" name="nomeMes">
              <input type="hidden" value="<?php echo $_POST['ano']; ?>" name="ano">
              <button type="submit" class="btn btn-primary"><?php echo $NomeMes; ?></button>
           </form>
          </div>
          <div class="box">
           <form action="mes.php" method="post">
              <?php
              $NomeMes = "Dezembro";
              ?>
              <input type="hidden" value="<?php echo $NomeMes; ?>" name="nomeMes">
              <input type="hidden" value="<?php echo $_POST['ano']; ?>" name="ano">
              <button type="submit" class="btn btn-primary"><?php echo $NomeMes; ?></button>
           </form>
          </div>
      </div>
    </div>
  <?php
  }
  ?>






  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>