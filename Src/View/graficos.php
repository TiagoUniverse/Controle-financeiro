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
for ($mes = 0; $mes < 12; $mes++) {
    $gasto_mensal[$mes] = $despensa_repositorio->listarGastosMensais_ByAno($_SESSION['ano'], $idStatusDespensa, $_SESSION['user_id'], $mes, $pdo);
}

// var_dump($gasto_mensal);


// GASTO POR TIPO DE DESPENSA
$gastoAnual_tipoDespensa = array();
for ($tipo_despensa = 1; $tipo_despensa <= 8; $tipo_despensa++) {
    $gastoAnual_tipoDespensa[$tipo_despensa - 1] = $despensa_repositorio->listarGastos_ByTipoDespensa($_SESSION['ano'], $idStatusDespensa, $_SESSION['user_id'], $tipo_despensa, $pdo);
}

// var_dump($gastoAnual_tipoDespensa);

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
        <div class="chartPie">
            <h2>Gasto anual baseado no tipo de despensa:</h2>
            <canvas id="chartPie"></canvas>
        </div>

        <div class="stackedChart">
            <h2>Gasto mensal de cada tipo de despensa</h2>
            <canvas id="stackedChart"></canvas>
        </div>
    </session>

    <br><br>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                    data: [dados_array[0], dados_array[1], dados_array[2], dados_array[3], dados_array[4], dados_array[5], dados_array[6], dados_array[7], dados_array[8], dados_array[9], dados_array[10], dados_array[11]],
                    borderWidth: 1
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

<script>
        const ctx3 = document.getElementById('stackedChart');
        var dados_array = <?php echo json_encode($gasto_mensal) ?>;
        console.log(dados_array);

        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Maio', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                datasets: [
                    {
                    label: 'Gastos mensais do ano',
                    data: [dados_array[0], dados_array[1], dados_array[2], dados_array[3], dados_array[4], dados_array[5], dados_array[6], dados_array[7], dados_array[8], dados_array[9], dados_array[10], dados_array[11]],
                    borderWidth: 1
                },
                {
                    label: 'Gastos mensais do ano',
                    data: [dados_array[0], dados_array[1], dados_array[2], dados_array[3], dados_array[4], dados_array[5], dados_array[6], dados_array[7], dados_array[8], dados_array[9], dados_array[10], dados_array[11]],
                    borderWidth: 1
                },
                {
                    label: 'Gastos mensais do ano',
                    data: [dados_array[0], dados_array[1], dados_array[2], dados_array[3], dados_array[4], dados_array[5], dados_array[6], dados_array[7], dados_array[8], dados_array[9], dados_array[10], dados_array[11]],
                    borderWidth: 1
                },
                {
                    label: 'Gastos mensais do ano',
                    data: [dados_array[0], dados_array[1], dados_array[2], dados_array[3], dados_array[4], dados_array[5], dados_array[6], dados_array[7], dados_array[8], dados_array[9], dados_array[10], dados_array[11]],
                    borderWidth: 1
                },
                {
                    label: 'Gastos mensais do ano',
                    data: [dados_array[0], dados_array[1], dados_array[2], dados_array[3], dados_array[4], dados_array[5], dados_array[6], dados_array[7], dados_array[8], dados_array[9], dados_array[10], dados_array[11]],
                    borderWidth: 1
                },
                {
                    label: 'Gastos mensais do ano',
                    data: [dados_array[0], dados_array[1], dados_array[2], dados_array[3], dados_array[4], dados_array[5], dados_array[6], dados_array[7], dados_array[8], dados_array[9], dados_array[10], dados_array[11]],
                    borderWidth: 1
                },
                {
                    label: 'Gastos mensais do ano',
                    data: [dados_array[0], dados_array[1], dados_array[2], dados_array[3], dados_array[4], dados_array[5], dados_array[6], dados_array[7], dados_array[8], dados_array[9], dados_array[10], dados_array[11]],
                    borderWidth: 1
                },
                {
                    label: 'Gastos mensais do ano',
                    data: [dados_array[0], dados_array[1], dados_array[2], dados_array[3], dados_array[4], dados_array[5], dados_array[6], dados_array[7], dados_array[8], dados_array[9], dados_array[10], dados_array[11]],
                    borderWidth: 1
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

</body>

</html>