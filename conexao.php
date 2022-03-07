<?php


define("__HOST__", "localhost");
define("__USER__", "root");
define("__PASS__", "");
define("__DATABASE__", "loja");

function getConnection()
{
    try {
        $key = 'strval';
        $con = new PDO("mysql:host={$key(__HOST__)}; dbname={$key(__DATABASE__)}", __USER__, __PASS__)
            or die("Error when trying to connect to the database");
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $con;
    } catch (PDOException $error) { # caso não consiga conectar irá entrar no  bloco do catch
        echo "Error when connect to database. Erro: {$error->getMessage()}";
   
exit;
    }
}

getConnection();

