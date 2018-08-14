<?php
	header('Content-Type: text/html; charset=utf8');
	include ("../includes/config.php");
	
	$nombreDeEmpresa = $_SESSION["nombre_de_empresa"];
	
	/* Se establece la propiedad de la galeria y secciones para poder ubicar las imagnes en la bd */
	$propietaria = "maestro_de_noticias";
	
	/* Se establece la página de retorno */
	$paginaDeRetorno = "blog.php";
	
	/* Se recuperan los datos de elemento a modificar */
	$id_de_noticia = $_POST["id_de_noticia"];
	$consulta = "SELECT * ";
	$consulta .= "FROM maestro_de_noticias ";
	$consulta .= "WHERE id_de_noticia = :idDeNoticia;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->bindParam(":idDeNoticia", $id_de_noticia); 
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
	
	/* Se crea una matriz de boletines para seleccionarla en el combo */
	$matrizDeBoletines = array();
	$consulta = "SELECT * ";
	$consulta .= "FROM boletines ";
	$consulta .= "ORDER BY idDeBoletines DESC;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$matrizDeBoletines = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
	$hacerConsulta->closeCursor(); // Se libera el recurso.
	    
	/* Se crea una matriz de imagenes para el articulo seleccionado */
	$matrizDeFotos = array();
	$consulta = "SELECT id_de_foto, nombre_de_foto, alt_de_imagen, descripcion_de_imagen ";
	$consulta .= "FROM maestro_de_imagenes ";
	$consulta .= "WHERE galeria_propietaria = :galeriaPropietaria ";
	$consulta .= "AND estado_de_imagen = :estadoDeImagen ";
	$consulta .= "AND id_de_elemento = :idDeNoticia;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->bindParam(":idDeNoticia", $id_de_noticia); // Se asigna una variable para la consulta.
	$hacerConsulta->bindValue(":estadoDeImagen", "A"); // Se asigna una variable para la consulta.
	$hacerConsulta->bindParam(":galeriaPropietaria", $propietaria); // Se asigna una variable para la consulta.
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$matrizDeFotos = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
	$numero_de_fotos = count($matrizDeFotos);
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
    <!-- Ckeditor -->
    <script src="../includes/ckeditor/ckeditor.js"></script>
    <!-- Sceript personalizados -->
    <script language="javascript" type="text/javascript">
	/* La siguiente funcion se ejecutara si se pulsa el boton Cancelar*/
	function retornar(){
		document.getElementById("formRetorno").submit();
	}
	function eliminarImagen(id){
		if (confirm("El proceso de borrado es irreversible, realmente quieres continuar?")){
			document.getElementById("id_de_foto").value = id;
			document.getElementById("formBorrarImagen").submit();
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
                <h3>Editar post</h3>
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
													<li role="presentation"><a href="#imagenNueva" aria-controls="imagenNueva" role="tab" data-toggle="tab">Nueva imagen</a></li>
												</ul>
														
												<!-- Tab panes -->
												<div class="tab-content">
													<div role="tabpanel" class="tab-pane active" id="datos">						
														<form action="grabar_cambios_post.php" method="POST" name="form" class="form-horizontal form-label-left" enctype="multipart/form-data" novalidate>
															<input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
															<input type="hidden" name="id_de_noticia" value="<?php echo $matriz["id_de_noticia"]; ?>" />
											
															<span>&nbsp;</span>
											
															<div class="item form-group">
																	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">T&iacute;tulo del post</label>
																	<div class="col-md-6 col-sm-6 col-xs-12">
																		 <input type="text" id="titulo_de_noticia" name="titulo_de_noticia" class="form-control col-md-7 col-xs-12" value="<?php echo $matriz["titulo_de_noticia"]; ?>" >
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
																		<label>Seleccionar Noticias para la secci&oacute;n Noticias; el resto de las secciones pertenecen a la Revista Digital.</label>
																	</div>
															</div>
															
															<div class="item form-group">
																<label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">Cuerpo del post</label>
																<div class="col-md-10 col-sm-6 col-xs-12">
																		<textarea name="cuerpo_de_noticia" id="cuerpo_de_noticia" class="form-control col-md-7 col-xs-12">
																	<?php echo $matriz["cuerpo_de_noticia"]; ?>
																		</textarea>
																	<script>
																		CKEDITOR.replace( 'cuerpo_de_noticia' );
																		CKEDITOR.add
																	</script>    
																</div>
															</div>
															
														<div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Imagen</label>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" value="<?php echo $matriz["imagen_de_noticia"]; ?>" type="text" disabled>
                                   <input id="imagen_actual" name="imagen_actual" value="<?php echo $matriz["imagen_de_noticia"]; ?>" type="hidden">
                                </div>
																<div class="col-md-2 col-sm-2 col-xs-12">
																	<?php
																		$estacdoCheck = "";
																		if ($matriz["imagen_de_noticia"] == "") {
																			$estacdoCheck = "disabled";
																		}
																	?>
                                   <label><input class="" id="borrar_imagen" name="borrar_imagen" type="checkbox" <?php echo $estacdoCheck; ?>> Borrar</label>
                                </div>
																<div class="col-md-3 col-sm-3 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" id="imagen_de_noticia" name="imagen_de_noticia" type="file">
                                </div>
                            </div>	
															
															<div class="item form-group">
																<label class="control-label col-md-2 col-sm-2 col-xs-12">Opciones</label>
																<div class="col-md-8 col-sm-6 col-xs-12">
																	<div class="">
																	<?php
																		if ($matriz["portada_de_noticia"] == "S") {
																			echo "<label><input type=\"checkbox\" class=\"js-switch\" id=\"portada_de_noticia\" name=\"portada_de_noticia\" checked /> En portada</label>";
																		} else {
																			echo "<label><input type=\"checkbox\" class=\"js-switch\" id=\"portada_de_noticia\" name=\"portada_de_noticia\" /> En portada</label>";
																		}
																		
																		echo "&nbsp;&nbsp;- &nbsp;&nbsp;";
																		
																		if ($matriz["destacado_de_noticia"] == "S") {
																			echo "<label><input type=\"checkbox\" class=\"js-switch\" id=\"destacado_de_noticia\" name=\"destacado_de_noticia\" checked /> Destacado</label>";
																		} else {
																			echo "<label><input type=\"checkbox\" class=\"js-switch\" id=\"destacado_de_noticia\" name=\"destacado_de_noticia\" /> Destacado</label>";
																		}
																	?>
																	</div>
																</div>
															</div>
								
															<div class="item form-group">
																	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">Estado </label>
																	<div class="col-md-6 col-sm-6 col-xs-12">
																		<div id="estado_de_noticia" class="btn-group" data-toggle="buttons">
																			<?php
																				if ($matriz["estado_de_noticia"] == "A"){
																					echo "<label class=\"btn btn-primary\" data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\">";
																					echo "<input type=\"radio\" name=\"estado_de_noticia\" value=\"A\" checked=\"checked\"> &nbsp; Publicada &nbsp;";
																					echo "</label>";
																					echo "<label class=\"btn btn-default\" data-toggle-class=\"btn btn-default\" data-toggle-passive-class=\"btn-default\">";
																					echo "<input type=\"radio\" name=\"estado_de_noticia\" value=\"I\"> &nbsp; No publicada &nbsp;";
																					echo "</label>";
																				} else {
																					echo "<label class=\"btn btn-default\" data-toggle-class=\"btn btn-default\" data-toggle-passive-class=\"btn-default\">";
																					echo "<input type=\"radio\" name=\"estado_de_noticia\" value=\"A\"> &nbsp; Publicada &nbsp;";
																					echo "</label>";
																					echo "<label class=\"btn btn-primary\" data-toggle-class=\"btn-primary\" data-toggle-passive-class=\"btn-default\">";
																					echo "<input type=\"radio\" name=\"estado_de_noticia\" value=\"I\"checked=\"checked\"> &nbsp; No publicada &nbsp;";
																					echo "</label>";
																				}
																			?>
																		</div>
																	</div>
															</div>
															
														<div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">PDF 1</label>
                                <div class="col-md-2 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" id="nombre_de_pdf_1" name="nombre_de_pdf_1" value="<?php echo $matriz["nombreDePdf"]; ?>" type="text">
                                </div>
																<div class="col-md-3 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" value="<?php echo $matriz["pdf"]; ?>" type="text" disabled>
                                </div>
																<div class="col-md-3 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" id="pdf_1" name="pdf_1" type="file">
                                </div>
                            </div>	
															
														<div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">PDF 2</label>
                                <div class="col-md-2 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" id="nombre_de_pdf_2" name="nombre_de_pdf_2" value="<?php echo $matriz["nombreDePdf2"]; ?>" type="text">
                                </div>
																<div class="col-md-3 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" value="<?php echo $matriz["pdf2"]; ?>" type="text" disabled>
                                </div>
																<div class="col-md-3 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" id="pdf_2" name="pdf_2" type="file">
                                </div>
                            </div>
														
														<div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">PDF 3</label>
                                <div class="col-md-2 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" id="nombre_de_pdf_3" name="nombre_de_pdf_3" value="<?php echo $matriz["nombreDePdf3"]; ?>" type="text">
                                </div>
																<div class="col-md-3 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" value="<?php echo $matriz["pdf3"]; ?>" type="text" disabled>
                                </div>
																<div class="col-md-3 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" id="pdf_3" name="pdf_3" type="file">
                                </div>
                            </div>
														
														<div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">PDF 4</label>
                                <div class="col-md-2 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" id="nombre_de_pdf_4" name="nombre_de_pdf_4" value="<?php echo $matriz["nombreDePdf4"]; ?>" type="text">
                                </div>
																<div class="col-md-3 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" value="<?php echo $matriz["pdf4"]; ?>" type="text" disabled>
                                </div>
																<div class="col-md-3 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" id="pdf_4" name="pdf_4" type="file">
                                </div>
                            </div>
														
														<div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">PDF 5</label>
                                <div class="col-md-2 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" id="nombre_de_pdf_5" name="nombre_de_pdf_5" value="<?php echo $matriz["nombreDePdf5"]; ?>" type="text">
                                </div>
																<div class="col-md-3 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" value="<?php echo $matriz["pdf5"]; ?>" type="text" disabled>
                                </div>
																<div class="col-md-3 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" id="pdf_5" name="pdf_5" type="file">
                                </div>
                            </div>	
															
															<!-- Campos utilizados solo en post asociados a la revista digital -->
															
															<div class="item form-group">
																<div class="col-md-12">
																	<br><br><b>Datos a cumplimentar en caso de art&iacute;culos para la Revista Digital:</b><hr>
																</div>
															</div>
															
															<div class="item form-group">
																	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Volumen</label>
																	<div class="col-md-6 col-sm-6 col-xs-12">
																		<select class="form-control" name="boletin_de_noticia" id="boletin_de_noticia">
																			<?php
																				if ($matriz["boletin_de_noticia"] == 0) echo "<option value=\"0\" selected>Seleciona un volumen...</option>";
																				foreach ($matrizDeBoletines as $boletin){
																					if ($matriz["boletin"] == $boletin["idDeBoletines"]){
																						echo "<option value=\"".$boletin["idDeBoletines"]."\" selected>".$boletin["tituloDeBoletin"]."</option>\n";
																					} else {
																						echo "<option value=\"".$boletin["idDeBoletines"]."\">".$boletin["tituloDeBoletin"]."</option>\n";
																					}
																				}
																			?>
																		</select>
																	</div>
															</div>
															
															<div class="item form-group">
																	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name"> Autor</label>
																	<div class="col-md-6 col-sm-6 col-xs-12">
																		 <input value="<?php echo $matriz["autor_de_noticia"]; ?>" id="autor_de_noticia" class="form-control col-md-7 col-xs-12" name="autor_de_noticia" type="text">
																	</div>
															</div>
															
															<div class="item form-group">
																	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Palabras clave </label>
																	<div class="col-md-6 col-sm-6 col-xs-12">
																		 <input value="<?php echo $matriz["keywords_de_noticia"]; ?>" id="keywords_de_noticia" class="form-control col-md-7 col-xs-12" name="keywords_de_noticia" type="text">
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
													<div role="tabpanel" class="tab-pane" id="imagenes">
														<span>&nbsp;</span>
														<?php
															if ($numero_de_fotos == 0){
																echo "<div class=\"col-md-12 bg-danger\">";
																echo "<br />En este momento el post seleccionada no tiene im&aacute;genes disponibles.<br />";
																echo "Puedes grabar una im&aacute;gen nueva, en la pesta&ntilde;a correspondiente.<br /><br />";
																echo "</div>";
								
															} else {
																$contador = 0;
																foreach ($matrizDeFotos as $foto) {
																	$contador++;
																	if($contador == 1 || $contador == 5) echo "<div class=\"row\">";
																	echo "<div class=\"col-md-3 col-sm-6\">";
																	
																	echo "<div class=\"thumbnail\">";
																	echo "<img src=\"../../images/galeria/fotos/".$foto["nombre_de_foto"]."\" alt=\"".$foto["alt_de_imagen"]."\" >";
																	echo "</div>"; // cierre thumbnail
																	echo "<div class=\"caption\">";
																	echo "<h3>".$foto["nombre_de_foto"]."</h3>";
																	if ($foto["descripcion_de_imagen"] != "") {
																		echo "<p>".$foto["descripcion_de_imagen"]."</p>";
																	} else {
																		echo "<p>No hay descripci&oacute;n disponible.</p>";
																	}
																	echo "<p>";
																	echo "<a href=\"javascript:eliminarImagen('".$foto["id_de_foto"]."');\" class=\"btn btn-primary\" ";
																	echo "role=\"button\">Eliminar</a>";
																	echo "</p>";
																	echo "</div>"; // cierre caption
																	echo "</div>"; // Cierre celda
																	if ($contador == 4 || $contador == 8 || $contador == $numero_de_fotos) echo "</div><div class=\"row\">&nbsp;</div>"; // Cierre row
																}
															} 
														?>
													</div>
													<div role="tabpanel" class="tab-pane" id="imagenNueva">
														<span>&nbsp;</span>
														<?php
															if ($numero_de_fotos >= 8) {
																echo "<div class=\"col-md-12 bg-danger\">";
																echo "<br />Ha al–canzado el n&uacute;mero m&aacute;ximo de im&aacute;genes para este post.<br />";
																echo "Si necesita grabar una nueva imagne, pro favor, borre previamente una de las existentes.<br /><br />";
																echo "</div>";
															} else {
																echo "<form action=\"grabar_imagen.php\" class=\"form-horizontal form-label-left\" name=\"grabar_nueva_imagen\" id=\"grabar_nueva_imagen\" method=\"post\" enctype=\"multipart/form-data\" novalidate>";
															?>
															<input type="hidden" name="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>" />
															<input type="hidden" name="id_de_noticia" value="<?php echo $matriz["id_de_noticia"]; ?>" />
											
															<span>&nbsp;</span>
											
															<div class="item form-group">
																	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Imagen: <span class="required">*</span></label>
																	<div class="col-md-6 col-sm-6 col-xs-12">
																		 <input id="nueva_imagen" class="form-control col-md-7 col-xs-12" name="nueva_imagen" type="file">
																	</div>
															</div>
															<div class="item form-group">
																	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Alt: </label>
																	<div class="col-md-6 col-sm-6 col-xs-12">
																		 <input id="alt_de_imagen" class="form-control col-md-7 col-xs-12" name="alt_de_imagen" type="text">
																	</div>
															</div>
															<div class="item form-group">
																	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Descripci&oacute;n:</label>
																	<div class="col-md-6 col-sm-6 col-xs-12">
																		 <input id="descripcion_de_imagen" class="form-control col-md-7 col-xs-12" name="descripcion_de_imagen" type="text">
																	</div>
															</div>
															<div class="item form-group">
																	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">&nbsp;</label>
																	<div class="col-md-6 col-sm-6 col-xs-12">
																<p>La im&aacute;gen debe tener unas dimensiones m&aacute;ximas de 1024 x 1024 pixeles y un peso m&aacute;ximo de 500 Kb.</p>
																	</div>
															</div>
															<div class="ln_solid"></div>
																	<div class="form-group">
																<div class="col-md-6 col-md-offset-2">
																		<button type="submit" class="btn btn-success">Aceptar</button>
																</div>
															</div>
														<?php
																echo "</form>";
															}						
														?>
													
													</div>
													
												</div>
													
											</div>
                    
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
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
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
	<!-- El siguiente formulario se utiliza para el borrado de imagenes-->
	<form action="borrar_imagen.php" method="post" name="formBorrarImagen" id="formBorrarImagen">
		<input type="hidden" name="id_de_noticia" id="id_de_noticia" value="<?php echo $id_de_noticia; ?>">
		<input type="hidden" name="id_de_foto" id="id_de_foto" value="">
		<input type="hidden" name="<?php echo session_name(); ?>" id="<?php echo session_name(); ?>" value="<?php echo session_id(); ?>">
	</form>   </body>
</html>