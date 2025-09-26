<?php
require_once("conexao.php");
session_start();

// Recupera o nome do usuário e o nome completo da sessão
$nomeUsuarioAutorizador = $_SESSION["nomeUsuario"];
$nomeCompletoAutorizador = $_SESSION["nomeCompleto"];

if (isset($_POST['btn_cadastrar'])) {
    $nomeColaborador = mysqli_escape_string($conexao, $_POST['nomeColaborador']);
    $setor = mysqli_escape_string($conexao, $_POST['setor']);
    $numeroMatricula = mysqli_escape_string($conexao, $_POST['numeroMatricula']);
    $dataHoraSaida = mysqli_escape_string($conexao, $_POST['dataHoraSaida']);

    // Converte a data e hora para o formato aceito pelo MySQL
    $dataHoraSaidaFormatada = date('Y-m-d H:i:s', strtotime($dataHoraSaida));

    $motivoSaida = mysqli_escape_string($conexao, $_POST['motivoSaida']);

    $inserirAutorizacao = "INSERT INTO Autorizacoes (NomeColaborador, Setor, NumeroMatricula, DataHoraSaida, MotivoSaida, NomeAutorizador, nome_completo)
    VALUES ('$nomeColaborador', '$setor', '$numeroMatricula', '$dataHoraSaidaFormatada', '$motivoSaida', '$nomeUsuarioAutorizador', '$nomeCompletoAutorizador')";

    if (mysqli_query($conexao, $inserirAutorizacao)) {
        // Mensagem de sucesso em JavaScript
        echo "<script>
                alert('Autorização cadastrada com sucesso!');
                window.location.href = 'autorizacao.php';
              </script>";
    } else {
        // Mensagem de erro em JavaScript
        echo "<script>
                alert('Erro ao cadastrar autorização: " . mysqli_error($conexao) . "');
                window.history.back();
              </script>";
    }

    // Fecha a conexão
    mysqli_close($conexao);
}
?>
