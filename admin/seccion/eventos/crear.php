<?php


include("../../bd.php");
include("../../templates/header.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST["titulo"];
    $fecha = $_POST["fecha"];
    $descripcion = $_POST["descripcion"];


    $carpetaServidor = __DIR__ . "/../../../uploads/eventos/";

    $carpetaWeb = "uploads/eventos/";


    if (!file_exists($carpetaServidor)) {
        mkdir($carpetaServidor, 0777, true);
    }


    $nombreImagen = time() . "_" . basename($_FILES["imagen"]["name"]);
    $rutaDestinoServidor = $carpetaServidor . $nombreImagen;
    $rutaDestinoWeb = $carpetaWeb . $nombreImagen;



    echo "<pre>";
    print_r($_FILES["imagen"]);
    echo "</pre>";

    echo "Ruta destino: $rutaDestinoServidor<br>";
    echo "Existe carpeta: " . (file_exists($carpetaServidor) ? "Sí" : "No") . "<br>";


    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaDestinoServidor)) {
        $sentencia = $pdo->prepare("INSERT INTO eventos (titulo, fecha, descripcion, imagen) 
                                    VALUES (:titulo, :fecha, :descripcion, :imagen)");

        $sentencia->bindParam(":titulo", $titulo);
        $sentencia->bindParam(":fecha", $fecha);
        $sentencia->bindParam(":descripcion", $descripcion);
        $sentencia->bindParam(":imagen", $rutaDestinoWeb);
        $sentencia->execute();

        header("Location:index.php");
        exit;
    } else {
        echo "Error al subir la imagen.";
    }
}
?>



<!doctype html>
<html lang="en">

<head>
    <title>Crear</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
</head>

<body>
    <main>
        <div class="card">
            <div class="card-header">Banners</div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título:</label>
                        <input type="text" class="form-control" name="titulo" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha:</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea class="form-control" name="descripcion" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen:</label>
                        <input type="file" class="form-control" name="imagen" accept="image/*" required>
                    </div>

                    <button type="submit" class="btn btn-success">Crear evento</button>
                    <a class="btn btn-primary" href="index.php">Cancelar</a>
                </form>


            </div>
            <div class="card-footer text-muted"></div>
        </div>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>