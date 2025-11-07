<?php
include("admin/bd.php");
session_start();
$query = "SELECT * FROM eventos";
$resultado = $pdo->query($query);

$eventos = [];
while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $eventos[] = $row;
}


shuffle($eventos);


$sentencia = $pdo->prepare("SELECT * FROM banner LIMIT 1");
$sentencia->execute();
$listaBanner = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$chef1 = $pdo->prepare("SELECT * FROM chef");
$chef1->execute();
$chefLista1 = $chef1->fetchAll(PDO::FETCH_ASSOC);


$testimonios = $pdo->prepare("SELECT * FROM testimonios");
$testimonios->execute();
$testimoniosList = $testimonios->fetchAll(PDO::FETCH_ASSOC);

$platos = $pdo->prepare("SELECT * FROM menu");
$platos->execute();
$menuLista = $platos->fetchAll(PDO::FETCH_ASSOC);

$reservasStmt = $pdo->prepare("SELECT mesa, estado FROM reservas");
$reservasStmt->execute();
$reservasList = $reservasStmt->fetchAll(PDO::FETCH_ASSOC);


// Reservas
$sentencia = $pdo->prepare("SELECT * FROM reservas WHERE estado = 1");
$sentencia->execute();
$reservasActivas = $sentencia->fetchAll(PDO::FETCH_ASSOC);


$totalMesas = 10;
$columnas = 5;
$filas = ceil($totalMesas / $columnas);
$mesasArray = array_fill(0, $filas, array_fill(0, $columnas, 0));


foreach ($reservasActivas as $reserva) {
    $fila = floor(($reserva['mesa'] - 1) / $columnas);
    $col = ($reserva['mesa'] - 1) % $columnas;
    $mesasArray[$fila][$col] = 1;
}


// arbol

$arbol = [
    "pregunta" => "¿Te sientes con buen ánimo hoy?",
    "si" => [
        "pregunta" => "¿Tienes mucha energía?",
        "si" => [
            "pregunta" => "¿Prefieres algo salado?",
            "si" => ["sugerencia" => "Carne asada con papas y jugo natural"],
            "no" => ["sugerencia" => "Ensalada fresca con frutas y agua de coco"]
        ],
        "no" => [
            "pregunta" => "¿Te gustaría algo ligero?",
            "si" => ["sugerencia" => "Wrap de pollo con jugo natural"],
            "no" => ["sugerencia" => "Pasta al pesto con pan de ajo"]
        ]
    ],
    "no" => [
        "pregunta" => "¿Te sientes estresado?",
        "si" => [
            "pregunta" => "¿Quieres algo dulce?",
            "si" => ["sugerencia" => "Postre de chocolate o tiramisú"],
            "no" => ["sugerencia" => "Sopa de tomate con queso fundido"]
        ],
        "no" => [
            "pregunta" => "¿Tienes hambre pero estás cansado?",
            "si" => ["sugerencia" => "Pasta cremosa con champiñones"],
            "no" => ["sugerencia" => "Sopa caliente de verduras"]
        ]
    ]
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    if (!isset($_SESSION['nodo'])) $_SESSION['nodo'] = $arbol;

    $nodoActual = $_SESSION['nodo'];
    $accion = $_POST['accion'];

    if ($accion === 'reiniciar') {
        $_SESSION['nodo'] = $arbol;
        $nodoActual = $_SESSION['nodo'];
    } elseif ($accion === 'respuesta' && isset($_POST['respuesta'])) {
        $respuesta = $_POST['respuesta'];
        if (isset($nodoActual[$respuesta])) {
            $_SESSION['nodo'] = $nodoActual[$respuesta];
            $nodoActual = $_SESSION['nodo'];
        }
    }

    header('Content-Type: application/json; charset=utf-8');
    if (isset($nodoActual['sugerencia'])) {
        echo json_encode(["sugerencia" => $nodoActual['sugerencia']]);
    } else {
        echo json_encode(["pregunta" => $nodoActual['pregunta']]);
    }
    exit;
}

// grafó

$clientes = [
    ["id" => 1, "nombre" => "María López"],
    ["id" => 2, "nombre" => "Carlos Pérez"],
    ["id" => 3, "nombre" => "Ana Gómez"],
    ["id" => 4, "nombre" => "Antonio"],
    ["id" => 5, "nombre" => "pepe12"],
    ["id" => 6, "nombre" => "Luis34"]
];

