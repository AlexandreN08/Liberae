<?php
session_start();

require_once("conexao.php");


if (isset($_POST['btn_login'])) {
    $nomeUsuario = mysqli_real_escape_string($conexao, $_POST['nomeUsuario']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);


    $sql = "SELECT u.NomeUsuario, u.IDUsuario, u.IDFuncao, u.Setor, u.NumeroMatricula, f.NomeFuncao 
            FROM Usuarios u
            INNER JOIN Funcoes f ON u.IDFuncao = f.IDFuncao
            WHERE u.NomeUsuario = '$nomeUsuario' AND u.Senha = '$senha'";

    $result = mysqli_query($conexao, $sql);


if (mysqli_num_rows($result) <= 0) {
    echo "<script language='javascript' type='text/javascript'>
    alert('Nome de usuário ou senha incorretos!');
    window.location.href = 'index.php';
    </script>";
    die();
} else {
    $row = mysqli_fetch_assoc($result);

    $_SESSION["nomeUsuario"] = $row['NomeUsuario'];
    $_SESSION["idUsuario"] = $row['IDUsuario'];
    $_SESSION["idFuncao"] = $row['IDFuncao'];
    $_SESSION["setor"] = $row['Setor'];
    $_SESSION["numeroMatricula"] = $row['NumeroMatricula'];
    $_SESSION["nomeFuncao"] = $row['NomeFuncao'];


if ($_SESSION['nomeUsuario'] === 'Alexandre Necher') {
    // Redireciona para a página de cadastro
    header("Location: cadastro.php");
    exit();
} else {
    // Redireciona de volta para a URL anterior ou para index.php se não houver uma URL anterior
    $url_anterior = isset($_SESSION['url_anterior']) ? $_SESSION['url_anterior'] : 'tela_inicial.php';
    header("Location: $url_anterior");
    exit();
}


    

}
}

?>


