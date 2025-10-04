<?php
include("../../bd.php");

$query = $pdo->prepare("SELECT * FROM testimonios;");
$query->execute();
$reviewStack = array_reverse($query->fetchAll(PDO::FETCH_ASSOC));

if (isset($_POST["peek"])) {
    $ultimo = $reviewStack[0];
}

if(isset($_POST["size"])){
    $stackSize = count($reviewStack);
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
    <title>Notifications</title>
</head>

<body>
    <header>
        <?php include("../../templates/header.php"); ?>
    </header>

    <main>
        <section class="container">
            <div class="card">
                <div class="card-header">
                    <h1>Pila de Notificaciónes</h1>
                </div>

                <div class="card-body">
                    <?php if (isset($ultimo)): ?>
                        <div class="alert alert-primary">
                            <?= $ultimo['opinion'] ?> - <?= $ultimo['nombre'] ?> (<?= $ultimo['fecha_insercion'] ?>)
                        </div>
                   <?php elseif(isset($stackSize)): ?>
                        <div class="alert alert-primary">
                            <?php echo "Tamaño Pila: ".$stackSize ?>
                        </div>
                    <?php endif; ?>

                    <div class="table-responsive-sm">
                        <table class="table">
                            <thead>
                                <th>Id</th>
                                <th>Opinion</th>
                                <th>Nombre</th>
                                <th>Fecha de la reseña</th>

                            </thead>
                            <?php foreach ($reviewStack as $stack): ?>

                                <tbody>
                                    <td><?php echo $stack["id"] ?></td>
                                    <td><?php echo $stack["opinion"] ?></td>
                                    <td><?php echo $stack["nombre"] ?></td>
                                    <td><?php echo $stack["fecha_insercion"] ?></td>



                                </tbody>
                            <?php endforeach ?>
                        </table>
                    </div>
                    <form action="" method="POST">
                        <button type="submit" name="size" class="btn btn-success">Cantidad de elementos <i class="bi bi-list-ol"></i></button>
                        <button type="submit" name="peek" class="btn btn-primary">Peek<i class="bi bi-building-check"></i></button>

                    </form>

                </div>


            </div>

        </section>
    </main>
</body>

</html>