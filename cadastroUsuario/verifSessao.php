<?php

$tempoLimite = 10;

if (!isset($_SESSION['logado'])) {
    header('Location: login.html');
    exit;
}

if(isset($_SESSION["ultimoAcesso"])){
    $tempoInativo = time() - $_SESSION["ultimoAcesso"];

    if($tempoInativo > $tempoLimite){
        session_unset();
        session_destroy();
        header("Location: login.html?motivo=timeout");
        exit;
    }
}

$_SESSION["ultimoAcesso"] = time();

?>