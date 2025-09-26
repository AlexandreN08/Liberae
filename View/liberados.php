<?php
require_once("conexao.php");
session_start();

$_SESSION['url_anterior'] = $_SERVER['REQUEST_URI'];

if (!isset($_SESSION['nomeUsuario'])) {
    header("Location: index.php");
    exit();
}

// Verifica se o usuário tem a função correta para acessar esta página (idFuncao = 4 ou idFuncao = 1)
if ($_SESSION['idFuncao'] != 4 && $_SESSION['idFuncao'] != 1) {
    echo "<script>
    alert('Seu perfil não tem acesso!');
    window.history.back();
    </script>";
    exit();
}

if (isset($_GET['confirmarSaida'])) {
    $idAutorizacao = $_GET['confirmarSaida'];
    $confirmarSaidaQuery = "UPDATE Autorizacoes SET SaidaConfirmada = TRUE WHERE IDAutorizacao = $idAutorizacao";
    $resultado = mysqli_query($conexao, $confirmarSaidaQuery);

    if ($resultado) {
        echo "Saída confirmada com sucesso!";
        exit;  
    } else {
        echo "Erro ao confirmar saída: " . mysqli_error($conexao);
    }
}

$consultarAutorizacoes = "
SELECT 
    a.IDAutorizacao, 
    a.NomeColaborador, 
    a.Setor, 
    a.NumeroMatricula,
    a.DataHoraSaida, 
    a.MotivoSaida, 
    a.DataHoraSolicitacao, 
    a.SaidaConfirmada,
    a.NomeAutorizador, 
    u.nome_completo AS Nome_completo
FROM 
    Autorizacoes a
LEFT JOIN 
    Usuarios u ON a.NomeAutorizador = u.NomeUsuario
WHERE 
    a.SaidaConfirmada = FALSE;


";

$resultadoAutorizacoes = mysqli_query($conexao, $consultarAutorizacoes);

if (!$resultadoAutorizacoes) {
    die("Erro na consulta: " . mysqli_error($conexao));
}
?>

<div class="menu">
    <?php include_once "menu.php"; ?>
</div>

<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

    <style>
        body {
            background-color: white;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            width: 80%;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .confirmar-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }

        .menu {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: white;
            z-index: 1000;
        }
    </style>

    <title>Liberados</title>
</head>

<body>

    <div class="container">
        <h2 class="text-center">Colaboradores Liberados</h2>

        <table>
            <thead>
                <tr>
                    <th>Nome Colaborador</th>
                    <th>Nome Autorizador</th>
                    <th>Data e Horário de Liberação</th>
                    <th>Número Matrícula</th>
                    <th>Motivo Saída</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultadoAutorizacoes)): ?>
                    <tr id="row_<?= $row['IDAutorizacao'] ?>">
                        <td>
                            <?= $row['NomeColaborador'] ?>
                        </td>
                        <td>
                            <?= $row['Nome_completo'] ?>
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
                        <td><button class="confirmar-btn" name="btn_cadastrar" id="btn_cadastrar"
                                onclick="confirmarSaida(<?= $row['IDAutorizacao'] ?>)">Confirmar Saída</button></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>

        </table>
    </div>

    <script>
        function confirmarSaida(idAutorizacao) {
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        
                        alert("Autorização #" + idAutorizacao + " confirmada com sucesso!");

                        var rowToRemove = document.getElementById("row_" + idAutorizacao);
                        if (rowToRemove) {
                            rowToRemove.parentNode.removeChild(rowToRemove);
                        }
                    } else {
                       
                        alert("Erro ao confirmar saída. Status: " + xhr.status);
                    }
                }
            };

            xhr.open("GET", "confirmar_saida.php?idAutorizacao=" + idAutorizacao, true);
            xhr.send();
        }
    </script>

</body>

</html>
