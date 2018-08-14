<?php
	/* Este script determina si los datos de identificacion son correctos y cual es el destino de la redirecci�n, seg�n se trate de un administrador,
	  un alumno o un padre, o no sea ninguno (o no est� autorizado). */
	include_once ("includes/config_ini.php"); //Se incluyen los datos de configuraci�n, una sola vez, por si se incorpora alguna funci�n.
	include_once ("includes/funciones_auxiliares.php"); //Se incluyen los datos de configuraci�n, una sola vez, por si se incorpora alguna funci�n.

	if (!isset($_REQUEST["mLogin"]) || !isset($_REQUEST["mPassword"])) exit(); // Si alguna de estas variables no est� definida, no se ha entrado desde el formulario principal.

	$destino = "";
	$mLogin = $_REQUEST["mLogin"];
	$mPassword = codificaClave($_REQUEST["mPassword"]);
	$paginaDeAccesoDenegado = "login.php?acceso=no";

	/* Se verifica si el usuario existe y es correcto */
	$id_de_usuario = "";
	$consulta = "SELECT id_de_usuario, tipo_de_usuario, nombre_de_usuario, apellidos_de_usuario ";
	$consulta .= "FROM maestro_de_usuarios ";
	$consulta .= "WHERE estado_de_usuario = 'A' ";
	$consulta .= "AND login_de_usuario= :loginDeUsuario ";
	$consulta .= "AND password_de_usuario= :passwordDeUsuario ;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
	$hacerConsulta->bindParam(":loginDeUsuario", $mLogin); // Se asigna una variable para la consulta.
	$hacerConsulta->bindParam(":passwordDeUsuario", $mPassword); // Se asigna una variable para la consulta.
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$matrizdeUsuarios = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
	$numero_de_usuarios = count($matrizdeUsuarios);
	$hacerConsulta->closeCursor(); // Se libera el recurso.

	if ($numero_de_usuarios == 1) {
		session_start(); //Se abre la sesi�n o se crea una nueva.
		$_SESSION["id_de_usuario"] = $matrizdeUsuarios[0]["id_de_usuario"];
		$_SESSION["nombre_de_usuario"] = $matrizdeUsuarios[0]["nombre_de_usuario"];
		$_SESSION["apellidos_de_usuario"] = $matrizdeUsuarios[0]["apellidos_de_usuario"];
		$_SESSION["tipo_de_usuario"] = $matrizdeUsuarios[0]["tipo_de_usuario"];
		$destino = "dashboard.php";

		/* Se registra el acceso en la bd */
		$ip_llamante = $_SERVER["REMOTE_ADDR"];
		$navegador = $_SERVER["HTTP_USER_AGENT"];
		$fechaDeAcceso = date("Y-m-d");
		$horaDeAcceso = date("H:i");

		/* Se recupera los datos de configuracion  */
		$consulta = "SELECT nombre, valor ";
		$consulta .= "FROM maestro_de_sistema ";
		$consulta .= "WHERE nombre = :nombreDeEmpresa;";
		$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
		$hacerConsulta->bindValue(":nombreDeEmpresa", "nombre_de_empresa"); // Se asigna una variable para la consulta.
		$hacerConsulta->execute(); // Se ejecuta la consulta.
		$matrizDeSistema = $hacerConsulta->fetch(PDO::FETCH_ASSOC); // Se recuperan los resultados.
		$hacerConsulta->closeCursor(); // Se libera el recurso.
		$_SESSION["nombre_de_empresa"] = $matrizDeSistema["valor"];

		/* Se registra la entrada en el historico de accesos */
		$consulta = "INSERT INTO historico_de_accesos (";
		$consulta .= "id_de_usuario, fecha_de_acceso, hora_de_acceso, ip_de_acceso, navegador_de_acceso";
		$consulta .= ") VALUES (";
		$consulta .= ":idDeUsuario, :fechaDeAcceso, :horaDeAcceso, :ipDeAcceso, :navegadorDeAcceso);";
		$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
		$hacerConsulta->bindParam(":idDeUsuario", $matrizdeUsuarios[0]["id_de_usuario"]);
		$hacerConsulta->bindParam(":fechaDeAcceso", $fechaDeAcceso);
		$hacerConsulta->bindParam(":horaDeAcceso", $horaDeAcceso);
		$hacerConsulta->bindParam(":ipDeAcceso", $ip_llamante);
		$hacerConsulta->bindParam(":navegadorDeAcceso", $navegador);
		$hacerConsulta->execute(); // Se ejecuta la consulta.
		$hacerConsulta->closeCursor(); // Se libera el recurso.
	} else {
		$destino = $paginaDeAccesoDenegado;
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<script language="javascript" type="text/javascript">
			function inicializar() {
				location.href = "<?php echo $destino; ?>";
			}
		</script>
	</head>
	<body onLoad="javascript:inicializar();">
	</body>
</html>
