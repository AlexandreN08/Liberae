<?php
require_once("conexao.php");
session_start();

$_SESSION['url_anterior'] = $_SERVER['REQUEST_URI'];

if (!isset($_SESSION['nomeUsuario'])) {
    header("Location: menuLogin.php");
    exit();
}

// Verifica se o usuário tem a função correta para acessar esta página (idFuncao = 4 ou idFuncao = 1)
if ($_SESSION['idFuncao'] != 5 && $_SESSION['idFuncao'] != 1 && $_SESSION['idFuncao'] != 2 && $_SESSION['idFuncao'] != 3 && $_SESSION['idFuncao'] != 4) {
    echo "<script>
    alert('Seu perfil não tem acesso!');
    window.history.back();
    </script>";
    exit();
}

$consultarLiberados = "
    SELECT a.IDAutorizacao, a.NomeColaborador, a.DataHoraSaida, a.NumeroMatricula, a.MotivoSaida,
           u.nome_completo AS NomeAutorizador
    FROM Autorizacoes a
    LEFT JOIN Usuarios u ON a.NomeAutorizador = u.NomeUsuario
    WHERE a.SaidaConfirmada = TRUE
    ORDER BY a.DataHoraSaida DESC
";

$resultadoLiberados = mysqli_query($conexao, $consultarLiberados);

if (!$resultadoLiberados) {
    die("Erro na consulta de Liberados: " . mysqli_error($conexao));
}

$consultarRetornos = "
    SELECT r.nomeColaborador, r.setor, r.numeroMatricula, r.dataHoraRetorno, a.DataHoraSaida
    FROM retorno r
    LEFT JOIN Autorizacoes a ON r.nomeColaborador = a.NomeColaborador AND r.dataHoraRetorno >= a.DataHoraSaida
    ORDER BY r.dataHoraRetorno DESC
";

$resultadoRetornos = mysqli_query($conexao, $consultarRetornos);

if (!$resultadoRetornos) {
    die("Erro na consulta de Retornos: " . mysqli_error($conexao));
}

$consultarAtrasos = "
    SELECT nome, matricula, motivo, data_hora_chegada, setor
    FROM funcionarios_atrasados
    ORDER BY data_hora_chegada DESC
";

$resultadoAtrasos = mysqli_query($conexao, $consultarAtrasos);

if (!$resultadoAtrasos) {
    die("Erro na consulta de Atrasos: " . mysqli_error($conexao));
}
?>

<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <style>
        .container {
            text-align: center;
        }

        .tabela {
            margin-top: 20px;
        }
    </style>

    <div class="menu">
        <?php include_once "menu.php"; ?>
    </div>

    <title>Lista de Liberados, Retornos e Atrasos</title>
</head>

<body>
    <div class="container">
        <button id="liberadosBtn" class="btn btn-primary">Colaboradores Liberados</button>
        <button id="retornosBtn" class="btn btn-primary">Retornos</button>
        <button id="atrasosBtn" class="btn btn-primary">Atrasos</button>

        <?php if ($resultadoLiberados): ?>
            <div id="tabelaLiberados" class="tabela">
                <h2 class="text-center">Colaboradores Liberados</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nome Colaborador (Liberados)</th>
                            <th>Data/Hora Liberação</th>
                            <th>Número Matrícula</th>
                            <th>Motivo Saída</th>
                            <th>Nome Autorizador</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($resultadoLiberados)): ?>
                            <tr>
                                <td>
                                    <?= $row['NomeColaborador'] ?>
                                </td>
                                <td>
                                    <?= date('d/m/Y H:i', strtotime($row['DataHoraSaida'])) ?>
                                </td>
                                <td>
                                    <?= $row['NumeroMatricula'] ?>
                                </td>
                                <td>
                                    <?= $row['MotivoSaida'] ?>
                                </td>
                                <td>
                                    <?= $row['NomeAutorizador'] ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center">Nenhum colaborador liberado encontrado.</p>
        <?php endif; ?>

        <?php if ($resultadoRetornos): ?>
            <div id="tabelaRetornos" class="tabela" style="display:none;">
                <h2 class="text-center">Retornos</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nome Colaborador (Retornos)</th>
                            <th>Setor</th>
                            <th>Número Matrícula</th>
                            <th>Data/Hora Saída</th>
                            <th>Data/Hora Retorno</th>
                            <th>Tempo Fora</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($resultadoRetornos)): ?>
                            <tr>
                                <td><?= $row['nomeColaborador'] ?></td>
                                <td><?= $row['setor'] ?></td>
                                <td><?= $row['numeroMatricula'] ?></td>
                                <td><?= isset($row['DataHoraSaida']) ? date('d/m/Y H:i', strtotime($row['DataHoraSaida'])) : 'Data de saída não registrada' ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($row['dataHoraRetorno'])) ?></td>
                                <td>
                                    <?php
                                    $saida = new DateTime($row['DataHoraSaida']);
                                    $retorno = new DateTime($row['dataHoraRetorno']);
                                    $intervalo = $saida->diff($retorno);
                                    $horas = $intervalo->format('%H');
                                    $minutos = $intervalo->format('%I');
                                    echo $horas . ' horas e ' . str_pad($minutos, 2, '0', STR_PAD_LEFT) . ' minutos';
                                    ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center">Nenhum retorno encontrado.</p>
        <?php endif; ?>

        <?php if ($resultadoAtrasos): ?>
            <div id="tabelaAtrasos" class="tabela" style="display:none;">
                <h2 class="text-center">Atrasos</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nome do Funcionário</th>
                            <th>Número de Matrícula</th>
                            <th>Setor</th>
                            <th>Motivo do Atraso</th>
                            <th>Data/Hora de Chegada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($resultadoAtrasos)): ?>
                            <tr>
                                <td>
                                    <?= $row['nome'] ?>
                                </td>
                                <td>
                                    <?= $row['matricula'] ?>
                                </td>
                                <td>
                                    <?= $row['setor'] ?>
                                </td>
                                <td>
                                    <?= $row['motivo'] ?>
                                </td>
                                <td>
                                    <?= date('d/m/Y H:i', strtotime($row['data_hora_chegada'])) ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center">Nenhum atraso encontrado.</p>
        <?php endif; ?>
    </div>

    <script>
        $(document).ready(function () {
            $("#liberadosBtn").click(function () {
                $("#tabelaLiberados").show();
                $("#tabelaRetornos").hide();
                $("#tabelaAtrasos").hide();
            });

            $("#retornosBtn").click(function () {
                $("#tabelaLiberados").hide();
                $("#tabelaRetornos").show();
                $("#tabelaAtrasos").hide();
            });

            $("#atrasosBtn").click(function () {
                $("#tabelaLiberados").hide();
                $("#tabelaRetornos").hide();
                $("#tabelaAtrasos").show();
            });
        });
    </script>
</body>

</html>
