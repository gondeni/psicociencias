<?php
include('../includes/config_ini.php');

// Se recoge la variable recibida por POST
if (isset($_POST["id_de_curso"])) {
  $id_de_curso = $_POST["id_de_curso"];
} else {
  $id_de_curso = 6;
}

// Obtenemos los datos del curso */
$consulta = "SELECT *  ";
$consulta .= "FROM cursos ";
$consulta .= "WHERE idDeCurso = :idDeCurso;";
$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
$hacerConsulta->bindParam(":idDeCurso", $id_de_curso);
$hacerConsulta->execute(); // Se ejecuta la consulta.
$curso = $hacerConsulta->fetch(PDO::FETCH_ASSOC); // Se recuperan los resultados.
$hacerConsulta->closeCursor(); // Se libera el recurso.

// Obtenemos los datos de la sede */
$consulta = "SELECT *  ";
$consulta .= "FROM sedes ";
$consulta .= "WHERE idDeSede = :idDeSede;";
$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
$hacerConsulta->bindParam(":idDeSede", $curso["sede"]);
$hacerConsulta->execute(); // Se ejecuta la consulta.
$sede = $hacerConsulta->fetch(PDO::FETCH_ASSOC); // Se recuperan los resultados.
$hacerConsulta->closeCursor(); // Se libera el recurso.

// Obtenemos los cursos relacionados */
$consulta = "SELECT idDeCurso, nombreDeCurso, modalidad, sede, fechas, horarios, plazas ";
$consulta .= "FROM cursos ";
$consulta .= "WHERE idDeSeccion = :idDeSeccion ";
$consulta .= "AND estado = :estadoDeCurso ";
$consulta .= "ORDER BY RAND() ";
$consulta .= "LIMIT 3;";
$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
$hacerConsulta->bindValue(":idDeSeccion", 6);
$hacerConsulta->bindValue(":estadoDeCurso", "A");
$hacerConsulta->execute(); // Se ejecuta la consulta.
$cursosRelacionados = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
$hacerConsulta->closeCursor(); // Se libera el recurso.

// Se define el banner a mostrsr ebn función de si tenemos info en la bd o no.
if ($curso["banner"] != "") {
  $banner = $curso["banner"];
} else {
  $banner = "banner.jpg";
}

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

  <!-- Fullcalendar -->
  <link rel="stylesheet" href="../assets/fullcalendar-3.9.0/fullcalendar.css">

  <style>
  #loading {
    display: none;
    position: absolute;
    top: 10px;
    right: 10px;
  }

  #calendario {
    /* max-width: 700px; */
    margin: auto;
  }

  @media (min-width: 800px) {
      .modal-lg {
          width: 900px;
          height: 900px; /* control height here */
      }
  }

  </style>
</head>

