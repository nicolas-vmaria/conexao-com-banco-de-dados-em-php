<?php
    session_start();
    if(!isset($_SESSION["logado"])){
        header("Location: ../templates/cadastro.html");
        exit;
    }
    require_once "verifSessao.php";
    require_once("conexao.php");

    $busca = $_GET["busca"] ?? "";

    try{
        if($busca !== ""){
            $sql = "SELECT * FROM tb_usuario 
                    WHERE nm_usuario LIKE :busca 
                    OR nm_login LIKE :busca 
                    OR ds_email LIKE :busca";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([":busca" => "%$busca%"]);
        } else {
            $sql = "SELECT * FROM tb_usuario";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }

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
    <link rel="stylesheet" href="../css/home.css">
</head>
<body>

    <h1>Bem-vindo, <?= htmlspecialchars($_SESSION["usuario"]) ?>!</h1>

    <form method="GET" action="">
        <input
            type="text"
            name="busca"
            placeholder="Busque por usuários"
            value="<?= htmlspecialchars($busca) ?>"
        >
        <button type="submit">Buscar</button>
    </form>

    <?php if($busca !== ""): ?>
        <p>Resultados para: <strong><?= htmlspecialchars($busca) ?></strong></p>
    <?php endif; ?>

    <div class="grid">
        <?php if(empty($usuarios)): ?>
            <p>Nenhum usuário encontrado.</p>
        <?php else: ?>
            <?php foreach ($usuarios as $u): ?>
                <div class="card">
                    <strong><?= htmlspecialchars($u["nm_usuario"]) ?></strong>
                    <p>Login: <?= htmlspecialchars($u["nm_login"]) ?></p>
                    <p>Email: <?= htmlspecialchars($u["ds_email"]) ?></p>
                    <a href="../php/editar.php?id=<?=$u["id"] ?>">Editar</a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <a href="../php/sair.php" class="btnExit">Sair</a>

</body>
</html>