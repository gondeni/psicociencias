<?php
    header('Content-Type: text/html; charset=utf8');
    include ("../includes/config.php");
    
    $nombreDeEmpresa = $_SESSION["nombre_de_empresa"];

    /* Se genera una matriz con los tipos de usuario de sistema */
    $matrizDeTiposDeUsuario = array();
    $consulta = "SELECT nombres_para_mostrar, valor ";
    $consulta .= "FROM maestro_de_sistema ";
    $consulta .= "WHERE nombre = :tipoDeUsuarios;";
    $hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
    $hacerConsulta->bindValue(":tipoDeUsuarios", "usersType"); 
    $hacerConsulta->execute(); // Se ejecuta la consulta.
    $matrizDeTiposDeUsuario = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
    $hacerConsulta->closeCursor(); // Se libera el recurso.
    
    /* Se genera una matriz con los usuarios registrado */
    $matrizDeUsuarios = array();
    $consulta = "SELECT * ";
    $consulta .= "FROM maestro_de_usuarios;";
    $hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
    $hacerConsulta->execute(); // Se ejecuta la consulta.
    $matrizDeUsuarios = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
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
                <h3>Gesti&oacute;n de usuarios</h3>
                 <a href="nuevo_usuario.php" class="btn btn-primary">Nuevo usuario</a>
              </div>
            </div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <table id="secciones" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Nombre</th>
                          <th>Apellidos</th>
                          <th>Tipo</th>
                          <th class="text-center">Estado</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      
                      <tbody>
						<?php
						  foreach($matrizDeUsuarios as $usuario) {
							echo "<tr>";
							echo "<td>".$usuario["nombre_de_usuario"]."</td>";
							echo "<td>".$usuario["apellidos_de_usuario"]."</td>";
							
							foreach($matrizDeTiposDeUsuario as $tipo) {
								if ($tipo["valor"] == $usuario["tipo_de_usuario"]) {
									echo "<td>".$tipo["nombres_para_mostrar"]."</td>";
								}
							}
							
							if ($usuario["estado_de_usuario"] == "A") {
								echo "<td class=\"text-center\"><span class=\"label label-success\">Activo</span></td>";
							} else {
								echo "<td class=\"text-center\"><span class=\"label label-danger\">Inactivo</span></td>";
							}
												
							echo "<td class=\"text-center\">";
							echo "<input type=\"button\" value=\"Modificar\" ";
							echo "onClick=\"javascript:saltarAModificarUsuario('".$usuario["id_de_usuario"]."');\" />";
							echo "</td>";
							
							echo "<td class=\"text-center\">";
							if ($usuario["tipo_de_usuario"] == "sadmin") {
								echo "<input type=\"button\" value=\"Borrar\" ";
								echo "onClick=\"javascript:saltarABorrarUsuario('".$usuario["id_de_usuario"]."');\" disabled/>";
							} else {
								echo "<input type=\"button\" value=\"Borrar\" ";
								echo "onClick=\"javascript:saltarABorrarUsuario('".$usuario["id_de_usuario"]."');\" />";
							}
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

	<script>
	/* Scripts personalizados */
		function inicializar(){
		}
		
		/* La siguiente funcion llama a la pagina de modificar seccion. */
		function saltarAModificarUsuario(usuario){
			document.getElementById("id_de_usuario").value = usuario;
			document.getElementById("formularioDeSalto").action = "editar_usuario.php";
			document.getElementById("formularioDeSalto").submit();
		}
	
		/* La siguiente funcion llama a la pagina de borrar seccion. */
		function saltarABorrarUsuario(usuario){
			if (confirm("El proceso de borrado es irreversible, realmente desea continuar?")){
				document.getElementById("id_de_usuario").value = usuario;
				document.getElementById("formularioDeSalto").action = "eliminar_usuario.php";
				document.getElementById("formularioDeSalto").submit();
			}
		}

		/* Datatables */
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
		/* /Datatables */
    </script>
	
    <!-- Formulario para modificar o borrar -->
    <form action="" id="formularioDeSalto" method="post">
            <input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
            <input type="hidden" name="id_de_usuario" id="id_de_usuario" value="" />
     <!-- /Formulario para modificar o borrar -->
    </form>
  </body>
</html>