<body>
  <main>

    <?php include ("../cabecera.php"); ?>

    <div class="container">
      <div class="row">
        <div class="col-md-12 g-px-0">

          <div class="g-bg-size-cover g-pos-rel g-height-370" data-bg-img-src="../imagenes/banner/<?php echo $banner; ?>">
            <div class="ml-auto g-width-40x--sm g-height-100x g-bg-white-opacity-0_7 g-pa-15">
              <div class="g-mb-10">
                <h3 class="h3 verde1 g-mb-15"><?php echo $curso["nombreDeCurso"]; ?></h3>
                <p class="verde1">Directora: Dª Begoña Aznárez</p>

                <div class="row g-mb-20">
                  <div class="col-md-1 g-font-size-25 verde1"><i class="icon-education-103 u-line-icon-pro"></i></div>
                  <div class="col-md-11 g-mt-5"><span class="g-font-weight-600 verde1">Modalidad:</span>
                    <?php
                    if ($curso["modalidad"] == "P") {
                      echo "Presencial";
                    } elseif ($curso["modalidad"] == "D") {
                      echo "Online";
                    } elseif ($curso["modalidad"] == "A") {
                      echo "Presencial y online";
                    } else {
                      echo "N/A";
                    }
                    ?>
                  </div>
                </div>

                <?php if ($curso["sede"] != "0") { ?>
                  <div class="row g-mb-20">
                    <div class="col-md-1 g-font-size-25 verde1 g-mt-5"><i class="icon-real-estate-077 u-line-icon-pro"></i></div>
                    <div class="col-md-11 "><span class="g-font-weight-600 verde1"><?php echo $sede["nombreDeSede"]; ?></span><br>
                      <?php echo $sede["direccionDeSede"]; ?></div>
                    </div>
                  <?php } ?>

                  <?php if ($curso["fechas"] != "") { ?>
                    <div class="row g-mb-20">
                      <div class="col-md-1 g-font-size-25 verde1 g-mt-5"><i class="fa fa-calendar"></i></div>
                      <div class="col-md-11 "><span class="g-font-weight-600 verde1">Fecha de sesiones presenciales</span><br>
                        <?php echo $curso["fechas"]; ?></div>
                      </div>
                    <?php } ?>

                    <?php if ($curso["horarios"] != "") { ?>
                      <div class="row">
                        <div class="col-md-1 g-font-size-25 verde1 g-mt-5"><i class="fa fa-clock-o"></i></div>
                        <div class="col-md-11 "><span class="g-font-weight-600 verde1">Horarios: </span><?php echo $curso["horarios"]; ?></div>
                      </div>
                    <?php } ?>

                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="row g-bg-verde1 g-color-white g-py-10 g-mb-20">
            <div class="col-md-8 col-sm-12">
              <h3><?php echo $curso["nombreDeCurso"]; ?></h3>
            </div>
            <div class="col-md-2 col-sm-6 text-center">
              <button class="btn btn-lg btn-warning g-font-weight-600 g-font-size-default rounded-3 btn-calendario" data-toggle="modal" data-target="#modalPrimario">Calendario</button>
            </div>
            <div class="col-md-2 col-sm-6 text-center">
              <a href="inscripciones.php" class="btn btn-lg u-btn-primary g-font-weight-600 g-font-size-default rounded-3 btn-matricula">Matricúlate online</a>
            </div>
          </div>
        </div>

        <section class="container g-pb-40">
          <div class="row justify-content-between">

            <div class="col-md-12">

              <div class="row g-pl-20">
                <div class="col-md-3">
                  <!-- Nav tabs -->
                  <ul class="nav flex-column u-nav-v8-2" role="tablist" data-target="nav-8-2-primary-ver" data-tabs-mobile-type="slide-up-down" data-btn-classes="btn btn-md btn-block rounded-0 u-btn-outline-primary">

                    <?php
                    if ($curso["tituloTab1"] != "") {
                      echo "<li class=\"nav-item\">";
                      echo "<a class=\"nav-link active\" data-toggle=\"tab\" href=\"#nav-8-2-primary-ver--1\" role=\"tab\">";
                      echo "<span class=\"u-nav-v8__icon u-icon-v3 u-icon-size--lg g-rounded-50x g-brd-around g-brd-4 g-brd-white\">";
                      echo "<i class=\"fa fa-file-text-o\"></i>";
                      echo "</span>";
                      echo "<strong class=\"text-uppercase u-nav-v8__title\">".$curso["tituloTab1"]."</strong>";
                      echo "</a>";
                      echo "</li>";
                    }

                    if ($curso["tituloTab2"] != "") {
                      echo "<li class=\"nav-item\">";
                      echo "<a class=\"nav-link\" data-toggle=\"tab\" href=\"#nav-8-2-primary-ver--2\" role=\"tab\">";
                      echo "<span class=\"u-nav-v8__icon u-icon-v3 u-icon-size--lg g-rounded-50x g-brd-around g-brd-4 g-brd-white\">";
                      echo "<i class=\"icon-education-092 u-line-icon-pro\"></i>";
                      echo "</span>";
                      echo "<strong class=\"text-uppercase u-nav-v8__title\">".$curso["tituloTab2"]."</strong>";
                      echo "</a>";
                      echo "</li>";
                    }

                    if ($curso["tituloTab3"] != "") {
                      echo "<li class=\"nav-item\">";
                      echo "<a class=\"nav-link\" data-toggle=\"tab\" href=\"#nav-8-2-primary-ver--3\" role=\"tab\">";
                      echo "<span class=\"u-nav-v8__icon u-icon-v3 u-icon-size--lg g-rounded-50x g-brd-around g-brd-4 g-brd-white\">";
                      echo "<i class=\"icon-education-197 u-line-icon-pro\"></i>";
                      echo "</span>";
                      echo "<strong class=\"text-uppercase u-nav-v8__title\">".$curso["tituloTab3"]."</strong>";
                      echo "</a>";
                      echo "</li>";
                    }

                    if ($curso["tituloTab4"] != "") {
                      echo "<li class=\"nav-item\">";
                      echo "<a class=\"nav-link\" data-toggle=\"tab\" href=\"#nav-8-2-primary-ver--4\" role=\"tab\">";
                      echo "<span class=\"u-nav-v8__icon u-icon-v3 u-icon-size--lg g-rounded-50x g-brd-around g-brd-4 g-brd-white\">";
                      echo "<i class=\"icon-education-176 u-line-icon-pro\"></i>";
                      echo "</span>";
                      echo "<strong class=\"text-uppercase u-nav-v8__title\">".$curso["tituloTab4"]."</strong>";
                      echo "</a>";
                      echo "</li>";
                    }

                    if ($curso["tituloTab5"] != "") {
                      echo "<li class=\"nav-item\">";
                      echo "<a class=\"nav-link\" data-toggle=\"tab\" href=\"#nav-8-2-primary-ver--5\" role=\"tab\">";
                      echo "<span class=\"u-nav-v8__icon u-icon-v3 u-icon-size--lg g-rounded-50x g-brd-around g-brd-4 g-brd-white\">";
                      echo "<i class=\"icon-finance-246 u-line-icon-pro\"></i>";
                      echo "</span>";
                      echo "<strong class=\"text-uppercase u-nav-v8__title\">".$curso["tituloTab5"]."</strong>";
                      echo "</a>";
                      echo "</li>";
                    }

                    if ($curso["tituloTab6"] != "") {
                      echo "<li class=\"nav-item\">";
                      echo "<a class=\"nav-link\" data-toggle=\"tab\" href=\"#nav-8-2-primary-ver--6\" role=\"tab\">";
                      echo "<span class=\"u-nav-v8__icon u-icon-v3 u-icon-size--lg g-rounded-50x g-brd-around g-brd-4 g-brd-white\">";
                      echo "<i class=\"icon-education-092 u-line-icon-pro\"></i>";
                      echo "</span>";
                      echo "<strong class=\"text-uppercase u-nav-v8__title\">".$curso["tituloTab6"]."</strong>";
                      echo "</a>";
                      echo "</li>";
                    }
                    ?>

                  </ul>
                  <!-- End Nav tabs -->
                </div>

                <div class="col-md-9 g-mb-20">
                  <!-- Tab panes -->
                  <div id="nav-8-2-primary-ver" class="tab-content g-pt-20 g-pt-0--md">

                    <?php

                    if ($curso["contenidoTab1"] != "") {
                      echo "<div class=\"tab-pane g-px-20 fade show active\" id=\"nav-8-2-primary-ver--1\" role=\"tabpanel\">";
                      echo $curso["contenidoTab1"];
                      echo "</div>";
                    }

                    if ($curso["contenidoTab2"] != "") {
                      echo "<div class=\"tab-pane g-px-20 fade\" id=\"nav-8-2-primary-ver--2\" role=\"tabpanel\">";
                      echo $curso["contenidoTab2"];
                      echo "</div>";
                    }

                    if ($curso["contenidoTab3"] != "") {
                      echo "<div class=\"tab-pane g-px-20 fade\" id=\"nav-8-2-primary-ver--3\" role=\"tabpanel\">";
                      echo $curso["contenidoTab3"];
                      echo "</div>";
                    }

                    if ($curso["contenidoTab4"] != "") {
                      echo "<div class=\"tab-pane g-px-20 fade\" id=\"nav-8-2-primary-ver--4\" role=\"tabpanel\">";
                      echo $curso["contenidoTab4"];
                      echo "</div>";
                    }

                    if ($curso["contenidoTab5"] != "") {
                      echo "<div class=\"tab-pane g-px-20 fade\" id=\"nav-8-2-primary-ver--5\" role=\"tabpanel\">";
                      echo $curso["contenidoTab5"];
                      echo "</div>";
                    }

                    if ($curso["contenidoTab6"] != "") {
                      echo "<div class=\"tab-pane g-px-20 fade\" id=\"nav-8-2-primary-ver--6\" role=\"tabpanel\">";
                      echo $curso["contenidoTab6"];
                      echo "</div>";
                    }

                    ?>

                  </div>
                  <!-- End Tab panes -->
                </div>
              </div>

            </div>
          </div>

          <div class="row">
            <div class="col-md-12">

              <div class="card g-brd-primary rounded-0">
                <h3 class="card-header h5 text-white g-bg-primary g-brd-transparent rounded-0">
                  <i class="fa fa-info-circle g-font-size-default g-mr-5"></i>
                  Solicita información
                </h3>

                <div class="card-block">

                  <!-- General Forms -->
                  <form class="" method="POST" action="">

                    <div class="row form-group g-mb-20">
                      <div class="col-md-6">
                        <input id="nombre" name="nombre" class="form-control form-control-md rounded-0" type="text" placeholder="Nombre">
                      </div>
                      <div class="col-md-6">
                        <input id="apellidos" name="apellidos" class="form-control form-control-md rounded-0" type="text" placeholder="Apellidos">
                      </div>
                    </div>

                    <div class="row form-group g-mb-20">
                      <div class="col-md-6">
                        <input id="profesion" name="profesion" class="form-control form-control-md rounded-0" type="text" placeholder="Profesión">
                      </div>
                      <div class="col-md-6">
                        <input id="email" name="email" class="form-control form-control-md rounded-0" type="email" placeholder="Email">
                      </div>
                    </div>

                    <div class="form-group g-mb-20">
                      <textarea id="consulta" name="consulta" class="form-control form-control-md g-resize-none rounded-0" rows="2" placeholder="Consulta"></textarea>
                    </div>

                    <div class="form-group g-mb-20">
                      <label class="form-check-inline u-check g-pl-25">
                        <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" type="checkbox">
                        <div class="u-check-icon-checkbox-v4 g-absolute-centered--y g-left-0">
                          <i class="fa" data-check-icon=""></i>
                        </div>
                        He leído y acepto la
                      </label>
                      <a href="../home/politica.php" target="_blank">Política de Privacidad</a>
                    </div>

                    <button class="btn btn-lg u-btn-primary g-font-weight-600 g-font-size-default rounded-3 text-uppercase g-py-5 g-px-20" type="submit" role="button">Enviar</button>

                  </form>
                  <!-- End General Forms -->

                </div>
              </div>
            </div>

          </div>

          <div class="row">
            <h4 class="col-md-12 verde2 g-mt-40 g-mb-20">Cursos relacionados</h4>

            <?php
            foreach ($cursosRelacionados as $relacionado) {
              echo "<div class=\"col-lg-4 col-md-6 g-mb-15 g-px-10\">";

              echo "<article class=\"g-bg-size-cover g-pos-rel article-cursos-home\" data-bg-img-src=\"../imagenes/cp_tp.jpg\">";
              echo "<div class=\"sombra-cursos-home ml-auto g-width-60x--sm g-bg-black-opacity-0_5 g-pa-15\">";
              echo "<div class=\"g-mb-70 titulo_de_curso\">";
              echo "<h4 class=\"h5 g-color-white g-mb-15\">".$relacionado["nombreDeCurso"]."</h4>";
              echo "</div>";
              echo "<div class=\"g-mb-30\">";
              echo "<p class=\"g-color-white-opacity-0_9\">¡Matrícula abierta!</p>";
              echo "</div>";
              echo "<a class=\"btn btn-md btn-block u-btn-primary g-font-weight-600 g-font-size-11 text-uppercase g-py-10\" href=\"#!\">";
              echo "<i class=\"g-mr-5 fa fa-info-circle\"></i>Más información";
              echo "</a>";
              echo "</div>";
              echo "</article>";

              echo "</div>";
            }
            ?>

          </div>
        </section>

        <!-- Modal -->
        <div class="modal" id="modalPrimario" tabindex="-1" aria-labelledby="modalLabel" >
          <div class="modal-dialog modal-lg" id="dialogoModal">
            <div class="modal-content">
              <div class="modal-body" id="cuerpoDeModalPrimario">
                <div id='calendario'></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" id="btnclose" data-dismiss="modal">Cerrar</button>
              </div>
            </div>
          </div>
        </div>

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

    <!-- JS Unify -->
    <script src="../assets/js/hs.core.js"></script>
    <script src="../assets/js/components/hs.header.js"></script>
    <script src="../assets/js/helpers/hs.hamburgers.js"></script>
    <script src="../assets/js/components/hs.tabs.js"></script>
    <script src="../assets/js/components/hs.go-to.js"></script>

    <!-- JS Customization -->
    <script src="../assets/js/custom.js"></script>

    <!-- Fullcalendar -->
    <script src="../assets/fullcalendar-3.9.0/lib/moment.min.js"></script>
    <script src="../assets/fullcalendar-3.9.0/fullcalendar.min.js"></script>
    <script src="../assets/fullcalendar-3.9.0/locale-all.js"></script>
    <script src="http://cdn.jsdelivr.net/qtip2/3.0.3/jquery.qtip.min.js"></script>

    <!-- JS Plugins Init. -->
    <script>
    $(document).ready(function() {
      var hoy = new Date();
      hoy =  hoy.getFullYear()+ "-" + (hoy.getMonth() + 1) + "-" + hoy.getDate();

      // initialization of tabs
      // $.HSCore.components.HSTabs.init('[role="tablist"]');

      $('#modalPrimario').on('show.bs.modal', function () {

        $.ajax({
          type: "POST",
          url: 'php/auxiliar_calendario.php',
          async: false
        });
        $('#calendario').fullCalendar({
          locale: 'es',
          header: {
            right: 'prev,next today',
            left: 'title',
          },
          defaultDate: hoy,
          editable: false,
          navLinks: true, // can click day/week names to navigate views
          eventLimit: true, // allow "more" link when too many events
          eventTextColor: 'white',
          events: {
            url: 'php/get-events.php',
            error: function() {
              $('#script-warning').show();
            }
          },
          eventRender: function(event, element) {
            element.qtip({
              content: event.title,
              style: {
                background: 'black',
                color: '#FFFFFF'
              },
              position: {
                my:'top-left'
                // corner: {
                //   target: 'center',
                //   tooltip: 'bottomMiddle'
                // }
              }
            });
          },
          loading: function(bool) {
            $('#loading').toggle(bool);
          }
        });
      });
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

    // $(document).on('ready', function () {
    //   // initialization of tabs
    //   $.HSCore.components.HSTabs.init('[role="tablist"]');
    // });

    $(window).on('resize', function () {
      setTimeout(function () {
        $.HSCore.components.HSTabs.init('[role="tablist"]');
      }, 200);
    });

    </script>

  </body>

  </html>
