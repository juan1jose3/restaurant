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
                        <a class="nav-link" href="#Chef">Chef</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#menu">Menu</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#testimonios">Testimonios</a>
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
                <h1>Restaurante Juan Jo</h1>
                <p>Bienvenido a nuestro Restaurante</p>
                <a href="#menu" class="btn btn-primary">Ver menú</a>
            </div>

        </div>

    </section>
    <br>
    <div class="d-flex justify-content-center">
        <div class="card text-white bg-dark mb-3 w-75">
            <div class="card-body">
                <h1 class="card-title" style="text-align: center;">Bienvenidos a su restaurante tipico</h1>
                <h4 class="card-text" style="text-align: center;">Recuerda que por la compra de 6, llevas 6 y pagas 4!</h4>
            </div>
        </div>
    </div>


    <br>

    <section id="Chef" class="ms-4">
        <h2>Nuestros Chefs</h2>
        <br>
        <div class="row row-cols-3 row-cols-md-d g-4">
            <div class="col d-flex justify-content-center">
                <div class="card h-100">
                    <img src="images/chef1.jpg" alt="Chef1" style="max-width:400px; border-radius:9px">
                    <div class="card-body">
                        <h5 class="card-title">Pedro José</h5>
                        <p class="card-text small"><strong>Experto en comida mediterránea</strong></p>
                        <div>
                            <img src="images/instagram.svg" alt="insta">
                            <img src="images/whatsapp.svg" alt="whatsapp">
                            <img src="images/facebook.svg" alt="face">
                        </div>
                    </div>
                </div>

            </div>

            <div class="col d-flex">
                <div class="card h-100">
                    <img src="images/chefNew.jpg" alt="Chef2" style="max-width:400px; border-radius:9px">
                    <div class="card-body">
                        <h5 class="card-title">Pedro José</h5>
                        <p class="card-text small"><strong>Experto en comida mediterránea</strong></p>
                        <div>
                            <img src="images/instagram.svg" alt="insta">
                            <img src="images/whatsapp.svg" alt="whatsapp">
                            <img src="images/facebook.svg" alt="face">
                        </div>
                    </div>
                </div>

            </div>

            <div class="col d-flex">
                <div class="card h-100">
                    <img src="images/cheff3.jpg" alt="Chef3" style="max-width:400px; border-radius:9px">
                    <div class="card-body">
                        <h5 class="card-title">Pedro José</h5>
                        <p class="card-text small"><strong>Experto en comida mediterránea</strong></p>
                        <div>

                            <img src="images/instagram.svg" alt="insta">
                            <img src="images/whatsapp.svg" alt="whatsapp">
                            <img src="images/facebook.svg" alt="face">
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </section>


    <section id="testimonios" class="bg-light py-5">
        <div class="container">

            <h2 class="text-center mb-4">Testimonios</h2>

            <div class="row">

                <div class="col-md-6 d-flex">
                    <div class="card mb-4 w-100">
                        <div class="card-body">
                            <p class="card-text">Sirven muy buena comida</p>
                        </div>
                        <div class="card-footer text-muted">
                            Oscar Jimenez
                        </div>
                    </div>
                </div>

                <div class="col-md-6 d-flex">
                    <div class="card mb-4 w-100">
                        <div class="card-body">
                            <p class="card-text">Muy buena atención</p>
                        </div>
                        <div class="card-footer text-muted">
                            Pedro Mondragon
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>

    <section id="menu">
        <h2 class="text-center">Recomendados</h2>
        <br>
        <div class="row row-cols-4 row-cols-md-d g-4">
            <div class="col d-flex">
                <div class="card h-100">
                    <img src="images/bandeja.jpg" alt="Bandeja Paisa" style="max-width:400px">
                    <div class="card-body">
                        <h5 class="card-title">Bandeja Paisa</h5>
                        <p class="card-text small"><strong>Ingredientes: </strong>Arroz,Arepa,Chicharon</p>
                        <p class="card-text"><strong>Precio: </strong>22000<strong>$</strong></p>
                    </div>
                </div>

            </div>


            <div class="col d-flex">
                <div class="card h-100">
                    <img src="images/bandeja.jpg" alt="Bandeja Paisa" style="max-width:400px">
                    <div class="card-body">
                        <h5 class="card-title">Bandeja Paisa</h5>
                        <p class="card-text small"><strong>Ingredientes: </strong>Arroz,Arepa,Chicharon</p>
                        <p class="card-text"><strong>Precio: </strong>22000<strong>$</strong></p>
                    </div>
                </div>

            </div>

            <div class="col d-flex">
                <div class="card h-100">
                    <img src="images/bandeja.jpg" alt="Bandeja Paisa" style="max-width:400px">
                    <div class="card-body">
                        <h5 class="card-title">Bandeja Paisa</h5>
                        <p class="card-text small"><strong>Ingredientes: </strong>Arroz,Arepa,Chicharon</p>
                        <p class="card-text"><strong>Precio: </strong>22000<strong>$</strong></p>
                    </div>
                </div>

            </div>

            <div class="col d-flex">
                <div class="card h-100">
                    <img src="images/bandeja.jpg" alt="Bandeja Paisa" style="max-width:400px">
                    <div class="card-body">
                        <h5 class="card-title">Bandeja Paisa</h5>
                        <p class="card-text small"><strong>Ingredientes: </strong>Arroz,Arepa,Chicharon</p>
                        <p class="card-text"><strong>Precio: </strong>22000<strong>$</strong></p>
                    </div>
                </div>

            </div>

        </div>
    </section>

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

    <section id="contacto" class="container mt-4"><br>
        <h2>Contacto</h2>
        <p>Para cualquier consulta o pedido, no dudes en contactarte con nosotros.</p>
        <form action="?" method="POST">


            <div class="form-group">
                <label for="nombre">Nombre: </label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre"><br>
                <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su correo electrónico"><br>
                <input type="text" name="form-control" id="telefono" name="telefono" placeholder="Ingrese su número de teléfono"><br>
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