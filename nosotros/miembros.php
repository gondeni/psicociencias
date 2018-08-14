<?php
  include('../includes/config_ini.php');
  
  /* Hacemos consulta de entidades */
	$consulta = "SELECT * ";
	$consulta .= "FROM miembros ";
	$consulta .= "ORDER BY apellidos ASC, nombre ASC;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$matrizDeMiembros = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
	$hacerConsulta->closeCursor(); // Se libera el recurso.

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Title -->
  <title>SEMPyP</title>

  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <!-- Favicon -->
  <link rel="shortcut icon" href="../favicon.ico">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  
  <!-- CSS Global Compulsory -->
  <link rel="stylesheet" href="../assets/vendor/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/vendor/icon-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/vendor/icon-line-pro/style.css">
  <link rel="stylesheet" href="../assets/vendor/icon-hs/style.css">
  <link rel="stylesheet" href="../assets/vendor/animate.css">
  <link rel="stylesheet" href="../assets/vendor/dzsparallaxer/dzsparallaxer.css">
  <link rel="stylesheet" href="../assets/vendor/dzsparallaxer/dzsscroller/scroller.css">
  <link rel="stylesheet" href="../assets/vendor/dzsparallaxer/advancedscroller/plugin.css">
  <link rel="stylesheet" href="../assets/vendor/hs-megamenu/src/hs.megamenu.css">
  <link rel="stylesheet" href="../assets/vendor/hamburgers/hamburgers.min.css">
  
  <!-- CSS Implementing Plugins -->
  <link  rel="stylesheet" href="../assets/vendor/custombox/custombox.min.css">

  <!-- CSS Unify -->
  <link rel="stylesheet" href="../assets/css/unify-core.css">
  <link rel="stylesheet" href="../assets/css/unify-components.css">
  <link rel="stylesheet" href="../assets/css/unify-globals.css">

  <!-- CSS Customization -->
  <link rel="stylesheet" href="../assets/css/custom.css">
</head>

