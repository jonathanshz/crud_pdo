<?php
require __DIR__ . "/../config/db.php";

// Tomar el ID
$id = (int) ($_GET["id"] ?? 0);
if($id <= 0){
    die("ID invalido");
}

//Eliminar con una consulta preparada
$query = "DELETE FROM alumnos WHERE id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute([":id"=> $id]);

header("Location: index.php");
?>