<?php
session_start();
require_once("conexao.php");

$nomeUsuarioAutorizador = $_SESSION["nomeUsuario"];

// Verifica se o formulário foi submetido
if (isset($_POST['btn_cadastrar'])) {
    
    // Coleta e sanitiza os dados do formulário
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $matricula = mysqli_real_escape_string($conexao, $_POST['matricula']);
    $funcao = mysqli_real_escape_string($conexao, $_POST['funcao']);
    $dias = mysqli_real_escape_string($conexao, $_POST['dias']);
    $setor = mysqli_real_escape_string($conexao, $_POST['setor']);
    $dia_inicio = mysqli_real_escape_string($conexao, $_POST['dia_inicio']);
    $dia_fim = mysqli_real_escape_string($conexao, $_POST['dia_fim']);

    // Prepara e executa a instrução SQL de inserção
    $sql = "INSERT INTO funcionarios_ferias (nome, matricula, funcao, dias, setor, dia_inicio, dia_fim)
            VALUES ('$nome', '$matricula', '$funcao', $dias, '$setor', '$dia_inicio', '$dia_fim')";

    // Executa a consulta SQL
    if ($conexao->query($sql) === TRUE) {
        header("Location: addFerias.php");
    } else {
        echo "Erro ao inserir dados: " . $conexao->error;
    }

    // Fecha a conexão com o banco de dados
    $conexao->close();
} else {
    // Redireciona se o formulário não foi submetido
    header("Location: index.php");
    exit();
}
?>
