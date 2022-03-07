<?php


try {
    $pdo = new PDO("mysql:dbname=loja;host=localhost","root", "");

} catch (PDOException $th) {
    echo "Erro com o banco de dados: " . $th;
}
catch (Exception $th) {
    echo "Erro com o banco de dados: " . $th;
}
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);