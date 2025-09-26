<?php
require_once("conexao.php");
session_start();

if (isset($_POST['btn_cadastrar'])) {
    $nome_completo = mysqli_escape_string($conexao, $_POST['nome_completo']); // nome Normal
    $nomeCompleto = mysqli_escape_string($conexao, $_POST['nomeCompleto']);  // nome de Usuario
    $tipoUsuario = mysqli_escape_string($conexao, $_POST['tipoUsuario']);
    $setor = mysqli_escape_string($conexao, $_POST['setor']);
    $numeroMatricula = mysqli_escape_string($conexao, $_POST['numeroMatricula']);
    $senha = mysqli_escape_string($conexao, $_POST['senha']);

    // Verifica se o usuário já existe
    $verificarUsuario = "SELECT IDUsuario FROM Usuarios WHERE NomeUsuario = '$nomeCompleto'";
    $resultado = mysqli_query($conexao, $verificarUsuario);

    if (mysqli_num_rows($resultado) > 0) {
        echo "Esse usuário já existe";
    } else {
        // Insere os dados na tabela de usuários
        $inserirUsuario = "INSERT INTO Usuarios (nome_completo, NomeUsuario, IDFuncao, Setor, NumeroMatricula, Senha)
                           VALUES ('$nome_completo', '$nomeCompleto', (SELECT IDFuncao FROM Funcoes WHERE NomeFuncao = '$tipoUsuario'),
                                   '$setor', '$numeroMatricula', '$senha')";

        if (mysqli_query($conexao, $inserirUsuario)) {
          // Mensagem de sucesso em JavaScript
    echo "<script>
    alert('Cadastro realizado com sucesso!');
    window.location.href = 'cadastro.php';
  </script>";
} else {
// Mensagem de erro em JavaScript
echo "<script>
    alert('Erro ao cadastrar!: " . mysqli_error($conexao) . "');
    window.history.back();
  </script>";
}
    // Fecha a conexão
    mysqli_close($conexao);
}
}
?>
