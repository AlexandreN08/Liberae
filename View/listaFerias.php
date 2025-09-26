<?php
// Verifica se um arquivo foi enviado
if(isset($_FILES['planilha'])){
    $file_name = $_FILES['planilha']['name'];
    $file_tmp = $_FILES['planilha']['tmp_name'];

    // Verifica a extensão do arquivo (permitindo apenas  .pdf)
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_extensions = array("pdf");

    if(!in_array($file_ext, $allowed_extensions)){
        echo "<script>alert('Extensão de arquivo não permitida, por favor, escolha um arquivo PDF.');</script>";
        echo "<script>window.location.href = 'addFerias.php';</script>";
        exit();
    }

    
    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true); // Cria o diretório se ele não existir
    }
    if (!is_writable($upload_dir)) {
        echo "<script>alert('O diretório de upload não tem permissões de escrita.');</script>";
        exit();
    }

    // Move o arquivo para o diretório desejado
    if(move_uploaded_file($file_tmp, $upload_dir.$file_name)){
        // Arquivo movido com sucesso, exibe mensagem de sucesso
        echo "<script>alert('Arquivo enviado com sucesso.');</script>";

        echo "<script>window.location.href = 'addFerias.php';</script>";
    } else {
        // Falha ao mover o arquivo, exibe mensagem de erro
        echo "<script>alert('Ocorreu um erro ao enviar o arquivo.');</script>";

        echo "<script>window.location.href = 'addFerias.php';</script>";
    }
} else {
    // Nenhum arquivo enviado
    echo "<script>alert('Nenhum arquivo enviado.');</script>";

    echo "<script>window.location.href = 'addFerias.php';</script>";
}
?>
