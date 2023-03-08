<?php

/**
 * ╔═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════╗
 * ║                                               CONTROLE FINANCEIRO                                                 ║
 * ║  ┌─────────────────────────────────────────────────────────────────────────────────────────────────────────────┐  ║
 * ║  │ @description: Register of all money saved in the bank                                                       │  ║
 * ║  | @dir: View                                                                                                  │  ║
 * ║  │ @author: Tiago César da Silva Lopes                                                                         │  ║
 * ║  │ @date: 03/03/23                                                                                             │  ║
 * ║  └─────────────────────────────────────────────────────────────────────────────────────────────────────────────┘  ║
 * ║═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════║
 */

require_once "conexao.php";
require_once "Recursos/Navegacao.php";

/*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │                                Variables                                                                      │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

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

if (isset($_POST['statusDespensa'])) {
  $statusDespensa = $_POST['statusDespensa'];
} else {
  $statusDespensa = null;
}

/*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │                                Poupancas's section                                                            │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

require_once "../Model/Poupancas_repositorio.php";

use model\Poupancas_repositorio;

$Poupancas_repositorio = new Poupancas_repositorio();


/*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │1-                               Cadastro de registros                                                         |
* | Description: Quando a variável está no status de 'SALVANDO REGISTRO ENTRADA', ele só vai salvar se ele não    |
* | encontrar o mesmo registro já salvo .   Data: 16/02/23                                                        │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

if ($adicionando_registro != null && $adicionando_registro == "SALVANDO REGISTRO ENTRADA") {

  /*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
  * │                                Validações                                                                     │
  * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
  */

  if (isset($_POST['data'])) {
    $dataDividida = explode("-", $_POST['data']);
  }

  /**  | @anotacao: Mensagem Vermelha                                                                                |
   *   | Funcionamento: A validação começa com ela definida como verdadeira. Se depois de todas as validações as     |
   *   | informações estiverem corretas, então o sistema vai exibir uma mensagem de sucesso e informar que o         |
   *   | cadastro foi feito com sucesso                                                                              |
   *   | Data: 16/02/23                                                                                              |
   */
  $mensagemVermelha = true;

  if (!isset($_POST['data'])) {
    $mensagem = "Informe uma data";
  } else if ($dataDividida[0] != $_SESSION['ano']) {
    $mensagem = "Faça um registro no ano de " . $_SESSION['ano'];
  } else if ($descricao == null) {
    $mensagem = "Por favor, preencha a descrição sobre o registro";
  } else if ($valor <= 0) {
    $mensagem = "Por favor, informe um valor positivo do dinheiro";
  } else {

    $retorno = $Poupancas_repositorio->consultarRegistro($descricao, $valor, $data, 7, $pdo);

    if ($retorno == false) {
      $mensagemVermelha = false;
      $mensagem = "Informação registrada com sucesso!";

      if ($_SESSION['tipo_registro'] == "Registros pessoais") {
        $statusDespensa = 7;
      } else {
        $statusDespensa = 5;
      }

      $Poupancas_repositorio->cadastro_entrada($descricao, $valor, $data, $_SESSION['ano'], $statusDespensa, $pdo);
    } else {
      $mensagem = "Registro já cadastrado!";
    }
  }

  $adicionando_registro = null;

  // Mensagem do resultado
  if ($mensagemVermelha) {
    echo "<div class='alert alert-danger' role='alert'> ";
  } else {
    echo "<div class='alert alert-success' role='alert'> ";
  }
  echo $mensagem;
  echo "</div>";
}

