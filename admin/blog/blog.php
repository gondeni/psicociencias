<?php
    header('Content-Type: text/html; charset=utf8');
    include ("../includes/config.php");
    
    /* Se recogen las varieables de sesion necesarias */
    $nombreDeEmpresa = $_SESSION["nombre_de_empresa"];
    $tipoDeUsuario = $_SESSION["tipo_de_usuario"];
    $idDeUsuario = $_SESSION["id_de_usuario"];
    
    /* Se recuperan los datos de elemento a modificar. Cada usuario solo podr‡ editar sus posts alvo que en el
    caso de asministradiores o superadministradores que podr‡n editar y eliminar cualquiera. */
    $consulta = "SELECT id_de_noticia, id_de_seccion, titulo_de_noticia, estado_de_noticia, ";
    $consulta .= "destacado_de_noticia, portada_de_noticia, usuario_de_creacion ";
    $consulta .= "FROM maestro_de_noticias ";
    $consulta .= "WHERE id_de_seccion = :idDeSeccion ";
    $consulta .= "ORDER BY id_de_noticia DESC;";
    $hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
    $hacerConsulta->bindValue(":idDeSeccion", 1);
    $hacerConsulta->execute(); // Se ejecuta la consulta.
    $matrizDeNoticias = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
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
                <h3>Gesti&oacute;n del noticias</h3>
                 <a href="nuevo_post.php" class="btn btn-primary">Nuevo post</a>
              </div>
            </div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
	    
                    <table id="secciones" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>T&iacute;tulo del post</th>
                          <th>Secci&oacute;n</th>
                          <th>Portada</th>
                          <th>Destacado</th>
                          <th class="text-center">Estado</th>
                          <th>&nbsp;</th>
                          <th>&nbsp;</th>
                        </tr>
                      </thead>
                      
                      <tbody>
                      <?php
                        foreach($matrizDeNoticias as $noticia) {
                          echo "<tr>";
                          
                          echo "<td>".$noticia["titulo_de_noticia"]."</td>";
                         
                          echo "<td>";
                          
                          $consulta = "SELECT nombre_de_seccion ";
                          $consulta .= "FROM maestro_de_clasificacion ";
                          $consulta .= "WHERE id_de_seccion = :idDeSeccion;";
                          $hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
                          $hacerConsulta->bindParam(":idDeSeccion", $noticia["id_de_seccion"]); // Se asigna una variable para la consulta.
                          $hacerConsulta->execute(); // Se ejecuta la consulta.
                          $matriz = $hacerConsulta->fetch(PDO::FETCH_ASSOC); // Se recuperan los resultados.
                          $hacerConsulta->closeCursor(); // Se libera el recurso.
                          
                          echo $matriz["nombre_de_seccion"];
                          echo "</td>";
                          
                          if ($noticia["portada_de_noticia"] == "S") {
                            echo "<td class=\"text-center\"><span class=\"label label-primary\">Si</span></td>";
                          } else {
                            echo "<td class=\"text-center\"><span class=\"label label-default\">No</span></td>";
                          }
                          
                          if ($noticia["destacado_de_noticia"] == "S") {
                            echo "<td class=\"text-center\"><span class=\"label label-warning\">Si</span></td>";
                          } else {
                            echo "<td class=\"text-center\"><span class=\"label label-default\">No</span></td>";
                          }
                          
                          if ($noticia["estado_de_noticia"] == "A") {
                            echo "<td class=\"text-center\"><span class=\"label label-success\">Activo</span></td>";
                          } else {
                            echo "<td class=\"text-center\"><span class=\"label label-danger\">Inactivo</span></td>";
                          }
                          
                          echo "<td class=\"text-center\">";
                          echo "<input type=\"button\" value=\"Modificar\" ";
                          echo "onClick=\"javascript:saltarAModificarNoticia('".$noticia["id_de_noticia"]."');\" />";
                          echo "</td>";
                          
                          echo "<td class=\"text-center\">";
                          echo "<input type=\"button\" value=\"Borrar\" ";
                          echo "onClick=\"javascript:saltarABorrarNoticia('".$noticia["id_de_noticia"]."');\" />";
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
            },
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
    <!-- /Datatables -->
    
    <!-- Scripts personalizados -->
    <script language="javascript" type="text/javascript">
      function inicializar(){
      }
            /* La siguiente funcion llama a la pagina de modificar noticia. */
      function saltarAModificarNoticia(noticia){
        document.getElementById("id_de_noticia").value = noticia;
        document.getElementById("formularioDeSalto").action = "editar_post.php";
        document.getElementById("formularioDeSalto").submit();
      }
    
            /* La siguiente funcion llama a la pagina de borrar noticia. */
      function saltarABorrarNoticia(noticia){
        if (confirm("El proceso de borrado es irreversible, realmente desea continuar?")){
          document.getElementById("id_de_noticia").value = noticia;
          document.getElementById("formularioDeSalto").action = "eliminar_post.php";
          document.getElementById("formularioDeSalto").submit();
        }
      }
    </script>
    
    <!-- Formulario para modificar o borrar -->
    <form action="" id="formularioDeSalto" method="post">
            <input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
            <input type="hidden" name="id_de_noticia" id="id_de_noticia" value="" />
     <!-- /Formulario para modificar o borrar -->
    </form>
  </body>
</html>