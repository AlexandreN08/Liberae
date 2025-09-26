<?php
require_once("conexao.php");
session_start();

$nomeUsuarioAutorizador = $_SESSION["nomeUsuario"];

if (isset($_POST['btn_cadastrar'])) {
    $nomeColaborador = mysqli_escape_string($conexao, $_POST['nomeColaborador']);
    $setor = mysqli_escape_string($conexao, $_POST['setor']);
    $numeroMatricula = mysqli_escape_string($conexao, $_POST['numeroMatricula']);
    $dataHoraRetorno = mysqli_escape_string($conexao, $_POST['dataHoraRetorno']);
    $dataHoraRetornoFormatada = date('Y-m-d H:i:s', strtotime($dataHoraRetorno));
    

    $inserirRetorno = "INSERT INTO retorno (nomeColaborador, setor, numeroMatricula, dataHoraRetorno)
    VALUES ('$nomeColaborador', '$setor', '$numeroMatricula', '$dataHoraRetornoFormatada')";

    if (mysqli_query($conexao, $inserirRetorno)) {
    // Mensagem de sucesso em JavaScript
    echo "<script>
    alert('Retorno enviado com sucesso!');
    window.location.href = 'retorno.php';
  </script>";
} else {
// Mensagem de erro em JavaScript
echo "<script>
    alert('Erro ao cadastrar retorno: " . mysqli_error($conexao) . "');
    window.history.back();
  </script>";
}
    mysqli_close($conexao);
}
?>
