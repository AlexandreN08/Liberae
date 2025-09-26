<?php
// Verifica se o ID do funcionário a ser removido foi enviado via POST
if(isset($_POST['id'])) {
    require_once("conexao.php");

    // ID do funcionário a ser removido
    $id = $_POST['id'];

    // Prepara a instrução SQL para remover o funcionário com o ID especificado
    $sql = "DELETE FROM funcionarios_ferias WHERE id = $id";

    // Executa a instrução SQL
    if(mysqli_query($conexao, $sql)) {
        // Redireciona de volta para a página principal após a remoção bem-sucedida
        header("Location: addFerias.php");
        exit();
    } else {
        // Se houver um erro na execução da instrução SQL, exibe uma mensagem de erro
        echo "Erro ao remover o funcionário: " . mysqli_error($conexao);
    }

    mysqli_close($conexao);
} else {
    // Se o ID do funcionário não foi enviado via POST, redireciona de volta para a página principal
    header("Location: tela_inicial.php");
    exit();
}
?>
