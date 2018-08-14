<?php

	include("config_ini.php");

	/* Se comprrueba que el usuario este validado, en caso contrario salimos.  */
	if ($_SESSION["id_de_usuario"] == "") header("Location: index.php");

	/* Se define la variable que va a controlar el nivel de los menus */
	$index = "";

?>
