<?php
    /* Se identifica si estamos en el index para ver la referencia correcta. */
    if ($index == "S") {
        $referencia = "";
    } else {
        $referencia = "../";
    }
?>
<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="<?php echo $referencia; ?>dashboard.php" class="site_title"><span><?php echo $nombreDeEmpresa?></span></a>
    </div>

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <ul class="nav side-menu">
            <li><a href="<?php echo $referencia; ?>dashboard.php"><i class="fa fa-home"></i> Inicio</a></li>

            <li><a><i class="fa fa-folder-open"></i> Secciones de la web <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo $referencia; ?>secciones/nueva_seccion.php">Nueva secci&oacute;n web</a></li>
                    <li><a href="<?php echo $referencia; ?>secciones/secciones.php">Ver secciones web</a></li>
                </ul>
            </li>

            <!--<li><a><i class="fa fa-sitemap"></i> Secciones <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo $referencia; ?>clasificacion/nueva_seccion.php">Nueva secci&oacute;n</a></li>
                    <li><a href="<?php echo $referencia; ?>clasificacion/nueva_subseccion.php">Nueva subsecci&oacute;n</a></li>
                    <li><a href="<?php echo $referencia; ?>clasificacion/secciones.php">Ver secciones</a></li>
                </ul>
            </li>-->

            <!--<li><a><i class="fa fa-shopping-cart"></i> Cat&aacute;logo <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo $referencia; ?>catalogo/nuevo_articulo.php">Nuevo art&iacute;culo</a></li>
                    <li><a href="<?php echo $referencia; ?>catalogo/catalogo.php">Gestionar cat&aacute;logo</a></li>
                </ul>
            </li>-->

            <!--<li><a><i class="fa fa-thumbs-o-up"></i> Trabajos realizados <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo $referencia; ?>portfolio/nuevo_trabajo.php">Nuevo trabajo</a></li>
                    <li><a href="<?php echo $referencia; ?>portfolio/portfolio.php">Gestionar trabajos</a></li>
                </ul>
            </li>-->

            <li><a><i class="fa fa-graduation-cap"></i> Cursos <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo $referencia; ?>cursos/nuevo_curso.php">Nuevo curso</a></li>
                    <li><a href="<?php echo $referencia; ?>cursos/cursos.php">Gestionar cursos</a></li>
                </ul>
            </li>

            <li><a><i class="fa fa-newspaper-o"></i> Noticias <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo $referencia; ?>blog/nuevo_post.php">Nueva noticia</a></li>
                    <li><a href="<?php echo $referencia; ?>blog/blog.php">Gestionar noticias</a></li>
                    <li><a href="<?php echo $referencia; ?>blog/revista.php">Gestionar revista</a></li>
                </ul>
            </li>

            <?php if ($_SESSION["tipo_de_usuario"] == "sadmin") { ?>
            <li><a><i class="fa fa-user"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo $referencia; ?>usuarios/nuevo_usuario.php">Nuevo usuario</a></li>
                    <li><a href="<?php echo $referencia; ?>usuarios/usuarios.php">Gestionar usuarios</a></li>
                </ul>
            </li>
            <?php
                }
                if ($_SESSION["tipo_de_usuario"] == "sadmin" || $_SESSION["tipo_de_usuario"] == "admin") {
            ?>
            <li><a href="<?php echo $referencia; ?>sistema/configuracion.php"><i class="fa fa-gears"></i> Sistema </a></li>
            <?php } ?>
            <li><a href="<?php echo $referencia; ?>cerrar_sesion.php"><i class="fa fa-power-off"></i> Cerrar sesi&oacute;n </a></li>

        </ul>
    </div>

    </div>
    <!-- /sidebar menu -->
  </div>
</div>
