<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Arquivo de Planilha</title>
</head>
<body>
    
    <?php
    // Diretório onde o arquivo de planilha está localizado
    $upload_dir = "uploads/";

    // Verifica se o diretório existe
    if (is_dir($upload_dir)) {
        // Abre o diretório
        if ($handle = opendir($upload_dir)) {
            // Variável para verificar se a pasta está vazia
            $empty = true;
            
            // Itera sobre os arquivos no diretório
            while (($file = readdir($handle)) !== false) {
                // Exclui os diretórios pai e atual
                if ($file != "." && $file != "..") {
                    $empty = false;
                    // Define o caminho completo do arquivo
                    $file_path = $upload_dir . $file;
                    // Define o tipo de conteúdo do arquivo
                    $content_type = mime_content_type($file_path);
                    // Verifica se o tipo de conteúdo é PDF
                    if ($content_type === 'application/pdf') {
                        // Exibe o arquivo PDF no navegador usando um iframe
                        echo '<iframe src="' . $file_path . '" style="width:100%; height:920px;"></iframe>';
                        break;
                    }
                }
            }
            
            // Verifica se a pasta está vazia
            if ($empty) {
                echo "<h2>A pasta de uploads está vazia.</h2>";
            }
            
            // Fecha o diretório
            closedir($handle);
        }
    } else {
        echo "<h2>O diretório de uploads não existe.</h2>";
    }
    ?>
</body>
</html>
