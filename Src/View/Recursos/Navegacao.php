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
?>

<header>
  <h1>Controle monetário</h1>
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
      <a href="#">Perfil: <b>Tiago</b></a>
      <a href="#">Alterar senha</a>
      <a href="#">Sair</a>
    </div>
  </div>
</div>