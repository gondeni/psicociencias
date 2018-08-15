<?php
    header('Content-Type: text/html; charset=utf8');
    include ("../includes/config.php");
    include ("../includes/formatear_fechas.php");
    
    $nombreDeEmpresa = $_SESSION["nombre_de_empresa"];
    $id_de_curso = $_POST['id_de_curso'];
    /* Se genera una matriz con las articulos  de la web */

    $consulta = "SELECT * FROM `cursos` WHERE `iDDeCurso` = ".$id_de_curso."";
    $hacerConsulta = $conexion->prepare($consulta);
    $hacerConsulta->execute();
    $curso = $hacerConsulta->fetch(PDO::FETCH_OBJ);

    $consulta = "SELECT * FROM `sesiones` WHERE `id_de_curso` = ".$curso->{'idDeCurso'}." ORDER BY `fecha_de_sesion` DESC;";
    $hacerConsulta = $conexion->prepare($consulta);
    $hacerConsulta->execute();
    $sesiones = $hacerConsulta->fetchAll(PDO::FETCH_OBJ);
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
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Colorpicker -->
    <link href="../vendors/colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../vendors/datepicker/css/bootstrap-datepicker3.css">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          
          <?php include("../menu.php"); ?>  
          <?php include("../menu_top.php"); ?>
	  
        <!-- CONTENIDO PRINCIPAL -->
        <div class="right_col" role="main">
          <div class="row">
            <div class="page-title">
              <div class="title_left">
                <h3>Gesti&oacute;n de sesiones</h3>
                 <a class="btn btn-primary" data-toggle="modal" data-target="#modalPrimario">Nueva sesión</a>
              </div>
            </div>
          </div>
          <br/>
          <div class="row">
              <h4><?php echo $curso->{'nombreDeCurso'}?></h4>
              <?php
                if(empty($sesiones)){
              ?>
                <h3>No existen sesiones para el curso seleccionado.</h3>
              <?php }else{ ?>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
	    
                    <table id="secciones" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Fecha de la sesi&oacute;n</th>
                          <th>Estado de la sesi&oacute;n</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                        <?php
                          foreach($sesiones as $sesion){
                          ?>
                          <tr>
                            <td><?php echo formatear_fecha($sesion->{'fecha_de_sesion'},1)?></td>
                            <td><?php echo $sesion->{'estado_de_sesion'}?></td>
                            <td><i class="fa fa-trash borrar" onclick="borrar_sesion(this)" id="<?php echo $sesion->{'id_de_sesion'}?>" aria-hidden="true"></i></td>
                          </tr>
                          <?php
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
                <?php } ?>
            </div>
          </div>
          <!-- Modal -->
          <div class="modal" id="modalPrimario" aria-labelledby="modalLabel" data-backdrop="static" data-keyboard="true">
            <div class="modal-dialog modal-sm" id="dialogoModal">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="tituloDeModalPrimario">Nueva sesión</h4>
                </div>
                <div class="modal-body" id="cuerpoDeModalPrimario">
                  <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                      <div class="form-group" id='fecha_de_sesion'>
                        <label for="fecha_de_sesion">Fecha de sesión</label>
                        <div class='input-group date fecha'>
                          <input type='text' class="form-control input-sm" id='fecha_de_sesion' name="fecha_de_sesion"/>
                          <span class="input-group-addon input-sm"> <i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                      </div>
                  </div>
                    <!-- <a href="#" class="btn btn-default" id="color_sesion">Elija color para la sesión</a> -->
                  </div>
                </div>
                <div class="modal-footer" id ="pieDeModalPrimario">
                  <button type="button" id="bot_crear" class="btn btn-success btn-sm pull-left" onclick="nueva_sesion();" style="margin: 3px;">Crear</button>
                  <button type="button" id="bot_cerrar" class="btn btn-default btn-sm pull-right" onclick="$('#modalPrimario').modal('hide')" style="margin: 3px;">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
        <!-- FIN CONTENIDO PRINCIPAL -->

          <?php include("../footer.php"); ?>  

      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <!-- Colorpicker -->
    <script src="../vendors/colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>

    <!-- Datepicker -->
    <script src="../vendors/datepicker/js/bootstrap-datepicker.js"></script>
    <script src="../vendors/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
    <!-- Scripts personalizados -->
    <script language="javascript" type="text/javascript">

      var hoy = new Date();
      hoy = hoy.getDate() + "/" + (hoy.getMonth() + 1) + "/" + hoy.getFullYear();

      $(document).ready(function () {

          $('#datatable').dataTable();
      
          $('#datatable-responsive').DataTable();
        
          $('#datatable-fixed-header').DataTable({
            fixedHeader: true
          });
    
          // TableManageButtons.init();

          $('#secciones').DataTable( {
              "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
              "pageLength": 50,
              "ordering": false
            } );

          var handleDataTableButtons = function() {
            if ($("#datatable-buttons").length) {
                $("#datatable-buttons").DataTable({
                  dom: "Bfrtip",
                  responsive: true
                });
            }
          };

          $(function() {
              $('#color_sesion').colorpicker().on('changeColor', function(e) {
                  $('body')[0].style.backgroundColor = e.color.toString('rgba');
              });
          });

            $("#fecha_de_sesion .input-group.date").datepicker({
              format: "dd-mm-yyyy",
              language: 'es',
              autoclose: true,
              todayHighlight: true,
              startDate: hoy,
            }).datepicker("setDate", hoy);
            
      });


      
      function nueva_sesion(){

        var d = $("#fecha_de_sesion .input-group.date").datepicker("getDate");
        // var fecha  =  ("0" + d.getDate()).slice(-2) + "-" + ("0"+(d.getMonth()+1)).slice(-2) + "-" + d.getFullYear();
        var fecha  =  d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();

        $.ajax({
          type: "POST",
          url: "auxiliar_sesiones.php",
          data: {opt:'nuevo',id_de_curso:'<?php echo $curso->{"idDeCurso"}?>',fecha:fecha},
          async: false,
          success: function (data){
            console.log(data);
            if(data=='true'){
              location.reload();
            }else{
              alert("La fecha para la cita del curso ya existe. Por favor, elija otra.");
            }
          }
        });
      }

      //Recibe el elemento del html, del cual extraeremos el ID que nos interesa
      function borrar_sesion(e){
        var txt;
        var r = confirm("Va a borrar la sesión");
        if (r == true) {
          $.ajax({
            type: "POST",
            url: "auxiliar_sesiones.php",
            data: {opt:'borrar',id_de_sesion:e.id},
            async: false,
            success: function (data){
              location.reload();
            }
          });
        }
      }

      /* La siguiente funcion llama a la pagina de modificar articulo. */
      function saltarAModificarCurso(curso){
        document.getElementById("id_de_curso").value = curso;
        document.getElementById("formularioDeSalto").action = "editar_curso.php";
        document.getElementById("formularioDeSalto").submit();
      }      
      
      /* La siguiente funcion llama a la pagina de creacion de cita. */
      function saltarANuevaCita(curso){
        document.getElementById("id_de_curso").value = curso;
        document.getElementById("formularioDeSalto").action = "nueva_cita.php";
        document.getElementById("formularioDeSalto").submit();
      }
    
      /* La siguiente funcion llama a la pagina de borrar articulo. */
      function saltarABorrarCursoo(curso){
        if (confirm("El proceso de borrado es irreversible, realmente desea continuar?")){
          document.getElementById("idDeCurso").value = curso;
          document.getElementById("formularioDeSalto").action = "eliminar_curso.php";
          document.getElementById("formularioDeSalto").submit();
        }
      }

    </script>
  </body>
</html>