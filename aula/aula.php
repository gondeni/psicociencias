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
  <link rel="stylesheet" href="../assets/vendor/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="../assets/vendor/dzsparallaxer/dzsparallaxer.css">
  <link rel="stylesheet" href="../assets/vendor/dzsparallaxer/dzsscroller/scroller.css">
  <link rel="stylesheet" href="../assets/vendor/dzsparallaxer/advancedscroller/plugin.css">
  <link rel="stylesheet" href="../assets/vendor/hs-megamenu/src/hs.megamenu.css">
  <link rel="stylesheet" href="../assets/vendor/hamburgers/hamburgers.min.css">

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

    <!-- Login -->
    <section class="container g-py-100">
      <div class="row justify-content-center">
        <div class="col-sm-8 col-lg-5">
          <div class="g-brd-around g-brd-gray-light-v4 rounded g-py-40 g-px-30">
            <header class="text-center mb-4">
              <h2 class="h2 g-color-black g-font-weight-600">Acceso a Aula Virtual</h2>
            </header>

            <!-- Form -->
            <form class="g-py-15">
              <p>Para acceder, por favor, introduzca su nombre de usuario y contraseña</p>
              <div class="mb-4">
                <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15" type="email" placeholder="Usuario">
              </div>

              <div class="g-mb-35">
                <input class="form-control g-color-black g-bg-white g-bg-white--focus g-brd-gray-light-v4 g-brd-primary--hover rounded g-py-15 g-px-15 mb-3" type="password" placeholder="Contraseña">
              </div>

              <div class="mb-4">
                <button class="btn btn-md btn-block u-btn-primary g-rounded-50 g-py-13" type="button">Acceder</button>
              </div>
            </form>
            <!-- End Form -->

            <footer class="text-center">
              <p class="g-color-gray-dark-v5 g-font-size-13 mb-0">Si aún no dispone de su nombre de usuario y contraseña puede solicitarlo en:<br>
              Teléfono: 915 185 198<br>
              e-mail: psicosomatica@psicociencias.com</p>
            </footer>
          </div>
        </div>
      </div>
    </section>
    <!-- End Login -->
    
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
  <script src="../assets/vendor/slick-carousel/slick/slick.js"></script>

  <!-- JS Unify -->
  <script src="../assets/js/hs.core.js"></script>
  <script src="../assets/js/components/hs.header.js"></script>
  <script src="../assets/js/helpers/hs.hamburgers.js"></script>
  <script src="../assets/js/components/hs.tabs.js"></script>
  <script src="../assets/js/components/hs.go-to.js"></script>
  <script src="../assets/js/components/gmap/hs.map.js"></script>
  <script src="../assets/js/components/hs.carousel.js"></script>
  <script src="../assets/js/helpers/hs.height-calc.js"></script>
  <script src="../assets/js/helpers/hs.focus-state.js"></script>
  
  <!-- JS Customization -->
  <script src="../assets/js/custom.js"></script>

  <!-- JS Plugins Init. -->
  <script>
    // initialization of google map
      function initMap() {
        $.HSCore.components.HSGMap.init('.js-g-map');
      }

      $(document).on('ready', function () {
        // initialization of carousel
        $.HSCore.components.HSCarousel.init('.js-carousel');
        
        // initialization of tabs
        $.HSCore.components.HSTabs.init('[role="tablist"]');
        
        // initialization of header's height equal offset
        $.HSCore.helpers.HSHeightCalc.init();

        // initialization of go to
        $.HSCore.components.HSGoTo.init('.js-go-to');
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
