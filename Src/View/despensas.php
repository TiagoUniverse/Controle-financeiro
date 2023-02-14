<?php

/** 
 * Author: Tiago César da Silva Lopes
 * Description: Register of all money spent
 * Date: 02/02/23
 */

require_once "conexao.php";
require_once "Recursos/Navegacao.php";

//Variáveis
$status_Mes = $_POST['status_Mes'];
$quinzena = $_POST['quinzena'];


// $consulta = $pdo->query("Select * from Despensas where quinzena = '{$quinzena}' and idStatus_mes = '{$status_Mes}' and idStatus_despensa = '{$idStatus_despensa}'             ");

$consulta = $pdo->query("Select * from despensas where status = 'ATIVO' and ano = '{$_SESSION['ano']}'  and IdStatus_mes = '{$status_Mes}' and quinzena = '{$quinzena}' 
and ( idStatus_despensa = 3 OR idstatus_despensa = 4 )          ");

// var_dump($consulta);

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

  <form action="mes.php" method="post">
    <input type="hidden" name="statusMes" value="<?php echo $status_Mes; ?>">
    <button class="btn btn-link">Voltar</button>
  </form>

  <h1 class="display-5 fw-bold" style="text-align: center;">Despensas: gastos pessoais</h1>
  <h3  style="text-align: center;">Quando estiver pronto, clique no botão de avançar para registrar as despensas da casa</h3>

  <div class="px-4 py-5 my-5 text-center">
    <img class="d-block mx-auto mb-4" src="../../Assets/img/dia 15.png" alt="" width="72" height="70">

    <h1 class="display-5 fw-bold">Entrada</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Por favor, digite um ano e mês válido na tela inicial.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Nª</th>
              <th scope="col">Descrição</th>
              <th scope="col">valor</th>
              <th scope="col">Data</th>
            </tr>
          </thead>
          <tbody>
            <?php

            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            ?>
              <tr>
                <th scope="row">1</th>
                <td> <?php echo $linha['nome']; ?> </td>
                <td> <?php echo $linha['email']; ?> </td>
              </tr>
            <?php
            }


            ?>
            <!-- <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Jacob</td>
              <td>Thornton</td>
              <td>@fat</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td colspan="2">Larry the Bird</td>
              <td>@twitter</td>
            </tr> -->
          </tbody>
        </table>









      </div>
    </div>
  </div>



  <div class="px-4 py-5 my-5 text-center">
    <img class="d-block mx-auto mb-4" src="../../Assets/img/dia 15.png" alt="" width="72" height="70">

    <h1 class="display-5 fw-bold">Saída</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Por favor, digite um ano e mês válido na tela inicial.</p>
      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Nª</th>
              <th scope="col">Descrição</th>
              <th scope="col">valor</th>
              <th scope="col">Data</th>
            </tr>
          </thead>
          <tbody>
            <?php

            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            ?>
              <tr>
                <th scope="row">1</th>
                <td> <?php echo $linha['nome']; ?> </td>
                <td> <?php echo $linha['email']; ?> </td>
              </tr>
            <?php
            }


            ?>
            <!-- <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>Otto</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Jacob</td>
              <td>Thornton</td>
              <td>@fat</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td colspan="2">Larry the Bird</td>
              <td>@twitter</td>
            </tr> -->
          </tbody>
        </table>









      </div>
    </div>
  </div>









  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>