$chefs = [
    ["id" => 7, "nombre" => "Gordon Ramsay"],
    ["id" => 8, "nombre" => "Massimo Bottura"],
    ["id" => 9, "nombre" => "Dominique Crenn"]
];


$enlaces = [
    ["from" => 1, "to" => 7],
    ["from" => 1, "to" => 8],
    ["from" => 2, "to" => 7],
    ["from" => 2, "to" => 9],
    ["from" => 3, "to" => 8],
    ["from" => 3, "to" => 9],
    ["from" => 4, "to" => 7],
    ["from" => 4, "to" => 8],
    ["from" => 5, "to" => 9],
    ["from" => 5, "to" => 8],
    ["from" => 6, "to" => 7],
    ["from" => 6, "to" => 9],

    ["from" => 7, "to" => 8],
    ["from" => 8, "to" => 9],
    ["from" => 9, "to" => 7]
];

$datos = [
    "clientes" => $clientes,
    "chefs" => $chefs,
    "enlaces" => $enlaces
];


?>


<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
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
    <link rel="stylesheet" href="styles/main.css">


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark md-auto">
        <div class="container">

            <a class="navbar-brand" href="#">RESTAURANTE <img src="images/re.svg" alt="egg" style="width:40px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-item nav-link active" href="#banner" aria-current="page">Inicio<span class="visually-hidden">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-item nav-link active" href="#evento-destacado" aria-current="page">Eventos<span class="visually-hidden">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#Chef">Chef</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#menu">Menu</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#testimonios">Testimonios</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-item nav-link active" href="#mapa-mesas" aria-current="page">Reservas<span class="visually-hidden">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#contacto">Contacto</a>
                    </li>

                </ul>

            </div>

        </div>



    </nav>

    <section id="banner" class="container-fluid p-0">
        <div class="banner-img" style="position:relative; background:url('images/stake2.jpg') center/cover no-repeat; height: 400px;">
            <div class="banner-text" style="position:absolute; top:50%; left: 50%; transform:translate(-50%, -50%); text-align:center;">
                <?php foreach ($listaBanner as $banner): ?>

                    <h1><?php echo $banner["titulo"]; ?></h1>
                    <p><?php echo $banner["descripcion"] ?></p>
                    <a href="<?php echo $banner["link"] ?>" class="btn btn-primary">Ver menú</a>
                <?php endforeach ?>
            </div>

        </div>

    </section>



    <?php if (!empty($eventos)): ?>
        <?php $evento = $eventos[0]; ?>
        <?php $imgPath = "/restaurant/" . $evento['imagen']; ?>



        <section id="evento-destacado" class="container-fluid p-0 my-5">
            <div class="evento-hero"
                style="position: relative; background: url('<?php echo htmlspecialchars($imgPath); ?>') center/cover no-repeat; height: 500px; border-radius: 20px; overflow:hidden;">


                <div style="position:absolute; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5);"></div>


                <div class="evento-text text-white text-center"
                    style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%); max-width:700px; padding:20px;">
                    <h2 class="fw-bold display-5"><?php echo htmlspecialchars($evento['titulo']); ?></h2>
                    <p class="lead"><?php echo htmlspecialchars($evento['descripcion']); ?></p>
                    <p><strong><?php echo htmlspecialchars($evento['fecha']); ?></strong></p>
                </div>
            </div>
        </section>
    <?php endif; ?>



    <br>

    <section id="Chef" class="ms-4">
        <h2>Nuestros Chefs</h2>
        <br>
        <div class="row row-cols-3 row-cols-md-d g-4">
            <?php foreach ($chefLista1 as $chef): ?>
                <div class="col d-flex justify-content-center">
                    <div class="card h-100">


                        <img src="images/<?php echo $chef["foto"]; ?>" alt="Chef1" style="max-width:500px; border-radius:9px">
                        <div class="card-body">

                            <h5 class="card-title"><?php echo $chef["nombre"]; ?></h5>
                            <p class="card-text small"><strong><?php echo $chef["descripcion"]; ?></strong></p>
                            <div>
                                <?php if (!empty($chef['linkinstagram'])): ?>
                                    <a href="<?php echo htmlspecialchars($chef['linkinstagram']); ?>"
                                        target="_blank" rel="noopener">
                                        <img src="images/instagram.svg" alt="insta" style="width:24px">
                                    </a>
                                <?php endif; ?>

                                <?php if (!empty($chef['linkyoutube'])): ?>
                                    <a href="<?php echo htmlspecialchars($chef['linkyoutube']); ?>"
                                        target="_blank" rel="noopener">
                                        <img src="images/youtube.svg" alt="youtube" style="width:24px">
                                    </a>
                                <?php endif; ?>

                                <?php if (!empty($chef['linkfacebook'])): ?>
                                    <a href="<?php echo htmlspecialchars($chef['linkfacebook']); ?>"
                                        target="_blank" rel="noopener">
                                        <img src="images/facebook.svg" alt="face" style="width:24px">
                                    </a>
                                <?php endif; ?>
                            </div>

                        </div>


                    </div>

                </div>
            <?php endforeach ?>
        </div>


        </div>
        </div>




    </section>


    <script src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
    <link href="https://unpkg.com/vis-network/styles/vis-network.css" rel="stylesheet" />

    <section id="grafo-social" class="py-5">
        <div class="container text-center">
            <h2 class="mb-4" style="color:#00ffe0;">🌐 Grafo Social</h2>
            <p class="text-muted">Relaciones entre clientes y chefs</p>
            <div id="network" style="width:100%; height:600px; background:#1a1a1a; border-radius:12px;"></div>
        </div>
    </section>

    <script>
        const datos = <?php echo json_encode($datos); ?>;

        // Crear nodos
        const nodes = new vis.DataSet([
            ...datos.clientes.map(c => ({
                id: c.id,
                label: c.nombre,
                group: "cliente"
            })),
            ...datos.chefs.map(ch => ({
                id: ch.id,
                label: ch.nombre,
                group: "chef"
            }))
        ]);

        // Crear enlaces
        const edges = new vis.DataSet(datos.enlaces);

        // Configuración visual
        const container = document.getElementById("network");
        const data = {
            nodes,
            edges
        };

        const options = {
            nodes: {
                shape: "dot",
                size: 20,
                font: {
                    color: "#fff",
                    size: 14
                },
                borderWidth: 2
            },
            groups: {
                cliente: {
                    color: {
                        background: "#00ffe0",
                        border: "#00ffe0"
                    }
                },
                chef: {
                    color: {
                        background: "#ff6600",
                        border: "#ff6600"
                    }
                }
            },
            edges: {
                color: {
                    color: "#aaa"
                },
                width: 2,
                smooth: {
                    type: "dynamic"
                }
            },
            layout: {
                improvedLayout: true
            },
            physics: {
                enabled: true,
                barnesHut: {
                    gravitationalConstant: -4000, // mantiene unión sin amontonarse
                    centralGravity: 0.4, // mantiene cohesión
                    springLength: 200, // separa nodos
                    springConstant: 0.05, // suaviza conexiones
                    damping: 0.2
                },
                stabilization: {
                    iterations: 300
                }
            },
            interaction: {
                hover: true,
                dragNodes: true,
                zoomView: true
            }
        };

        new vis.Network(container, data, options);
    </script>





    <section id="testimonios" class="bg-light py-5">
        <div class="container">


            <h2 class="text-center mb-4">Testimonios</h2>

            <div class="row">
                <?php foreach ($testimoniosList as $testimonio): ?>

                    <div class="col-md-6 d-flex">
                        <div class="card mb-4 w-100">
                            <div class="card-body">
                                <p class="card-text"><?php echo $testimonio["opinion"] ?></p>
                            </div>
                            <div class="card-footer text-muted">
                                <?php echo $testimonio["nombre"] ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>

            </div>

        </div>

    </section>

    <section id="menu">
        <div class="container">
            <h2 class="text-center">Recomendados</h2>
            <br>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($menuLista as $menu): ?>
                    <div class="col d-flex justify-content-center">
                        <div class="card h-100">
                            <?php
                            $imgPath = $menu['foto'] ? "/restaurant/" . $menu['foto'] : "/restaurant/uploads/menu/default.jpg";
                            ?>
                            <img src="<?php echo htmlspecialchars($imgPath); ?>"
                                alt="<?php echo htmlspecialchars($menu['nombre']); ?>"
                                class="card-img-top rounded-3">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($menu["nombre"]); ?></h5>
                                <p class="card-text small"><strong>Ingredientes: </strong><?php echo htmlspecialchars($menu["ingredientes"]); ?></p>
                                <p class="card-text"><strong>Precio: </strong><?php echo htmlspecialchars($menu["precio"]); ?><strong>$</strong></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="sugerencias" class="container my-5">
        <h2 class="text-center mb-4">¿No sabes qué comer? Te ayudamos</h2>
        <div id="arbol" class="card p-4 text-center">
            <p id="texto" class="fs-4">¿Te sientes con buen ánimo hoy?</p>
            <div id="botones">
                <button class="btn btn-success mx-2" onclick="responder('si')">Sí</button>
                <button class="btn btn-danger mx-2" onclick="responder('no')">No</button>
            </div>
        </div>
    </section>

    <script>
        function responder(resp) {
            const formData = new URLSearchParams();
            formData.append('accion', 'respuesta');
            formData.append('respuesta', resp);

            fetch(window.location.pathname, {
                    method: 'POST',
                    body: formData
                })
                .then(r => r.json())
                .then(data => actualizarVista(data))
                .catch(() => alert('Error al comunicar con el servidor.'));
        }

        function reiniciar() {
            const formData = new URLSearchParams();
            formData.append('accion', 'reiniciar');

            fetch(window.location.pathname, {
                    method: 'POST',
                    body: formData
                })
                .then(r => r.json())
                .then(data => actualizarVista(data))
                .catch(() => alert('Error al comunicar con el servidor.'));
        }

        function actualizarVista(data) {
            const texto = document.getElementById('texto');
            const botones = document.getElementById('botones');

            if (data.sugerencia) {
                texto.textContent = data.sugerencia;
                botones.innerHTML = `<button class="btn btn-secondary" onclick="reiniciar()">Volver a empezar</button>`;
            } else if (data.pregunta) {
                texto.textContent = data.pregunta;
                botones.innerHTML = `
            <button class="btn btn-success mx-2" onclick="responder('si')">Sí</button>
            <button class="btn btn-danger mx-2" onclick="responder('no')">No</button>
        `;
            }
        }
    </script>




    <section id="Horarios" class="ms-4 mt-4">
        <h2 style="text-align: center;">Horarios de atención</h2>
        <div class="d-flex justify-content-center">
            <div class="card text-white bg-dark mb-3 card text-white bg-dark mb-3 w-50">
                <div class="card-body">
                    <h3 class="card-title" style="text-align: center;">Lunes-viernes</h3>
                    <h4 class="card-text" style="text-align: center;">9:00 -- 17:00</h4>
                    <br>
                    <h3 class="card-title" style="text-align: center;">Sábados</h3>
                    <h4 class="card-text" style="text-align: center;">10:00 -- 13:00</h4>
                    <br>
                    <h3 class="card-title" style="text-align: center;">Domingo y feriados</h3>
                    <h4 class="card-text" style="text-align: center;">CERRADO</h4>

                </div>
            </div>
        </div>

    </section>


    <section id="mapa-mesas" class="container mt-5">
        <h2 class="text-center mb-4">Estado de Mesas</h2>
        <?php for ($f = 0; $f < $filas; $f++): ?>
            <div class="row justify-content-center mb-2">
                <?php for ($c = 0; $c < $columnas; $c++): ?>
                    <?php
                    $numMesa = $f * $columnas + $c + 1;
                    if ($numMesa > $totalMesas) continue;
                    ?>
                    <div class="col-auto">
                        <div class="card text-center"
                            style="width: 100px; height: 100px; 
                                background-color: <?= ($mesasArray[$f][$c]) ? '#dc3545' : '#198754' ?>;
                                color: white; display:flex; align-items:center; justify-content:center;">
                            Mesa <?= $numMesa ?><br>
                            <?= ($mesasArray[$f][$c]) ? 'Ocupada' : 'Libre' ?>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        <?php endfor; ?>
    </section>



    <section id="contacto" class="container mt-4"><br>
        <h2>Contacto</h2>
        <p>Para cualquier consulta o pedido, no dudes en contactarte con nosotros.</p>
        <form action="admin/seccion/comentarios/crear.php" method="POST">


            <div class="form-group">
                <label for="nombre">Nombre: </label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre"><br>
                <input type="email" class="form-control" id="correo" name="correo" placeholder="Ingrese su correo electrónico" required><br>
                <div class="mb-3">
                    <label for="Mensaje" class="form-label">Mensaje</label>
                    <textarea class="form-control" id="mensaje" name="mensaje" rows="6" placeholder="Escriba su mensaje"></textarea>
                </div>
                <br>
                <input type="submit" class="btn btn-primary" value="Enviar mensaje" name="enviar" id="">
            </div>
        </form>

    </section>
    <br>
    <br>



    <header>
        <!-- place navbar here -->
    </header>
    <main></main>
    <footer class="bg-dark text-light text-center">
        <p> &copy; 2025 Derechos reservados</p>

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