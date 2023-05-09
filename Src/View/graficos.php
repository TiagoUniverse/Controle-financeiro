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

if ($_SESSION['tipo_registro'] == "Registros pessoais") {
    $idStatusDespensa = 4;
} else {
    $idStatusDespensa = 2;
}

/*┌───────────────────────────────────────────────────────────────────────────────────────────────────────────────┐
* │                                Despensa's section                                                             │
* └───────────────────────────────────────────────────────────────────────────────────────────────────────────────┘
*/
require_once "../Model/Despensas.php";

use model\Despensas;

require_once "../Model/Despensas_repositorio.php";

use model\Despensas_repositorio;

$despensa = new Despensas();
$despensa_repositorio = new Despensas_repositorio();



// GASTO ANUAL 

$gasto_anual = $despensa_repositorio->listarGastos_Anuais($_SESSION['ano'], $idStatusDespensa, $_SESSION['user_id'], $pdo);

// var_dump($gasto_anual);


// GASTO POR MES
$gasto_mensal = array();
for ($mes = 1; $mes <= 12; $mes++) {
    $gasto_mensal[$mes] = $despensa_repositorio->listarGastosMensais_ByAno($_SESSION['ano'], $idStatusDespensa, $_SESSION['user_id'], $mes, $pdo);
}

// var_dump($gasto_mensal);


// GASTO POR TIPO DE DESPENSA
$gastoAnual_tipoDespensa = array();
for ($tipo_despensa = 1; $tipo_despensa <= 8; $tipo_despensa++) {
    $gastoAnual_tipoDespensa[$tipo_despensa - 1] = $despensa_repositorio->listarGastosAnuais_ByTipoDespensa($_SESSION['ano'], $idStatusDespensa, $_SESSION['user_id'], $tipo_despensa, $pdo);
}

// var_dump($gastoAnual_tipoDespensa);


// Gasto mensal por tipo de despensa
$gastoMensal_Mercado = array();
$gastoMensal_Transporte = array();
$gastoMensal_Tv = array();
$gastoMensal_Lazer = array();
$gastoMensal_Comida = array();
$gastoMensal_Saude = array();
$gastoMensal_Moradia = array();
$gastoMensal_Roupas = array();

for ($tipo_despensa = 1; $tipo_despensa <= 8; $tipo_despensa++) {

    for ($idStatusMes = 1; $idStatusMes <= 12; $idStatusMes++) {
        switch ($tipo_despensa) {
            case 1:
                $gastoMensal_Mercado[] = $despensa_repositorio->listarGastosMensais_ByTipoDespensa(
                    $_SESSION['ano'],
                    $idStatusDespensa,
                    $_SESSION['user_id'],
                    $tipo_despensa,
                    $idStatusMes,
                    $pdo
                );
                break;
            case 2:
                $gastoMensal_Transporte[] = $despensa_repositorio->listarGastosMensais_ByTipoDespensa(
                    $_SESSION['ano'],
                    $idStatusDespensa,
                    $_SESSION['user_id'],
                    $tipo_despensa,
                    $idStatusMes,
                    $pdo
                );
                break;
            case 3:
                $gastoMensal_Tv[] = $despensa_repositorio->listarGastosMensais_ByTipoDespensa(
                    $_SESSION['ano'],
                    $idStatusDespensa,
                    $_SESSION['user_id'],
                    $tipo_despensa,
                    $idStatusMes,
                    $pdo
                );
                break;
            case 4:
                $gastoMensal_Lazer[] = $despensa_repositorio->listarGastosMensais_ByTipoDespensa(
                    $_SESSION['ano'],
                    $idStatusDespensa,
                    $_SESSION['user_id'],
                    $tipo_despensa,
                    $idStatusMes,
                    $pdo
                );
                break;
            case 5:
                $gastoMensal_Comida[] = $despensa_repositorio->listarGastosMensais_ByTipoDespensa(
                    $_SESSION['ano'],
                    $idStatusDespensa,
                    $_SESSION['user_id'],
                    $tipo_despensa,
                    $idStatusMes,
                    $pdo
                );
                break;
            case 6:
                $gastoMensal_Saude[] = $despensa_repositorio->listarGastosMensais_ByTipoDespensa(
                    $_SESSION['ano'],
                    $idStatusDespensa,
                    $_SESSION['user_id'],
                    $tipo_despensa,
                    $idStatusMes,
                    $pdo
                );
                break;
            case 7:
                $gastoMensal_Moradia[] = $despensa_repositorio->listarGastosMensais_ByTipoDespensa(
                    $_SESSION['ano'],
                    $idStatusDespensa,
                    $_SESSION['user_id'],
                    $tipo_despensa,
                    $idStatusMes,
                    $pdo
                );
                break;
            case 8:
                $gastoMensal_Roupas[] = $despensa_repositorio->listarGastosMensais_ByTipoDespensa(
                    $_SESSION['ano'],
                    $idStatusDespensa,
                    $_SESSION['user_id'],
                    $tipo_despensa,
                    $idStatusMes,
                    $pdo
                );
                break;
            default:
                echo "Erro na busca dos dados mensais do tipo de despensa";
                break;
        }
    }
}

