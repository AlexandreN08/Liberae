<?php
require_once("conexao.php");

if (isset($_GET['idAutorizacao'])) {
    $idAutorizacao = $_GET['idAutorizacao'];

    $confirmarSaidaQuery = "UPDATE Autorizacoes SET SaidaConfirmada = TRUE WHERE IDAutorizacao = $idAutorizacao";
    $resultado = mysqli_query($conexao, $confirmarSaidaQuery);

    if ($resultado) {
        
        echo "Saída confirmada com sucesso!";
    } else {
        
        echo "Erro ao confirmar saída: " . mysqli_error($conexao);
    }
} else {
    
    echo "Parâmetro 'idAutorizacao' não fornecido.";
}
?>
