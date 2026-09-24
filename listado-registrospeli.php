<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cine";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM peliculas ORDER BY id ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <title>Cartelera de peliculas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        h1{
            text-align:center;
            color:green;
            margin-top:30px;
            margin-bottom:30px;
        }

        table{
            width:80%;
            margin:auto;
        }
.btn-agregar {
    display: inline-block;
    padding: 10px 15px;
    background-color: #198754;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin-bottom: 15px;
}

.btn-agregar:hover {
    background-color: #146c43;
}
    </style>

</head>

<body>

<div class="container">

<h1>Cartelera de Peliculas </h1>
<a href="formulariopeli.html" class="btn-agregar">
    Agregar película
</a>

<?php if(count($clientes)>0){ ?>

<table class="table table-bordered table-hover">

    <thead class="table-dark">

        <tr>

            <th>ID</th>
            <th>Titulo de pelicula</th>
            <th>Director de pelicula</th>
            <th>Genero de Pelicula</th>
            <th>Año de pelicula</th>
            <th>Duracion de pelicula</th>
            <th>Editar</th>
            <th>Borrar</th>

        </tr>

    </thead>

    <tbody>

<?php foreach($clientes as $row){ ?>

<tr>

    <td><?php echo $row["id"]; ?></td>

    <td><?php echo $row["titulo"]; ?></td>

    <td><?php echo $row["director"]; ?></td>

    <td><?php echo $row["genero"]; ?></td>

    <td><?php echo $row["anio"]; ?></td>

    <td><?php echo $row["duracion"]; ?></td>

    <td>

        <a class="btn btn-primary btn-sm"
           href="actualizarpeli.php?id=<?php echo $row["id"]; ?>">
            Editar
        </a>

    </td>

    <td>

        <button
            class="btn btn-danger btn-sm"
            data-bs-toggle="modal"
            data-bs-target="#modalEliminar"
            data-id="<?php echo $row["id"]; ?>">
            Borrar
        </button>

    </td>

</tr>

<?php } ?>

    </tbody>

</table>

<?php
}
else
{
    echo "<div class='alert alert-warning'>No existen registros.</div>";
}
?>

</div>

<!-- Modal -->

<div class="modal fade" id="modalEliminar" tabindex="-1">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header bg-danger text-white">

<h5 class="modal-title">

Confirmar eliminación

</h5>

<button
type="button"
class="btn-close btn-close-white"
data-bs-dismiss="modal">
</button>

</div>

<div class="modal-body">

¿Está seguro de que desea eliminar esta pelicula?

</div>

<div class="modal-footer">

<button
type="button"
class="btn btn-secondary"
data-bs-dismiss="modal">

Cancelar

</button>

<a href="" id="btnEliminar" class="btn btn-danger">

Eliminar

</a>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

const modalEliminar = document.getElementById('modalEliminar');

modalEliminar.addEventListener('show.bs.modal', function(event){

    var boton = event.relatedTarget;

    var id = boton.getAttribute('data-id');

    document.getElementById("btnEliminar").href = "delete-registropeli.php?id=" + id;

});

</script>

</body>

</html>