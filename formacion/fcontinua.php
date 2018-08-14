<?php
  include('../includes/config_ini.php');
  
  /* Hacemos consulta de entidades */
	$consulta = "SELECT idDeCurso, nombreDeCurso, modalidad, plazas, banner ";
	$consulta .= "FROM cursos ";
  $consulta .= "WHERE estado = :estadoDeCurso ";
  $consulta .= "AND idDeSeccion = :idDeSeccion ";
  $consulta .= "AND modalidad = :modalidadDeCurso ";
  $consulta .= "ORDER BY orden ASC;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
  $hacerConsulta->bindValue(":estadoDeCurso", "A");
  $hacerConsulta->bindValue(":idDeSeccion", "7");
  $hacerConsulta->bindValue(":modalidadDeCurso", "Y");
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$matrizDeCursos = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
	$hacerConsulta->closeCursor(); // Se libera el recurso.
  $numeroDeCursos = count($matrizDeCursos);

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
      <div class="divimage dzsparallaxer--target w-100 u-bg-overlay g-bg-black-opacity-0_4--after" style="height: 140%; background-image: url(../imagenes/fcontinua.jpg);"></div>
      <!-- End Parallax Image -->

      <!-- Promo Block Content -->
      <div class="container g-color-white text-center g-py-140">
        <h3 class="display-5 g-font-weight-300 text-uppercase g-letter-spacing-1 mb-0">Formación Contínua</h3>
        <h3 class="display-6 g-font-weight-300 text-uppercase g-letter-spacing-1 mb-0">Actividades extracurriculares impartidas por figuras destacadas de la psicoterapia</h3>
      </div>
      <!-- Promo Block Content -->
    </section>
    <!-- End Promo Block -->

    <section class="container g-pt-50 g-pb-40">
      <div class="row justify-content-between">
        <div class="col-lg-12 g-mb-20">
          <!--<h2 class="h3">Formación Contínua</h2>
          
          <p>Bajo la convicción de que la formación continua es imprescindible para el reciclaje profesional que garantiza una actuación terapéutica eficaz,
					la SEMPyP ofrece a sus alumnos del Máster la oportunidad de participar de manera gratuita, en actividades extracurriculares impartidas por figuras
					destacadas de la psicoterapia.</p>
          
          <div class="alert alert-success" role="alert">
            <a href="../nosotros/entidades.php">Práctica Clínica Supervisada</a>
          </div>
          
          <div class="alert alert-success" role="alert">
            Talleres y seminarios 2018-19:
          </div>-->
          
          <div class="row">
            
            <div class="col-md-12">                                  
              <div class="g-brd-around g-brd-gray-light-v4 g-brd-top-3 g-brd-primary-top g-rounded-3 g-pa-20 g-mb-7">
                <div class="text-center">
                  <h3 class="g-font-weight-600 verde2">Mentoring: el proceso de convertirse en psicoterapeuta</h3>
                </div>
                <p class="text-center"><i class="fa fa fa-calendar"></i> 10 Ene. / 7 Feb. / 14 Mar. / 11 Abr. / 23 May.</p>
                <p class="text-center"><a href="javascript:saltarACurso(39);">///// Más informción</a></p>
              </div>
            </div>
          
          </div>
              
          <div class="row">
            
            <div class="col-md-6 g-mb-30">
              <article class="g-bg-size-cover g-pos-rel" data-bg-img-src="../imagenes/cursos/apego_mini.jpg">
                <div class="ml-auto g-width-50x--sm g-bg-black-opacity-0_5 g-pa-30">
                  <div class="g-mb-120">
                    <h3 class="h4 g-color-white g-mb-15"><small>Formación continua en</small> Apego y Psicoterapia</h3>
                  </div>          
                  <a class="btn btn-md btn-block u-btn-primary g-font-weight-600 g-font-size-11 text-uppercase g-py-10" href="javascript:saltarACurso(40);">
                    <i class="g-mr-5 fa fa-info-circle"></i>Más información
                  </a>
                </div>
              </article>
            </div>
          
            <div class="col-md-6 g-mb-30">
              <article class="g-bg-size-cover g-pos-rel" data-bg-img-src="../imagenes/cursos/coaching.jpg">
                <div class="ml-auto g-width-50x--sm g-bg-black-opacity-0_5 g-pa-30">
                  <div class="g-mb-60">
                    <h3 class="h4 g-color-white g-mb-15"><small>Formación continua en</small> Herramientas de Coaching en Psicoterapia Breve</h3>
                  </div>          
                  <a class="btn btn-md btn-block u-btn-primary g-font-weight-600 g-font-size-11 text-uppercase g-py-10" href="javascript:saltarACurso(30);">
                    <i class="g-mr-5 fa fa-info-circle"></i>Más información
                  </a>
                </div>
              </article>
            </div>           
            
          </div> <!-- //row -->
					
          <div class="row">
            
            <div class="col-md-6 g-mb-30">
              <article class="g-bg-size-cover g-pos-rel" data-bg-img-src="../imagenes/cursos/intervencion.jpg">
                <div class="ml-auto g-width-50x--sm g-bg-black-opacity-0_5 g-pa-30">
                  <div class="g-mb-0">
                    <h3 class="h4 g-color-white g-mb-15"><small>Formación continua en</small> Intervención en duelo: Inteligencia emocional aplicada a la pérdida</h3>
                  </div>          
                  <a class="btn btn-md btn-block u-btn-primary g-font-weight-600 g-font-size-11 text-uppercase g-py-10" href="javascript:saltarACurso(35);">
                    <i class="g-mr-5 fa fa-info-circle"></i>Más información
                  </a>
                </div>
              </article>
            </div>
          
            <div class="col-md-6 g-mb-30">
              <article class="g-bg-size-cover g-pos-rel" data-bg-img-src="../imagenes/cursos/guion.jpg">
                <div class="ml-auto g-width-50x--sm g-bg-black-opacity-0_5 g-pa-30">
                  <div class="g-mb-75">
                    <h3 class="h4 g-color-white g-mb-15"><small>Formación continua en</small> Guion de Vida en Psicoterapia Breve</h3>
                  </div>          
                  <a class="btn btn-md btn-block u-btn-primary g-font-weight-600 g-font-size-11 text-uppercase g-py-10" href="javascript:saltarACurso(27);">
                    <i class="g-mr-5 fa fa-info-circle"></i>Más información
                  </a>
                </div>
              </article>
            </div>           
            
          </div> <!-- //row -->					
					
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
  <form action="" id="formularioDeSalto" method="post">
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

  <!-- JS Unify -->
  <script src="../assets/js/hs.core.js"></script>
  <script src="../assets/js/components/hs.header.js"></script>
  <script src="../assets/js/helpers/hs.hamburgers.js"></script>
  <script src="../assets/js/components/hs.tabs.js"></script>
  <script src="../assets/js/components/hs.go-to.js"></script>

  <!-- JS Plugins Init. -->
  <script>
    
      // Paso a curso individual
      function saltarACurso (id) {
        document.getElementById("id_de_curso").value = id;
        document.getElementById("formularioDeSalto").action = "curso.php";
        document.getElementById("formularioDeSalto").submit();
      }
    
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
      
  </script>

</body>

</html>
