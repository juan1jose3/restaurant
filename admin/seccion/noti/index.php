<?php
include("../../bd.php");
session_start();

if (isset($_POST["reset_stack"])) {
    unset($_SESSION['reviewStack']);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

if (!isset($_SESSION['reviewStack'])) {
    $query = $pdo->prepare("SELECT * FROM testimonios;");
    $query->execute();
    $_SESSION['reviewStack'] = array_values($query->fetchAll(PDO::FETCH_ASSOC));
}

$reviewStack =& $_SESSION['reviewStack'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['peek'])) {
        if (count($reviewStack) > 0) {
            $ultimo = $reviewStack[count($reviewStack) - 1];
        }
    }
    if (isset($_POST['size'])) {
        $stackSize = count($reviewStack);
    }
    if (isset($_POST['mark_read'])) {
        if (count($reviewStack) > 0) {
            array_pop($reviewStack);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Pila de Notificaciones</title>
</head>
<body>
<header>
    <?php include("../../templates/header.php"); ?>
</header>
<main>
    <section class="container">
        <div class="card mt-3">
            <div class="card-header">
                <h1>Pila de Notificaciónes</h1>
            </div>
            <div class="card-body">
                <?php if (isset($ultimo)): ?>
                    <div class="alert alert-primary">
                        <?= htmlspecialchars($ultimo['opinion']) ?> - <?= htmlspecialchars($ultimo['nombre']) ?> (<?= htmlspecialchars($ultimo['fecha_insercion']) ?>)
                    </div>
                <?php elseif(isset($stackSize)): ?>
                    <div class="alert alert-primary">
                        <?php echo "Tamaño Pila: ".intval($stackSize) ?>
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
                        <?php foreach (array_reverse($reviewStack) as $stack): ?>
                            <tbody>
                                <td><?= htmlspecialchars($stack["id"]) ?></td>
                                <td><?= htmlspecialchars($stack["opinion"]) ?></td>
                                <td><?= htmlspecialchars($stack["nombre"]) ?></td>
                                <td><?= htmlspecialchars($stack["fecha_insercion"]) ?></td>
                            </tbody>
                        <?php endforeach ?>
                    </table>
                </div>

                <form action="" method="POST">
                    <button type="submit" name="size" class="btn btn-success">Cantidad de elementos</button>
                    <button type="submit" name="peek" class="btn btn-primary">Peek</button>
                    <button type="submit" name="mark_read" class="btn btn-warning">Marcar como leído</button>
                    <button type="submit" name="reset_stack" class="btn btn-secondary">Refrescar pila</button>
                </form>
            </div>
        </div>
    </section>
</main>
</body>
</html>
