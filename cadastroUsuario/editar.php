<?php 
session_start();

if(!isset ($_SESSION["logado"]) ){
    header("Location: cadastro.html");
    exit;
}

require_once("conexao.php");

try{
    $id = $_GET["id"] ?? null;

    $sql = "select * from tb_usuario where id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id",$id);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() == 0){
        echo "Usuario não encontrado";
        exit;
    }

    

}catch(PDOException $e){
    echo "Erro ao buscar usuário: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Editar Usuário</h1>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?= $usuario["id"] ?>">
        <label for="nm_usuario">Nome de Usuário:</label>
        <input type="text" id="nm_usuario" name="nm_usuario" value="<?= htmlspecialchars($usuario["nm_usuario"]) ?>" required><br><br>

        <label for="nm_login">Login:</label>
        <input type="text" id="nm_login" name="nm_login" value="<?= htmlspecialchars($usuario["nm_login"]) ?>" required><br><br>

        <label for="ds_email">Email:</label>
        <input type="email" id="ds_email" name="ds_email" value="<?= htmlspecialchars($usuario["ds_email"]) ?>" required><br><br>

        <button type="submit">Atualizar</button>
</body>
</html>