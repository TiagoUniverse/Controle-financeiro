<?php

/**
 * ╔═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════╗
 * ║                                               CONTROLE FINANCEIRO                                                 ║
 * ║  ┌─────────────────────────────────────────────────────────────────────────────────────────────────────────────┐  ║
 * ║  │ @description: Homepage                                                                                      │  ║
 * ║  | @dir: View                                                                                                  │  ║
 * ║  │ @author: Tiago César da Silva Lopes                                                                         │  ║
 * ║  │ @date: 25/01/23                                                                                             │  ║
 * ║  └─────────────────────────────────────────────────────────────────────────────────────────────────────────────┘  ║
 * ║═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════║
 */

require_once "conexao.php";
// require_once "Recursos/Navegacao.php";

//Atualizando session
$_SESSION['nomeMes'] = null;
$_SESSION['statusMes'] = null;
$_SESSION['quinzena'] = null;

//Variáveis
if (!isset($_POST['limpaFiltro'])) {
  $_SESSION['ano'] = null;
}

if (isset($_POST['limpaFiltro']) && $_POST['limpaFiltro'] == 1) {
  $_SESSION['ano'] = null;
} else if (isset($_POST['ano']) != null) {
  $_SESSION['ano'] = $_POST['ano'];
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
  <title>Controle monetário</title>
</head>

<body>
  <header>
    <h1>Controle monetário</h1>
  </header>
  <div class="nav-bar">
    <form action="home.php" method="post">
      <input type="hidden" name="tipo_registro" value="Registros pessoais">
      <button type="submit" class="nav-bar-selecionado">Registros pessoais</button>
    </form>
    <form action="home.php" method="post">
      <input type="hidden" name="tipo_registro" value="Registros da casa">
      <button type="submit" class="nav-bar-desmarcado">Registros da casa</button>
    </form>
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
  <form method="POST" action="home.php" class="input-pesquisar">
    <select name="ano" class="input-pesquisar-items">
      <?php
      for ($year = (int)date('Y'); 1900 <= $year; $year--) : ?>
        <option value="<?= $year; ?>" n><?= $year; ?></option>
      <?php endfor; ?>
    </select>
    <button type="submit" class="input-pesquisar-items">Pesquisar</button>
  </form>
  <div class="gallery">
    <img src='../../Assets//img//1.png' alt="january">
    <img src='../../Assets//img//february.png' alt="february">
    <img src='../../Assets//img//march.png' alt="march">
    <img src='../../Assets//img//april.png' alt="april">
    <img src='../../Assets//img//may.png' alt="may">
    <img src='../../Assets//img//june.png' alt="june">
    <img src='../../Assets//img//july.png' alt="July">
    <img src='../../Assets//img//august.png' alt="August">
    <img src='../../Assets//img//september.png' alt="september">
    <img src='../../Assets//img//october.png' alt="october">
    <img src='../../Assets//img//november.png' alt="november">
    <img src='../../Assets//img//december.png' alt="december">
    <img src='../../Assets//img//savings.png' alt="savings">
  </div>
  <footer>
    Tiago Universe, PE 2023.
  </footer>
  <script src="../../Assets//Js//dropdown.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
  integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> -->
</body>

</html>