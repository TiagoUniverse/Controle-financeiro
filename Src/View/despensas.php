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

if (isset($_POST['statusDespensa'])) {
  $statusDespensa = $_POST['statusDespensa'];
} else {
  $statusDespensa = null;
}

/*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │                                Conexão com BD                                                                 │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

/**
 * Salvando Registros
 * funcionamento: Quando a variável está no status de 'Salvando registro', ele só vai salvar se ele não encontrar o mesmo registro já salvo 
 * Data: 16/02/23
 */

/*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │1-                               Cadastro de registros                                                         │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

if ($adicionando_registro != null && $adicionando_registro == "SALVANDO REGISTRO") {


  /*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
  * │                                Validações                                                                     │
  * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
  */

  if (isset($_POST['data'])) {
    $dataDividida = explode("-", $_POST['data']);
  }


  // Mês para validação
  if ($_SESSION['statusMes'] < 10) {
    $mes_selecionado = "0" . $_SESSION['statusMes'];
  } else {
    $mes_selecionado = $_SESSION['statusMes'];
  }

  /**
   * Mensagem Vermelha
   * Funcionamento: A validação começa com ela definida como verdadeira. Se depois de todas as validações as informações estiverem corretas, então o sistema
   * vai exibir uma mensagem de sucesso e informar que o cadastro foi feito com sucesso
   * Data: 16/02/23
   */

  $mensagemVermelha = true;
  if (!isset($_POST['data'])) {
    $mensagem = "Informe uma data";
  } else if ($dataDividida[1] != $mes_selecionado) {
    $mensagem = "Selecione uma data do mes de " . $_SESSION['nomeMes'];
  } else if ($dataDividida[0] != $_SESSION['ano']) {
    $mensagem = "Faça um registro no ano de " . $_SESSION['ano'];
  } else if ($descricao == null) {
    $mensagem = "Por favor, preencha a descrição sobre o registro";
  } else if ($valor <= 0) {
    $mensagem = "Por favor, informe um valor positivo do dinheiro";
  } else {

    $retorno = $Despensas_repositorio->consultarRegistro($descricao, $valor, $data, $pdo);

    if ($retorno == false) {
      $mensagemVermelha = false;
      $mensagem = "Informação registrada com sucesso!";


      $Despensas_repositorio->cadastro_entrada($descricao, $valor, $data, $_SESSION['ano'], $_SESSION['quinzena'], $_SESSION['statusMes'], $statusDespensa, $pdo);
    } else {
      $mensagem = "Registro já cadastrado!";
    }
  }

  $adicionando_registro = null;

  // Mensagem do resultado
  if ($mensagemVermelha) {
?>
    <div class="alert alert-danger" role="alert">
    <?php
  } else {
    ?>
      <div class="alert alert-success" role="alert">
      <?php
    }
    echo $mensagem;
      ?>
      </div>
    <?php
  }

  /*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
  * │                                Exclusão de registros                                                          │
  * └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
  */
  var_dump(isset($_POST['descricaoExclusao']));


  if ($adicionando_registro != null && $adicionando_registro == "DELETANDO REGISTRO") {
    // echo $adicionando_registro;
    echo "A exclusão é de: " . $_POST['descricaoExclusao'];

    // var_dump($_POST['idExclusao']);
  }



  // Consulta
  $consulta = $pdo->query("Select id, descricao, valor, DATE_FORMAT(dataDespensa, '%d/%m/%Y') as dataDespensa, ano, quinzena from despensas where status = 'ATIVO' 
  and ano = '{$_SESSION['ano']}'  and IdStatus_mes = '{$_SESSION['statusMes']}' and quinzena = '{$_SESSION['quinzena']}' 
  and ( idStatus_despensa = 3 OR idstatus_despensa = 4 )  Order By dataDespensa        ");

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
        <p class="lead mb-4">Por favor, digite um ano e mês válido na tela inicial.</p>
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
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                ?>
                  <tr>
                    <!-- <th scope="row">1</th> -->
                    <td> <?php echo $contador; ?> </td>
                    <td> <?php echo $linha['descricao']; ?> </td>
                    <td> <?php echo "R$" . $linha['valor']; ?> </td>
                    <td> <?php echo $linha['dataDespensa']; ?> </td>
                    <td> <a href=""><img src="../../Assets//Icons//pencil.png" class="icon_exclusao"> </a> </td>
                    <td>

                      <a href="excluir_despensa.php">
                        <img src="../../Assets//Icons//x-mark-xxl.png" class="icon_exclusao">
                      </a>

                    </td>


                  </tr>
                <?php
                  $contador++;
                }

                if ($adicionando_registro != null && $adicionando_registro == "REGISTRANDO ENTRADA") {
                ?>
                  <form method="post">
                    <input type="hidden" name="adicionando_registro" value='SALVANDO REGISTRO'>
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
                <form action="despensas.php" method="post">
                  <input type="hidden" value="" name="adicionando_registro">
                  <button type="submit" class="btn btn-secondary">Cancelar</button>
                </form>
              </div>
            </div>


          <?php
          }

          if ($adicionando_registro == null) {
          ?>
            <form action="despensas.php" method="post">
              <input type="hidden" value="REGISTRANDO ENTRADA" name="adicionando_registro">
              <button type="submit" class="btn btn-primary">Adicionar um novo registro</button>
            </form>
          <?php
          }
          ?>

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