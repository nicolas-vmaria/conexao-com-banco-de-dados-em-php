<?php
    session_start();
    if(!isset ($_SESSION["logado"]) ){
        header("Location: cadastro.html");
    }

    require_once("conexao.php");

    $sql = "SELECT * FROM tb_usuario";

            $stmt = $pdo->prepare($sql);

            $stmt->execute();

            $login = $stmt->fetch(PDO::FETCH_ASSOC);
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?= $_SESSION["logado"];?></h1>
    <h1><?= $_SESSION["usuario"];?></h1>
    <h1><?= $_SESSION["email"];?></h1>

    <a href="sair.php">Sair</a>
</body>
</html>