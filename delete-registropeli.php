<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cine";

try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "DELETE FROM peliculas WHERE id=:id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(":id", $_GET["id"]);

    $stmt->execute();

    header("Location: listado-registrospeli.php");
    exit();

} catch(PDOException $e){

    echo $e->getMessage();

}