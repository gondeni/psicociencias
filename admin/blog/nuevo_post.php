<?php
	header('Content-Type: text/html; charset=utf8');
	include ("../includes/config.php");
	
	$nombreDeEmpresa = $_SESSION["nombre_de_empresa"];
		
	/* Se establece la propiedad de la galeria y secciones para poder ubicar las imagnes en la bd */
	$propietaria = "maestro_de_noticias";
	
	/* Se establece la página de retorno */
	$paginaDeRetorno = "blog.php";
	
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
                <h3>Nuevo post del blog</h3>
              </div>
            </div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                    
                        <form action="grabar_post.php" method="POST" name="form" class="form-horizontal form-label-left" enctype="multipart/form-data" novalidate>

                            <span class="section">Intruduzce tu post</span>

                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">T&iacute;tulo del post<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <input id="titulo_de_noticia" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="1" name="titulo_de_noticia" placeholder="T&iacute;tulo del post" required="required" type="text">
                                </div>
                            </div>
														
														<div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Secci&oacute;n</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
																	<select class="form-control" id="id_de_seccion" name="id_de_seccion">
																		<?php
																			foreach($matrizDeSecciones as $seccion) {
																				echo "<option value=\"".$seccion["id_de_seccion"]."\">".$seccion["nombre_de_seccion"]."</option>\n";
																			}
																		?>
																	</select>
																	<label>Seleccionar Noticias para la secci&oacute;n Noticias; el resto de las secciones pertenecen a la Revista Digital.</label>

                                </div>
                            </div>
														
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">Cuerpo del post</label>
                                <div class="col-md-10 col-sm-6 col-xs-12">
                                    <textarea name="cuerpo_de_noticia" id="cuerpo_de_noticia" class="form-control col-md-7 col-xs-12"></textarea>
                                    <script>
																			CKEDITOR.replace( 'cuerpo_de_noticia' );
																			CKEDITOR.add
																		</script>    
                                </div>
														</div>
							
														<div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Imagen</label>
                                <div class="col-md-8 col-sm-6 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" id="imagen_de_noticia" name="imagen_de_noticia" type="file">
                                </div>
                            </div>
														
														<div class="item form-group">
															<label class="control-label col-md-2 col-sm-2 col-xs-12">Opciones</label>
															<div class="col-md-8 col-sm-6 col-xs-12">
																<div class="">
																	<label><input type="checkbox" class="js-switch" id="portada_de_noticia" name="portada_de_noticia" checked /> En portada</label>
																	&nbsp;&nbsp;- &nbsp;&nbsp;
																	<label><input type="checkbox" class="js-switch" id="destacado_de_noticia" name="destacado_de_noticia" /> Destacado</label>
																</div>
															</div>
														</div>
														
														<div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">Estado </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="estado_de_noticia" class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="estado_de_noticia" value="A" checked="checked"> &nbsp; Publicado &nbsp;
                                        </label>
                                        <label class="btn btn-default" data-toggle-class="btn btn-default" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="estado_de_noticia" value="I"> No publicado
                                        </label>
                                    </div>
                                </div>
                            </div>													
														
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name"></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
																	<br><b>Documentos pdf asociados al post</b>
                                </div>
                            </div>
														
														<div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">PDF 1</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" id="nombre_de_pdf_1" name="nombre_de_pdf_1" value="Ver documento" type="text">
                                </div>
																<div class="col-md-4 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" id="pdf_1" name="pdf_1" type="file">
                                </div>
                            </div>														
																												
														<div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">PDF 2</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" id="nombre_de_pdf_2" name="nombre_de_pdf_2" value="Ver documento 2" type="text">
                                </div>
																<div class="col-md-4 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" id="pdf_2" name="pdf_2" type="file">
                                </div>
                            </div>														
																												
														<div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">PDF 3</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" id="nombre_de_pdf_3" name="nombre_de_pdf_3" value="Ver documento 3" type="text">
                                </div>
																<div class="col-md-4 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" id="pdf_3" name="pdf_3" type="file">
                                </div>
                            </div>														
																												
														<div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">PDF 4</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" id="nombre_de_pdf_4" name="nombre_de_pdf_4" value="Ver documento 4" type="text">
                                </div>
																<div class="col-md-4 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" id="pdf_4" name="pdf_4" type="file">
                                </div>
                            </div>														
																												
														<div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">PDF 5</label>
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                   <input class="form-control col-md-7 col-xs-12" id="nombre_de_pdf_5" name="nombre_de_pdf_5" value="Ver documento 5" type="text">
                                </div>
																<div class="col-md-4 col-sm-4 col-xs-12">
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
																<div class="col-md-8 col-sm-6 col-xs-12">
																	<select class="form-control" name="boletin_de_noticia" id="boletin_de_noticia">
																		<?php
																			echo "<option value=\"0\" selected>Seleciona un volumen...</option>";
																			foreach ($matrizDeBoletines as $boletin){
																					echo "<option value=\"".$boletin["idDeBoletines"]."\">".$boletin["tituloDeBoletin"]."</option>\n";
																			}
																		?>
																	</select>
																</div>
														</div>
														
                            <div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Autor</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <input id="autor_de_noticia" class="form-control col-md-7 col-xs-12" name="autor_de_noticia" placeholder="Autor" type="text">
                                </div>
                            </div>
														
														<div class="item form-group">
                                <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Palabras clave</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <input id="keywords_de_noticia" class="form-control col-md-7 col-xs-12" name="keywords_de_noticia" placeholder="Palabras clave" type="text">
                                </div>
                            </div>
														
														<div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-2">
                                        <button type="submit" class="btn btn-success">Aceptar</button>
                                        <button type="button" class="btn btn-primary" onClick="javascript:retornar();">Cancelar</button>
                                    </div>
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
  </body>
</html>