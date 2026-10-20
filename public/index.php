<?php
require_once __DIR__ . "/../config/db.php";
$consulta = "SELECT * FROM alumnos ORDER BY id DESC";
//Ejecucion
$stmt = $pdo->query($consulta);
$alumnos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title></title>
</head>

<body>
    <h1>CRUD con PDO (ALUMNO)</h1>
    <h2>Listado</h2>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Creado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</body>

</html>