// var_dump($gastoMensal_Lazer);

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
    <title>Gráficos</title>
</head>

<body>
    <?php require_once "Recursos/Navegacao.php"; ?>
    <form action="home.php" method="post">
        <input type="hidden" name="statusMes" value="<?php echo $_SESSION['statusMes']; ?>">
        <button class="voltar-menu" style="border:none;">Voltar</button>
    </form>

    <form method="POST" action="graficos.php" class="input-pesquisar">
        <select name="ano" class="input-pesquisar-items">
            <?php
            for ($year = (int)date('Y'); 1900 <= $year; $year--) : ?>
                <option value="<?= $year; ?>" n><?= $year; ?></option>
            <?php endfor; ?>
        </select>
        <button type="submit" class="input-pesquisar-items">Pesquisar</button>
    </form>
    <h2 class="actual-year"><?php echo $_SESSION['ano']; ?></h2>

    <h3 class="gasto-anual">Gasto total deste ano: <u>R$<?php echo $gasto_anual; ?> </u> </h3>

    <session class="graficos">
        <!-- Gráfico dos gastos de todos os meses -->
        <div class="mychartBar">
            <h2>Gastos mensais do ano:</h2>
            <canvas id="ChartBar"></canvas>
        </div>

        <br>
        <div class="stackedChart">
            <h2>Gasto mensal de cada tipo de despensa</h2>
            <canvas id="stackedChart"></canvas>
        </div>

        <div class="chartPie">
            <h2>Gasto anual baseado no tipo de despensa:</h2>
            <canvas id="chartPie"></canvas>
        </div>
    </session>

    <br><br>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- 1.Gasto mensal -->
    <script>
        const ctx = document.getElementById('ChartBar');
        var dados_array = <?php echo json_encode($gasto_mensal) ?>;
        console.log(dados_array);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Maio', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                datasets: [{
                    label: 'Gastos mensais do ano',
                    data: [dados_array[1], dados_array[2], dados_array[3], dados_array[4], dados_array[5], dados_array[6], dados_array[7], dados_array[8], dados_array[9],
                    dados_array[10], dados_array[11], dados_array[12]],
                    borderWidth: 1
                    // backgroundColor: ["red"], 
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <!-- 2.Gasto mensal por tipo -->
    <script>
        const ctx3 = document.getElementById('stackedChart');
        var mercado_array = <?php echo json_encode($gastoMensal_Mercado)  ?> ;
        var Transporte_array = <?php echo json_encode($gastoMensal_Transporte)  ?> ;
        var TV_array = <?php echo json_encode($gastoMensal_Tv)  ?> ;
        var Lazer_array = <?php echo json_encode($gastoMensal_Lazer)  ?> ;
        var Comida_array = <?php echo json_encode($gastoMensal_Comida)  ?> ;
        var Saude_array = <?php echo json_encode($gastoMensal_Saude)  ?> ;
        var Moradia_array = <?php echo json_encode($gastoMensal_Moradia)  ?> ;
        var Roupas_array = <?php echo json_encode($gastoMensal_Roupas)  ?> ;

        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Maio', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                datasets: [{
                        label: 'Mercado',
                        data: [mercado_array[0], mercado_array[1], mercado_array[2], mercado_array[3], mercado_array[4], mercado_array[5], mercado_array[6], mercado_array[7], mercado_array[8], mercado_array[9], mercado_array[10], mercado_array[11]],
                        borderWidth: 1,
                        backgroundColor: ["blue"],
                    },
                    {
                        label: 'Transporte',
                        data: [Transporte_array[0], Transporte_array[1], Transporte_array[2], Transporte_array[3], Transporte_array[4], Transporte_array[5], Transporte_array[6], Transporte_array[7], Transporte_array[8], Transporte_array[9], Transporte_array[10], Transporte_array[11]],
                        borderWidth: 1,
                        backgroundColor: ["red"],
                    },
                    {
                        label: 'TV/ Internet/ telefone',
                        data: [TV_array[0], TV_array[1], TV_array[2], TV_array[3], TV_array[4], TV_array[5], TV_array[6], TV_array[7], TV_array[8], TV_array[9], TV_array[10], TV_array[11]],
                        borderWidth: 1,
                        backgroundColor: ["green"],
                    },
                    {
                        label: 'Lazer',
                        data: [Lazer_array[0], Lazer_array[1], Lazer_array[2], Lazer_array[3], Lazer_array[4], Lazer_array[5], Lazer_array[6], Lazer_array[7], Lazer_array[8], Lazer_array[9], Lazer_array[10], Lazer_array[11]],
                        borderWidth: 1,
                        backgroundColor: ["yellow"],
                    },
                    {
                        label: 'Comida fora ou Ifood',
                        data: [Comida_array[0], Comida_array[1], Comida_array[2], Comida_array[3], Comida_array[4], Comida_array[5], Comida_array[6], Comida_array[7], Comida_array[8], Comida_array[9], Comida_array[10], Comida_array[11]],
                        borderWidth: 1,
                        backgroundColor: ["orange"],
                    },
                    {
                        label: 'Saúde e beleza',
                        data: [Saude_array[0], Saude_array[1], Saude_array[2], Saude_array[3], Saude_array[4], Saude_array[5], Saude_array[6], Saude_array[7], Saude_array[8], Saude_array[9], Saude_array[10], Saude_array[11]],
                        borderWidth: 1,
                        backgroundColor: ["gray"],
                    },
                    {
                        label: 'Moradia',
                        data: [Moradia_array[0], Moradia_array[1], Moradia_array[2], Moradia_array[3], Moradia_array[4], Moradia_array[5], Moradia_array[6], Moradia_array[7], Moradia_array[8], Moradia_array[9], Moradia_array[10], Moradia_array[11]],
                        borderWidth: 1,
                        backgroundColor: ["purple"],
                    },
                    {
                        label: 'Roupas',
                        data: [Roupas_array[0], Roupas_array[1], Roupas_array[2], Roupas_array[3], Roupas_array[4], Roupas_array[5], Roupas_array[6], Roupas_array[7], Roupas_array[8], Roupas_array[9], Roupas_array[10], Roupas_array[11]],
                        borderWidth: 1,
                        backgroundColor: ["pink"],
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <!-- 3.Gasto anual por tipo -->
    <script>
        const ctx2 = document.getElementById('chartPie');
        var dados2_array = <?php echo json_encode($gastoAnual_tipoDespensa) ?>;

        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Mercado', 'Transporte', 'TV/ Internet/ telefone', 'Lazer', 'Comida fora ou Ifood', 'Saúde e Beleza', 'Moradia', 'Roupas'],
                datasets: [{
                    label: 'Gasto anual baseado no tipo de despensa',
                    data: [dados2_array[0], dados2_array[1], dados2_array[2], dados2_array[3], dados2_array[4], dados2_array[5], dados2_array[6], dados2_array[7]],
                    borderWidth: 1
                    // backgroundColor: ["red"], 
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    

</body>

</html>