if ($adicionando_registro != null && $adicionando_registro == "SALVANDO REGISTRO SAIDA") {

  /*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
  * │                                Validações                                                                     │
  * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
  */

  if (isset($_POST['data'])) {
    $dataDividida = explode("-", $_POST['data']);
  }

  /**  | @anotacao: Mensagem Vermelha                                                                                |
   *   | Funcionamento: A validação começa com ela definida como verdadeira. Se depois de todas as validações as     |
   *   | informações estiverem corretas, então o sistema vai exibir uma mensagem de sucesso e informar que o         |
   *   | cadastro foi feito com sucesso                                                                              |
   *   | Data: 16/02/23                                                                                              |
   */
  $mensagemVermelha = true;

  if (!isset($_POST['data'])) {
    $mensagem = "Informe uma data";
  } else if ($dataDividida[0] != $_SESSION['ano']) {
    $mensagem = "Faça um registro no ano de " . $_SESSION['ano'];
  } else if ($descricao == null) {
    $mensagem = "Por favor, preencha a descrição sobre o registro";
  } else if ($valor <= 0) {
    $mensagem = "Por favor, informe um valor positivo do dinheiro";
  } else {

    $retorno = $Poupancas_repositorio->consultarRegistro($descricao, $valor, $data, 8, $pdo);

    if ($retorno == false) {
      $mensagemVermelha = false;
      $mensagem = "Informação registrada com sucesso!";

      if ($_SESSION['tipo_registro'] == "Registros pessoais") {
        $statusDespensa = 8;
      } else {
        $statusDespensa = 6;
      }

      $Poupancas_repositorio->cadastro_Saida($descricao, $valor, $data, $_SESSION['ano'], $statusDespensa, $pdo);
    } else {
      $mensagem = "Registro já cadastrado!";
    }
  }

  $adicionando_registro = null;

  // Mensagem do resultado
  if ($mensagemVermelha) {
    echo "<div class='alert alert-danger' role='alert'> ";
  } else {
    echo "<div class='alert alert-success' role='alert'> ";
  }
  echo $mensagem;
  echo "</div>";
}

