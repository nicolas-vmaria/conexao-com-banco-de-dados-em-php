<?php
    session_start(); 

    require_once('conexao.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
            $login = trim($_POST["nm_login"] ?? "");
            $password = trim($_POST["ds_password"] ?? "");
            
            $sql = "SELECT * FROM tb_usuario WHERE nm_login = :login";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":login", $login);
            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC); 

            if($usuario && password_verify($password, $usuario["ds_password"])){
                $_SESSION["logado"] = $usuario["nm_login"];
                $_SESSION["usuario"] = $usuario["nm_usuario"];
                $_SESSION["email"] = $usuario["ds_email"];
                $_SESSION["ultimoAcesso"] = time();

                header("Location: ../php/home.php");
                exit; 
            } else {
                echo "Email e senha incorretos";
            }

        } catch(PDOException $e){
            echo "Erro ao logar: " . $e->getMessage();
        }
    }
?>