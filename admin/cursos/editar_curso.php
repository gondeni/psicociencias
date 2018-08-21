<?php
header('Content-Type: text/html; charset=utf8');
include ("../includes/config.php");

$nombreDeEmpresa = $_SESSION["nombre_de_empresa"];

/* Se establece la propiedad de la galeria y secciones para poder ubicar las imagnes en la bd */
$propietaria = "maestro_de_cursos";

/* Se establece la p�gina de retorno */
$paginaDeRetorno = "cursos.php";

/* Se recuperan los datos de elemento a modificar */
$id_de_curso = $_POST["id_de_curso"];
$consulta = "SELECT * ";
$consulta .= "FROM cursos ";
$consulta .= "WHERE idDeCurso = :idDeCurso;";
$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
$hacerConsulta->bindParam(":idDeCurso", $id_de_curso); // Se asigna una variable para la consulta.
$hacerConsulta->execute(); // Se ejecuta la consulta.
$matriz = $hacerConsulta->fetch(PDO::FETCH_ASSOC); // Se recuperan los resultados.
$hacerConsulta->closeCursor(); // Se libera el recurso.

/* Se crea una matriz de secciones para seleccionarla en el combo */
$matrizDeSecciones = array();
$consulta = "SELECT id_de_seccion, nombre_de_seccion ";
$consulta .= "FROM maestro_de_secciones ";
$consulta .= "WHERE estado_de_seccion = :estadoDeSeccion ";
$consulta .= "AND id_de_padre = :idDePadre ";
$consulta .= "ORDER BY id_de_seccion ASC;";
$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
$hacerConsulta->bindValue(":idDePadre", 0);
$hacerConsulta->bindValue(":estadoDeSeccion", "A");
$hacerConsulta->execute(); // Se ejecuta la consulta.
$matrizDeSecciones = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
$hacerConsulta->closeCursor(); // Se libera el recurso.

