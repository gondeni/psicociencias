<?php
  include('../includes/config_ini.php');
  
  //primero obtenemos el parametro que nos dice en que pagina estamos y
  //el limete de regitros que queremos por pagina
  $limit = 5; // Número de registros a mostrar por página
  $page = 1; //inicializamos la variable $page a 1 por default
  if(array_key_exists('pg', $_GET)) {
      $page = $_GET['pg']; //si el valor pg existe en nuestra url, significa que estamos en una pagina en especifico.
  }
  
  //ahora que tenemos en que pagina estamos obtengamos los resultados:
  // a) el numero de registros en la tabla
  $consulta = "SELECT id_de_noticia ";
  $consulta .= "FROM maestro_de_noticias ";
  $consulta .= "WHERE estado_de_noticia = :estadoDeNoticia;";
  $hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
  $hacerConsulta->bindValue(":estadoDeNoticia", "A");
  $hacerConsulta->execute();
  $matriz = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
  $hacerConsulta->closeCursor(); // Se libera el recurso.
  $total_de_noticias = count($matriz);
  
  //ahora dividimos el conteo por el numero de registros que queremos por pagina.
  $max_num_paginas = intval($total_de_noticias/$limit);
  
  /* POSTS MÁS RECIENTES */
  /* Se recogen las variables de mes y añoo en caso de que desde esta página se pidan los post de un periodo concreto */
  if (isset($_GET["mes"]) && isset($_GET["anno"])) {
      $mes_de_noticia = $_GET["mes"];
      $anno_de_noticia = $_GET["anno"];
      $fecha_de_creacion = $anno_de_noticia."-".$mes_de_noticia."-%";
  }

  // ahora obtenemos el segmento paginado que corresponde a esta pagina
  /* En la cobsulta se le resta 1 a la variable $page? para calcular el offset, el multiplicador tiene que ser siempre 0-based. es decir,
  si $page = 1, el ofset debe ser 0 para obtener un LIMIT 0, 5 (los primeros 5 registros despues del registro 0) y si $page = 2,
  obtener un LIMIT 5,5 (los primeros 5 registros despues del registro 5), y asi sucesivamente.*/
  $consulta = "SELECT id_de_noticia, titulo_de_noticia, cuerpo_de_noticia, fecha_de_creacion, imagen_de_noticia, entrada_de_noticia ";
  $consulta .= "FROM maestro_de_noticias ";
  $consulta .= "WHERE estado_de_noticia = :estadoDeNoticia ";
  $consulta .= "AND id_de_seccion = :tipoDeNoticia "; 
  $consulta .= "ORDER BY fecha_de_creacion DESC ";
  $consulta .= "LIMIT ".(($page - 1) * $limit).", ".$limit.";";
  $hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
  $hacerConsulta->bindValue(":tipoDeNoticia", 1);
  $hacerConsulta->bindValue(":estadoDeNoticia", "A");
  if (isset($_GET["mes"]) && isset($_GET["anno"])) {
      $hacerConsulta->bindParam(":fechaDeCreacion", $fecha_de_creacion);
  }
  $hacerConsulta->execute(); // Se ejecuta la consulta.
  $matrizDeNoticias = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
  $hacerConsulta->closeCursor(); // Se libera el recurso.
  $numeroDeNoticias = count($matrizDeNoticias);

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
      <div class="container g-color-white text-center g-py-120">
        <h2 class="display-4 g-font-weight-300 text-uppercase g-letter-spacing-1 mb-0">Noticias</h2>
        <h3 class="display-6 g-font-weight-300 text-uppercase g-letter-spacing-1 mb-0">¿Quieres estar al día de todas nuestras novedades? ¡Síguenos!</h3>
      </div>
      <!-- Promo Block Content -->
    </section>
    <!-- End Promo Block -->
    
    <section class="container g-pt-20 g-pb-20">
      <div class="row justify-content-between">
        <div class="col-lg-12 g-mb-60">
                 
          <!-- Blog Minimal Blocks -->
          <div class="container g-pt-20 g-pb-20">
            <div class="row justify-content-between">
              <div class="col-lg-8 g-mb-80">
                <h2 class="h3">Noticias</h2>
                <p>¿Quieres estar al día de todas nuestras novedades?</p>
                <p>Síguenos en Twitter y Facebook y no te pierdas lo último en artículos, vídeos, entrevistas, propuestas formativas y toda la información que
                hace de nuestra profesión un valor social.</p>

                <div class="g-pr-20--lg">
                  
                <?php
                  if ($numeroDeNoticias > 0) {
                      foreach ($matrizDeNoticias as $noticia) {
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
                        for ($i=300; $i>0; $i--) //Se establece la longitud maxima de la cadena en i caracteres 
                            if ($cuerpoPlanoDeNoticia[$i]==' ') break; //se evita el corte de palabras y se corta en el primer punto.
                        $cuerpoCortoDeNoticia = substr($cuerpoPlanoDeNoticia, 0, $i); //se corta el texto y se guarda en una variable
                
                        echo "<article class=\"u-shadow-v4 g-bg-white g-brd-around g-brd-gray-light-v3 g-line-height-2 g-pa-30 g-mb-30\" role=\"alert\">";
                        
                        if ($noticia["imagen_de_noticia"] == "") {
                            echo "<div class=\"g-mb-10\">";
                            echo "<span class=\"d-block g-color-gray-dark-v4 g-font-weight-700 g-font-size-12 text-uppercase mb-2\">".date("d-m-Y", strtotime($noticia["fecha_de_creacion"]))."</span>";
                            echo "<h2 class=\"h4 g-color-black g-font-weight-600 mb-3\">";
                            echo "<a class=\"u-link-v5 g-color-black g-color-primary--hover\" href=\"javascript:saltarADetalleNoticia(".$noticia["id_de_noticia"].");\">".$noticia["titulo_de_noticia"]."</a>";
                            echo "</h2>";
                            echo "<p class=\"g-color-gray-dark-v4 g-line-height-1_8\">".$cuerpoCortoDeNoticia."...</p>";
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
                            echo "<a class=\"u-link-v5 g-color-black g-color-primary--hover\" href=\"javascript:saltarADetalleNoticia(".$noticia["id_de_noticia"].");\">".$noticia["titulo_de_noticia"]."</a>";
                            echo "</h2>";
                            echo "<p class=\"g-color-gray-dark-v4 g-line-height-1_8\">".$cuerpoCortoDeNoticia."...</p>";                            
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                        
                        echo "<div class=\"row\">";
                        echo "<div class=\"col-md-6\">";
                        echo "<a class=\"g-font-size-13\" href=\"javascript:saltarADetalleNoticia(".$noticia["id_de_noticia"].");\">////// Leer más...</a>";
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
                        
                      }
                  }
               ?>
    
                  <!-- Paginador -->
                  <nav id="stickyblock-end" class="text-center" aria-label="Page Navigation">
                    <ul class="list-inline">
                      
                    <?php
                       // Botón "Anterior"
                        if ($page == 1) {
                           echo "<li class=\"list-inline-item float-left g-hidden-xs-down\">";
                           echo "<a class=\"u-pagination-v1__item u-pagination-v1-4 g-brd-gray-light-v3 g-brd-primary--hover g-rounded-50 g-pa-7-16\" href=\"#\" aria-label=\"Previous\">";
                           echo "<span aria-hidden=\"true\">";
                           echo "<i class=\"fa fa-angle-left g-mr-5\"></i> Previous";
                           echo "</span>";
                           echo "<span class=\"sr-only\">Previous</span>";
                           echo "</a>";
                           echo "</li>";
                        } else {
                           echo "<li class=\"list-inline-item float-left g-hidden-xs-down\">";
                           echo "<a class=\"u-pagination-v1__item u-pagination-v1-4 g-brd-gray-light-v3 g-brd-primary--hover g-rounded-50 g-pa-7-16\" href=\"noticias.php?pg=".($page-1)."\" aria-label=\"Anterior\">";
                           echo "<span aria-hidden=\"true\">";
                           echo "<i class=\"fa fa-angle-left g-mr-5\"></i> Anterior";
                           echo "</span>";
                           echo "<span class=\"sr-only\">Anterior</span>";
                           echo "</a>";
                           echo "</li>";
                        }
                        
                        /* A los links del paginador se le suma 1 a la variable $i? para mantenerlo humanamente entendible (los simples mortales cuentan a partir de 1) */
                        /* Añadimos un control de botones para eviar que se muestren más de 5. */
                        $botones = 0;
                        for($i=0; $i < $max_num_paginas; $i++) {
                          $botones++;
                          if (($page - 4 + $i) > 0) {
                            $paginaParaMostrar = $page - 4 + $i;
                          } else {
                            $paginaParaMostrar = ($i+1);
                          }
                          echo "<li class=\"list-inline-item\">";
                          echo "<a class=\"u-pagination-v1__item u-pagination-v1-4 u-pagination-v1-4--active g-rounded-50 g-pa-7-14\" href=\"noticias.php?pg=".$paginaParaMostrar."\">".$paginaParaMostrar."</a>";
                          echo "</li>";
                          if ($botones == 9) break;
                        }
                        
                        // Botón "Siguiente"
                        if ($page == $max_num_paginas) {
                          echo "<li class=\"list-inline-item float-right g-hidden-xs-down\">";
                          echo "<a class=\"u-pagination-v1__item u-pagination-v1-4 g-brd-gray-light-v3 g-brd-primary--hover g-rounded-50 g-pa-7-16\" href=\"\" aria-label=\"Siguiemte\">";
                          echo "<span aria-hidden=\"true\">";
                          echo "<i class=\"fa fa-angle-right g-ml-5\"></i> Siguiente";
                          echo "</span>";
                          echo "<span class=\"sr-only\">Suiguiente</span>";
                          echo "</a>";
                          echo "</li>";
                        } else {
                          echo "<li class=\"list-inline-item float-right g-hidden-xs-down\">";
                          echo "<a class=\"u-pagination-v1__item u-pagination-v1-4 g-brd-gray-light-v3 g-brd-primary--hover g-rounded-50 g-pa-7-16\" href=\"noticias.php?pg=".($page+1)."\" aria-label=\"Siguiemte\">";
                          echo "<span aria-hidden=\"true\">";
                          echo "<i class=\"fa fa-angle-right g-ml-5\"></i> Siguiente";
                          echo "</span>";
                          echo "<span class=\"sr-only\">Suiguiente</span>";
                          echo "</a>";
                          echo "</li>";
                        }
                     ?>
        
                    </ul>
                  </nav>
                  <!-- Fin paginador -->
                  
                </div>
              </div>
      
              <div class="col-lg-4 g-brd-left--lg g-brd-gray-light-v4 g-mb-80">
                
                <article class="u-shadow-v21 g-bg-white g-brd-around g-brd-gray-light-v4 g-brd-top-2 g-brd-primary-top rounded g-pa-15">
                  <div class="media-body">
                    <div class="d-flex justify-content-between verde2">
                      <h4>Newsletter</h4>              
                    </div>
                    <h5>Suscríbete para estar al día de nuestras novedades</h5>
                    <div class="input-group g-mb-10">
                      <div class="input-group-prepend">
                        <span class="input-group-text g-bg-white g-color-gray-dark-v5 rounded-0"><i class="fa fa-envelope"></i></span>
                      </div>
                      <input class="form-control pl-0 u-form-control g-brd-left-none rounded-0 g-mr-15" type="text" placeholder="Introduce tu email...">
                      <div class="input-group-append">
                        <button class="btn u-btn-primary rounded-0">Suscribirse</button>
                      </div>
                    </div>
                    <label class="form-check-inline u-check g-pl-25">
                      <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox">
                      <div class="u-check-icon-checkbox-v4 g-absolute-centered--y g-left-0">
                        <i class="fa" data-check-icon=""></i>
                      </div>
                      He leído y acepto la <a href="politica.php" target="_blank">&nbsp;Política de Privacidad</a>
                    </label>
                  </div>
                </article>
                
                <hr class="g-my-20">
                                
                <article class="u-shadow-v21 g-bg-white g-brd-around g-brd-gray-light-v4 g-brd-top-2 g-brd-primary-top rounded g-pa-15">
                  <div class="media-body">
                    <div class="d-flex justify-content-between verde2">
                      <h4>Psicoterapia solidaria. Informate</h4>              
                    </div>
                    <a href="../nosotros/psicoterapia_solidaria.php"><img src="../imagenes/psicoterapiaSolidaria.jpg" width="300"/></a>
                  </div>
                </article>
                
                <hr class="g-my-20">
                
                <article class="u-shadow-v21 g-bg-white g-brd-around g-brd-gray-light-v4 g-brd-top-2 g-brd-primary-top rounded g-pa-15">
                  <div class="media-body">
                    <div class="d-flex justify-content-between verde2">
                      <h4>Facebook SEMPyP</h4>              
                    </div>
                    <div class="fb-page" data-href="https://www.facebook.com/SEMPyP" data-tabs="timeline" data-width="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/SEMPyP"><a href="https://www.facebook.com/SEMPyP">Sociedad Española de Medicina Psicosomática y Psicoterapia</a></blockquote></div></div>
                  </div>
                </article>
                
                <hr class="g-my-20">
                
                <article class="u-shadow-v21 g-bg-white g-brd-around g-brd-gray-light-v4 g-brd-top-2 g-brd-primary-top rounded g-pa-15">
                  <div class="media-body">
                    <div class="d-flex justify-content-between verde2">
                      <h4>Twitter SEMPyP</h4>              
                    </div>
                    <a class="twitter-timeline" lang="ES" href="https://twitter.com/SEMPyP" data-widget-id="676486534258913280">Tweets por el @SEMPyP.</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                  </div>
                </article>

              </div>
            </div>
          </div>
          <!-- End Blog Minimal Blocks -->


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
  
  <!-- Formulario de salto a noticia -->
  <form action="" id="formularioDeSaltoANoticia" method="post">
      <input type="hidden" name="id_de_noticia" id="id_de_noticia" value="" />
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
    // Paso a noticia individual
		function saltarADetalleNoticia (id) {
			document.getElementById("id_de_noticia").value = id;
			document.getElementById("formularioDeSaltoANoticia").action = "noticia.php";
			document.getElementById("formularioDeSaltoANoticia").submit();
		}
    
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
