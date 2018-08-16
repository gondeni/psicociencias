<?php
	header("Pragma: no-cache");
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

	/***********************************************************************************/
	$nombreDeLaEmpresa = "Sociedad Espa&ntilde;ola de Medicina Psicosom&aacute;tica y Psicoterapia";
	$nombreDelPanel= "CRM SEMPyP";
	/***********************************************************************************/

	 // CONEXION LOCAL
	$usuario = "root";
	$password = "";
	$baseDeDatos = "psico2018";
	$servidor = "localhost";
	$dsn = "mysql:host=".$servidor.";dbname=".$baseDeDatos.";port=3306;charset=UTF8";


	/* CONEXION REMOTA */
	// $usuario = "JLML10_cherrera";
	// $password = "C467345hr";
	// $baseDeDatos = "psico2018";
	// $servidor = "hostingmysql292.nominalia.com";
	// $dsn = "mysql:host=".$servidor.";dbname=".$baseDeDatos.";port=3306;charset=UTF8";


	/* Se conecta con la base de datos elegida.    */
	$conexion = new PDO ($dsn, $usuario, $password);
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
