<?php

function talogado()
{
  if ($_SESSION['connected'] !== 1) {
    header("location: login.php");
  }
}

talogado();

/**
 * Tipo de registro
 * Fucnionamento: Os tipos de registros se classificam em registros pessoais e em registros da casa. Cada um deles possui poupança e despensas
 * Data: 07/03/23
 */

if (!isset($_SESSION['tipo_registro'])) {
  $_SESSION['tipo_registro'] = "Registros pessoais";
}

if (isset($_POST['tipo_registro'])) {
  $_SESSION['tipo_registro'] = $_POST['tipo_registro'];
}

$nome_dividido = explode(" ", $_SESSION['user_name']);
?>

<header>
  <a href="home.php">
    <h1>Controle monetário</h1>
  </a>
</header>
<div class="nav-bar">
  <?php
  if ($_SESSION['tipo_registro'] == "Registros pessoais") {
  ?>
    <form action="home.php" method="post">
      <input type="hidden" name="tipo_registro" value="Registros pessoais">
      <button type="submit" class="nav-bar-selecionado">Registros pessoais</button>
    </form>
    <form action="home.php" method="post">
      <input type="hidden" name="tipo_registro" value="Registros da casa">
      <button type="submit" class="nav-bar-desmarcado">Registros da casa</button>
    </form>
  <?php
  } else {
  ?>
    <form action="home.php" method="post">
      <input type="hidden" name="tipo_registro" value="Registros pessoais">
      <button type="submit" class="nav-bar-desmarcado">Registros pessoais</button>
    </form>
    <form action="home.php" method="post">
      <input type="hidden" name="tipo_registro" value="Registros da casa">
      <button type="submit" class="nav-bar-selecionado">Registros da casa</button>
    </form>
  <?php
  }
  ?>
  <div class="dropdown">
    <button onclick="myFunction()" class="dropbtn">
      Configurações
      <img src="../../Assets//Icons//dropdown.png">
    </button>
    <div id="myDropdown" class="dropdown-content">
      <a href="#"><?php echo "Perfil: <b>" . $nome_dividido[0] . "</b>"; ?></a>
      <a href="trocar-senha.php">Alterar senha</a>
      <a href="logoff.php">Sair</a>
    </div>
  </div>
</div>

<footer>
  <a id="name_footer" href="https://github.com/TiagoUniverse" target="_blank" >Tiago Lopes</a>, PE 2023.
</footer>
<script src="../../Assets//Js//dropdown.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> -->