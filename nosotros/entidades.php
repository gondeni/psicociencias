<?php
  include('../includes/config_ini.php');
  
  /* Hacemos consulta de entidades */
	$consulta = "SELECT * ";
	$consulta .= "FROM entidades ";
	$consulta .= "ORDER BY orden ASC;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$matrizDeEntidades = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
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
  <link  rel="stylesheet" href="../assets/vendor/slick-carousel/slick/slick.css">

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
      <div class="divimage dzsparallaxer--target w-100 u-bg-overlay g-bg-black-opacity-0_4--after" style="height: 140%; background-image: url(../imagenes/entidades.jpg);"></div>
      <!-- End Parallax Image -->

      <!-- Promo Block Content -->
      <div class="container g-color-white text-center g-py-150">
        <h2 class="display-5 g-font-weight-300 text-uppercase g-letter-spacing-1 mb-0">Entidades Colaboradoras</h2>
        <h2 class="display-g g-font-weight-300 text-uppercase g-letter-spacing-1 mb-0">Práctica clínica supervisada en los distintos campos de acción profesional</h2>
      </div>
      <!-- Promo Block Content -->
    </section>
    <!-- End Promo Block -->

    <section class="container g-pt-50 g-pb-40">
      <div class="row justify-content-between">
        <div class="col-lg-12 g-mb-60">
          <h2 class="h3">Entidades Colaboradoras</h2>
          
          <p>
            <span class="u-dropcap g-color-primary g-mr-20 g-mb-10">L</span>
            a Sociedad Española de Medicina Psicosomática y Psicoterapia colabora con las siguientes instituciones, públicas y privadas,
						para ofrecerte la posibilidad de realizar prácticas de psicología clínica dentro de distintos campos de acción profesional.
						El practicum estará supervisado por profesionales miembros de nuestro equipo y será acreditado, a efectos de currículo, para garantizar una formación
						y unos resultados de excelencia. (Todo lo demás fuera)</p>
          
          <!-- Carousel -->
          <div id="carouselCus3" class="js-carousel g-mb-0--lg" data-infinite="true" data-fade="true" data-lazy-load="ondemand" data-arrows-classes="u-arrow-v1 g-absolute-centered--y g-width-45 g-height-45 g-font-size-30 g-color-gray-dark-v4 g-color-primary--hover" data-arrow-left-classes="fa fa-angle-left g-left-0 g-left-40--lg" data-arrow-right-classes="fa fa-angle-right g-right-0 g-right-40--lg" data-nav-for="#carouselCus4">
           
           <?php
            foreach ($matrizDeEntidades as $entidad) {
              echo "<div class=\"js-slide\">";
              echo "<div class=\"row justify-content-center align-items-center no-gutters\">";
              echo "<div class=\"col-sm-4 col-lg-3\">";
							echo "<a href=\"".$entidad["web_de_entidad"]."\" target=\"_blank\">";
							echo "<img width=\"100%\" src=\"../imagenes/entidades/".$entidad["imagen_de_entidad"]."\"/>";
							echo "</a>";
							echo "</div>";
							echo "<div class=\"col-sm-8 col-lg-7\">";
              echo "<div class=\"g-px-30 g-px-50--lg g-py-60\">";
              echo "<h3 class=\"h4 mb-1\">".$entidad["nombre_de_entidad"]."</h3>";
              echo "<p class=\"mb-4\">".$entidad["contenido_de_entidad"]."</p>";
              echo "</div>";
              echo "</div>";
              echo "</div>";
              echo "</div>";
            }
           ?>
           
          </div>
          
          <div id="carouselCus4" class="js-carousel text-center u-carousel-v3 g-mx-minus-15" data-infinite="true" data-center-mode="true" data-slides-show="5" data-is-thumbs="true" data-lazy-load="ondemand" data-nav-for="#carouselCus3">
            <?php
              foreach ($matrizDeEntidades as $entidad) {
                echo "<div class=\"js-slide g-opacity-1 g-cursor-pointer g-px-15\">";
                echo "<img class=\"img-fluid mb-3\" src=\"../imagenes/entidades/".$entidad["imagen_de_entidad"]."\" alt=\"".$entidad["nombre_de_entidad"]."\">";
                echo "</div>";
              }
            ?>
            
            <!--<div class="js-slide g-opacity-1 g-cursor-pointer g-px-15">
              <img class="img-fluid mb-3" src="../assets/img-temp/400x450/img1.jpg" alt="Image Description">
              <h3 class="h6 g-color-gray-dark-v4">Jessica Lisbon</h3>
            </div>-->
          
          </div>
          <!-- End Carousel -->

                      
        </div>
        
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
  <script  src="../assets/vendor/slick-carousel/slick/slick.js"></script>

  <!-- JS Unify -->
  <script src="../assets/js/hs.core.js"></script>
  <script src="../assets/js/components/hs.header.js"></script>
  <script src="../assets/js/helpers/hs.hamburgers.js"></script>
  <script src="../assets/js/components/hs.tabs.js"></script>
  <script src="../assets/js/components/hs.go-to.js"></script>
  <script src="../assets/js/components/gmap/hs.map.js"></script>
  <script  src="../assets/js/components/hs.carousel.js"></script>

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
      });
      
      $(document).ready(function () {
        // initialization of carousel
        $.HSCore.components.HSCarousel.init('[class*="js-carousel"]');
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
      
  </script>

</body>

</html>