/* Se crea una matriz de sedes para seleccionarla en el combo */
$matrizDeSedes = array();
$consulta = "SELECT idDeSede, nombreDeSede ";
$consulta .= "FROM sedes;";
$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
$hacerConsulta->bindValue(":idDePadre", 0);
$hacerConsulta->execute(); // Se ejecuta la consulta.
$matrizDeSedes = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
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
	<!-- Switchery -->
	<link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
	<!-- Custom Theme Style -->
	<link href="../build/css/custom.min.css" rel="stylesheet">

	<!-- Spectrum -->
	<link href="../vendors/bgrins-spectrum-98454b5/spectrum.css" rel="stylesheet">

	<!-- Ckeditor -->
	<script src="../includes/ckeditor/ckeditor.js"></script>


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
								<h3>Editar curso</h3>
							</div>
						</div>

						<div class="row">

							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="x_panel">
									<div class="x_content">

										<form action="grabar_cambios_curso.php" method="POST" name="form" class="form-horizontal form-label-left" enctype="multipart/form-data" novalidate>
											<input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
											<input type="hidden" name="id_de_curso" value="<?php echo $matriz["idDeCurso"]; ?>" />

											<span>&nbsp;</span>

											<div class="item form-group">
												<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Nombre <span class="required">*</span></label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input value="<?php echo $matriz["nombreDeCurso"]; ?>" id="nombre_de_curso" class="form-control col-md-7 col-xs-12" data-validate-length-range="0" data-validate-words="0" name="nombre_de_curso" required="required" type="text">
												</div>
											</div>

											<div class="item form-group">
												<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Secci&oacute;n</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<select class="form-control" name="id_de_seccion" id="id_de_seccion">
														<?php
														$selected = "";
														if ($matriz["idDeSeccion"] == 0) $selected = "selected";;
														foreach ($matrizDeSecciones as $seccion){
															if ($matriz["idDeSeccion"] == $seccion["id_de_seccion"]){
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
												<label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">Descripci&oacute;n</label>
												<div class="col-md-10 col-sm-6 col-xs-12">
													<textarea name="descripcion_de_curso" id="descripcion_de_curso" class="form-control col-md-7 col-xs-12">
														<?php echo $matriz["descripcionDeCurso"]; ?>
													</textarea>
													<script>
													CKEDITOR.replace( 'descripcion_de_curso' );
													CKEDITOR.add
													</script>
												</div>
											</div>

											<div class="item form-group">
												<label class="control-label col-md-2 col-sm-2 col-xs-12" for="modalidad">Modalidad:</label>
												<div class="col-md-8 col-sm-6 col-xs-12">
													<label class="radio-inline">
														<input type="radio" name="modalidad_de_curso" id="modalidad_de_cursoD" value="D" <?php if ($matriz["modalidad"] == "D") echo "checked=\"checked\""; ?>> On line
													</label>
													<label class="radio-inline">
														<input type="radio" name="modalidad_de_curso" id="modalidad_de_cursoP" value="P" <?php if ($matriz["modalidad"] == "P") echo "checked=\"checked\""; ?>> Presencial
													</label>
													<label class="radio-inline">
														<input type="radio" name="modalidad_de_curso" id="modalidad_de_cursoA" value="A" <?php if ($matriz["modalidad"] == "A") echo "checked=\"checked\""; ?>> Presencial y Online
													</label>
													<label class="radio-inline">
														<input type="radio" name="modalidad_de_curso" id="modalidad_de_cursoX" value="X" <?php if ($matriz["modalidad"] == "X") echo "checked=\"checked\""; ?>> M&aacute;ster
													</label>
													<label class="radio-inline">
														<input type="radio" name="modalidad_de_curso" id="modalidad_de_cursoY" value="Y" <?php if ($matriz["modalidad"] == "Y") echo "checked=\"checked\""; ?>> Sesiones,...
													</label>
												</div>
											</div>
											<div class="item form-group">
												<label class="control-label col-md-2 col-sm-2 col-xs-12" for="color">Color calendario:</label>
												<div class="control-label col-md-2 col-sm-2 col-xs-12">
													<input type='text' id="color" name="color"/>
												</div>
											</div>
											<div class="item form-group">
												<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Sede</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<select class="form-control" name="id_de_sede" id="id_de_sede">
														<?php
														$selected = "";
														if ($matriz["sede"] == 0) $selected = "selected";;
														foreach ($matrizDeSedes as $sede){
															if ($matriz["sede"] == $sede["idDeSeccion"]){
																echo "<option value=\"".$sede["idDeSeccion"]."\" selected>".$sede["nombreDeSede"]."</option>\n";
															} else {
																echo "<option value=\"".$sede["idDeSeccion"]."\">".$sede["nombreDeSede"]."</option>\n";
															}
														}
														?>
													</select>
												</div>
											</div>

											<div class="item form-group">
												<label class="control-label col-md-2 col-sm-2 col-xs-12" for="modalidad">Modalidad:</label>
												<div class="col-md-8 col-sm-6 col-xs-12">
													<label class="radio-inline">
														<input type="radio" name="sesiones_de_curso" id="sesiones_de_cursoS" value="S" <?php if ($matriz["sesionesPresenciales"] == "S") echo "checked=\"checked\""; ?>> Si
													</label>
													<label class="radio-inline">
														<input type="radio" name="sesiones_de_curso" id="sesiones_de_cursoN" value="N" <?php if ($matriz["sesionesPresenciales"] == "N") echo "checked=\"checked\""; ?>> No
													</label>
												</div>
											</div>

											<div class="item form-group">
												<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Fechas</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input value="<?php echo $matriz["fechas"]; ?>" id="fechas_de_curso" class="form-control col-md-7 col-xs-12" name="fechas_de_curso" rtype="text">
												</div>
											</div>

											<div class="item form-group">
												<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Horarios</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input value="<?php echo $matriz["horarios"]; ?>" id="horarios_de_curso" class="form-control col-md-7 col-xs-12" name="horarios_de_curso" rtype="text">
												</div>
											</div>

											<div class="item form-group">
												<label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">Ficha m&aacute;ster</label>
												<div class="col-md-10 col-sm-6 col-xs-12">
													<textarea name="ficha_master" id="ficha_master" class="form-control col-md-7 col-xs-12">
														<?php echo $matriz["fichaMaster"]; ?>
													</textarea>
													<script>
													CKEDITOR.replace( 'ficha_master' );
													CKEDITOR.add
													</script>
												</div>
											</div>

											<div class="control-label col-md-2">Contenido</div>
											<div class="col-md-10">
												<div role="tabpanel">
													<!-- Nav tabs -->
													<ul class="nav nav-tabs" role="tablist">
														<li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">
															<?php
															if ($matriz["tituloTab1"] != "") {
																echo $matriz["tituloTab1"];
															} else {
																echo "Pesta&ntilde;a 1";
															}
															?>
														</a></li>
														<li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">
															<?php
															if ($matriz["tituloTab2"] != "") {
																echo $matriz["tituloTab2"];
															} else {
																echo "Pesta&ntilde;a 2";
															}
															?>
														</a></li>
														<li role="presentation"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab">
															<?php
															if ($matriz["tituloTab3"] != "") {
																echo $matriz["tituloTab3"];
															} else {
																echo "Pesta&ntilde;a 3";
															}
															?>
														</a></li>
														<li role="presentation"><a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab">
															<?php
															if ($matriz["tituloTab4"] != "") {
																echo $matriz["tituloTab4"];
															} else {
																echo "Pesta&ntilde;a 4";
															}
															?>
														</a></li>
														<li role="presentation"><a href="#tab5" aria-controls="tab5" role="tab" data-toggle="tab">
															<?php
															if ($matriz["tituloTab5"] != "") {
																echo $matriz["tituloTab5"];
															} else {
																echo "Pesta&ntilde;a 5";
															}
															?>

														</a></li>
														<li role="presentation"><a href="#tab6" aria-controls="tab6" role="tab" data-toggle="tab">
															<?php
															if ($matriz["tituloTab6"] != "") {
																echo $matriz["tituloTab6"];
															} else {
																echo "Pesta&ntilde;a 6";
															}
															?>
														</a></li>
													</ul>

													<!-- Tab panes -->
													<div class="tab-content">
														<div role="tabpanel" class="tab-pane active" id="tab1">
															<div class="form-group">
																<label for="titulo">T&iacute;tulo pesta&ntilde;a 1:</label>
																<input type="input" class="form-control" id="tituloTab1" name="tituloTab1" maxlength="50" value="<?php echo $matriz["tituloTab1"]; ?>">
															</div>
															<div class="form-group">
																<label for="texto">Contenido pesta&ntilde;a 1:</label>
																<textarea name="contenidoTab1"><?php echo $matriz["contenidoTab1"]; ?></textarea>
																<script>
																CKEDITOR.replace( 'contenidoTab1' );
																CKEDITOR.add
																</script>
															</div>
														</div>
														<div role="tabpanel" class="tab-pane" id="tab2">
															<div class="form-group">
																<label for="titulo">T&iacute;tulo pesta&ntilde;a 2:</label>
																<input type="input" class="form-control" id="tituloTab2" name="tituloTab2" maxlength="50" value="<?php echo $matriz["tituloTab2"]; ?>">
															</div>
															<div class="form-group">
																<label for="texto">Contenido pesta&ntilde;a 2:</label>
																<textarea name="contenidoTab2"><?php echo $matriz["contenidoTab2"]; ?></textarea>
																<script>
																CKEDITOR.replace( 'contenidoTab2' );
																CKEDITOR.add
																</script>
															</div>
														</div>
														<div role="tabpanel" class="tab-pane" id="tab3">
															<div class="form-group">
																<label for="titulo">T&iacute;tulo pesta&ntilde;a 3:</label>
																<input type="input" class="form-control" id="tituloTab3" name="tituloTab3" maxlength="50" value="<?php echo $matriz["tituloTab3"]; ?>">
															</div>
															<div class="form-group">
																<label for="texto">Contenido pesta&ntilde;a 3:</label>
																<textarea name="contenidoTab3"><?php echo $matriz["contenidoTab3"]; ?></textarea>
																<script>
																CKEDITOR.replace( 'contenidoTab3' );
																CKEDITOR.add
																</script>
															</div>
														</div>
														<div role="tabpanel" class="tab-pane" id="tab4">
															<div class="form-group">
																<label for="titulo">T&iacute;tulo pesta&ntilde;a 4:</label>
																<input type="input" class="form-control" id="tituloTab4" name="tituloTab4" maxlength="50" value="<?php echo $matriz["tituloTab4"]; ?>">
															</div>
															<div class="form-group">
																<label for="texto">Contenido pesta&ntilde;a 4:</label>
																<textarea name="contenidoTab4"><?php echo $matriz["contenidoTab4"]; ?></textarea>
																<script>
																CKEDITOR.replace( 'contenidoTab4' );
																CKEDITOR.add
																</script>
															</div>
														</div>
														<div role="tabpanel" class="tab-pane" id="tab5">
															<div class="form-group">
																<label for="titulo">T&iacute;tulo pesta&ntilde;a 5:</label>
																<input type="input" class="form-control" id="tituloTab5" name="tituloTab5" maxlength="50" value="<?php echo $matriz["tituloTab5"]; ?>">
															</div>
															<div class="form-group">
																<label for="texto">Contenido pesta&ntilde;a 5:</label>
																<textarea name="contenidoTab5"><?php echo $matriz["contenidoTab5"]; ?></textarea>
																<script>
																CKEDITOR.replace( 'contenidoTab5' );
																CKEDITOR.add
																</script>
															</div>
														</div>
														<div role="tabpanel" class="tab-pane" id="tab6">
															<div class="form-group">
																<label for="titulo">T&iacute;tulo pesta&ntilde;a 6:</label>
																<input type="input" class="form-control" id="tituloTab6" name="tituloTab6" maxlength="50" value="<?php echo $matriz["tituloTab6"]; ?>">
															</div>
															<div class="form-group">
																<label for="texto">Contenido pesta&ntilde;a 6:</label>
																<textarea name="contenidoTab6"><?php echo $matriz["contenidoTab6"]; ?></textarea>
																<script>
																CKEDITOR.replace( 'contenidoTab6' );
																CKEDITOR.add
																</script>
															</div>
														</div>
													</div>
												</div>
											</div>

											<div class="item form-group">
												<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Orden</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input value="<?php echo $matriz["orden"]; ?>" id="orden_de_curso" class="form-control col-md-7 col-xs-12" name="orden_de_curso" rtype="text">
												</div>
											</div>

											<div class="item form-group">
												<label class="control-label col-md-2 col-sm-2 col-xs-12" for="modalidad">Plazas:</label>
												<div class="col-md-8 col-sm-6 col-xs-12">
													<label class="radio-inline">
														<input type="radio" name="plazas_de_curso" id="plazas_de_cursoS" value="S" <?php if ($matriz["plazas"] == "S") echo "checked=\"checked\""; ?>> Plazas disponibles
													</label>
													<label class="radio-inline">
														<input type="radio" name="plazas_de_curso" id="plazas_de_cursoN" value="N" <?php if ($matriz["plazas"] == "N") echo "checked=\"checked\""; ?>> Curso cerrado
													</label>
													<label class="radio-inline">
														<input type="radio" name="plazas_de_curso" id="plazas_de_cursoP" value="P" <?php if ($matriz["plazas"] == "P") echo "checked=\"checked\""; ?>> Pr&oacute;xima matr&iacute;cula
													</label>
													<label class="radio-inline">
														<input type="radio" name="plazas_de_curso" id="plazas_de_cursoA" value="A" <?php if ($matriz["plazas"] == "A") echo "checked=\"checked\""; ?>> Plazas agotadas
													</label>
												</div>
											</div>

											<div class="item form-group">
												<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Imagen</label>
												<div class="col-md-3 col-sm-3 col-xs-12">
													<input class="form-control col-md-7 col-xs-12" value="<?php echo $matriz["imagen_de_curso"]; ?>" type="text" disabled>
													<input id="imagen_actual" name="imagen_actual" value="<?php echo $matriz["imagen_de_curso"]; ?>" type="hidden">
												</div>
												<div class="col-md-2 col-sm-2 col-xs-12">
													<?php
													$estacdoCheck = "";
													if ($matriz["imagen_de_curso"] == "") {
														$estacdoCheck = "disabled";
													}
													?>
													<label><input class="" id="borrar_imagen" name="borrar_imagen" type="checkbox" <?php echo $estacdoCheck; ?>> Borrar</label>
												</div>
												<div class="col-md-3 col-sm-3 col-xs-12">
													<input class="form-control col-md-7 col-xs-12" id="imagen_de_curso" name="imagen_de_curso" type="file">
												</div>
											</div>

											<div class="item form-group">
												<label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">Estado </label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<div id="estado_de_articulo" class="btn-group" data-toggle="buttons">
														<?php
														if ($matriz["estado"]== "A"){
															echo "<label class=\"btn btn-primary\" data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\">";
															echo "<input type=\"radio\" name=\"estado_de_curso\" value=\"A\" checked=\"checked\"> &nbsp; Activo &nbsp;";
															echo "</label>";
															echo "<label class=\"btn btn-default\" data-toggle-class=\"btn btn-default\" data-toggle-passive-class=\"btn-default\">";
															echo "<input type=\"radio\" name=\"estado_de_curso\" value=\"I\"> &nbsp; Inactivo &nbsp;";
															echo "</label>";
														} else {
															echo "<label class=\"btn btn-default\" data-toggle-class=\"btn btn-default\" data-toggle-passive-class=\"btn-default\">";
															echo "<input type=\"radio\" name=\"estado_de_curso\" value=\"A\"> &nbsp; Activo &nbsp;";
															echo "</label>";
															echo "<label class=\"btn btn-primary\" data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\">";
															echo "<input type=\"radio\" name=\"estado_de_curso\" value=\"I\"checked=\"checked\"> &nbsp; Inactivo &nbsp;";
															echo "</label>";
														}
														?>
													</div>
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
		<!-- spectrum -->
		<script src="../vendors/bgrins-spectrum-98454b5/spectrum.js"></script>

		<!-- Sceript personalizados -->
		<script language="javascript" type="text/javascript">
		/* La siguiente funcion se ejecutara si se pulsa el boton Cancelar*/

		$(document).ready(function(){

			$("#color").spectrum({
				color: "#ECC",
				showInput: true,
				className: "full-spectrum",
				showInitial: true,
				showPaletteOnly: true,
				showSelectionPalette: true,
				hideAfterPaletteSelect:true,
				maxSelectionSize: 10,
				preferredFormat: "hex",
				localStorageKey: "spectrum.demo",
				move: function (color) {

				},
				show: function () {

				},
				beforeShow: function () {

				},
				hide: function () {

				},
				change: function() {

				},
				palette: [
					["rgb(0, 0, 0)", "rgb(67, 67, 67)", "rgb(102, 102, 102)",
					"rgb(204, 204, 204)", "rgb(217, 217, 217)","rgb(255, 255, 255)"],
					["rgb(152, 0, 0)", "rgb(255, 0, 0)", "rgb(255, 153, 0)", "rgb(255, 255, 0)", "rgb(0, 255, 0)",
					"rgb(0, 255, 255)", "rgb(74, 134, 232)", "rgb(0, 0, 255)", "rgb(153, 0, 255)", "rgb(255, 0, 255)"],
					["rgb(230, 184, 175)", "rgb(244, 204, 204)", "rgb(252, 229, 205)", "rgb(255, 242, 204)", "rgb(217, 234, 211)",
					"rgb(208, 224, 227)", "rgb(201, 218, 248)", "rgb(207, 226, 243)", "rgb(217, 210, 233)", "rgb(234, 209, 220)",
					"rgb(221, 126, 107)", "rgb(234, 153, 153)", "rgb(249, 203, 156)", "rgb(255, 229, 153)", "rgb(182, 215, 168)",
					"rgb(162, 196, 201)", "rgb(164, 194, 244)", "rgb(159, 197, 232)", "rgb(180, 167, 214)", "rgb(213, 166, 189)",
					"rgb(204, 65, 37)", "rgb(224, 102, 102)", "rgb(246, 178, 107)", "rgb(255, 217, 102)", "rgb(147, 196, 125)",
					"rgb(118, 165, 175)", "rgb(109, 158, 235)", "rgb(111, 168, 220)", "rgb(142, 124, 195)", "rgb(194, 123, 160)",
					"rgb(166, 28, 0)", "rgb(204, 0, 0)", "rgb(230, 145, 56)", "rgb(241, 194, 50)", "rgb(106, 168, 79)",
					"rgb(69, 129, 142)", "rgb(60, 120, 216)", "rgb(61, 133, 198)", "rgb(103, 78, 167)", "rgb(166, 77, 121)",
					"rgb(91, 15, 0)", "rgb(102, 0, 0)", "rgb(120, 63, 4)", "rgb(127, 96, 0)", "rgb(39, 78, 19)",
					"rgb(12, 52, 61)", "rgb(28, 69, 135)", "rgb(7, 55, 99)", "rgb(32, 18, 77)", "rgb(76, 17, 48)"]
				]

			});

		});

		function retornar(){
			document.getElementById("formRetorno").submit();
		}
		function eliminarImagen(id){
			if (confirm("El proceso de borrado es irreversible, realmente quieres continuar?")){
				document.getElementById("id_de_foto").value = id;
				document.getElementById("formBorrarImagen").submit();
			}
		}

		// Validator
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

		<!-- El siguiente formulario se emplea para volver al documeto web que haya llamado a este. -->
		<form action="<?php  echo $paginaDeRetorno; ?>" name="formRetorno" id="formRetorno" method="post">
			<input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
		</form>

	</body>
	</html>