<body>
  <main>

    <?php include ("../cabecera.php"); ?>

    <!-- Promo Block -->
    <section class="dzsparallaxer auto-init height-is-based-on-content use-loading mode-scroll loaded dzsprx-readyall " data-options='{direction: "fromtop", animation_duration: 25, direction: "reverse"}'>
      <!-- Parallax Image -->
      <div class="divimage dzsparallaxer--target w-100 u-bg-overlay g-bg-black-opacity-0_4--after" style="height: 140%; background-image: url(../imagenes/miembros.jpg);"></div>
      <!-- End Parallax Image -->

      <!-- Promo Block Content -->
      <div class="container g-color-white text-center g-py-150">
        <h2 class="display-5 g-font-weight-300 text-uppercase g-letter-spacing-1 mb-0">Miembros de la Sociedad Española de Medicina Psicosomática y Psicoterapia</h2>
      </div>
      <!-- Promo Block Content -->
    </section>
    <!-- End Promo Block -->

    <section class="container g-pt-50 g-pb-40">
      <div class="row justify-content-between">
        <div class="col-lg-12 g-mb-10">
          <!--<h2 class="h3">Miembros</h2>
          
          <!--<p>
            <span class="u-dropcap g-color-primary g-mr-20 g-mb-10">L</span>
            istado completo de Miembros de la Sociedad Española de Medicina Piscosomática y Psicoterapia que han autorizado la publicación de sus datos personales en nuestra página web.
            (Información detallada pinchando en cada uno de los nombres de la lista).<br><br>
          </p>-->
          
        </div>
          
        <?php
          foreach ($matrizDeMiembros as $miembro) {
            echo "<div class=\"col-lg-4 col-md-6 col-xs-1 g-pa-10\">";
            echo "<article class=\"u-shadow-v21 g-bg-white g-brd-around g-brd-gray-light-v4 g-brd-top-2 g-brd-primary-top rounded g-pa-15\">";
            echo "<div class=\"media-body\">";
            echo "<div class=\"d-flex justify-content-between verde2\">";
            echo "<a href=\"javascript:saltarAPagina('".$miembro["id_miembro"]."');\" data-modal-target=\"#modal4\" data-modal-effect=\"fall\"><b>".$miembro["apellidos"].", ".$miembro["nombre"]."</b></a>";
            echo "</div>";
            echo "<span class=\"d-block\">".$miembro["titulacion"]."</span>";            
            echo "</div>";
            echo "</article>";
            echo "</div>";
          }
        ?>                   
        
      </div>
         
    </section>
    
    <?php include ("../pie.php"); ?>

    <a class="js-go-to u-go-to-v1" href="#!" data-type="fixed" data-position='{
     "bottom": 15,
     "right": 15
   }' data-offset-top="400" data-compensation="#js-header" data-show-effect="zoomIn">
      <i class="hs-icon hs-icon-arrow-top"></i>
    </a>
  </main>
  
  <!-- Demo modal window -->
  <div id="modal4" class="text-left g-max-width-600 g-bg-white g-overflow-y-auto g-pa-20" style="display: none;" data-modal-type="ontarget"> 
    <button type="button" class="close" onclick="Custombox.modal.close();">
      <i class="hs-icon hs-icon-close"></i>
    </button>
    <h4 class="g-mb-20">Información del miembro de la Sociedad</h4>
    <iframe width="550" src="" id="marcoParaContenidosAdicionales" scrolling="yes" frameborder="0" class="iframe"></iframe>
  </div>
  <!-- End Demo modal window -->

  <div class="u-outer-spaces-helper"></div>

  <!-- JS Global Compulsory -->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/jquery-migrate/jquery-migrate.min.js"></script>
  <script src="../assets/vendor/popper.min.js"></script>
  <script src="../assets/vendor/bootstrap/bootstrap.min.js"></script>


  <!-- JS Implementing Plugins -->
  <script src="../assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>
  <script src="../assets/vendor/dzsparallaxer/dzsparallaxer.js"></script>
  <script src="../assets/vendor/dzsparallaxer/dzsscroller/scroller.js"></script>
  <script src="../assets/vendor/dzsparallaxer/advancedscroller/plugin.js"></script>
  <script src="../assets/vendor/gmaps/gmaps.min.js"></script>

  <!-- JS Unify -->
  <script src="../assets/js/hs.core.js"></script>
  <script src="../assets/js/components/hs.header.js"></script>
  <script src="../assets/js/helpers/hs.hamburgers.js"></script>
  <script src="../assets/js/components/hs.tabs.js"></script>
  <script src="../assets/js/components/hs.go-to.js"></script>
  <script src="../assets/js/components/gmap/hs.map.js"></script>
  
  <!-- JS Implementing Plugins -->
  <script  src="../assets/vendor/custombox/custombox.min.js"></script>
  <script  src="../assets/js/components/hs.modal-window.js"></script>

  <!-- JS Customization -->
  <script src="../assets/js/custom.js"></script>

  <!-- JS Plugins Init. -->
  <script>
    // initialization of google map
      function initMap() {
        $.HSCore.components.HSGMap.init('.js-g-map');
      }

      $(document).on('ready', function () {
        // initialization of tabs
        $.HSCore.components.HSTabs.init('[role="tablist"]');

        // initialization of go to
        $.HSCore.components.HSGoTo.init('.js-go-to');
      
        // initialization of popups
        $.HSCore.components.HSModalWindow.init('[data-modal-target]');
      });

      $(window).on('load', function () {
        // initialization of header
        $.HSCore.components.HSHeader.init($('#js-header'));
        $.HSCore.helpers.HSHamburgers.init('.hamburger');

        // initialization of HSMegaMenu component
        $('.js-mega-menu').HSMegaMenu({
          event: 'hover',
          pageContainer: $('.container'),
          breakpoint: 991
        });
      });

      $(window).on('resize', function () {
        setTimeout(function () {
          $.HSCore.components.HSTabs.init('[role="tablist"]');
        }, 200);
      });
      
      /* Personalizados */
      function saltarAPagina(busqueda){
         var URL = "miembros_detalle.php?id_de_miembro=" + busqueda;
         document.getElementById("marcoParaContenidosAdicionales").src = URL;
         $("#marcoParaContenidosAdicionales").height("250");
         $("#marcoParaContenidosAdicionales").attr("scrolling", "no");
      }
    
  </script>

</body>

</html>
