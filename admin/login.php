<?php
    header('Content-Type: text/html; charset=utf8');
    
    /* Si no se han registrado las variables de sesión, se registran ahora.
    /* Una vez creadas las variables de sesión (si no lo estaban ya), son inicializadas.
      Esta inicialización se produce cada vez que se pasa por esta página. */
    $_SESSION["id_de_usuario"] = "";
    $_SESSION["nombre_de_usuario"] = "";
    $_SESSION["apellidos_de_usuario"] = "";
    
    /* Se identifica si venimos de un acceso denegado*/
    $accesoDenegado = $_REQUEST["acceso"];
        
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SEMPyP</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form action="verificar_acceso.php" method="post">
                    <input type="hidden" name="<?php echo session_name(); ?>2" value="<?php echo session_id(); ?>" />
                    <h1>Acceso al panel web</h1>
                    <div>
                        <input type="text" id="mLogin" name="mLogin" class="form-control" placeholder="Usuario" required="" />
                    </div>
                    <div>
                        <input type="password" id="mPassword" name="mPassword" class="form-control" placeholder="Contrase&ntilde;a" required="" />
                    </div>
                    <div>
                        <button type="submit" class="btn btn-default submit" >Iniciar sesi&oacute;n</button>
                    </div>
                </form>
                 <?php
                    if ($accesoDenegado == "no") {
                        echo "<div class=\"alert alert-danger\" role=\"alert\">";
                        echo "El nombre de usuario y/o contrase&ntilde;a no es correcto";
                        echo "</div>";
                    }
                ?>
                <div class="separator"><div>
                    <p>©2018 Todos los derechos reservados.</p>
                </div>
            </div>
            </section>
        </div>
      </div>
    
    </div>
  </body>
</html>