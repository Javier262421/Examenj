<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cine";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Could not connect. " . $e->getMessage());
}

try {
  $sql = "INSERT INTO peliculas (titulo, director, genero,anio,duracion) VALUES (:p_titulo, :p_director, :p_genero, :p_anio, :p_duracion)";
  // Prepare the SQL query template
  $stmt = $conn->prepare($sql);
  // Bind parameters
  $stmt->bindParam(':p_titulo', $titulo, PDO::PARAM_STR);
  $stmt->bindParam(':p_director', $director, PDO::PARAM_STR);
  $stmt->bindParam(':p_genero', $genero, PDO::PARAM_STR);
  $stmt->bindParam(':p_anio', $anio, PDO::PARAM_STR);
  $stmt->bindParam(':p_duracion', $duracion, PDO::PARAM_STR);
  // Execute with values
  $titulo = $_POST["titulo"];
  $director = $_POST["director"];
  $genero = $_POST["genero"];
  $anio = $_POST["anio"];
  $duracion = $_POST["duracion"];
  $stmt->execute();


  echo "New records created successfully";
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}
header("Location: listado-registrospeli.php");
exit();

$stmt = null;
$conn = null;
