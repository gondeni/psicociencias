<?php
  include('../includes/config_ini.php');
  
  // Se recoge la variable recibida por POST
  $id_de_noticia = $_POST["id_de_noticia"];
  
  // Obtenemos los datos de la noticia 
  $consulta = "SELECT id_de_noticia, titulo_de_noticia, cuerpo_de_noticia, fecha_de_creacion, imagen_de_noticia ";
  $consulta .= "FROM maestro_de_noticias ";
  $consulta .= "WHERE id_de_noticia = :idDeNoticia;";
  $hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
  $hacerConsulta->bindParam(":idDeNoticia", $id_de_noticia);
  $hacerConsulta->execute(); // Se ejecuta la consulta.
  $noticia = $hacerConsulta->fetch(PDO::FETCH_ASSOC); // Se recuperan los resultados.
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
      <div class="divimage dzsparallaxer--target w-100 u-bg-overlay g-bg-black-opacity-0_4--after" style="height: 140%; background-image: url(../imagenes/noticias.jpg);"></div>
      <!-- End Parallax Image -->

      <!-- Promo Block Content -->
      <div class="container g-color-white text-center g-py-150">
        <h2 class="display-3 g-font-weight-300 text-uppercase g-letter-spacing-1 mb-0">Noticias</h2>
      </div>
      <!-- Promo Block Content -->
    </section>
    <!-- End Promo Block -->
    
    <section class="container g-pt-20 g-pb-20">
      <div class="row justify-content-between">
        <div class="col-lg-12 g-mb-60">
          
          <div class="container g-pt-50 g-pb-20">
            <div class="row justify-content-between">
              <div class="g-pr-20--lg">
                  
                <?php
                
                    //Variables para las redes sociales
                    // Imagen para mostrar en redes sociales
                    if ($noticia["imagen_de_noticia"] != "") {
                      $imagenRS = $noticia["imagen_de_noticia"];
                    } else {
                      $imagenRS = "logotipo.jpg";
                    }
                    
                    $tituloSM = str_replace("<br>", "", $noticia["titulo_de_noticia"]);
                    $descripcionSM = "Sociedad Espa&ntilde;ola de Medicina Psicosom&aacute;tica y Psicoterapia";
                    $urlSM = "http://www.psicociencias.com/noticias/ver_noticia.php?mIdDeNoticia=".$noticia["id_de_noticia"];
                    $imagenSM = "http://www.psicociencias.com/imagenes/noticias/".$imagenRS;
                    
                    // Se limita la longitud del cuerpo de la noticis / post que se muestra
                    $cuerpoDeNoticia = $noticia["cuerpo_de_noticia"];
                    $cuerpoPlanoDeNoticia = strip_tags($cuerpoDeNoticia); //Se limpia el texto de caracteres que puedan dar problemas
                                
                    echo "<article class=\"u-shadow-v4 g-bg-white g-brd-around g-brd-gray-light-v3 g-line-height-2 g-pa-30 g-mb-30\" role=\"alert\">";
                    
                    if ($noticia["imagen_de_noticia"] == "") {
                        echo "<div class=\"g-mb-10\">";
                        echo "<span class=\"d-block g-color-gray-dark-v4 g-font-weight-700 g-font-size-12 text-uppercase mb-2\">".date("d-m-Y", strtotime($noticia["fecha_de_creacion"]))."</span>";
                        echo "<h2 class=\"h4 g-color-black g-font-weight-600 mb-3\">";
                        echo "<a class=\"u-link-v5 g-color-black g-color-primary--hover\" href=\"javascript:saltarANoticia(".$noticia["id_de_noticia"].");\">".$noticia["titulo_de_noticia"]."</a>";
                        echo "</h2>";
                        echo "<p class=\"g-color-gray-dark-v4 g-line-height-1_8\">".$cuerpoPlanoDeNoticia."</p>";
                        echo "</div>";
                    } else {
                        echo "<div class=\"g-mb-10\">";
                        echo "<div class=\"row\">";
                        echo "<div class=\"col-md-3\">";
                        echo "<img src=\"../imagenes/noticias/".$noticia["imagen_de_noticia"]."\" class=\"img-responsive\" width=\"90%\"/>";
                        echo "</div>";
                        echo "<div class=\"col-md-9\">";
                        echo "<span class=\"d-block g-color-gray-dark-v4 g-font-weight-700 g-font-size-12 text-uppercase mb-2\">".date("d-m-Y", strtotime($noticia["fecha_de_creacion"]))."</span>";
                        echo "<h2 class=\"h4 g-color-black g-font-weight-600 mb-3\">";
                        echo "<a class=\"u-link-v5 g-color-black g-color-primary--hover\" href=\"#!\">".$noticia["titulo_de_noticia"]."</a>";
                        echo "</h2>";
                        echo "<p class=\"g-color-gray-dark-v4 g-line-height-1_8\">".$cuerpoPlanoDeNoticia."</p>";                            
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    
                    echo "<div class=\"row\">";
                    echo "<div class=\"col-md-6\">";
                    echo "</div>";
                    echo "<div class=\"col-md-6 g-font-size-20 text-right\">";
                    echo "<a href=\"#\" data-type=\"facebook\" data-url=\"".$urlSM."\" data-title=\"".$tituloSM."\" data-description=\"".$tituloSM."\" data-media=\"".$imagenSM."\" class=\"prettySocial fa fa-facebook\"></a>";
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    echo "<a href=\"#\" data-type=\"twitter\" data-url=\"".$urlSM."\" data-description=\"".$tituloSM."\" data-via=\"SEMPyP\" class=\"prettySocial fa fa-twitter\"></a>";
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    echo "<a href=\"#\" data-type=\"googleplus\" data-url=\"".$urlSM."\" data-description=\"".$tituloSM."\" class=\"prettySocial fa fa-google-plus\"></a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</article>";
                 ?>
                  
              </div>
              
              <div class="col-md-12 text-center"><a href="noticias.php">Volver</a></div>

            </div>
          </div>

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

  <!-- JS Unify -->
  <script src="../assets/js/hs.core.js"></script>
  <script src="../assets/js/components/hs.header.js"></script>
  <script src="../assets/js/helpers/hs.hamburgers.js"></script>
  <script src="../assets/js/components/hs.tabs.js"></script>
  <script src="../assets/js/components/hs.go-to.js"></script>
  <script src="../assets/js/components/gmap/hs.map.js"></script>

  <!-- pretty social -->
  <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
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

  <!-- JS Plugins Init. -->
  <script>
    
    // Pretty Social
    $('.prettySocial').prettySocial();
    
    $(window).on('resize', function () {
      setTimeout(function () {
        $.HSCore.components.HSTabs.init('[role="tablist"]');
      }, 200);
    });
      
  </script>

</body>

</html>
