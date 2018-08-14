<?php
	include('../includes/config_ini.php');
  
	$id_de_miembro = $_GET["id_de_miembro"];
  
  /* Hacemos consulta de entidades */
	$consulta = "SELECT * ";
	$consulta .= "FROM miembros ";
	$consulta .= "WHERE id_miembro = :idDeMiembro;";
	$hacerConsulta = $conexion->prepare($consulta); // Se crea un objeto PDOStatement.
    $hacerConsulta->bindParam(":idDeMiembro", $id_de_miembro); 
	$hacerConsulta->execute(); // Se ejecuta la consulta.
	$matriz = $hacerConsulta->fetchAll(PDO::FETCH_ASSOC); // Se recuperan los resultados.
	$hacerConsulta->closeCursor(); // Se libera el recurso.

?>

<!DOCTYPE html>
<html lang="es">
	<head>
	  <!-- Required Meta Tags Always Come First -->
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta http-equiv="x-ua-compatible" content="ie=edge">

	  <!-- Google Fonts -->
	  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	  
	  <!-- CSS Global Compulsory -->
	  <link rel="stylesheet" href="../assets/vendor/bootstrap/bootstrap.min.css">
	  <link rel="stylesheet" href="../assets/vendor/icon-awesome/css/font-awesome.min.css">
	  <link rel="stylesheet" href="../assets/vendor/icon-line-pro/style.css">
	  <link rel="stylesheet" href="../assets/vendor/icon-hs/style.css">
	  <!--<link rel="stylesheet" href="../assets/vendor/animate.css">
	  <link rel="stylesheet" href="../assets/vendor/dzsparallaxer/dzsparallaxer.css">
	  <link rel="stylesheet" href="../assets/vendor/dzsparallaxer/dzsscroller/scroller.css">
	  <link rel="stylesheet" href="../assets/vendor/dzsparallaxer/advancedscroller/plugin.css">
	  <link rel="stylesheet" href="../assets/vendor/hs-megamenu/src/hs.megamenu.css">
	  <link rel="stylesheet" href="../assets/vendor/hamburgers/hamburgers.min.css">-->

	  <!-- CSS Unify -->
	  <link rel="stylesheet" href="../assets/css/unify-core.css">
	  <link rel="stylesheet" href="../assets/css/unify-components.css">
	  <link rel="stylesheet" href="../assets/css/unify-globals.css">
	
	  <!-- CSS Customization -->
	  <link rel="stylesheet" href="../assets/css/custom.css">
	</head>
	
	<body>
		<p>Hola mundo</p>
	</body>
</html>