<?php
require_once("conexao.php");
session_start();

$_SESSION['url_anterior'] = $_SERVER['REQUEST_URI'];

if (!isset($_SESSION['nomeUsuario'])) {
    header("Location: index.php");
    exit();
}

// Verifica se o usuário tem a função correta para acessar esta página (idFuncao = 5 ou idFuncao = 1)
if ($_SESSION['idFuncao'] != 5 && $_SESSION['idFuncao'] != 1) {
    echo "<script>
    alert('Seu perfil não tem acesso!');
    window.history.back();
    </script>";
    exit();
}

// Verifica se um arquivo foi enviado
if (isset($_FILES['planilha'])) {
    $file_name = $_FILES['planilha']['name'];
    $file_tmp = $_FILES['planilha']['tmp_name'];

    // Verifica a extensão do arquivo (permitindo apenas .xlsx, .xls, .pdf)
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_extensions = array("pdf");

    if (!in_array($file_ext, $allowed_extensions)) {
        echo "Extensão de arquivo não permitida, por favor, escolha um arquivo PDF";
        echo "<script>window.location.href = 'addFerias.php';</script>";
        exit();
    }

    // Move o arquivo para o diretório desejado
    $upload_dir = "uploads/";
    move_uploaded_file($file_tmp, $upload_dir . $file_name);

    // Recarrega a página para exibir o novo arquivo na lista
    echo "<script>window.location.href = 'addFerias.php';</script>";
}

// Função para excluir um arquivo
function deleteFile($fileName) {
    $upload_dir = "uploads/";
    $file_path = $upload_dir . $fileName;
    if (file_exists($file_path)) {
        unlink($file_path);
        return true;
    } else {
        return false;
    }
}

// Verifica se o parâmetro "delete" foi enviado para excluir um arquivo
if (isset($_GET['delete']) && !empty($_GET['delete'])) {
    $fileToDelete = $_GET['delete'];
    if (deleteFile($fileToDelete)) {
        echo "<script>alert('Arquivo $fileToDelete excluído com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao excluir o arquivo $fileToDelete.');</script>";
    }
    // Recarrega a página após a exclusão do arquivo
    echo "<script>window.location.href = 'addFerias.php';</script>";
}
?>

<div class="menu">
    <?php include_once "menu.php"; ?>
</div>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Arquivo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            text-align: center;
        }

        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
            background-color: #f9f9f9;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .file-info {
            text-align: center;
            margin-top: 20px;
        }

        .file-info p {
            margin: 10px;
            padding: 40px;
        }

        .btn-delete {
            background-color: #dc3545;
            color: #fff;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Upload de Arquivo</h2>
    <form action="listaFerias.php" method="post" enctype="multipart/form-data">
        <label for="file-upload" class="custom-file-upload">
            Selecionar Arquivo
        </label>
        <input id="file-upload" type="file" name="planilha" accept=".pdf">
        <br><br>
        <input type="submit" value="Enviar">
    </form>

    <div class="file-info">
        <?php
        $upload_dir = "uploads/";
        $files = scandir($upload_dir);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                echo "<p>$file <a href=\"?delete=$file\" class=\"btn-delete\">Excluir Arquivo</a></p>";
            }
        }
        ?>
    </div>
</div>

</body>
</html>
