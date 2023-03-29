<?php

/**
 * ╔═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════╗
 * ║                                               CONTROLE FINANCEIRO                                                 ║
 * ║  ┌─────────────────────────────────────────────────────────────────────────────────────────────────────────────┐  ║
 * ║  │ @description: Register of all money spent                                                                   │  ║
 * ║  | @dir: View                                                                                                  │  ║
 * ║  │ @author: Tiago César da Silva Lopes                                                                         │  ║
 * ║  │ @date: 02/02/23                                                                                             │  ║
 * ║  └─────────────────────────────────────────────────────────────────────────────────────────────────────────────┘  ║
 * ║═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════║
 */

require_once "conexao.php";

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
* │                                Despensas's section                                                            │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/

require_once "../Model/Despensas_repositorio.php";

use model\Despensas_repositorio;

$Despensas_repositorio = new Despensas_repositorio();


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

  // Mês para validação
  if ($_SESSION['statusMes'] < 10) {
    $mes_selecionado = "0" . $_SESSION['statusMes'];
  } else {
    $mes_selecionado = $_SESSION['statusMes'];
  }

  /**  | @anotacao: Mês limite                                                                                       |
   *   | Funcionamento: A quinzena 2 permite registro do dia 20/mes atual até o dia 04/próximo mes. Para isso, vamos |
   *   | limitar o registro para registrar apenas o mes atual ou o próximo mes                                       |
   *   | Data: 03/03/23                                                                                              |
   */

  if ($mes_selecionado == 12) {
    $mes_limite = 1;
  } else {
    $mes_limite = $mes_selecionado + 1;
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
  } else if ($_SESSION['quinzena'] == "Quinzena 1" && $dataDividida[1] != $mes_selecionado) {
    $mensagem = "Selecione uma data do mes de " . $_SESSION['nomeMes'];
  } else if ($_SESSION['quinzena'] == "Quinzena 2" && $dataDividida[1] != $mes_selecionado && $dataDividida[2] > 5) {
    $mensagem = "Informe um valor da segunda quinzena até o dia 4";
  } else if ($dataDividida[1] > $mes_limite) {
    $mensagem = "Para cadastrar na 2ª quinzena, insira registro entre o mês atual e o próximo mês.";
  } else if ($dataDividida[0] != $_SESSION['ano']) {
    $mensagem = "Faça um registro no ano de " . $_SESSION['ano'];
  } else if ($descricao == null) {
    $mensagem = "Por favor, preencha a descrição sobre o registro";
  } else if ($valor <= 0) {
    $mensagem = "Por favor, informe um valor positivo do dinheiro";
  } else if ($_SESSION['quinzena'] == "Quinzena 1" && ($dataDividida[2] < 5 || $dataDividida[2] > 19)) {
    $mensagem = "Por favor, insira um registro dentro dos dias da primeira quinzena (dia 5 até dia 19)";
  } else if ($_SESSION['quinzena'] == "Quinzena 2" && ($dataDividida[2] <= 4 || $dataDividida[2] > 31)) {
    $mensagem = "Por favor, insira um registro dentro dos dias da segunda quinzena (20 até dia 4 do próximo mês)";
  } else {
    $retorno = $Despensas_repositorio->consultarRegistro($descricao, $valor, $data, 3, $pdo);

    if ($retorno == false) {
      $mensagemVermelha = false;
      $mensagem = "Informação registrada com sucesso!";

      if ($_SESSION['tipo_registro'] == "Registros pessoais") {
        $statusDespensa = 3;
      } else {
        $statusDespensa = 1;
      }

      $Despensas_repositorio->cadastro_entrada($descricao, $valor, $data, $_SESSION['ano'], $_SESSION['quinzena'], $_SESSION['statusMes'], $statusDespensa, $_SESSION['user_id'], $pdo);
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

  // Mês para validação
  if ($_SESSION['statusMes'] < 10) {
    $mes_selecionado = "0" . $_SESSION['statusMes'];
  } else {
    $mes_selecionado = $_SESSION['statusMes'];
  }

  /**  | @anotacao: Mês limite                                                                                       |
   *   | Funcionamento: A quinzena 2 permite registro do dia 20/mes atual até o dia 04/próximo mes. Para isso, vamos |
   *   | limitar o registro para registrar apenas o mes atual ou o próximo mes                                       |
   *   | Data: 03/03/23                                                                                              |
   */

  if ($mes_selecionado == 12) {
    $mes_limite = 1;
  } else {
    $mes_limite = $mes_selecionado + 1;
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
  } else if ($_SESSION['quinzena'] == "Quinzena 1" && $dataDividida[1] != $mes_selecionado) {
    $mensagem = "Selecione uma data do mes de " . $_SESSION['nomeMes'];
  } else if ($_SESSION['quinzena'] == "Quinzena 2" && $dataDividida[1] != $mes_selecionado && $dataDividida[2] > 5) {
    $mensagem = "Informe um valor da segunda quinzena até o dia 4";
  } else if ($dataDividida[1] > $mes_limite) {
    $mensagem = "Para cadastrar na 2ª quinzena, insira registro entre o mês atual e o próximo mês.";
  } else if ($dataDividida[0] != $_SESSION['ano']) {
    $mensagem = "Faça um registro no ano de " . $_SESSION['ano'];
  } else if ($descricao == null) {
    $mensagem = "Por favor, preencha a descrição sobre o registro";
  } else if ($valor <= 0) {
    $mensagem = "Por favor, informe um valor positivo do dinheiro";
  } else if ($_SESSION['quinzena'] == "Quinzena 1" && ($dataDividida[2] < 5 || $dataDividida[2] > 19)) {
    $mensagem = "Por favor, insira um registro dentro dos dias da primeira quinzena (dia 5 até dia 19)";
  } else if ($_SESSION['quinzena'] == "Quinzena 2" && ($dataDividida[2] <= 4 || $dataDividida[2] > 31)) {
    $mensagem = "Por favor, insira um registro dentro dos dias da segunda quinzena (20 até dia 4 do próximo mês)";
  } else {

    $retorno = $Despensas_repositorio->consultarRegistro($descricao, $valor, $data, 4, $pdo);

    if ($retorno == false) {
      $mensagemVermelha = false;
      $mensagem = "Informação registrada com sucesso!";

      if ($_SESSION['tipo_registro'] == "Registros pessoais") {
        $statusDespensa = 4;
      } else {
        $statusDespensa = 2;
      }

      $Despensas_repositorio->cadastro_Saida($descricao, $valor, $data, $_SESSION['ano'], $_SESSION['quinzena'], $_SESSION['statusMes'], $statusDespensa, $_SESSION['user_id'], $pdo);
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

  $consulta_Entrada = $pdo->query("Select id, descricao, valor, DATE_FORMAT(dataDespensa, '%d/%m/%Y') as dataDespensa, ano, quinzena from despensas where status = 'ATIVO' 
  and ano = '{$_SESSION['ano']}'  and IdStatus_mes = '{$_SESSION['statusMes']}' and quinzena = '{$_SESSION['quinzena']}' 
  and ( idStatus_despensa = 1) and idUsuario = '{$_SESSION['user_id']}'  Order By month(dataDespensa)        ");

  $consulta_Saida = $pdo->query("Select id, descricao, valor, DATE_FORMAT(dataDespensa, '%d/%m/%Y') as dataDespensa, ano, quinzena from despensas where status = 'ATIVO' 
  and ano = '{$_SESSION['ano']}'  and IdStatus_mes = '{$_SESSION['statusMes']}' and quinzena = '{$_SESSION['quinzena']}' 
  and ( idstatus_despensa = 2 )  and idUsuario = '{$_SESSION['user_id']}'   Order By month(dataDespensa)        ");
} else {

  $consulta_Entrada = $pdo->query("Select id, descricao, valor, DATE_FORMAT(dataDespensa, '%d/%m/%Y') as dataDespensa, ano, quinzena from despensas where status = 'ATIVO' 
  and ano = '{$_SESSION['ano']}'  and IdStatus_mes = '{$_SESSION['statusMes']}' and quinzena = '{$_SESSION['quinzena']}' 
  and ( idStatus_despensa = 3)  and idUsuario = '{$_SESSION['user_id']}'   Order By month(dataDespensa)        ");

  $consulta_Saida = $pdo->query("Select id, descricao, valor, DATE_FORMAT(dataDespensa, '%d/%m/%Y') as dataDespensa, ano, quinzena from despensas where status = 'ATIVO' 
  and ano = '{$_SESSION['ano']}'  and IdStatus_mes = '{$_SESSION['statusMes']}' and quinzena = '{$_SESSION['quinzena']}' 
  and ( idstatus_despensa = 4 )  and idUsuario = '{$_SESSION['user_id']}'   Order By month(dataDespensa)        ");
}

/*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │                                Registros do gasto e da receita                                                |
* | Description: After viewing the SQL, we are going to calculate how many money do we have                       │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/
$dinheiroEntrada = 0;
$dinheiroSaida = 0;

$Entrada_fetch = $consulta_Entrada->fetchAll(PDO::FETCH_ASSOC);
$Saida_fetch = $consulta_Saida->fetchAll(PDO::FETCH_ASSOC);

foreach ($Entrada_fetch as $row) {
  $dinheiroEntrada +=  $row['valor'];
}

foreach ($Saida_fetch as $row) {
  $dinheiroSaida +=  $row['valor'];
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
  <form action="mes.php" method="post">
    <input type="hidden" name="statusMes" value="<?php echo $_SESSION['statusMes']; ?>">
    <button class="voltar-menu" style="border:none;">Voltar</button>
  </form>

  <main class="main-despensas">
    <h2><?php echo $_SESSION['quinzena']; ?></h2>
    <h3><?php echo "Despensas: " . $_SESSION['tipo_registro']; ?></h3>
    <p>Clique em registrar e manipule os registros</p>
    <table class="table-dinheiroTotal">
      <thead>
        <tr>
          <th scope="col"> Gasto total </th>
          <th scope="col">Receita total</th>
          <th scope="col">Resultado da subtração</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="col"><?php echo "R$" . $dinheiroSaida; ?> </th>
          <th scope="col"><?php echo "R$" . $dinheiroEntrada; ?> </th>
          <th scope="col" style="color:#e61e19;"><?php echo "R$" . ($dinheiroEntrada - $dinheiroSaida); ?> </th>
        </tr>
      </tbody>
    </table>
    <br>
    <?php
    if ($_SESSION['quinzena'] == "Quinzena 1") {
      echo "<img src='../../Assets/img/dia 15.png' alt='a calendar with the number 15' width='72' height='70'> ";
    } else {
      echo "<img src='../../Assets/img/dia 30.png' alt='a calendar with the number 30' width='72' height='70'> ";
    }
    ?>
    <h2>Saída</h2>
    <a href="#Entrada_title"> Navegar até os registros de Entrada</a>
    <table class="table-saida">
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
            <td> <?php echo $contador; ?> </td>
            <td> <?php echo $linha['descricao']; ?> </td>
            <td> <?php echo "R$" . $linha['valor']; ?> </td>
            <td> <?php echo $linha['dataDespensa']; ?> </td>
            <td>
              <form action="alterar.php" method="post">
                <input type="hidden" value=" <?php echo $linha['id']; ?>" name="id">
                <input type="hidden" value="DESPENSAS" name="pagina_inicial">
                <button type="submit"><img src="../../Assets//Icons//pencil.png" class="icon_exclusao"></button>
              </form>
            </td>
            <td>
              <form action="excluir.php" method="post">
                <input type="hidden" value=" <?php echo $linha['id']; ?>" name="id">
                <input type="hidden" value="DESPENSAS" name="pagina_inicial">
                <button type="submit"><img src="../../Assets//Icons//x-mark-xxl.png" class="icon_exclusao"></button>
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
  </main>


</body>

</html>