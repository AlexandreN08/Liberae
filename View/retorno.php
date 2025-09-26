<?php
session_start();
require_once("conexao.php");

if (!isset($_SESSION['nomeUsuario'])) {
    header("Location: menuLogin.php");
    exit();
}

// Verifica se o usuário tem a função correta para acessar esta página (idFuncao = 4 ou idFuncao = 1)
if ($_SESSION['idFuncao'] != 4 && $_SESSION['idFuncao'] != 1 && $_SESSION['idFuncao'] != 2 && $_SESSION['idFuncao'] != 3 && $_SESSION['idFuncao'] != 5) {
    echo "<script>
    alert('Seu perfil não tem acesso!');
    window.history.back();
    </script>";
    exit();
}



$nomeColaborador = $setor = $numeroMatricula = $dataHoraRetorno = $motivoSaida = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeColaborador = mysqli_real_escape_string($conexao, $_POST['nomeColaborador']);
    $setor = mysqli_real_escape_string($conexao, $_POST['setor']);
    $numeroMatricula = mysqli_real_escape_string($conexao, $_POST['numeroMatricula']);
    $dataHoraRetorno = date('Y-m-d H:i:s', strtotime($_POST['dataHoraRetorno']));
    $motivoSaida = mysqli_real_escape_string($conexao, $_POST['motivoSaida']);

    $sql = "INSERT INTO retorno (nomeColaborador, setor, numeroMatricula, dataHoraRetorno, motivoSaida)
            VALUES ('$nomeColaborador', '$setor', '$numeroMatricula', '$dataHoraRetorno', '$motivoSaida')";

    if (mysqli_query($conexao, $sql)) {
        echo "<div class='container'>";
        echo "<h2 class='text-center'>Dados Salvos com Sucesso!</h2>";
        echo "<p>Nome do Colaborador: $nomeColaborador</p>";
        echo "<p>Setor: $setor</p>";
        echo "<p>Número da Matrícula: $numeroMatricula</p>";
        echo "<p>Data e Hora de Retorno: $dataHoraRetorno</p>";
        echo "</div>";
    } else {
        echo "Erro ao salvar os dados: " . mysqli_error($conexao);
    }
}

mysqli_close($conexao);
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

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 80px;
        }

        .form-group {
            margin-bottom: 15px;
            width: 400px;
        }

        .form-control {
            padding: 8px;
        }

        button {
            padding: 10px;
        }

        .menu {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: white;
            z-index: 1000;

        }
    </style>

    <title>Retorno da Autorização</title>
</head>

<body>
    <div class="menu">
        <?php include_once "menu.php"; ?>
    </div>

    <div class="container">
        <h2 class="text-center">Retorno da Autorização</h2>

        <form action="retorno_DB.php" method="post">
            <div class="form-group">
                <label for="nomeColaborador">Nome completo do Colaborador:</label>
                <input type="text" id="nomeColaborador" name="nomeColaborador" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="setor">Setor:</label>
                <input type="text" id="setor" name="setor" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="numeroMatricula">Número da Matrícula:</label>
                <input type="text" id="numeroMatricula" name="numeroMatricula" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="dataHoraRetorno">Data e Horário de Retorno:</label>
                <input type="datetime-local" id="dataHoraRetorno" name="dataHoraRetorno" class="form-control" required>
            </div>

            

            <button type="submit" name="btn_cadastrar" id="btn_cadastrar" class="btn btn-primary btn-block">Enviar Retorno</button>
        </form>
    </div>
</body>

</html>
