<?php
    require_once('conexao.php');

    if ($_SERVER["REQUEST_METHOD"]== "POST"){
        try{
            $login= trim($_POST["nm_login"] ?? "");
            
            $password= trim($_POST["ds_password"] ?? "");

            $sql = "SELECT * FROM tb_usuario WHERE 
            nm_login=:login
            ";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(":login",$login);

            $stmt->execute();

            $login = $stmt->fetch(PDO::FETCH_ASSOC);

            if($login && password_verify($password,$login["ds_password"])){
                session_start();
                $_SESSION["logado"]= $login["nm_login"];
                $_SESSION["usuario"]= $login["nm_usuario"];
                $_SESSION["email"]= $login["ds_email"];
                

                header("Location: home.php");
            }else{
                echo"Email e senha incorretos";
            }

        }
        catch(PDOException $e){
            echo"Erro ao logar: ". $e->getMessage();
        }
    }
?>