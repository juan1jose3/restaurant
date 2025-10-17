<?php
session_start();
include("../../bd.php");


if (!isset($_SESSION["queueInventario"])) {
    $_SESSION["queueInventario"] = [];
}

$queueInventario = $_SESSION["queueInventario"];


if (isset($_POST["registrar"])) {
    $nuevoItem = [
        "nombreProducto" => $_POST["nombreProducto"],
        "cantidad" => $_POST["cantidad"],
        "proveedor" => $_POST["proveedor"]
    ];


    array_push($queueInventario, $nuevoItem);

    $_SESSION["queueInventario"] = $queueInventario;
}


if (isset($_POST["aceptar"])) {
    if (!empty($queueInventario)) {

        $itemProcesado = array_shift($queueInventario);


        $sentencia = $pdo->prepare("INSERT INTO inventario (nombreProducto, cantidad, proveedor) VALUES (?, ?, ?)");
        $sentencia->execute([
            $itemProcesado["nombreProducto"],
            $itemProcesado["cantidad"],
            $itemProcesado["proveedor"]
        ]);


        $_SESSION["queueInventario"] = $queueInventario;
    }
}

//unset($_SESSION["queueInventario"]);

?>


<!doctype html>
<html lang="en">

<head>
    <title>AdminInventario</title>
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
    <header>
        <?php include("../../templates/header.php"); ?>
    </header>

    <main>

        <div class="container">
            <div
                class="row justify-content-center align-items-center g-2">
                <div class="col-md-6">
                    <br>
                    <div class="card text-center">
                        <div class="card-header">Agregar a inventario</div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-4 col-form-label">Nombre Producto</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" placeholder="Ingrese el nombre del producto" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputPass" class="col-4 col-form-label">Cantidad</label>
                                    <div class="col-8">
                                        <input type="number" class="form-control" id="cantidad" name="cantidad" placeholder="0" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="inputPass" class="col-4 col-form-label">Proveedor</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control" id="proveedor" name="proveedor" placeholder="Ingrese el proveedor" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="offset-sm-4 col-sm-8">
                                        <button type="submit" class="form-control btn btn-primary" name="registrar">Registrar</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <br>

        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h1>Cola de inventario</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive-sm">
                        <table class="table">
                            <thead>
                                <th>Nombre Producto</th>
                                <th>Cantidad</th>
                                <th>Proveedor</th>
                            </thead>
                            <?php foreach ($_SESSION["queueInventario"] as $item): ?>
                                <tbody>

                                    <td><?php echo $item["nombreProducto"] ?></td>
                                    <td><?php echo $item["cantidad"] ?></td>
                                    <td><?php echo $item["proveedor"] ?></td>
                                    


                                </tbody>
                            <?php endforeach ?>
                        </table>
                    </div>
                    <form action="" method="POST">
                        <button type="submit" class="form-control btn btn-primary" name="aceptar">Aceptar y registrar</button>
                    </form>

                </div>

            </div>
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