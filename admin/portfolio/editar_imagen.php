<?php
	header('Content-Type: text/html; charset=utf8');
	include ("../includes/config.php");
	
	$nombreDeEmpresa = $_SESSION["nombre_de_empresa"];
	
	/* Se establece la propiedad de la galeria y secciones para poder ubicar las imagnes en la bd */
	$propietaria = "maestro_de_portfolio";
	
	/* Se establece la página de retorno */
	$paginaDeRetorno = "editar_trabajo.php";
	
	/* Se recuperan las variables recibidas por post */
	$id_de_trabajo = $_POST["id_de_trabajo"];
	$id_de_foto = $_POST["id_de_foto"];
	
	/* Se recuperan los datos de elemento a modificar */
	$consulta = "SELECT * ";
	$consulta .= "FROM maestro_de_imagenes ";
	$consulta .= "WHERE id_de_foto = :idDeFoto;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->bindParam(":idDeFoto", $id_de_foto); // Se asigna una variable para la consulta.
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$matriz = $hacerConsulta->fetch(PDO::FETCH_ASSOC); // Se recuperan los resultados.
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
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <!-- Ckeditor -->
    <script src="../includes/ckeditor/ckeditor.js"></script>       
	<!-- CSS de BjqUpLoader -->
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstraptheme.min.css">
	<link rel="stylesheet" href="../includes/jqUploader/css/jqUploader.min.css">
	  
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          
          <?php include("../menu.php"); ?>  
          <?php include("../menu_top.php"); ?>
		
		</div>

          <!-- CONTENIDO PRINCIPAL -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Editar imagen</h3>
              </div>
            </div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
											
								<form action="grabar_cambios_imagen.php" method="POST" name="form" class="form-horizontal form-label-left" novalidate>
									<input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
									<input type="hidden" name="id_de_trabajo" value="<?php echo $id_de_trabajo; ?>" />
									<input type="hidden" name="id_de_foto" value="<?php echo $matriz["id_de_foto"]; ?>" />
					
									<span>&nbsp;</span>
					
									<div class="item form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-12" for="foto">&nbsp;</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<img src="../../imagenes/trabajos/<?php echo $matriz["nombre_de_foto"]; ?>"/>
										</div>
									</div>
									
									<div class="item form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Nombre de la imagen</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										   <input value="<?php echo $matriz["nombre_de_foto"]; ?>" class="form-control col-md-7 col-xs-12" type="text" disabled>
										</div>
									</div>
									
									<div class="item form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-12">Tipo de imagen</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										   <input value="<?php echo $matriz["tipo_de_foto"]; ?>" class="form-control col-md-7 col-xs-12" type="text" disabled>
										</div>
									</div>
									
									<div class="item form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-12">Peso de la imagen</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										   <input value="<?php echo $matriz["peso_de_foto"]." bytes"; ?>" class="form-control col-md-7 col-xs-12" type="text" disabled>
										</div>
									</div>
									
									<div class="item form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-12">Alt de imagen</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										   <input value="<?php echo $matriz["alt_de_imagen"]; ?>" id="alt_de_imagen" class="form-control col-md-7 col-xs-12" data-validate-length-range="0" data-validate-words="0" name="alt_de_imagen" type="text">
										</div>
									</div>
									
									<div class="item form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-12">Orden de imagen</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										   <input value="<?php echo $matriz["orden_de_imagen"]; ?>" id="orden_de_imagen" class="form-control col-md-7 col-xs-12" data-validate-length-range="0" data-validate-words="0" name="orden_de_imagen" type="text">
										</div>
									</div>
																		
									<div class="item form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-12">Descripci&oacute;n</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										   <input value="<?php echo $matriz["descripcion_de_imagen"]; ?>" id="descripcion_de_imagen" class="form-control col-md-7 col-xs-12" data-validate-length-range="0" data-validate-words="0" name="descripcion_de_imagen" type="text">
										</div>
									</div>
									
									<div class="item form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">Im&aacute;gen de portada </label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div id="imagen_de_portada" class="btn-group" data-toggle="buttons">
												<?php
													if ($matriz["imagen_de_portada"]== "P"){
														echo "<label class=\"btn btn-primary\" data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\">";
														echo "<input type=\"radio\" name=\"imagen_de_portada\" value=\"P\" checked=\"checked\"> &nbsp; Si &nbsp;";
														echo "</label>";
														echo "<label class=\"btn btn-default\" data-toggle-class=\"btn btn-default\" data-toggle-passive-class=\"btn-default\">";
														echo "<input type=\"radio\" name=\"imagen_de_portada\" value=\"N\"> &nbsp; No &nbsp;";
														echo "</label>";
													} else {
														echo "<label class=\"btn btn-default\" data-toggle-class=\"btn btn-default\" data-toggle-passive-class=\"btn-default\">";
														echo "<input type=\"radio\" name=\"imagen_de_portada\" value=\"P\"> &nbsp; Si &nbsp;";
														echo "</label>";
														echo "<label class=\"btn btn-primary\" data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\">";
														echo "<input type=\"radio\" name=\"imagen_de_portada\" value=\"N\"checked=\"checked\"> &nbsp; No &nbsp;";
														echo "</label>";
													}
												?>
											</div>
										</div>
									</div>
									
									<div class="item form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">Estado </label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div id="estado_de_imagen" class="btn-group" data-toggle="buttons">
												<?php
													if ($matriz["estado_de_imagen"]== "A"){
														echo "<label class=\"btn btn-primary\" data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\">";
														echo "<input type=\"radio\" name=\"estado_de_imagen\" value=\"A\" checked=\"checked\"> &nbsp; Activo &nbsp;";
														echo "</label>";
														echo "<label class=\"btn btn-default\" data-toggle-class=\"btn btn-default\" data-toggle-passive-class=\"btn-default\">";
														echo "<input type=\"radio\" name=\"estado_de_imagen\" value=\"I\"> &nbsp; Inactivo &nbsp;";
														echo "</label>";
													} else {
														echo "<label class=\"btn btn-default\" data-toggle-class=\"btn btn-default\" data-toggle-passive-class=\"btn-default\">";
														echo "<input type=\"radio\" name=\"estado_de_imagen\" value=\"A\"> &nbsp; Activo &nbsp;";
														echo "</label>";
														echo "<label class=\"btn btn-primary\" data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\">";
														echo "<input type=\"radio\" name=\"estado_de_imagen\" value=\"I\"checked=\"checked\"> &nbsp; Inactivo &nbsp;";
														echo "</label>";
													}
												?>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-md-6 col-md-offset-2">
											<button type="submit" class="btn btn-success">Aceptar</button>
											<button type="button" class="btn btn-primary" onClick="retornar();">Cancelar</button>
										</div>
									</div>
								</form>
								
							</div>

						</div> <!-- Div general panel -->
                    
                  </div>
                </div>
              </div>

            </div>
          </div>
        <!-- FIN CONTENIDO PRINCIPAL -->

        <?php include("../footer.php"); ?>  

		</div>
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
    <!-- validator -->
    <script src="../vendors/validator/validator.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
	<!-- Archivos de jqUploader -->
	<!-- JavaScript de jQuery 
	<script language="javascript" type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>-->
	<!-- JavaScript de jQueryUI -->
	<script src="https://code.jquery.com/ui/1.12.1/jqueryui.min.js"></script>
	<!-- JavaScript de Bootstrap 
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
	<!-- JavaScript de jqUploader -->
	<script language="javascript" type="text/javascript" src="../includes/jqUploader/js/jqUploader.js"></script>
    
    <script>
		
		/* La siguiente funcion se ejecutara si se pulsa el boton Cancelar*/
		function retornar(){
			document.getElementById("formRetorno").submit();
		}

		/* Validador */		
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
		/* Fin validador. */
    </script>
    
	<!-- El siguiente formulario se emplea para volver al documeto web que haya llamado a este. -->
	<form action="<?php  echo $paginaDeRetorno; ?>" name="formRetorno" id="formRetorno" method="post">
		<input type="hidden" name="id_de_trabajo" value="<?php echo $id_de_trabajo; ?>" />
		<input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
	</form>
  
  </body>
</html>