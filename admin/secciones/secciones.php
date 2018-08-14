<?php
    header('Content-Type: text/html; charset=utf8');
    include ("../includes/config.php");
    
    $nombreDeEmpresa = $_SESSION["nombre_de_empresa"];
    
    /* Se genera una matriz con las secciones de la web */
    $matrizDeSecciones = array();
    $consulta = "SELECT id_de_seccion, id_de_padre, nombre_de_seccion, estado_de_seccion ";
    $consulta .= "FROM maestro_de_secciones ";
    $consulta .= "ORDER BY id_de_seccion ASC;";
    foreach ($conexion->query($consulta, PDO::FETCH_ASSOC) as $seccion) $matrizDeSecciones[] = $seccion;

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
		document.getElementById("id_de_seccion").value = seccion;
		document.getElementById("formularioDeSalto").action = "editar_seccion.php";
		document.getElementById("formularioDeSalto").submit();
	}

        /* La siguiente funcion llama a la pagina de borrar seccion. */
	function saltarABorrarSeccion(seccion){
		if (confirm("El proceso de borrado es irreversible, realmente desea continuar?")){
			document.getElementById("id_de_seccion").value = seccion;
			document.getElementById("formularioDeSalto").action = "eliminar_seccion.php";
			document.getElementById("formularioDeSalto").submit();
		}
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
                <h3>Gesti&oacute;n de las secciones de la web</h3>
                <a href="nueva_seccion.php" class="btn btn-primary">Nueva secci&oacute;n</a>
              </div>
            </div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <table id="secciones" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Nombre de la secci&oacute;n</th>
                          <th>Secci&oacute;n padre</th>
                          <th class="text-center">Estado</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      <?php
                        foreach($matrizDeSecciones as $seccion) {
							echo "<tr>";
							echo "<td>".$seccion["nombre_de_seccion"]."</td>";
							echo "<td>";
							if ($seccion["id_de_padre"] == 0) {
							  echo "--";
							} else {
							  $consulta = "SELECT nombre_de_seccion ";
							  $consulta .= "FROM maestro_de_secciones ";
							  $consulta .= "WHERE id_de_seccion=:idDePadre;";
							  $hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
							  $hacerConsulta->bindParam(":idDePadre", $seccion["id_de_padre"]); // Se asigna una variable para la consulta.
							  $hacerConsulta->execute(); // Se ejecuta la consulta.
							  $matriz = $hacerConsulta->fetch(PDO::FETCH_ASSOC); // Se recuperan los resultados.
							  $hacerConsulta->closeCursor(); // Se libera el recurso.
							  
							  echo $matriz["nombre_de_seccion"];
							}
							echo "</td>";
							if ($seccion["estado_de_seccion"] == "A") {
								echo "<td class=\"text-center\"><span class=\"label label-success\">Activa</span></td>";
							} else {
								echo "<td class=\"text-center\"><span class=\"label label-danger\">Inactiva</span></td>";
							}
							echo "<td class=\"text-center\">";
							echo "<input type=\"button\" value=\"Modificar\" ";
							echo "onClick=\"javascript:saltarAModificarSeccion('".$seccion["id_de_seccion"]."');\" />";
							echo "</td>";
							echo "<td class=\"text-center\">";
							echo "<input type=\"button\" value=\"Borrar\" ";
							echo "onClick=\"javascript:saltarABorrarSeccion('".$seccion["id_de_seccion"]."');\" disabled=\"true\" />";
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
        <input type="hidden" name="id_de_seccion" id="id_de_seccion" value="" />
    </form>
     <!-- /Formulario para modificar o borrar -->

  </body>
</html>