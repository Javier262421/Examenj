<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cine";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Could not connect. " . $e->getMessage());
}

try {

    $sql = "UPDATE peliculas
            SET titulo = :p_titulo,
                director = :p_director,
                genero = :p_genero,
                anio    = :p_anio,
            duracion   = :p_duracion
            WHERE id = :p_id";

    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':p_titulo', $titulo);
    $stmt->bindParam(':p_director', $director);
    $stmt->bindParam(':p_genero', $genero);
    $stmt->bindParam(':p_anio', $anio);
    $stmt->bindParam(':p_duracion', $duracion);
    $stmt->bindParam(':p_id', $id);

    $titulo = $_POST["titulo"];
    $director = $_POST["director"];
    $genero = $_POST["genero"];
    $anio = $_POST["anio"];
    $duracion = $_POST["duracion"];
    $id = $_POST["id"];

    $stmt->execute();

    echo "Registro actualizado correctamente";

} catch (PDOException $e) {

    echo "Error: " . $e->getMessage();

}
header("Location: listado-registrospeli.php");
exit();
$stmt = null;
$conn = null;
?>