<?php
include("../../templates/header.php");
include("../../bd.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : "";
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : "";
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : "";
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : "";

    // Imagen
    $imagen = $_FILES['imagen']['name'] ?? "";
    $rutaImagen = "";

    if ($imagen != "") {
        $nombreArchivo = time() . "_" . $imagen;
        $rutaDestino = __DIR__ . "/../../../uploads/eventos/" . $nombreArchivo;

        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaDestino)) {
            $rutaImagen = "uploads/eventos/" . $nombreArchivo;
        }
    }

    try {
        if ($rutaImagen != "") {
            // Actualiza también la imagen
            $stmt = $pdo->prepare("UPDATE eventos 
                                   SET titulo = :titulo, 
                                       fecha = :fecha, 
                                       descripcion = :descripcion, 
                                       imagen = :imagen 
                                   WHERE id = :id");
            $stmt->bindParam(':imagen', $rutaImagen);
        } else {
            // Mantiene la imagen existente
            $stmt = $pdo->prepare("UPDATE eventos 
                                   SET titulo = :titulo, 
                                       fecha = :fecha, 
                                       descripcion = :descripcion 
                                   WHERE id = :id");
        }

        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        echo "Error al actualizar: " . $e->getMessage();
    }
}

// --- Cargar datos actuales ---
$id = isset($_GET['txtID']) ? $_GET['txtID'] : '';
$titulo = $fecha = $descripcion = $imagen = "";

if ($id) {
    $select = $pdo->prepare("SELECT * FROM eventos WHERE id = :id");
    $select->bindParam(':id', $id);
    $select->execute();
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $titulo = $row['titulo'];
        $fecha = $row['fecha'];
        $descripcion = $row['descripcion'];
        $imagen = $row['imagen'];
    }
}
?>

<!doctype html>
<html lang="es">
<head>
    <title>Editar Evento</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <main class="container mt-4">
        <div class="card">
            <div class="card-header">Editar Evento</div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

                    <div class="mb-3">
                        <label class="form-label">Título:</label>
                        <input type="text" class="form-control" name="titulo"
                               value="<?php echo htmlspecialchars($titulo); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha:</label>
                        <input type="date" class="form-control" name="fecha"
                               value="<?php echo htmlspecialchars($fecha); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción:</label>
                        <textarea class="form-control" name="descripcion" rows="4" required><?php echo htmlspecialchars($descripcion); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Imagen actual:</label><br>
                        <?php if ($imagen): ?>
                            <img src="/restaurant/<?php echo $imagen; ?>" width="150" class="img-thumbnail mb-2">
                        <?php else: ?>
                            <p class="text-muted">Sin imagen</p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Cambiar Imagen:</label>
                        <input type="file" class="form-control" name="imagen" accept="image/*">
                    </div>

                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    <a class="btn btn-primary" href="index.php">Cancelar</a>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <?php include("../../templates/footer.php"); ?>
    </footer>
</body>
</html>
