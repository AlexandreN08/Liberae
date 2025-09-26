<?php
session_start();

if (!isset($_SESSION['nomeUsuario'])) {
    header("Location: menuLogin.php");
    exit();
}

// Verifica se o usuário tem a função correta para acessar esta página (idFuncao = 4 ou idFuncao = 1)
if ($_SESSION['idFuncao'] != 2 && $_SESSION['idFuncao'] != 3 && $_SESSION['idFuncao'] != 1 && $_SESSION['idFuncao'] != 5) {
    echo "<script>
    alert('Seu perfil não tem acesso!');
    window.history.back();
    </script>";
    exit();
}
?>

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

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 80px;
        }

        .form-group {
            margin-bottom: 15px;
            max-width: 400px;
            width: 100%;
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
        @media (max-width: 768px) {
            .container {
                width: 100%;
                padding: 0 15px;
            }
        }
    </style>

    <title>Autorização de Saída</title>
</head>

<body>
    <div class="menu">
        <?php include_once "menu.php"; ?>
    </div>

    <div class="container">
        <h2 class="text-center">Autorização de Saída</h2>

        <form action="autorizacoes_DB.php" method="post">
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
                <label for="dataHoraSaida">Data e Horário da Saída:</label>
                <input type="datetime-local" id="dataHoraSaida" name="dataHoraSaida" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="motivoSaida">Motivo da Saída:</label>
                <textarea id="motivoSaida" name="motivoSaida" class="form-control" rows="3" required></textarea>
            </div>

            <button type="submit" name="btn_cadastrar" id="btn_cadastrar" class="btn btn-primary btn-block">Autorizar
                Saída</button>
        </form>
    </div>

</body>

</html>
