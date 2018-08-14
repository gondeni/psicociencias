<?php
    header('Content-Type: text/html; charset=utf8');
    include ("includes/config.php");
        
    /* se identifica el indez para determinar la referencia de los menus */
    $index = "S";
    
    $nombreDeEmpresa = $_SESSION["nombre_de_empresa"];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $nombreDeEmpresa?></title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          
          <?php include("menu.php"); ?>  
          <?php include("menu_top.php"); ?>  
  
          <!-- CONTENIDO PRINCIPAL -->
          <div class="right_col" role="main">
            
            <div class="row">
              <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-body"><h1>Dashboard</h1></div>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-2">
                <div class="panel panel-default text-center">
                  <div>&nbsp;</div>
                  <a href="secciones/secciones.php"><img src="imagenes/secciones.png" /></a>
                  <div class="panel-body">Secciones</div>
                </div>
              </div>
              <!--<div class="col-md-2">
                <div class="panel panel-default text-center">
                  <div>&nbsp;</div>
                  <a href="catalogo/catalogo.php"><img src="imagenes/catalogo.png" /></a>
                  <div class="panel-body">Cat&aacute;logo de productos</div>
                </div>
              </div>-->
              <!--<div class="col-md-2">
                 <div class="panel panel-default text-center">
                  <div>&nbsp;</div>
                  <a href="portfolio/portfolio.php"><img src="imagenes/trabajos.png" /></a>
                  <div class="panel-body">Trabajos realizados</div>
                 </div>
              </div>-->
              <div class="col-md-2">
                 <div class="panel panel-default text-center">
                  <div>&nbsp;</div>
                  <a href="portfolio/portfolio.php"><img src="imagenes/catalogo.png" /></a>
                  <div class="panel-body">Cursos</div>
                 </div>
              </div>
              <div class="col-md-2">
                <div class="panel panel-default text-center">
                  <div>&nbsp;</div>
                  <a href="blog/blog.php"><img src="imagenes/blog.png" /></a>
                  <div class="panel-body">Noticias</div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="panel panel-default text-center">
                  <div>&nbsp;</div>
                  <a href="usuarios/usuarios.php"><img src="imagenes/user.png" /></a>
                  <div class="panel-body">Usuarios</div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="panel panel-default text-center">
                  <div>&nbsp;</div>
                  <a href="sistema/configuracion.php"><img src="imagenes/config.png" /></a>
                  <div class="panel-body">Configuraci&oacute;n</div>
                </div>
              </div>
            </div>
            
                    
          </div>
           <!-- FIN CONTENIDO PRINCIPAL -->

        </div>
          <?php include("footer.php"); ?>  
      </div>
    </div>

    <!-- jQuery -->
    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="build/js/custom.min.js"></script>

  </body>
</html>
