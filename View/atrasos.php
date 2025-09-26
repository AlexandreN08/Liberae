<?php
session_start();

if (!isset($_SESSION['nomeUsuario'])) {
    header("Location: menuLogin.php");
    exit();
}

// Verifica se o usuário tem a função correta para acessar esta página (recpção = 4 ou admin = 1 ou supervisor = 2 ou lider = 3 ou RH = 5)
if ($_SESSION['idFuncao'] != 4 && $_SESSION['idFuncao'] != 1 && $_SESSION['idFuncao'] != 2 && $_SESSION['idFuncao'] != 3 && $_SESSION['idFuncao'] != 5) {
    echo "<script>
    alert('Seu perfil não tem acesso!');
    window.history.back();
    </script>";
    exit();
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
    <title>Registro de Funcionários Atrasados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
        }

        .form-control {
            margin-bottom: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 100px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Registro de Funcionários Atrasados</h2>
        <form action="backend_salvar_atrasos.php" method="POST">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Funcionário:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="matricula" class="form-label">Número de Matrícula:</label>
                <input type="text" class="form-control" id="matricula" name="matricula" required>
            </div>
            <div class="mb-3">
                <label for="setor" class="form-label">Setor:</label>
                <input type="text" class="form-control" id="setor" name="setor" required>
            </div>
            <div class="mb-3">
                <label for="motivo" class="form-label">Motivo do Atraso:</label>
                <textarea class="form-control" id="motivo" name="motivo" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="data_hora_chegada" class="form-label">Data/Hora de Chegada:</label>
                <input type="datetime-local" class="form-control" id="data_hora_chegada" name="data_hora_chegada" required>
            </div>
            <button  type="submit" name="btn_cadastrar" id="btn_cadastrar" class="btn btn-primary btn-block">Registrar Atraso</button>
        </form>
    </div>
</body>

</html>
