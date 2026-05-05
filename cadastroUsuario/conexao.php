<?php
$host = "localhost";
$dbname = "aulaphp";
$usuario = "root";
$senha = "";
    /* 
    PDO - É uma camada de acesso a banco de dados que permite conectar qualquer banco de dados com a mesma sintaxe
    */ 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha);
    //Testar se a conexão foi bem-sucedida
    
    //Se der erro no sql, lança uma exceção.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>



