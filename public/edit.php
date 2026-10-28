<?php

require_once __DIR__ . "/../config/db.php";

$error = "";
$id = (int)($_GET['id'] ?? 0);
if ($id <= 0) {
    die("ID Invalido");
}

$consulta = "SELECT id,nombre,email FROM  alumnos WHERE id = :id";
$stmt = $pdo->prepare($consulta);
$stmt->execute(array(":id" => $id));
$alumno = $stmt->fetch();

if (!$alumno) {
    die("Registro no encontrado");
}
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $nombre = trim($_POST["nombre"] ?? "");
    $email = trim($_POST["email"] ?? "");

    if ($nombre === "" || $email === "") {
        $error = "Todos los Campos son obligatorios";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "El email no es valido";
    }
    try {
        $sql = " UPDATE alumnos SET nombre = :nombre, email = :email WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ":nombre" => $nombre,
            ":email" => $email,
            ":id" => $id
        ]);
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        $error = "Error al actualizar" . $e->getMessage();
    }
} else {
    //cargar los datos del alumno
    $nombre = $alumno["nombre"];
    $email = $alumno["email"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>

<body>
    <h1>Editar</h1>
    <a href="index.php">Incio</a>
    <?php if ($error) : ?>
        <p><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post">
        <label for="">Nombre</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>" required>
        <br>
        <label for="">Correo</label>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
        <button type="submit">Actualizar</button>
    </form>
</body>

</html>