<?php

function isAdministrador() {
    // Verifique se o tipo de usuário é administrador
    return isset($_SESSION['idFuncao']) && $_SESSION['idFuncao'] == 1;
}

?>
