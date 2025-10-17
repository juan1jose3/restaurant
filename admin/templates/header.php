<?php
    $url_base = "http://localhost/restaurant/admin/";
?>
<style>
    .navbar .nav-link{
        color: white;
    }
</style>
<header>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
            <nav class="navbar navbar-expand navbar-light bg-dark">
                <div class="nav navbar-nav">
                    <a class="nav-item nav-link" href="#" aria-current="page"><span class="visual">Administrador</span></a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>/seccion/banners/">Banner</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>/seccion/eventos/">Administrar eventos</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>/seccion/colaboradores/">Colaboradores</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>/seccion/testimonios/">Testimonios</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>/seccion/menu/">Menu</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>/seccion/usuarios/">Usuarios</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>/seccion/comentarios/">Comentarios</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>/seccion/reservas/">Reservas</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>/seccion/adminInventario/">Cola inventario</a>
                    <a class="nav-item nav-link" href="#">Cerrar sesion</a>
                    <a class="nav-item nav-link" href="<?php echo $url_base;?>/seccion/noti/"><i class="bi bi-bell"></i></a>
                </div>
             </nav>
            <!-- place navbar here -->
             
        </header>