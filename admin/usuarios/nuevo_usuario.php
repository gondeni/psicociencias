<?php
	header('Content-Type: text/html; charset=utf8');
	include ("../includes/config.php");
	
	$nombreDeEmpresa = $_SESSION["nombre_de_empresa"];
	
	/* Se establece la página de retorno */
	$paginaDeRetorno = "usuarios.php";
	
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
                <h3>Nuevo usuario</h3>
              </div>
            </div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                    
                        <form action="grabar_usuario.php" method="POST" name="form" class="form-horizontal form-label-left" novalidate autocomplete="off">

                            <span class="section">Datos del usuario</span>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nombre<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
					<input id="nombre_de_usuario" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" data-validate-words="1" name="nombre_de_usuario" placeholder="Nombre de usuario" required="required" type="text">
                                </div>
                            </div>
			    <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Apellidos<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
					<input id="apellidos_de_usuario" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" data-validate-words="1" name="apellidos_de_usuario" placeholder="Apellidos de usuario" required="required" type="text">
                                </div>
                            </div>
			    <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Login<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
					<input id="login_de_usuario" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="1" name="login_de_usuario" placeholder="Login de usuario" required="required" type="text">
                                </div>
                            </div>
			    <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Contrase&ntilde;a<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
					<input id="password_de_usuario" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="1" name="password_de_usuario" placeholder="Contrase&ntilde;a de usuario" required="required" type="password">
                                </div>
                            </div>
			    <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tipo</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
					<select class="form-control" id="tipo_de_usuario" name="tipo_de_usuario">
						<?php
							foreach ($matrizDeTiposDeUsuario as $item) {
								echo "<option value=\"".$item["valor"]."\">".$item["nombres_para_mostrar"]."</option>\n";
							}
						?>
					</select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Estado</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="estado_de_usuario" class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="estado_de_usuario" value="A" checked="checked"> &nbsp; Activo &nbsp;
                                        </label>
                                        <label class="btn btn-default" data-toggle-class="btn btn-default" data-toggle-passive-class="btn-default">
                                            <input type="radio" name="estado_de_usuario" value="I"> Inactivo
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
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