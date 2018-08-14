<?php
	header('Content-Type: text/html; charset=utf8');
	include ("../includes/config.php");
	
	$nombreDeEmpresa = $_SESSION["nombre_de_empresa"];
		
	/* Se establece la propiedad de la galeria y secciones para poder ubicar las imagnes en la bd */
	$propietaria = "maestro_de_catalogo";
	
	/* Se establece la página de retorno */
	$paginaDeRetorno = "catalogo.php";
	
	/* Se crea una matriz de secciones para seleccionarla en el combo */
	$matrizDeSecciones = array();
	$consulta = "SELECT id_de_seccion, nombre_de_seccion ";
	$consulta .= "FROM maestro_de_clasificacion ";
	$consulta .= "WHERE entidad_propietaria = :seccionPropietaria ";
	$consulta .= "AND estado_de_seccion = :estadoDeSeccion ";
	$consulta .= "AND id_de_padre = :idDePadre ";
	$consulta .= "ORDER BY id_de_seccion ASC;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->bindValue(":idDePadre", 0); 
	$hacerConsulta->bindValue(":estadoDeSeccion", "A"); 
	$hacerConsulta->bindParam(":seccionPropietaria", $propietaria); 
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$matrizDeSecciones = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
	$hacerConsulta->closeCursor(); // Se libera el recurso.
	
	/* Se crea una matriz de subsecciones para seleccionarla en el combo */
	$matrizDeSubsecciones = array();
	$consulta = "SELECT id_de_seccion, nombre_de_seccion, id_de_padre ";
	$consulta .= "FROM maestro_de_clasificacion ";
	$consulta .= "WHERE entidad_propietaria = :seccionPropietaria ";
	$consulta .= "AND estado_de_seccion = :estadoDeSeccion ";
	$consulta .= "AND id_de_padre != :idDePadre ";
	$consulta .= "ORDER BY id_de_seccion ASC;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->bindValue(":idDePadre", 0); 
	$hacerConsulta->bindValue(":estadoDeSeccion", "A"); 
	$hacerConsulta->bindParam(":seccionPropietaria", $propietaria); 
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$matrizDeSubsecciones = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
	$hacerConsulta->closeCursor(); // Se libera el recurso.
	
	
	//echo "<pre>";
	//var_dump($matrizDeSubsecciones);
	//die();
	
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
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <!-- Ckeditor -->
    <script src="../includes/ckeditor/ckeditor.js"></script>
    <!-- Sceript personalizados -->
    <script language="javascript" type="text/javascript">
	/* La siguiente funcion se ejecutara si se pulsa el boton Cancelar*/
	function retornar(){
		document.getElementById("formRetorno").submit();
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
                <h3>Nuevo art&iacute;culo del cat&aacute;logo</h3>
              </div>
            </div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                    
                        <form action="grabar_articulo.php" method="POST" name="form" class="form-horizontal form-label-left" novalidate>

                            <span class="section">Datos de la art&iacute;culo del cat&aacute;logo</span>

                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Nombre<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <input id="nombre_de_articulo" class="form-control col-md-7 col-xs-12" data-validate-length-range="0" data-validate-words="0" name="nombre_de_articulo" placeholder="Nombre de art&iacute;culo" required="required" type="text">
                                </div>
                            </div>
							<div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Secci&oacute;n</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">							
									<select class="form-control" id="id_de_seccion" name="id_de_seccion">
										<?php
											foreach($matrizDeSecciones as $seccion) {
												echo "<option value=\"".$seccion["id_de_seccion"]."\">".$seccion["nombre_de_seccion"]."</option>\n";
												foreach ($matrizDeSubsecciones as $subseccion) {
													if ($seccion["id_de_seccion"] == $subseccion["id_de_padre"]) {
														echo "<option value=\"".$subseccion["id_de_seccion"]."\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$subseccion["nombre_de_seccion"]."</option>\n";
													}
												}
											}
										?>
									</select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">Descripci&oacute;n</label>
                                <div class="col-md-8 col-sm-6 col-xs-12">
                                    <textarea name="descripcion_de_articulo" id="descripcion_de_articulo" class="form-control col-md-7 col-xs-12"></textarea>
                                        <script>
                                                CKEDITOR.replace( 'descripcion_de_articulo' );
                                                CKEDITOR.add
                                        </script>    
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Precio</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <input id="precio_de_articulo" class="form-control col-md-7 col-xs-12" name="precio_de_articulo" placeholder="Precio en &euro;" type="text">
                                </div>
                            </div>
			    <div class="item form-group">
				<label class="control-label col-md-2 col-sm-2 col-xs-12">Destacado</label>
				<div class="col-md-8 col-sm-6 col-xs-12">
					<div class="">
						<label><input type="checkbox" class="js-switch" id="articulo_destacado" name="articulo_destacado" /></label>
					</div>
				</div>
			    </div>
			    <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">Estado </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="estado_de_articulo" class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="estado_de_articulo" value="A" checked="checked"> &nbsp; Activo &nbsp;
                                        </label>
                                        <label class="btn btn-default" data-toggle-class="btn btn-default" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="estado_de_articulo" value="I"> Inactivo
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Palabras clave</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <input id="keywords_de_articulo" class="form-control col-md-7 col-xs-12" name="keywords_de_articulo" placeholder="Palabras clave" type="text">
                                </div>
                            </div>
			    <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-2">
                                        <button type="submit" class="btn btn-success">Aceptar</button>
                                        <button type="button" class="btn btn-primary" onClick="javascript:retornar();">Cancelar</button>
                                    </div>
                            </div>
                       </form>
                    
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
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- validator -->
    <script src="../vendors/validator/validator.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    
    <!-- validator -->
    <script>
      // initialize the validator function
      validator.message.date = 'not a real date';

      // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
      $('form')
        .on('blur', 'input[required], input.optional, select.required', validator.checkField)
        .on('change', 'select.required', validator.checkField)
        .on('keypress', 'input[required][pattern]', validator.keypress);

      $('.multi.required').on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

      $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;

        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
          submit = false;
        }

        if (submit)
          this.submit();

        return false;
      });
    </script>
    <!-- /validator -->
	<!-- El siguiente formulario se emplea para volver al documeto web que haya llamado a este. -->
	<form action="<?php  echo $paginaDeRetorno; ?>" name="formRetorno" id="formRetorno" method="post">
		<input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
	</form>
  </body>
</html>