/*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │                                Consulta dos registro                                                          |
* | Description: Show the registers dependind if the SESSION['tipo_registro'] is about                            │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

if ($_SESSION['tipo_registro'] == "Registros da casa") {

  $consulta_Entrada = $pdo->query("Select * from poupancas where status = 'ATIVO' 
  and ano = '{$_SESSION['ano']}' and ( idstatus_despensa = 5 )    Order By month(dataPoupanca)     ");

  $consulta_Saida = $pdo->query("Select * from poupancas where status = 'ATIVO' 
  and ano = '{$_SESSION['ano']}' and ( idstatus_despensa = 6 )    Order By month(dataPoupanca)     ");
} else {

  $consulta_Entrada = $pdo->query("Select * from poupancas where status = 'ATIVO' 
  and ano = '{$_SESSION['ano']}' and ( idstatus_despensa = 7 )    Order By month(dataPoupanca) ");

  $consulta_Saida = $pdo->query("Select * from poupancas where status = 'ATIVO' 
  and ano = '{$_SESSION['ano']}' and ( idstatus_despensa = 8 )    Order By month(dataPoupanca) ");
}

/*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │                                Registros do dinheiro total                                                    |
* | Description: After viewing the SQL, we are going to calculate how many money do we have                       │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/
$dinheiroTotal = 0;
$dinheiroGastoTotal = 0;

$Entrada_fetch = $consulta_Entrada->fetchAll(PDO::FETCH_ASSOC);
$Saida_fetch = $consulta_Saida->fetchAll(PDO::FETCH_ASSOC);

foreach ($Entrada_fetch as $row) {
  $dinheiroTotal +=  $row['valor'];
}

foreach ($Saida_fetch as $row) {
  $dinheiroGastoTotal +=  $row['valor'];
}

/*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │                                Valor estimado da poupança                                                     |
* | Description: The user can say the estimate value of the actual money in a specific year. (Date: 08/03/23)     │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

$consulta_ValorEstimado = $pdo->query("Select * from poupancas where status = 'ATIVO' 
and ano = '{$_SESSION['ano']}' and ( idstatus_despensa = 11 ) ");

var_dump($consulta_ValorEstimado);

if ($adicionando_registro != null && $adicionando_registro == "SALVANDO VALOR ESTIMADO") {

  $mensagemVermelha = true;

  if (!isset($_POST['valor_estimado'])) {
    $mensagem = "Informe um valor estimado";
  } else {
    $mensagemVermelha = false;
    $mensagem = "Valor estimado atualizado";

    $descricao = "Valor total e estimado da poupança atual";
    $valor = $_POST['valor_estimado'];
    $data = date('Y-m-d H:i:s');

    $retorno = $Poupancas_repositorio->consultarValorEstimado($descricao, $valor, 11, $pdo);

    if ($retorno == false) {

      // $Poupancas_repositorio->cadastro_entrada($descricao, $valor, $data, $_SESSION['ano'], 11, $pdo);
    } else {
      echo "encontrei";
    }

  }

  $adicionando_registro = null;

  // Mensagem do resultado
  if ($mensagemVermelha) {
    echo "<div class='alert alert-danger' role='alert'> ";
  } else {
    echo "<div class='alert alert-success' role='alert'> ";
  }
  echo $mensagem;
  echo "</div>";
}

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Poupança de <?php echo $_SESSION['ano']; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="../../Assets/Css/Content.css" />
  <link rel="stylesheet" href="../../Assets/Css/Footer.css" />
</head>

<body>

  <form action="mes.php" method="post">
    <input type="hidden" name="statusMes" value="<?php echo $_SESSION['statusMes']; ?>">
    <button class="btn btn-link">Voltar</button>
  </form>

  <h2 class="display-5 fw-bold" style="text-align: center;"> <?php echo "Poupança de " . $_SESSION['ano']  . ": " . $_SESSION['tipo_registro']; ?> </h2>


  <!-- Dinheiro total -->
  <br>
  <div class="col-lg-6 mx-auto" style="background-color:cadetblue">

    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Valor atual da poupança</th>
            <th scope="col">Valor estimado manualmente</th>
            <th scope="col">Dinheiro total gasto</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <th scope="col"><?php echo $dinheiroTotal; ?> </th>
            <th scope="col">
              <form action="poupancas.php" method="post">
                <input type="hidden" value="SALVANDO VALOR ESTIMADO" name="adicionando_registro">
                <input type="number" name="valor_estimado" required>
                <button type="submit"> Salvar</button>
              </form>

            </th>
            <th scope="col"><?php echo $dinheiroGastoTotal; ?> </th>
          </tr>
        </tbody>
      </table>

    </div>
  </div>

  <br>
  <h3 style="text-align: center;">Abaixo registre todas as entradas e saídas da sua poupança</h3>

  <div class="px-4 py-5 my-5 text-center">

    <img class="d-block mx-auto mb-4" src="../../Assets/Icons//bank.png" alt="" width="72" height="70">

    <h1 class="display-5 fw-bold" id="Entrada_title">Entrada</h1>
    <p class="lead mb-4">Por favor, digite um ano e mês válido na tela inicial.</p>
    <a href="#Saida_title"> Navegar até os registros de Saída</a>
    <br><br>

    <div class="col-lg-6 mx-auto" style="background-color:#c79797">

      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Nª</th>
              <th scope="col">Descrição</th>
              <th scope="col">valor</th>
              <th scope="col">Data</th>
              <th scope="col">Alteração</th>
              <th scope="col">Exclusão</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $contador = 1;
            foreach ($Entrada_fetch as $linha) {
            ?>
              <tr>
                <!-- <th scope="row">1</th> -->
                <td> <?php echo $contador; ?> </td>
                <td> <?php echo $linha['descricao']; ?> </td>
                <td> <?php echo "R$" . $linha['valor']; ?> </td>
                <td> <?php echo $linha['dataPoupanca']; ?> </td>
                <td>

                  <form action="alterar.php" method="post">
                    <input type="hidden" value=" <?php echo $linha['id']; ?>" name="id">
                    <input type="hidden" value="POUPANCA" name="pagina_inicial">
                    <button type="submit"> <img src="../../Assets//Icons//pencil.png" class="icon_exclusao"></button>
                  </form>

                </td>
                <td>

                  <form action="excluir.php" method="post">
                    <input type="hidden" value=" <?php echo $linha['id']; ?>" name="id">
                    <input type="hidden" value="POUPANCA" name="pagina_inicial">
                    <button type="submit"> <img src="../../Assets//Icons//x-mark-xxl.png" class="icon_exclusao"></button>
                  </form>

                </td>
              </tr>
            <?php
              $contador++;
            }

            if ($adicionando_registro != null && $adicionando_registro == "REGISTRANDO ENTRADA") {
            ?>
              <form method="post">
                <input type="hidden" name="adicionando_registro" value='SALVANDO REGISTRO ENTRADA'>
                <input type="hidden" name="statusDespensa" value='3'>
                <tr>
                  <th scope="col">Nª</th>
                  <th scope="col">
                    <input type="text" name="descricao">
                  </th>
                  <th scope="col">
                    <input type="number" min="1" step="any" name="valor">
                  </th>
                  <th scope="col">
                    <input type="date" name="data" value='<?php echo date("Y-m-d"); ?>'>
                  </th>

                </tr>
              <?php
            }

              ?>
          </tbody>

        </table>

      </div>
      <?php
      if ($adicionando_registro != null && $adicionando_registro == "REGISTRANDO ENTRADA") {
      ?>

        <div class="row g-0 text-center">
          <div class="col-sm-6 col-md-6">
            <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
          </div>
          <div class="col-6 col-md-6">
            <form action="poupancas.php" method="post">
              <input type="hidden" value="" name="adicionando_registro">
              <button type="submit" class="btn btn-secondary">Cancelar</button>
            </form>
          </div>
        </div>


      <?php
      }

      if ($adicionando_registro == null) {
      ?>
        <form action="poupancas.php" method="post">
          <input type="hidden" value="REGISTRANDO ENTRADA" name="adicionando_registro">
          <button type="submit" class="btn btn-primary">Adicionar um novo registro</button>
        </form>
      <?php
      }
      ?>

    </div>
  </div>

  <div class="px-4 py-5 my-5 text-center">
    <img class="d-block mx-auto mb-4" src="../../Assets/Icons//bank.png" alt="" width="72" height="70">

    <h1 class="display-5 fw-bold" id="Saida_title">Saída</h1>
    <div class="col-lg-6 mx-auto">
      <p class="lead mb-4">Por favor, digite um ano e mês válido na tela inicial.</p>
      <a href="#Entrada_title"> Navegar até os registros de Entrada</a>
      <br><br>

      <div class="d-grid gap-2 d-sm-flex justify-content-sm-center" style="background-color:#c79797">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Nª</th>
              <th scope="col">Descrição</th>
              <th scope="col">valor</th>
              <th scope="col">Data</th>
              <th scope="col">Alteração</th>
              <th scope="col">Exclusão</th>
            </tr>
          </thead>
          <tbody>
            <?php

            $contador = 1;
            foreach ($Saida_fetch as $linha) {
            ?>
              <tr>
                <!-- <th scope="row">1</th> -->
                <td> <?php echo $contador; ?> </td>
                <td> <?php echo $linha['descricao']; ?> </td>
                <td> <?php echo "R$" . $linha['valor']; ?> </td>
                <td> <?php echo $linha['dataPoupanca']; ?> </td>
                <td>

                  <form action="alterar.php" method="post">
                    <input type="hidden" value=" <?php echo $linha['id']; ?>" name="id">
                    <input type="hidden" value="POUPANCA" name="pagina_inicial">
                    <button type="submit"> <img src="../../Assets//Icons//pencil.png" class="icon_exclusao"></button>
                  </form>

                </td>
                <td>

                  <form action="excluir.php" method="post">
                    <input type="hidden" value=" <?php echo $linha['id']; ?>" name="id">
                    <input type="hidden" value="POUPANCA" name="pagina_inicial">
                    <button type="submit"> <img src="../../Assets//Icons//x-mark-xxl.png" class="icon_exclusao"></button>
                  </form>

                </td>
              </tr>
            <?php
              $contador++;
            }

            if ($adicionando_registro != null && $adicionando_registro == "REGISTRANDO SAIDA") {
            ?>
              <form method="post">
                <input type="hidden" name="adicionando_registro" value='SALVANDO REGISTRO SAIDA'>
                <input type="hidden" name="statusDespensa" value='3'>
                <tr>
                  <th scope="col">Nª</th>
                  <th scope="col">
                    <input type="text" name="descricao">
                  </th>
                  <th scope="col">
                    <input type="number" min="1" step="any" name="valor">
                  </th>
                  <th scope="col">
                    <input type="date" name="data" value='<?php echo date("Y-m-d"); ?>'>
                  </th>

                </tr>
              <?php
            }

              ?>
          </tbody>

        </table>

      </div>
      <?php
      if ($adicionando_registro != null && $adicionando_registro == "REGISTRANDO SAIDA") {
      ?>

        <div class="row g-0 text-center">
          <div class="col-sm-6 col-md-6">
            <button type="submit" class="btn btn-primary">Registrar</button>
            </form>
          </div>
          <div class="col-6 col-md-6">
            <form action="poupancas.php" method="post">
              <input type="hidden" value="" name="adicionando_registro">
              <button type="submit" class="btn btn-secondary">Cancelar</button>
            </form>
          </div>
        </div>

      <?php
      }

      if ($adicionando_registro == null) {
      ?>
        <form action="poupancas.php" method="post">
          <input type="hidden" value="REGISTRANDO SAIDA" name="adicionando_registro">
          <button type="submit" class="btn btn-primary">Adicionar um novo registro</button>
        </form>
      <?php
      }
      ?>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>