<?php
  include('../includes/config_ini.php');

  /* Realizamos la consulta para mostarr las 3 noticias más recientes. */
  $consulta = "SELECT * ";
  $consulta .= "FROM maestro_de_noticias ";
  $consulta .= "WHERE estado_de_noticia = :estadoDeNoticia ";
  $consulta .= "ORDER BY fecha_de_creacion DESC ";
  $consulta .= "LIMIT 3;";
  $hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
  $hacerConsulta->bindValue(":estadoDeNoticia", "A");
  $hacerConsulta->execute();
  $matrizDeNoticias = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
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
  <!-- CSS Global Icons -->
  <link rel="stylesheet" href="../assets/vendor/icon-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/vendor/icon-line/css/simple-line-icons.css">
  <link rel="stylesheet" href="../assets/vendor/icon-etlinefont/style.css">
  <link rel="stylesheet" href="../assets/vendor/icon-line-pro/style.css">
  <link rel="stylesheet" href="../assets/vendor/icon-hs/style.css">
  <link rel="stylesheet" href="../assets/vendor/dzsparallaxer/dzsparallaxer.css">
  <link rel="stylesheet" href="../assets/vendor/dzsparallaxer/dzsscroller/scroller.css">
  <link rel="stylesheet" href="../assets/vendor/dzsparallaxer/advancedscroller/plugin.css">
  <link rel="stylesheet" href="../assets/vendor/animate.css">
  <link rel="stylesheet" href="../assets/vendor/fancybox/jquery.fancybox.min.css">
  <link rel="stylesheet" href="../assets/vendor/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="../assets/vendor/typedjs/typed.css">
  <link rel="stylesheet" href="../assets/vendor/hs-megamenu/src/hs.megamenu.css">
  <link rel="stylesheet" href="../assets/vendor/hamburgers/hamburgers.min.css">

  <!-- CSS Unify -->
  <link rel="stylesheet" href="../assets/css/unify-core.css">
  <link rel="stylesheet" href="../assets/css/unify-components.css">
  <link rel="stylesheet" href="../assets/css/unify-globals.css">

  <!-- Master Slider -->
  <link rel="stylesheet" href="../assets/vendor/master-slider/source/assets/css/masterslider.main.css">
  <link rel="stylesheet" href="slider/assets/css/style.css">

  <!-- CSS Implementing Plugins -->
  <link  rel="stylesheet" href="../assets/vendor/slick-carousel/slick/slick.css">

  <!-- CSS Customization -->
  <link rel="stylesheet" href="../assets/css/custom.css">

</head>

<body>
  <main>

    <?php

      include ("../cabecera.php");

      include ("slider/slider.php");

      include ("nosotros.php");

      include ("cursos.php");

      include ("entidades.php");

      include ("fcontinua.php");

      include ("testimonios.php");

      include ("noticias.php");

      include ("newsletter.php");

      include ("../pie.php");

     ?>

    <!-- Boton de subir -->
    <a class="js-go-to u-go-to-v1" href="#!" data-type="fixed" data-position='{
        "bottom": 15,
        "right": 15
      }' data-offset-top="400" data-compensation="#js-header" data-show-effect="zoomIn">
      <i class="hs-icon hs-icon-arrow-top"></i>
    </a>
    <!-- Fin boton de subir -->

  </main>

  <div class="u-outer-spaces-helper"></div>

  <!-- Formulario de salto -->
  <form action="" id="formularioDeSalto" method="post">
      <input type="hidden" name="id_de_noticia" id="id_de_noticia" value="" />
      <input type="hidden" name="id_de_curso" id="id_de_curso" value="" />
  </form>

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
  <script src="../assets/vendor/slick-carousel/slick/slick.js"></script>
  <script src="../assets/vendor/fancybox/jquery.fancybox.min.js"></script>
  <script src="../assets/vendor/typedjs/typed.min.js"></script>

  <!-- JS Contadores -->
  <script  src="../assets/vendor/appear.js"></script>

  <!-- JS Master Slider -->
  <script src="../assets/vendor/master-slider/source/assets/js/masterslider.min.js"></script>

  <!-- JS Unify -->
  <script src="../assets/js/hs.core.js"></script>
  <script src="../assets/js/components/hs.carousel.js"></script>
  <script src="../assets/js/components/hs.header.js"></script>
  <script src="../assets/js/helpers/hs.hamburgers.js"></script>
  <script src="../assets/js/components/hs.tabs.js"></script>
  <script src="../assets/js/components/hs.popup.js"></script>
  <script src="../assets/js/components/text-animation/hs.text-slideshow.js"></script>
  <script src="../assets/js/components/hs.go-to.js"></script>
  <script  src="../assets/js/components/hs.chart-pie.js"></script>

  <!-- pretty social -->
  <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  <!--<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>-->
  <script src="../assets/prettySocial/jquery.prettySocial.min.js"></script>


  <!-- Time line de facebook -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5&appId=252705591408136";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>

  <script>

    /* Scripts personalizados. */

    // Paso a noticia individual
		function saltarANoticia (id) {
			document.getElementById("id_de_noticia").value = id;
			document.getElementById("formularioDeSalto").action = "../noticias/noticia.php";
			document.getElementById("formularioDeSalto").submit();
		}
    
    // Paso a curso individual
		function saltarACurso (id) {
			document.getElementById("id_de_curso").value = id;
			document.getElementById("formularioDeSalto").action = "../formacion/curso.php";
			document.getElementById("formularioDeSalto").submit();
		}

   /* JS Plugins Init. */

    // Pretty Social
    $('.prettySocial').prettySocial();

    $(document).on('ready', function () {
        // initialization of carousel
        $.HSCore.components.HSCarousel.init('.js-carousel');

        // initialization of tabs
        $.HSCore.components.HSTabs.init('[role="tablist"]');

        // initialization of popups
        $.HSCore.components.HSPopup.init('.js-fancybox');

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

      var slider = new MasterSlider();

      slider.control('arrows');
      slider.control('timebar', {insertTo: '#masterslider'});
      slider.control('bullets');
      slider.setup('masterslider', {
        width: 1400,
        height: 580,
        space: 1,
        layout: 'fullwidth',
        loop: true,
        preload: 0,
        instantStartLayers: true,
        autoplay: true,
        view: 'fade'
      });

    $(document).ready(function(){
      $('.scroll-a-nosotros').click(function(){
        $('body, html').animate({
          scrollTop: '600px'
        }, 600);
      });

    });

  </script>

</body>

</html>
