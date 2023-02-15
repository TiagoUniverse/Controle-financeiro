<?php

/** 
 * Author: Tiago César da Silva Lopes
 * Description: Register of all money spent
 * Date: 02/02/23
 */

require_once "conexao.php";
require_once "Recursos/Navegacao.php";

/*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │                                Despensas's section                                                            │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

require_once "../Model/Despensas_repositorio.php";
use model\Despensas_repositorio;

$Despensas_repositorio = new Despensas_repositorio();


/*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │                                Variables                                                                      │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

if (isset($_POST['quinzena'])) {
  $_SESSION['quinzena'] = $_POST['quinzena'];
}

if (isset($_POST['adicionando_registro'])) {
  $adicionando_registro = $_POST['adicionando_registro'];
} else {
  $adicionando_registro = null;
}

if (isset($_POST['descricao'])) {
  $descricao = $_POST['descricao'];
} else {
  $descricao = null;
}

if (isset($_POST['valor'])) {
  $valor = $_POST['valor'];
} else {
  $valor = null;
}

if (isset($_POST['data'])) {
  $data = $_POST['data'];
} else {
  $data = null;
}


$statusDespensa = $_POST['statusDespensa'];
if (isset($_POST['idStatus_despensa'])) {
  $idStatus_despensa = $_POST['idStatus_despensa'];
} else {
  $idStatus_despensa = null;
}



echo $adicionando_registro;


/*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │                                Conexão com BD                                                                 │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

if ($adicionando_registro != null && $adicionando_registro == "SALVANDO REGISTRO"){
  $Despensas_repositorio->cadastro_StatusDespensas("Tiago" , $pdo);
  
  
  // $Despensas_repositorio->cadastro_entrada($descricao, $valor, $data , $_SESSION['ano'], $_SESSION['quinzena'] , $_SESSION['statusMes']  , $statusDespensa , $pdo);
  // $adicionando_registro = "";
}

// $consulta = $pdo->query("Select * from Despensas where quinzena = '{$quinzena}' and idstatusMes = '{$_SESSION['statusMes']}' and idStatus_despensa = '{$idStatus_despensa}'             ");

$consulta = $pdo->query("Select * from despensas where status = 'ATIVO' and ano = '{$_SESSION['ano']}'  and IdStatus_mes = '{$_SESSION['statusMes']}' and quinzena = '{$_SESSION['quinzena']}' 
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
    <input type="hidden" name="statusMes" value="<?php echo $_SESSION['statusMes']; ?>">
    <button class="btn btn-link">Voltar</button>
  </form>

  <h1 class="display-5 fw-bold" style="text-align: center;">Despensas: gastos pessoais</h1>
  <h3 style="text-align: center;">Quando estiver pronto, clique no botão de avançar para registrar as despensas da casa</h3>

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

            if ($adicionando_registro != null && $adicionando_registro == "REGISTRANDO ENTRADA") {
            ?>
              <form method="post">
                <input type="hidden" name= "adicionando_registro" value='SALVANDO REGISTRO'>
                <input type="hidden" name= "statusDespensa" value='3'>
                <tr>
                  <th scope="col">Nª</th>
                  <th scope="col">
                    <input type="text" name="descricao">
                  </th>
                  <th scope="col">
                    <input  type="number" min="1" step="any" name="valor">
                  </th>
                  <th scope="col">
                    <input type="date" name="data">
                  </th>
                  <button>Registrar</button>
                </tr>
              </form>


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
    <?php
    if ($adicionando_registro == null) {
    ?>
      <form action="despensas.php" method="post">
        <input type="hidden" value="REGISTRANDO ENTRADA" name="adicionando_registro">
        <button>Adicionar um novo registro</button>
      </form>
    <?php
    }

    if ($adicionando_registro != null && $adicionando_registro == "REGISTRANDO ENTRADA") {
    ?>
      <tr>
        <th scope="col">Nª</th>
        <th scope="col">
          <input type="text">
        </th>
        <th scope="col">
          <input type="text">
        </th>
        <th scope="col">
          <input type="text">
        </th>
        <button>Registrar</button>
      </tr>

    <?php
    }
    ?>



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

  <div class="px-4 py-5 my-5 text-center">
    <?php
    if ($adicionando_registro == null) {
    ?>
      <form action="despensas.php" method="post">
        <input type="hidden" value="REGISTRANDO ENTRADA" name="adicionando_registro">
        <button>Adicionar um novo registro</button>
      </form>
    <?php
    }
    ?>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>