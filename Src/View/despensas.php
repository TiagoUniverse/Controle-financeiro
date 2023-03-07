<?php

/**
 * ╔═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════╗
 * ║                                               CONTROLE FINANCEIRO                                                 ║
 * ║  ┌─────────────────────────────────────────────────────────────────────────────────────────────────────────────┐  ║                                                                                              │  ║
 * ║  │ @class: Despensas                                                                                           │  ║
 * ║  │ @description: Register of all money spent                                                                   │  ║
 * ║  | @dir: View                                                                                                  │  ║
 * ║  │ @author: Tiago César da Silva Lopes                                                                         │  ║
 * ║  │ @date: 02/02/23                                                                                             │  ║
 * ║  └─────────────────────────────────────────────────────────────────────────────────────────────────────────────┘  ║
 * ║═══════════════════════════════════════════════════════════════════════════════════════════════════════════════════║
 */

require_once "conexao.php";
require_once "Recursos/Navegacao.php";

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

  /** | @anotacao: Mês limite                                                                                       |
  *   | Funcionamento: A quinzena 2 permite registro do dia 20/mes atual até o dia 04/próximo mes. Para isso, vamos |
  *   | limitar o registro para registrar apenas o mes atual ou o próximo mes                                       |
  *   | Data: 03/03/23                                                                                              |
  */

  if ($mes_selecionado == 12) {
    $mes_limite = 1;
  } else {
    $mes_limite = $mes_selecionado + 1;
  }

  /** | @anotacao: Mensagem Vermelha                                                                                |
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
  } else if ($_SESSION['quinzena'] == "Quinzena 2" && ($dataDividida[2] > 5     || ($dataDividida[2] != 1 && $dataDividida[2] != 2 
    && $dataDividida[2] != 3 && $dataDividida[2] != 4 &&  $dataDividida[2] < 19))) {
    $mensagem = "Por favor, insira um registro dentro dos dias da segunda quinzena (20 até dia 4 do próximo mês)";
  } else {
  
    $retorno = $Despensas_repositorio->consultarRegistro($descricao, $valor, $data, 3, $pdo);
   
    if ($retorno == false) {
      $mensagemVermelha = false;
      $mensagem = "Informação registrada com sucesso!";
      $Despensas_repositorio->cadastro_entrada($descricao, $valor, $data, $_SESSION['ano'], $_SESSION['quinzena'], $_SESSION['statusMes'], 3, $pdo);
    }else {
      $mensagem = "Registro já cadastrado!";
    }

    $adicionando_registro = null;

    // Mensagem do resultado
    if ($mensagemVermelha) {
    ?>
      <div class="alert alert-danger" role="alert">
    <?php
    }else{
    ?>
      <div class="alert alert-success" role="alert">
    <?php
    }
    echo $mensagem;
    ?>
      </div>
    <?php

  }

}
