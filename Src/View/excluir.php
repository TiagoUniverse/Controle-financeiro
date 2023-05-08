<?php

/**
 * ╔═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════╗
 * ║                                               CONTROLE FINANCEIRO                                                 ║
 * ║  ┌─────────────────────────────────────────────────────────────────────────────────────────────────────────────┐  ║
 * ║  │ @description: Delete of a register                                                                          │  ║
 * ║  | @dir: View                                                                                                  │  ║
 * ║  │ @author: Tiago César da Silva Lopes                                                                         │  ║
 * ║  │ @date: 27/02/23                                                                                             │  ║
 * ║  └─────────────────────────────────────────────────────────────────────────────────────────────────────────────┘  ║
 * ║═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════║
 */

require_once "conexao.php";
require_once "Recursos/Navegacao.php";

/*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │                                Poupancas's section                                                            │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

require_once "../Model/Poupancas_repositorio.php";

use model\Poupancas_repositorio;

$Poupancas_repositorio = new Poupancas_repositorio();

/*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │                                Despensas's section                                                            │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

require_once "../Model/Despensas_repositorio.php";

use model\Despensas_repositorio;

require_once "../Model/Despensas.php";

use model\Despensas;

$Despensas_repositorio = new Despensas_repositorio();
$Despensas = new Despensas();

/*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │                                TipoDespensa's section                                                         │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

require_once "../Model/Tipo_despensa.php";
use model\tipo_despensa;

require_once "../Model/Tipo_despensa_repositorio.php";
use model\Tipo_despensa_repositorio;

$tipo_despensa = new tipo_despensa();
$tipo_despensa_repositorio = new Tipo_despensa_repositorio();



// Variables
$id = $_POST['id'];
$pagina_inicial = $_POST['pagina_inicial'];
$possui_TipoDespensa = false;

if ($pagina_inicial == "POUPANCA") {
  $Despensas = $Poupancas_repositorio->consultaById($id, $pdo);
  $possui_TipoDespensa = false;
} else {
  $Despensas = $Despensas_repositorio->consultaById($id, $pdo);
  $possui_TipoDespensa = true;
}

if (isset($_POST['foiExcluido']) && $_POST['foiExcluido'] == "EXCLUIDO") {

  
  if ($pagina_inicial == "POUPANCA") {
    $Poupancas_repositorio->excluir_registro($id, $pdo);
  } else {
    $Despensas_repositorio->excluir_registro($id, $pdo);
  }

}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="shortcut icon" type="x-icon" href="../../Assets/img/calendario.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../../Assets//Css//styles.css" rel="stylesheet">
  <link href="../../Assets//Css//dropdown.css" rel="stylesheet">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
  integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> -->
  <title> Exclusão: Despensas de <?php echo $_SESSION['nomeMes']; ?> de <?php echo $_SESSION['ano']; ?></title>
</head>

<body>
  <?php require_once "Recursos/Navegacao.php"; ?>

  <?php
  if ($pagina_inicial == "POUPANCA") {
  ?>
    <form action="poupancas.php" method="post">
    <?php
  } else {
    ?>
      <form action="despensas.php" method="post">
      <?php
    }
      ?>
      <input type="hidden" name="statusMes" value="<?php echo $_SESSION['statusMes']; ?>">
      <button class="voltar-menu" style="border:none;">Voltar</button>
      </form>

      <main class="main-alterar">
        <img class="d-block mx-auto mb-4" src="../../Assets/img/dia 15.png" alt="" width="72" height="70">
        <h1 class="display-5 fw-bold" style="text-align: center;"><?php echo strtolower($pagina_inicial) . ": gastos pessoais"; ?></h1>
        <h3 style="text-align: center;">Verifique se é este o registro que deseja excluir e confirme</h3>

        <?php
        if (!isset($_POST['foiExcluido'])) {

        ?>

          <form action="excluir.php" method="post">
            <input type="hidden" name="foiExcluido" value="EXCLUIDO">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="pagina_inicial" value="<?php echo $pagina_inicial; ?>">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label"> Descrição: </label>
              <input type="text" value="<?php echo $Despensas->getDescricao();  ?> " class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
            </div>
            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Valor:</label>
              <input type="text" value="<?php echo $Despensas->getValor();  ?> " class="form-control" id="exampleInputPassword1" disabled>
            </div>

            <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Data:</label>
              <input type="text" value="<?php echo $Despensas->getData();  ?> " class="form-control" id="exampleInputPassword1" disabled>
            </div>

            <?php
            if($possui_TipoDespensa){
             $nomeDespensa = $tipo_despensa_repositorio->consultar($Despensas->getIdTipoDespensa() , $pdo);
              ?>
              <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Tipo de despensa:</label>
              <input type="text" value="<?php echo $nomeDespensa->getNome();  ?> " class="form-control" id="exampleInputPassword1" disabled>
            </div>
              <?php
            }


            ?>

            <button type="submit" class="btn btn-danger">Excluir</button>
          </form>

        <?php
        } else {
        ?>
          <h3 class="resultado">Excluido!</h3>
        <?php
        }
        ?>
      </main>




      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>