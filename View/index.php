<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            max-width: 350px;
            margin-top: -15vh;
            text-align: center;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
           
        }
        .input-group input {
            border: 1px solid black;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
            width: 100%;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            width: 100%;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <img class="logo" src="Palmali.png" alt="Logo">
        </div>
        <h2>AUTORIZA</h2>
        <form action="login.php" method="post">
            <div class="mb-3 input-group">
                <label for="nomeUsuario" class="visually-hidden">Usuário:</label>
                <input type="text" name="nomeUsuario" id="nomeUsuario" class="form-control" placeholder="Usuário" required>
            </div>
            <div class="mb-3 input-group">
                <label for="senha" class="visually-hidden">Senha:</label>
                <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required>
            </div>
            <button type="submit" name="btn_login" class="btn btn-primary">Entrar</button>
        </form>
        <br>
        <a href="tela_inicial.php">Voltar</a>
    </div>
</body>
</html>
