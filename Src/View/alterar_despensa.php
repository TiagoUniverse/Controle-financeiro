<?php

/** 
 * Author: Tiago César da Silva Lopes
 * Description: Register of all money spent
 * Date: 27/02/23
 */

require_once "conexao.php";
require_once "Recursos/Navegacao.php";


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

// Variables
$id = $_POST['id'];

$Despensas = $Despensas_repositorio->consultaById($id, $pdo);

if (isset($_POST['foiAlterado']) && $_POST['foiAlterado'] == "ALTERADO"){

  //Variables
  $descricao = $_POST['descricao'];
  $valor = $_POST['valor'];
  $dataDespensa = $_POST['dataDespensa'];

  $Despensas_repositorio->alterar($descricao , $valor, $dataDespensa , $id , $pdo);


}

// var_dump($Despensas);

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Despensas de <?php echo $_SESSION['nomeMes']; ?> de <?php echo $_SESSION['ano']; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="../../Assets/Css/Content.css" />
  <link rel="stylesheet" href="../../Assets/Css/Footer.css" />
</head>

<body>

  <form action="despensas.php" method="post">
    <input type="hidden" name="statusMes" value="<?php echo $_SESSION['statusMes']; ?>">
    <button class="btn btn-link">Voltar</button>
  </form>

  <h1 class="display-5 fw-bold" style="text-align: center;">Despensas: gastos pessoais</h1>
  <h3 style="text-align: center;">Verifique se é este o registro que deseja alterar e confirme</h3>

  <div class="px-4 py-5 my-5 text-center">
    <img class="d-block mx-auto mb-4" src="../../Assets/img/dia 15.png" alt="" width="72" height="70">

  <?php
  if (!isset($_POST['foiAlterado'])){
    ?>
    <form action="alterar_despensa.php" method="post">
      <input type="hidden" name="foiAlterado" value="ALTERADO">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label"> Descrição: </label>
        <input type="text" value="<?php echo $Despensas->getDescricao();  ?> " name="descricao" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Valor:</label>
        <input type="text" value="<?php echo $Despensas->getValor();  ?> " name="valor" class="form-control" id="exampleInputPassword1" >
      </div>

      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Data:</label>
        <input type="text" value="<?php echo $Despensas->getData();  ?> " name="dataDespensa" class="form-control" id="exampleInputPassword1" >
      </div>
      <button type="submit" class="btn btn-danger">Alterar</button>
    </form>
    <?php
  } else {
    ?>
    <h1>Registro alterado!</h1>
    <?php
  }
  ?>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>