<?php
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

	/***********************************************************************************/
	$nombreDeLaEmpresa = "SEMPyP";
	$nombreDelPanel= "Panel de Administraci&oacute;n Web";
	/***********************************************************************************/

	/* CONEXION LOCAL 
	$usuario = "root";
	$password = "";
	$dsn = "mysql:host=localhost;dbname=psico2018;port=3306;charset=UTF8";
    */ 

	/* CONEXION REMOTA */
	$usuario = "JLML10_cherrera";
	$password = "C467345hr";
	$baseDeDatos = "psico2018";
	$servidor = "hostingmysql292.nominalia.com";
	$dsn = "mysql:host=".$servidor.";dbname=".$baseDeDatos.";port=3306;charset=UTF8";
	
	
	/* Se conecta con la base de datos elegida.    */
	$conexion = new PDO ($dsn, $usuario, $password);
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	/* Se abre sesi�n en cada archivo .php  */
	session_start(); //Se abre la sesi�n o se crea una nueva.
	

?>
