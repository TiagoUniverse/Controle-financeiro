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

//Atualizando session
$_SESSION['nomeMes'] = null;
$_SESSION['statusMes'] = null;
$_SESSION['quinzena'] = null;

//Variáveis
if (!isset($_SESSION['ano'])) {
  $_SESSION['ano'] = date("Y");;
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../../Assets//Css//styles.css" rel="stylesheet">
  <link href="../../Assets//Css//dropdown.css" rel="stylesheet">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
  <title>Controle monetário</title>
</head>

<body>
  <?php require_once "Recursos/Navegacao.php"; ?>
  <form method="POST" action="home.php" class="input-pesquisar">
    <select name="ano" class="input-pesquisar-items">
      <?php
      for ($year = (int)date('Y'); 1900 <= $year; $year--) : ?>
        <option value="<?= $year; ?>" n><?= $year; ?></option>
      <?php endfor; ?>
    </select>
    <button type="submit" class="input-pesquisar-items">Pesquisar</button>
  </form>
  <h2 class="actual-year"><?php echo $_SESSION['ano']; ?></h2>
  <div class="gallery">
    <form action="mes.php" method="post">
      <input type="hidden" value="1" name="statusMes">
      <input type="hidden" value="Janeiro" name="nomeMes">
      <input type="hidden" value="<?php echo $_SESSION['ano']; ?>" name="ano">
      <button type="submit"><img src='../../Assets//img//1.png' alt="january"></button>
    </form>


    <a href=''><img src='../../Assets//img//february.png' alt="february"></a>
    <a href=''><img src='../../Assets//img//march.png' alt="march"></a>
    <a href=''><img src='../../Assets//img//april.png' alt="april"></a>
    <a href=''><img src='../../Assets//img//may.png' alt="may"></a>
    <a href=''><img src='../../Assets//img//june.png' alt="june"></a>
    <a href=''><img src='../../Assets//img//july.png' alt="July"></a>
    <a href=''><img src='../../Assets//img//august.png' alt="August"></a>
    <a href=''><img src='../../Assets//img//september.png' alt="september"></a>
    <a href=''><img src='../../Assets//img//october.png' alt="october"></a>
    <a href=''><img src='../../Assets//img//november.png' alt="november"></a>
    <a href=''><img src='../../Assets//img//december.png' alt="december"></a>
    <a href=''><img src='../../Assets//img//savings.png' alt="savings"></a>
  </div>
</body>

</html>