<?php
    session_start();
    if(!isset ($_SESSION["logado"]) ){
        header("Location: cadastro.html");
        exit;
    }

    require_once("conexao.php");

    try{
        $sql = "SELECT * FROM tb_usuario";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e){
        echo "Erro ao buscar usuários: " . $e->getMessage();
    }
    
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>

    <h1>Bem-vindo, <?= htmlspecialchars($_SESSION["usuario"]) ?>!</h1>

    <div class="grid">
        <?php foreach ($usuarios as $u): ?>
            <div class="card">
                <strong><?= htmlspecialchars($u["nm_usuario"]) ?></strong>
                <p>Login: <?= htmlspecialchars($u["nm_login"]) ?></p>
                <p>Email: <?= htmlspecialchars($u["ds_email"]) ?></p>
                <a href="./editar.php?id=<?= $u["id"] ?>">Editar</a>
            </div>
        <?php endforeach; ?>
    </div>

    <a href="./sair.php" class="btnExit">Sair</a>

</body>
</html>