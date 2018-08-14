<?php
    header('Content-Type: text/html; charset=utf8');
    include ("../includes/config.php");
    
    $nombreDeEmpresa = $_SESSION["nombre_de_empresa"];
    
	/* Se genera una matriz con los elementod configurables por el usuario */
	$matrizDeSistema= array();
	$consulta = "SELECT id_de_sistema, nombres_para_mostrar, valor ";
	$consulta .= "FROM maestro_de_sistema ";
	$consulta .= "WHERE visible = :visible;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->bindValue(":visible", "S"); 
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$matrizDeSistema = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
	$hacerConsulta->closeCursor(); // Se libera el recurso.

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
      <!-- Scripts personalizados -->
      <script language="javascript" type="text/javascript">
	function inicializar(){
	}
        /* La siguiente funcion llama a la pagina de modificar seccion. */
	function saltarAModificarSeccion(seccion){
		document.getElementById("id_de_sistema").value = seccion;
		document.getElementById("formularioDeSalto").action = "editar_configuracion.php";
		document.getElementById("formularioDeSalto").submit();
	}
  </script>
      
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
                <h3>Configuraci&oacute;n</h3>
              </div>
            </div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <table id="config" class="table table-bordered">
                      <thead>
                        <tr>
                          <th class="col-md-2">Item</th>
                          <th class="col-md-10">Contenido</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      <?php
                        foreach($matrizDeSistema as $item) {
                          echo "<tr>";
                          echo "<td class=\"text-center\">";
			  echo $item["nombres_para_mostrar"]."</br>";
			  echo "<a href=\"javascript:saltarAModificarSeccion('".$item["id_de_sistema"]."');\">";
			  echo "(Modificar)";
			  echo "</a>";
			  echo "</td>";
                          echo "<td>".$item["valor"]."</td>";
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

    <!-- Datatables -->
    <script>
      $(document).ready(function() {
        $('#secciones').DataTable( {
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }
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
    <!-- /Datatables -->
    <!-- Formulario para modificar o borrar -->
    <form action="" id="formularioDeSalto" method="post">
            <input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
            <input type="hidden" name="id_de_sistema" id="id_de_sistema" value="" />
     <!-- /Formulario para modificar o borrar -->
    </form>
  </body>
</html>