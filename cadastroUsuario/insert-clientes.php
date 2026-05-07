<?php

session_start();

require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    try {

        // Capturando e limpando dados do formulário
        $usuario  = trim($_POST["nm_usuario"] ?? "");
        $login    = trim($_POST["nm_login"] ?? "");
        $email    = trim($_POST["ds_email"] ?? "");
        $password = trim($_POST["ds_password"] ?? "");

        // Validação simples
        if ($usuario == "") {
            die("O nome de usuário é obrigatório.");
        }
        if ($login == "") {
            die("O nome de login é obrigatório.");
        }
        if ($email == "") {
            die("O email é obrigatório.");
        }
        if ($password == "") {
            die("A senha é obrigatória.");
        }

        // Hash da senha (boa prática)
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO tb_usuario
                (nm_usuario, nm_login, ds_email, ds_password)
                VALUES
                (:usuario, :login, :email, :password)";

        $stmt = $pdo->prepare($sql);

        // Bind dos parâmetros
        $stmt->bindParam(":usuario",  $usuario);
        $stmt->bindParam(":login",    $login);
        $stmt->bindParam(":email",    $email);
        $stmt->bindParam(":password", $passwordHash);

        // Executa
        $stmt->execute();

        
         $_SESSION["usuario"]=$usuario;
         $_SESSION["logado"]=$login;
         $_SESSION["email"]=$email;


        header("Location: home.php");
        exit;

    } catch (PDOException $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
    }

} else {
    echo "Erro no envio do formulário.";
}
?>