<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cine";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!isset($_GET["id"])) {
    die("No se recibió el ID.");
}

$id = $_GET["id"];

$sql = "SELECT * FROM peliculas WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();

$fila = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$fila) {
    die("Registro no encontrado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Registro</title>

    <style>
        body{
            font-family: Arial,sans-serif;
            background:#f4f4f4;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .formulario{
            background:white;
            padding:20px;
            border-radius:8px;
            width:300px;
            box-shadow:0 0 10px rgba(0,0,0,.2);
        }

        input{
            width:100%;
            padding:8px;
            margin-bottom:10px;
        }

        button{
            width:100%;
            padding:10px;
        }
    </style>

</head>
<body>

<div class="formulario">

<h2>Actualizar Registro</h2>

<form action="actualizar-registro-bdpeli.php" method="post">

    <input type="hidden" name="id" value="<?php echo $fila["id"]; ?>">

    <label>Titulo</label>
    <input
        type="text"
        name="titulo"
        value="<?php echo $fila["titulo"]; ?>"
        required>

    <label>Director</label>
    <input
        type="text"
        name="director"
        value="<?php echo $fila["director"]; ?>"
        required>

    <label>Genero</label>
    <input
        type="text"
        name="genero"
        value="<?php echo $fila["genero"]; ?>"
        required>
   <label>Año</label>
    <input
        type="number"
        name="anio"
        value="<?php echo $fila["anio"]; ?>"
        required>

    <label>Duracion</label>
    <input
        type="number"
        name="duracion"
        value="<?php echo $fila["duracion"]; ?>"
        required>
    <button type="submit">Actualizar</button>

</form>

</div>

</body>
</html>