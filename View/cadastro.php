<?php
session_start();

// Verifica se o índice 'nomeUsuario' existe na sessão
if (!isset($_SESSION['nomeUsuario'])) {
    // Mensagem de erro e redirecionamento para o login
    echo "<script language='javascript' type='text/javascript'>
            alert('Você precisa estar logado para acessar esta página.');
            window.location.href = 'menuLogin.php';
          </script>";
    exit();
}

if ( $_SESSION['idFuncao'] != 1) {
    echo "<script>
    alert('Seu perfil não tem acesso!');
    window.history.back();
    </script>";
    exit();
}

?>



<div class="menu">
    <?php include_once ("menu.php"); ?>
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

            .form-group {
                max-width: 100%;
            }
        }
    </style>

    <title>Cadastro de Usuário</title>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Cadastro de Usuário</h2>
        <form action="cadastro_DB.php" method="post">
            <div class="form-group">
                <label for="nome_completo">Nome Completo:</label>
                <input type="text" id="nome_completo" name="nome_completo" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tipoUsuario">Tipo de Usuário:</label>
                <select id="tipoUsuario" name="tipoUsuario" class="form-control" required>
                    <option value="administrador">Administrador</option>
                    <option value="supervisor">Supervisor</option>
                    <option value="lider">Lider</option>
                    <option value="rh">RH</option>
                    <option value="portaria">Portaria</option>
                </select>
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
                <label for="nomeCompleto">Usuário:</label>
                <input type="text" id="nomeCompleto" name="nomeCompleto" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="text" id="senha" name="senha" class="form-control" required>
            </div>
            <button type="submit" name="btn_cadastrar" id="btn_cadastrar" class="btn btn-primary btn-block">Cadastrar</button>
        </form>
    </div>
</body>

</html>
