<?php
    session_start();
    if(!isset ($_SESSION["logado"]) ){
        header("Location: cadastro.html");
        exit;
    }

    require_once("conexao.php");

    try{
        $sql="update tb_usuario set nm_usuario=:nm_usuario, nm_login=:nm_login, ds_email=:ds_email where id=:id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":nm_usuario",$_POST["nm_usuario"]);
        $stmt->bindParam(":nm_login",$_POST["nm_login"]);
        $stmt->bindParam(":ds_email",$_POST["ds_email"]);
        $stmt->bindParam(":id",$_POST["id"]);
        $stmt->execute();

        header("Location: home.php");
        exit;
    } catch(PDOException $e) {
        echo "Erro ao atualizar usuário: " . $e->getMessage();
    }

?>