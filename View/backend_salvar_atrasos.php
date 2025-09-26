<?php

if (isset($_POST['btn_cadastrar'])) {
    require_once("conexao.php");

    // Preparar os dados para inserção no banco de dados
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $matricula = mysqli_real_escape_string($conexao, $_POST['matricula']);
    $setor = mysqli_real_escape_string($conexao, $_POST['setor']);
    $motivo = mysqli_real_escape_string($conexao, $_POST['motivo']);
    $data_hora_chegada = mysqli_real_escape_string($conexao, $_POST['data_hora_chegada']);

    $sql = "INSERT INTO funcionarios_atrasados (nome, matricula,setor, motivo, data_hora_chegada) VALUES ('$nome', '$matricula', '$setor', '$motivo', '$data_hora_chegada')";

    if (mysqli_query($conexao, $sql)) {
           // Mensagem de sucesso em JavaScript
    echo "<script>
    alert('Cadastro realizado com sucesso!');
    window.location.href = 'atrasos.php';
  </script>";
} else {
// Mensagem de erro em JavaScript
echo "<script>
    alert('Erro ao cadastrar o atraso: " . mysqli_error($conexao) . "');
    window.history.back();
  </script>";
}
  
    mysqli_close($conexao);
}
?>
