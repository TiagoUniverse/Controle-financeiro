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

if ($_SESSION['tipo_registro'] == "Registros pessoais"){
    $idStatusDespensa = 4;
} else {
    $idStatusDespensa = 2;
}


// GASTO ANUAL 

$gasto_anual = $despensa_repositorio->listarGastos_ByAno($_SESSION['ano'] , $idStatusDespensa , $_SESSION['user_id'] , $pdo);

var_dump($gasto_anual);

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

    <session class="graficos">
        <!-- Gráfico dos gastos de todos os meses -->
        <div class="mychartBar">
            <canvas id="ChartBar"></canvas>
        </div>

        <br>
        <div class="chartPie">
            <canvas id="chartPie"></canvas>
        </div>
    </session>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('ChartBar');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Maio', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                datasets: [{
                    label: 'Gastos mensais do ano',
                    data: [12, 19, 3, 5, 2, 3],
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

        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
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


</body>

</html>