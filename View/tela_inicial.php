<?php
session_start();

if (!isset($_SESSION['nomeUsuario'])) {
    header("Location: menuLogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        .menu {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: white;
            z-index: 1000;
        }

        .imagem {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
            padding: 45px;
        }

        .container {
            text-align: center;
            padding-top: 50px;
        }

        .frase {
            font-size: 20px;
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="menu">
        <?php include_once "menu.php"; ?>
    </div>

    <div class="container">
        <img class="imagem" src="pig.png" alt="Imagem de um porquinho">
        <p class="frase">AUTORIZA - Sistema de Liberação de Funcionários para otimizar processos internos.</p>
    </div>
</body>

</html>
