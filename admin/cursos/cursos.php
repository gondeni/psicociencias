<?php
    header('Content-Type: text/html; charset=utf8');
    include ("../includes/config.php");
    
    $nombreDeEmpresa = $_SESSION["nombre_de_empresa"];
    
    /* Se genera una matriz con las articulos  de la web */
    $matrizDeCursos = array();
    $consulta = "SELECT idDeCurso, nombreDeCurso, estado, modalidad ";
    $consulta .= "FROM cursos ";
    $consulta .= "ORDER BY modalidad ASC, nombreDeCurso ASC;";
    foreach ($conexion->query($consulta, PDO::FETCH_ASSOC) as $curso) $matrizDeCursos[] = $curso;

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
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Gesti&oacute;n de cursos</h3>
                 <a href="nuevo_curso.php" class="btn btn-primary">Nueva curso</a>
              </div>
            </div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
	    
                    <table id="secciones" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Nombre del curso</th>
                          <th>Modalidad</th>
                          <th class="text-center">Estado</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      <?php
                        foreach($matrizDeCursos as $curso) {
                          echo "<tr>";
                          
                          echo "<td>".$curso["nombreDeCurso"]."</td>";
                          
                          echo "<td>";
                          if ($curso["modalidad"] == "P") {
                            echo "Presencial";
                          } elseif ($curso["modalidad"] == "D") {
                            echo "On line";
                          } elseif ($curso["modalidad"] ==  "A") {
                            echo "P + D";
                          } elseif ($curso["modalidad"] == "X") {
                            echo "Máster";
                          } else {
                            echo "Sesiones";
                          }
                          echo "</td>";
                          
                          if ($curso["estado"] == "A") {
                            echo "<td class=\"text-center\"><span class=\"label label-success\">Activo</span></td>";
                          } else {
                            echo "<td class=\"text-center\"><span class=\"label label-danger\">Inactivo</span></td>";
                          }
                          
                          echo "<td class=\"text-center\">";
                          echo "<input type=\"button\" value=\"Modificar\" ";
                          echo "onClick=\"javascript:saltarAModificarCurso('".$curso["idDeCurso"]."');\" />";
                          echo "</td>";
                          echo "<td class=\"text-center\">";
                          echo "<input type=\"button\" value=\"Borrar\" ";
                          echo "onClick=\"javascript:saltarABorrarCurso('".$curso["idDeCurso"]."');\" />";
                          echo "</td>";
                          echo "</tr>";
                        }
                      ?>
                      </tbody>
                    </table>
                  </div>
                </div>
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

    <!-- Scripts personalizados -->
    <script language="javascript" type="text/javascript">
      function inicializar(){
      }
      
      /* La siguiente funcion llama a la pagina de modificar articulo. */
      function saltarAModificarCurso(curso){
        document.getElementById("id_de_curso").value = curso;
        document.getElementById("formularioDeSalto").action = "editar_curso.php";
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

      /* Datatables */
      $(document).ready(function() {
          $('#secciones').DataTable( {
            "language": {"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"},
            "pageLength": 50,
            "ordering": false
          } );
      } );
      
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
              $("#datatable-buttons").DataTable({
                dom: "Bfrtip",
                responsive: true
              });
          }
        };
    
        $('#datatable').dataTable();
      
        $('#datatable-responsive').DataTable();
      
        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });
      
        TableManageButtons.init();
      });

    </script>

    <!-- Formulario para modificar o borrar -->
    <form action="" id="formularioDeSalto" method="post">
            <input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
            <input type="hidden" name="id_de_curso" id="id_de_curso" value="" />
    </form>
     <!-- /Formulario para modificar o borrar -->

  </body>
</html>