<?php
    if ($index == "S") {
        $referencia = "";
    } else {
        $referencia = "../";
    }
?>
<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
        <div class="nav toggle"><a id="menu_toggle"><i class="fa fa-bars"></i></a></div>

        <ul class="nav navbar-nav navbar-right">
          <li class="">
            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
               <?php echo $_SESSION["nombre_de_usuario"]." ".$_SESSION["apellidos_de_usuario"]; ?>
              <span class=" fa fa-angle-down"></span>
            </a>
            <ul class="dropdown-menu dropdown-usermenu pull-right">
              <li><a href="<?php echo $referencia; ?>sistema/configuracion.php"><i class="fa fa-gears pull-right"></i>Sistema</a></li>
              <li><a href="<?php echo $referencia; ?>cerrar_sesion.php"><i class="fa fa-sign-out pull-right"></i> Cerrar sesi&oacute;n</a></li>
            </ul>
          </li>
      </ul>
        
    </nav>
  </div>
</div>
<!-- /top navigation -->