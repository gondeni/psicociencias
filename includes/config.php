<?php
	include("config_ini.php");
	
	/* Se abre sesi�n en cada archivo .php  */
	session_start(); //Se abre la sesi�n o se crea una nueva.
	
	/* Se comprrueba que el usuario este validado, en caso contrario salimos.*/
	if ($_SESSION["id_user"] == "") header("Location: ../index.php");
	
	/* Se define la variable que va a controlar el nivel de los menus
	$index = "";*/

?>