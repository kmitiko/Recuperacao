<?php

require_once('./conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Activity</title>
</head>

<body>
    <h1>Purchases Database</h1>
    <h2>Create</h2>
    <?php




function create($produtos)
{

    $con = getConnection();


    try {

        #Insert something

        $stmt = $con->prepare("INSERT INTO produtos(nome, preco, qtdestoque, nrserie, cod, marca) VALUES (:nome , :preco, :qtdestoque, :nrserie, :cod, :marca)");

        $stmt->bindParam(":nome", $produtos->nome);
        $stmt->bindParam(":preco", $produtos->preco);
        $stmt->bindParam(":qtdestoque", $produtos->qtdestoque);
        $stmt->bindParam(":nrserie", $produtos->nrserie);
        $stmt->bindParam(":cod", $produtos->cod);
        $stmt->bindParam(":marca", $produtos->marca);

        if ($stmt->execute()) {
            echo " Produtos Registered successfully";
        }
    } catch (PDOException $error) {
        echo "Error When Register the Produtos. Error: {$error->getMessage()}";
    } finally {
        unset($con);
        unset($stmt);
    }
}

#create test
$produtos = new stdClass();
$produtos->nome = "Televisão";
$produtos->preco = "R$3.500,00";
$produtos->qtdestoque = 100;
$produtos->nrserie = 10023;
$produtos->cod = 10023541;
$produtos->marca = "Samsung";


create($produtos);
echo "<br><br>---<br><br>";

#create test
$produtos = new stdClass();
$produtos->nome = "Cafeteira";
$produtos->preco = "R$1.470,00";
$produtos->qtdestoque = 50;
$produtos->nrserie = 91023;
$produtos->cod = 9250354;
$produtos->marca = "Nexpresso";


create($produtos);
echo "<br><br>---<br><br>";

?>
<h2>Lista</h2>
    <?php



function get()
{
    try {
        $con = getConnection();
        # Select something

        $rs = $con->query("SELECT nome, preco, qtdestoque, nrserie, cod, marca FROM produtos");

        while ($row = $rs->fetch(PDO::FETCH_OBJ)) {
            echo "Nome: " . $row->nome . " <br> produtos: ";
            echo $row->preco . "<br> preco: ";
            echo $row->qtdestoque . "<br> qtdestoque";
            echo $row->nrserie . "<br> nrserie: ";
            echo $row->cod . "<br> cod";
            echo $row->marca . "<br> marca";


        }
    } catch (PDOException $error) {
        echo "Error When Listing Fruits. Error: {$error->getMessage()}";
    } finally {
        unset($con);
        unset($stmt);
    }
}

#get test
echo "List of Produtos <br><br>---<br><br>";
get();

?>
    <h2>Find</h2>
    <?php
    function find($nome)
    {
        try {
            $con = getConnection();
            # Select something

            $stmt = $con->prepare("SELECT nome, preco, qtdestoque, nrserie, cod, marca FROM produtos WHERE nome  LIKE :nome");
            $stmt->bindValue(":nome", "%{$nome}%");


            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {


                    while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
                        echo "Name: " . $row->nome . " <br> produtos: ";
                        echo $row->preco . "<br> preco: ";
                        echo $row->qtdestoque . "<br> qtdestoque: ";
                        echo $row->nrserie . "<br> nrserie: ";
                        echo $row->cod . "<br> cod: ";
                        echo $row->marca . "<br> marca: ";
                    }
                }
            }
        } catch (PDOException $error) {
            echo "Error When Searching the Produto. Error: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }
    #find test
    echo "Produto(s) Found Successfully<br><br>---<br><br>";
    find("v");

    echo "---<br><br>";
    ?>

    <h2>Update</h2>
    <?php
    function update($produtos)
    {
        $con = getConnection();


        try {

            #Insert something

            $stmt = $con->prepare("SELECT nome, preco, qtdestoque, nrserie, cod, marca WHERE id = :id");

            $stmt->bindParam(":id", $produtos->id);
            $stmt->bindParam(":nome", $produtos->nome);
            $stmt->bindParam(":preco", $produtos->preco);
            $stmt->bindParam(":qtdestoque", $produtos->qtdestoque);
            $stmt->bindParam(":nrserie", $produtos->nrserie);
            $stmt->bindParam(":cod", $produtos->cod);
            $stmt->bindParam(":marca", $produtos->marca);

            if ($stmt->execute()) :
                echo "Produtos Updated Successfully";
            endif;
        } catch (PDOException $error) {
            echo "Error When Update the Produtos. Error: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

    $produtos = new stdClass();
    $produtos->nome = "Notebook";
    $produtos->preco = "R$6.600,00";
    $produtos->qtdestoque = 3;
    $produtos->id = 4;
    update($produtos);
    echo "<br><br>---<br><br>";
    ?>

    <h2>List</h2>
    <?php
    #get test
    echo "List of Produtos(s) <br><br>---<br><br>";
    get();

    ?>

<h2>Delete</h2>
    <?php
    function delete($id)
    {
        $con = getConnection();


        try {

            #Insert something

            $stmt = $con->prepare("DELETE FROM produtos WHERE  id = ?");

            $stmt->bindParam(1, $id);

            if ($stmt->execute()) :
                echo "Produtos Deleted Successfully";
            endif;
        } catch (PDOException $error) {
            echo "Error When Delete the Produtos. Error: {$error->getMessage()}";
        } finally {
            unset($con);
            unset($stmt);
        }
    }

   
    delete(1);

    echo "<br><br>---<br><br>";
    ?>
    <h2>List</h2>
    <?php
    #get test
    echo "List of Fruit(s) <br><br>---<br><br>";
    get();

    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>


