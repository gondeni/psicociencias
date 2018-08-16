<?php
include('../includes/config_ini.php');
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


  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="http://cdn.jsdelivr.net/qtip2/3.0.3/jquery.qtip.min.css">

  <style>

  /* body {
  margin: 0;
  padding: 0;
  font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
  font-size: 14px;
  } */

  #script-warning {
    display: none;
    background: #eee;
    border-bottom: 1px solid #ddd;
    padding: 0 10px;
    line-height: 40px;
    text-align: center;
    font-weight: bold;
    font-size: 12px;
    color: red;
  }

  #loading {
    display: none;
    position: absolute;
    top: 10px;
    right: 10px;
  }

  #calendario {
    max-width: 900px;
    margin: 40px auto;
    padding: 0 10px;
  }

  </style>

</head>

<body>
  <main>

    <?php
    include ("../cabecera.php");
    ?>

    <div id='script-warning'>
      <code>php/get-events.php</code> must be running.
    </div>

    <div id='loading'>loading...</div>
    <div class="row">
      <div id='calendario'></div>
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

<!-- jQuery library -->
<script src="http://cdn.jsdelivr.net/qtip2/3.0.3/jquery.qtip.min.js"></script>
<script>

$(document).ready(function() {
  var hoy = new Date();
  hoy =  hoy.getFullYear()+ "-" + (hoy.getMonth() + 1) + "-" + hoy.getDate();

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
    editable: true,
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
          corner: {
            target: 'center',
            tooltip: 'bottomMiddle'
          }
        }
      });
    },
    loading: function(bool) {
      $('#loading').toggle(bool);
    }
  });

});

</script>
</body>

</html>
