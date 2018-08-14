<?php
	header('Content-Type: text/html; charset=utf8');
	include ("../includes/config.php");
	
	$nombreDeEmpresa = $_SESSION["nombre_de_empresa"];
	
	/* Se establece la propiedad de la galeria y secciones para poder ubicar las imagnes en la bd */
	$propietaria = "maestro_de_portfolio";
	
	/* Se establece la página de retorno */
	$paginaDeRetorno = "portfolio.php";
	
	/* Se recuperan los datos de elemento a modificar */
	$id_de_trabajo = $_POST["id_de_trabajo"];
	$consulta = "SELECT * ";
	$consulta .= "FROM maestro_de_portfolio ";
	$consulta .= "WHERE id_de_trabajo = :idDeTrabajo;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->bindParam(":idDeTrabajo", $id_de_trabajo); // Se asigna una variable para la consulta.
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$matriz = $hacerConsulta->fetch(PDO::FETCH_ASSOC); // Se recuperan los resultados.
	$hacerConsulta->closeCursor(); // Se libera el recurso.
	
	/* Se crea una matriz de secciones para seleccionarla en el combo */
	$matrizDeSecciones = array();
	$consulta = "SELECT id_de_seccion, nombre_de_seccion ";
	$consulta .= "FROM maestro_de_clasificacion ";
	$consulta .= "WHERE entidad_propietaria = :seccionPropietaria ";
	$consulta .= "AND estado_de_seccion = :estadoDeSeccion ";
	$consulta .= "ORDER BY id_de_seccion ASC;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->bindValue(":estadoDeSeccion", "A"); 
	$hacerConsulta->bindParam(":seccionPropietaria", $propietaria); 
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$matrizDeSecciones = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
	$hacerConsulta->closeCursor(); // Se libera el recurso.
	
	/* Se crea una matriz de imagenes para el trabajo seleccionado  */
	$matrizDeFotos = array();
	$consulta = "SELECT id_de_foto, nombre_de_foto, orden_de_imagen, imagen_de_portada, estado_de_imagen ";
	$consulta .= "FROM maestro_de_imagenes ";
	$consulta .= "WHERE galeria_propietaria = :galeriaPropietaria ";
	$consulta .= "AND id_de_elemento = :idDeTrabajo ";
	$consulta .= "ORDER BY imagen_de_portada ASC, estado_de_imagen ASC, orden_de_imagen ASC;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->bindParam(":idDeTrabajo", $id_de_trabajo); // Se asigna una variable para la consulta.
	$hacerConsulta->bindParam(":galeriaPropietaria", $propietaria); // Se asigna una variable para la consulta.
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$matrizDeFotos = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
	$numero_de_fotos = count($matrizDeFotos);
	$hacerConsulta->closeCursor(); // Se libera el recurso.
	
	/* Se crea una matriz con los usuario clientes para asignar la galería si fuese necesario, es decir, si es privada,
	en caso contrario se dejara como pública (cliente = 0). */
	$matrizDeClientes = array();
	$consulta = "SELECT id_de_usuario, nombre_de_usuario, apellidos_de_usuario ";
	$consulta .= "FROM maestro_de_usuarios ";
	$consulta .= "WHERE tipo_de_usuario = :tipoDeUsuario ";
	$consulta .= "AND estado_de_usuario = :estadoDeUsuario ";
	$consulta .= "ORDER BY apellidos_de_usuario ASC;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->bindValue(":tipoDeUsuario", "cliente"); 
	$hacerConsulta->bindValue(":estadoDeUsuario", "A"); 
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$matrizDeClientes = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
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
                <h3>Editar art&iacute;culo</h3>
              </div>
            </div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
			
					<div>
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#datos" aria-controls="datos" role="tab" data-toggle="tab">Datos generales</a></li>
							<li role="presentation"><a href="#imagenes" aria-controls="imagenes" role="tab" data-toggle="tab">Im&aacute;genes</a></li>
							<li role="presentation"><a href="#imagenNueva" aria-controls="imagenNueva" role="tab" data-toggle="tab">Cargar im&aacute;genes</a></li>
						</ul>
						  
						<!-- Tab panes -->
						<div class="tab-content">
							
							<div role="tabpanel" class="tab-pane active" id="datos">
								
								<form action="grabar_cambios_trabajo.php" method="POST" name="form" class="form-horizontal form-label-left" novalidate>
									<input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
									<input type="hidden" name="id_de_trabajo" value="<?php echo $matriz["id_de_trabajo"]; ?>" />
					
									<span>&nbsp;</span>
					
									<div class="item form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Nombre <span class="required">*</span></label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										   <input value="<?php echo $matriz["nombre_de_trabajo"]; ?>" id="nombre_de_trabajo" class="form-control col-md-7 col-xs-12" data-validate-length-range="0" data-validate-words="0" name="nombre_de_trabajo" required="required" type="text">
										</div>
									</div>
									
									<div class="item form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Secci&oacute;n</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<select class="form-control" name="id_de_seccion" id="id_de_seccion">
												<?php
													$selected = "";
													if ($matriz["id_de_seccion"] == 0) $selected = "selected";;
													foreach ($matrizDeSecciones as $seccion){
														if ($matriz["id_de_seccion"] == $seccion["id_de_seccion"]){
															echo "<option value=\"".$seccion["id_de_seccion"]."\" selected>".$seccion["nombre_de_seccion"]."</option>\n";
														} else {
															echo "<option value=\"".$seccion["id_de_seccion"]."\">".$seccion["nombre_de_seccion"]."</option>\n";
														}
													}
												?>
											</select>
										</div>
									</div>
									
									<div class="item form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Cliente</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<select class="form-control" name="cliente_de_trabajo" id="cliente_de_trabajo">
												<?php
													if ($matriz["cliente_de_trabajo"] == 0) {
														echo "<option value=\"0\" selected>Galer&iacute;a p&uacute;blica (web)</option>";
													} else {
														echo "<option value=\"0\">Galer&iacute;a p&uacute;blica (web)</option>";
													}
													foreach ($matrizDeClientes as $cliente){
														if ($matriz["cliente_de_trabajo"] == $cliente["id_de_usuario"]){
															echo "<option value=\"".$cliente["id_de_usuario"]."\" selected>".$cliente["apellidos_de_usuario"].", ".$cliente["nombre_de_usuario"]."</option>\n";
														} else {
															echo "<option value=\"".$cliente["id_de_usuario"]."\">".$cliente["apellidos_de_usuario"].", ".$cliente["nombre_de_usuario"]."</option>\n";
														}
													}
												?>
											</select>
										</div>
									</div>
									
									<div class="item form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">Descripci&oacute;n</label>
										<div class="col-md-8 col-sm-6 col-xs-12">
											<textarea name="descripcion_de_trabajo" id="descripcion_de_trabajo" class="form-control col-md-7 col-xs-12">
											<?php echo $matriz["descripcion_de_trabajo"]; ?>
											</textarea>
											<script>
												CKEDITOR.replace( 'descripcion_de_trabajo' );
												CKEDITOR.add
											</script>    
										</div>
									</div>
									
									<div class="item form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Palabras clave </label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										   <input value="<?php echo $matriz["keywords_de_trabajo"]; ?>" id="keywords_de_trabajo" class="form-control col-md-7 col-xs-12" name="keywords_de_trabajo" type="text">
										</div>
									</div>
									
									<div class="item form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Orden</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
										   <input value="<?php echo $matriz["orden_de_trabajo"]; ?>" id="orden_de_trabajo" class="form-control col-md-7 col-xs-12" data-validate-length-range="0" data-validate-words="0" name="orden_de_trabajo" type="text">
										</div>
									</div>
									
									<div class="item form-group">
										<label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">Estado </label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div id="estado_de_trabajo" class="btn-group" data-toggle="buttons">
												<?php
													if ($matriz["estado_de_trabajo"]== "A"){
														echo "<label class=\"btn btn-primary\" data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\">";
														echo "<input type=\"radio\" name=\"estado_de_trabajo\" value=\"A\" checked=\"checked\"> &nbsp; Activo &nbsp;";
														echo "</label>";
														echo "<label class=\"btn btn-default\" data-toggle-class=\"btn btn-default\" data-toggle-passive-class=\"btn-default\">";
														echo "<input type=\"radio\" name=\"estado_de_trabajo\" value=\"I\"> &nbsp; Inactivo &nbsp;";
														echo "</label>";
													} else {
														echo "<label class=\"btn btn-default\" data-toggle-class=\"btn btn-default\" data-toggle-passive-class=\"btn-default\">";
														echo "<input type=\"radio\" name=\"estado_de_trabajo\" value=\"A\"> &nbsp; Activo &nbsp;";
														echo "</label>";
														echo "<label class=\"btn btn-primary\" data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\">";
														echo "<input type=\"radio\" name=\"estado_de_trabajo\" value=\"I\"checked=\"checked\"> &nbsp; Inactivo &nbsp;";
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
							
							<div role="tabpanel" class="tab-pane" id="imagenes">
								<span>&nbsp;</span>
								<?php
									if ($numero_de_fotos == 0){
										echo "<div class=\"col-md-12 bg-danger\">";
										echo "<br />En este momento el art&iacute;culo seleccionada no tiene im&aacute;genes disponibles.<br />";
										echo "Puedes grabar una im&aacute;gen nueva, en la pesta&ntilde;a correspondiente.<br /><br />";
										echo "</div>";
		
									} else {
										$contador = 0;
										echo "<div class=\"row\">";
										foreach ($matrizDeFotos as $foto) {											

											echo "<div class=\"col-md-3 col-sm-6\">";
											
											echo "<div class=\"thumbnail\">";
											echo "<img src=\"../../imagenes/trabajos/".$foto["nombre_de_foto"]."\" alt=\"".$foto["alt_de_imagen"]."\" >";
											echo "</div>"; // cierre thumbnail
											
											echo "<div class=\"caption\">";
											
											if ($foto["imagen_de_portada"] == "P") {
												echo "<h4>&nbsp;&nbsp;Imagen de portada</h4>";
											} else {
												echo "<p>&nbsp;</p>";												
											}
											
											echo "<h4>&nbsp;&nbsp;".$foto["nombre_de_foto"]." (".$foto["orden_de_imagen"].")</h4>";
																					
											if ($foto["estado_de_imagen"] == "A") {
												echo "<p>&nbsp;&nbsp;Estado: activa</p>";
											} else {
												echo "<p>&nbsp;&nbsp;Estado: inactiva</p>";
											}
											
											echo "<p>";
											echo "&nbsp;&nbsp;<a href=\"javascript:modificarImagen('".$foto["id_de_foto"]."');\" class=\"btn btn-success\" role=\"button\">Modificar</a>";
											echo "&nbsp;&nbsp;<a href=\"javascript:eliminarImagen('".$foto["id_de_foto"]."');\" class=\"btn btn-primary\" role=\"button\">Eliminar</a>";
											echo "</p>";
											
											echo "</div>"; // cierre caption
											
											echo "</div>"; // Cierre celda
											
											$contador++;
											if ($contador%4 == 0 && $contador == $numero_de_fotos) {
												echo "</div><div class=\"row\">&nbsp;</div>"; // Si contador es multiplo de 4 e igual a total de fotos cerramos y fin.
											} elseif($contador%4 == 0) {
												echo "</div><div class=\"row\">&nbsp;</div><div class=\"row\">"; // Si contador es multiplo de 4 cerramos y nueva fila.
											} elseif ($contador == $numero_de_fotos) {
												echo "</div><div class=\"row\">&nbsp;</div>"; // Si contador es igual a total de fotos cerramos y fin.
											}
											
										}
									} 
								?>
							</div>
							
							<div role="tabpanel" class="tab-pane" id="imagenNueva">
								<!-- El contenedor de jqUpLoader que será convertido en la herramienta de subida de archivos -->
								<div id="contenedor_de_archivos"></div>
							</div>
							
						</div> <!-- Div tab content-->
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
		/* Creamos un objeto para extender el contenedor de jqUpLoadercon la funcionalidad del plugin. */
		var subidor = $('#contenedor_de_archivos').jqUploader({
			url_destino: 'grabar_imagenes.php',
			color_fondo: 'rgb(255, 255, 255)',
			color_fondo_encabezado_y_pie: 'rgba(200, 200, 200, 1)',
			borde:'1px dashed black',
			altura: '600px',
			anchura: '100%',
			anchura_min: '30%',
			altura_min: '100px',
			peso_maximo_de_cada_archivo: '2M',
			peso_maximo_de_la_subida: '100M',
			maximo_numero_de_archivos: 50,
			tipos_de_archivo: new Array(
			'image/jpeg'
			),
			campos_complementarios: new Array(
				new Array('Descripci&oacute;n', 'text', 'descripcion',	'maxlength=10'),
				new Array('Portada (introducir P para portada)', 'text', 'portada', 'maxlength=1')
			),
			campos_procedentes_de_la_pagina: new Array(
				'id_de_trabajo'
			),
			accion_de_subida_correcta: 'C'
		});
		/* Script personalizados */
		
		/* La siguiente funcion se ejecutara si se pulsa el boton Cancelar*/
		function retornar(){
			document.getElementById("formRetorno").submit();
		}
		
		function eliminarImagen(id){
			if (confirm("El proceso de borrado es irreversible, realmente quieres continuar?")){
				document.getElementById("id_de_foto").value = id;
				document.getElementById("formularioDeSalto").action = "borrar_imagen.php";
				document.getElementById("formularioDeSalto").submit();
			}	
		}
		
		function modificarImagen(id){
			document.getElementById("id_de_foto").value = id;
			document.getElementById("formularioDeSalto").action = "editar_imagen.php";
			document.getElementById("formularioDeSalto").submit();
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
		<input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
	</form>
	
	<!-- El siguiente formulario se utiliza para el borrado de imagenes-->
	<form action="" method="post" name="formularioDeSalto" id="formularioDeSalto">
		<input type="hidden" name="id_de_trabajo" id="id_de_trabajo" value="<?php echo $id_de_trabajo; ?>">
		<input type="hidden" name="id_de_foto" id="id_de_foto" value="">
		<input type="hidden" name="<?php echo session_name(); ?>" id="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>">
	</form>
  
  </body>
</html>