<?php
  include('../includes/config_ini.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Title -->
  <title>SEMPyP</title>

  <!-- Required Meta Tags Always Come First -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <!-- Favicon -->
  <link rel="shortcut icon" href="../favicon.ico">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

  <!-- CSS Global Compulsory -->
  <link rel="stylesheet" href="../assets/vendor/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/vendor/icon-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/vendor/icon-line-pro/style.css">
  <link rel="stylesheet" href="../assets/vendor/icon-hs/style.css">
  <link rel="stylesheet" href="../assets/vendor/animate.css">
  <link rel="stylesheet" href="../assets/vendor/dzsparallaxer/dzsparallaxer.css">
  <link rel="stylesheet" href="../assets/vendor/dzsparallaxer/dzsscroller/scroller.css">
  <link rel="stylesheet" href="../assets/vendor/dzsparallaxer/advancedscroller/plugin.css">
  <link rel="stylesheet" href="../assets/vendor/hs-megamenu/src/hs.megamenu.css">
  <link rel="stylesheet" href="../assets/vendor/hamburgers/hamburgers.min.css">

  <!-- CSS Unify -->
  <link rel="stylesheet" href="../assets/css/unify-core.css">
  <link rel="stylesheet" href="../assets/css/unify-components.css">
  <link rel="stylesheet" href="../assets/css/unify-globals.css">

  <!-- CSS Customization -->
  <link rel="stylesheet" href="../assets/css/custom.css">
</head>

<body>
  <main>

    <?php include ("../cabecera.php"); ?>

    <section class="container g-pt-50 g-pb-40">
      <div class="row justify-content-between">
        <div class="col-lg-12 g-mb-20">
          <h2 class="h3">Formulario de Inscripción</h2>

          <p><b>Plazo de matriculaci&oacute;n:</b></p>
          <p>Desde el 1 de junio de 2018 hasta completar las plazas convocadas.</p>
          <p><b>Documentaci&oacute;n a presentar:</b></p>
          <ul>
            <li>Fotocopia del t&iacute;tulo de licenciatura o grado en Medicina o Psicolog&iacute;a, o fotocopia del carnet de Colegiado.
            En su caso, justificante de inscripci&oacute;n en el &uacute;ltimo curso de ambas titulaciones</li>
            <li>Fotograf&iacute;a tama&ntilde;o carnet</li>
            <li>Fotocopia del D.N.I o pasaporte</li>
            <li>Justificante de abono de tasas de inscripci&oacute;n</li>
          </ul>
          <p><b>Las plazas son limitadas, adjudic&aacute;ndose por riguroso orden de inscripci&oacute;n</b></p>

				<form action="enviar_inscripcion.php" method="POST" name="form" id="form" onSubmit="javascript:return comprobarFormulario();" enctype="multipart/form-data">

          <div class="card g-brd-primary rounded-0  g-mb-20">
            <h3 class="card-header h5 text-white g-bg-primary g-brd-transparent rounded-0">Datos personales</h3>
            <div class="card-block">
              <div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<div class="alert alert-warning" role="alert">Los campos marcados con * son obligatorios</div>
										<label for="apellidos">Apellidos*</label>
										<input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="nombre">Nombre*</label>
										<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="fechaNac">Fecha de nacimiento*</label>
										<input type="text" class="form-control" id="fechaNac" name="fechaNac" placeholder="dd-mm-aaaa">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="nacionalidad">Nacionalidad*</label>
										<input type="text" class="form-control" id="nacionalidad" name="nacionalidad" placeholder="Nacionalidad">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="domicilio">Domicilio*</label>
										<input type="text" class="form-control" id="domicilio" name="domicilio" placeholder="Domicilio">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="ciudad">Ciudad*</label>
										<input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="provincia">Provincia*</label>
										<input type="text" class="form-control" id="provincia" name="provincia" placeholder="Provincia">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="cp">C&oacute;digo postal*</label>
										<input type="text" class="form-control" id="cp" name="cp" placeholder="C&oacute;digo postal">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="dni">DNI / Pasaporte*</label>
										<input type="text" class="form-control" id="dni" name="dni" placeholder="DNI / Pasaporte">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="tlf">Tel&eacute;fono fijo</label>
										<input type="text" class="form-control" id="tlf" name="tlf" placeholder="Tel&eacute;fono fijo">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="movil">Tel&eacute;fono m&oacute;vil*</label>
										<input type="text" class="form-control" id="movil" name="movil" placeholder="Tel&eacute;fono m&oacute;vil">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="mail">Correo electr&oacute;nico*</label>
										<input type="email" class="form-control" id="mail" name="mail" placeholder="Correo electr&oacute;nico">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									 <div class="form-group">
											<label for="f_foto">Adjuntar fotograf&iacute;a*</label>
											<input type="file" id="f_foto" name="f_foto">
											<p class="help-block"><b>(Formato JPG)</b> Fotograf&iacute;a tama&ntilde;o carnet</p>
									  </div>
								</div>
								<div class="col-md-6">
									 <div class="form-group">
											<label for="f_dni">Adjuntar DNI / Pasaporte*</label>
											<input type="file" id="f_dni" name="f_dni">
											<p class="help-block"><b>(Formato PDF)</b> Fotocopia del D.N.I o pasaporte</p>
									  </div>
								</div>
							</div>
            </div>
          </div>

          <div class="card g-brd-primary rounded-0 g-mb-20">
            <h3 class="card-header h5 text-white g-bg-primary g-brd-transparent rounded-0">Datos profesionales</h3>
            <div class="card-block">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="grado">Licenciatura / Grado*</label>
										<input type="text" class="form-control" id="grado" name="grado" placeholder="Licenciatura / Grado">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="especialidad">Especialidad*</label>
										<input type="text" class="form-control" id="especialidad" name="especialidad" placeholder="Especialidad">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label for="fin">A&ntilde;o de finalizaci&oacute;n*</label>
										<input type="text" class="form-control" id="fin" name="fin" placeholder="A&ntilde;o de finalizaci&oacute;n">
									</div>
								</div>
								<div class="col-md-9">
									 <div class="form-group">
											<label for="titulo">Adjuntar t&iacute;tulo*</label>
											<input type="file" id="f_titulo" name="f_titulo">
											<p class="help-block"><b>(Formato PDF)</b> Fotocopia del t&iacute;tulo de licenciatura o grado en Medicina o Psicolog&iacute;a,
											o fotocopia del carnet de Colegiado. En su caso, justificante de inscripci&oacute;n en el &uacute;ltimo curso de
											ambas titulaciones.</p>
									  </div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="centro">Centro de trabajo</label>
										<input type="text" class="form-control" id="centro" name="centro" placeholder="Centro de trabajo">
									</div>
								</div>
							</div>

            </div>
          </div>

          <div class="card g-brd-primary rounded-0  g-mb-20">
            <h3 class="card-header h5 text-white g-bg-primary g-brd-transparent rounded-0">Tasas de inscripci&oacute;n y reserva de plaza* curso de experto (por cada curso)</h3>
            <div class="card-block">
							<div class="alert alert-success" role="alert">
								Presencial: 210 &euro; / Distancia (on-line): 190 &euro;</br>
								Clínica e Intervención en Trauma con EMDR y Psicoterapia Breve con Ni&ntilde;os y Adolescentes: 310 &euro; </br>
								Formación Superior en EMDR: 350 &euro;</br>
								Transferir o ingresar en la cuenta de la SEMPyP: Banco Popular ES54 0075 0134 77 0607312954 y adjuntar justificante.</br>
								<b>Para que la reserva de plaza se haga efectiva ser&aacute; imprescindible adjuntar el documento que justifique el pago de la inscripci&oacute;n</b>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="dia">Transferencia / ingreso realizado el d&iacute;a*</label>
										<input type="text" class="form-control" id="dia" name="dia" placeholder="dd-mm-aaaa">
										<p class="help-block">*No reembolsable. Se mantendr&aacute; vigente durante un a&ntilde;o.</p>
									</div>
								</div>
								<div class="col-md-6">
									 <div class="form-group">
											<label for="f_matricula">Adjuntar justificante*</label>
											<input type="file" id="f_matricula" name="f_matricula">
											<p class="help-block"><b>(Formato PDF)</b> Justificante de abono de tasas de inscripci&oacute;n</p>
									  </div>
								</div>
							</div>

            </div>
          </div>

          <div class="card g-brd-primary rounded-0  g-mb-20">
            <h3 class="card-header h5 text-white g-bg-primary g-brd-transparent rounded-0">Forma de pago*</h3>
            <div class="card-block">
							<div class="row">
								<div class="col-md-12">

									<label>Presenciales (marque la que corresponda)</label>
									<div class="radio">
										<label>
										  <input type="radio" name="pago" id="pagoD" value="P" onchange="datosDomiciliacion(this.value);">
										  Domiciliaci&oacute;n bancaria: 5 cuotas mensuales de 205 &euro;
										</label>
									</div>

									<div class="radio">
										<label>
										  <input type="radio" name="pago" id="pagoE" value="E" onchange="datosDomiciliacion(this.value);">
										  Efectivo (a abonar en las sesiones presenciales): 5 cuotas de 200 &euro;
										</label>
									</div>

									<p>&nbsp;</p>
									<label>On line</label>
									<div class="radio">
										<label>
										  <input type="radio" name="pago" id="pagoD" value="D" onchange="datosDomiciliacion(this.value);">
										  Domiciliaci&oacute;n bancaria: 9 cuotas mensuales de 100 &euro;
										</label>
									</div>

									<p>&nbsp;</p>
									<label>Clínica e Intervención en Trauma con EMDR y Psicoterapia Breve con Ni&ntilde;os y Adolescentes</label>
									<div class="radio">
										<label>
										  <input type="radio" name="pago" id="pagoX" value="P2" onchange="datosDomiciliacion(this.value);">
										  Domiciliaci&oacute;n bancaria: 3 cuotas mensuales de 310 &euro;
										</label>
									</div>

									<div class="radio">
										<label>
										  <input type="radio" name="pago" id="pagoX" value="E2" onchange="datosDomiciliacion(this.value);">
										  Efectivo (a abonar en las sesiones presenciales): 3 cuotas de 300 &euro;
										</label>
									</div>

									<p>&nbsp;</p>
									<label>Formación Superior en EMDR</label>
									<div class="radio">
										<label>
										  <input type="radio" name="pago" id="pagoX" value="P3" onchange="datosDomiciliacion(this.value);">
										  Domiciliaci&oacute;n bancaria: 3 cuotas mensuales de 365 &euro;
										</label>
									</div>

									<div class="radio">
										<label>
										  <input type="radio" name="pago" id="pagoX" value="E3" onchange="datosDomiciliacion(this.value);">
										  Efectivo (a abonar en las sesiones presenciales): 3 cuotas de 360 &euro;
										</label>
									</div>

									<p>&nbsp;</p>
									<label>Tasas universitarias (si se ha inscrito en esta modalidad):</label>
									<p>Pago &uacute;nico de 265 &euro; al solicitar el T&iacute;tulo.</p>

								</div>
							</div>

							<div id="datosDomiciliacion" style="display:none;">
								<p>&nbsp;</p>
								<label>Datos bancarios (cuenta de domiciliaci&oacute;n de las cuotas, si procede):</label>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="titularBanco">Titular</label>
											<input type="text" class="form-control" id="titularBanco" name="titularBanco" placeholder="Titular">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="banco">Entidad bancaria</label>
											<input type="text" class="form-control" id="banco" name="banco" placeholder="Entidad bancaria">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="iban">C&oacute;digo IBAN</label>
											<input type="text" class="form-control" id="iban" name="iban" placeholder="ES _ _ / _ _ _ _ / _ _ _ _ / _ _  / _ _ _ _ _ _ _ _ _ _ ">
										</div>
									</div>
								</div>
							</div>

            </div>
          </div>

          <div class="card g-brd-primary rounded-0  g-mb-20">
            <h3 class="card-header h5 text-white g-bg-primary g-brd-transparent rounded-0">Tipo de inscripción</h3>
            <div class="card-block">
							<div class="alert alert-success" role="alert">
								Curso/s en los que se inscribe (marque lo que proceda, presencial o distancia).</br>
								No olvide marcar la modalidad universitaria si est&aacute; interesado/a en tramitar as&iacute; su Curso de Experto.
							</div>

							<div class="row">
								<div class="col-md-6">
									<label>Nombre del curso</label>
								</div>

								<div class="col-md-2 center">
									<label>Universitario</label>
								</div>

								<div class="col-md-4 center">
									<label>Modalidad</label>
								</div>
							</div>

							<div class="row"><div class="col-md-12"><hr></div></div>

							<div class="row">
								<div class="col-md-6">
									<label>
										<input type="checkbox" class="casilla_comprobable" name="pbp" id="pbp">
										Psicoterapia Breve de Pareja
									</label>
								</div>

								<div class="col-md-2 center">
									<label class="checkbox-inline">
										<input type="radio" name="u_pbp" id="u_pbp_s" value="s"> S&iacute;
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="u_pbp" id="u_pbp_n" value="n" checked> No
									</label>
								</div>

								<div class="col-md-4 center">
									<label class="checkbox-inline">
										<input type="radio" name="m_pbp" id="m_pbp_p" value="p" checked> Presencial
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="m_pbp" id="m_pbp_d" value="d" hidden>
									</label>
								</div>
							</div>

							<div class="row"><div class="col-md-12"><hr></div></div>

							<!--<div class="row">
								<div class="col-md-6">
									<label>
										<input type="checkbox" class="casilla_comprobable" name="ipb" id="ipb">
										Integraci&oacute;n de T&eacute;cnicas en Psicoterapia
									</label>
								</div>

								<div class="col-md-2 center">
									<label class="checkbox-inline">
										<input type="radio" name="u_ipb" id="u_ipb_s" value="s"> S&iacute;
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="u_ipb" id="u_ipb_n" value="n" checked> No
									</label>
								</div>

								<div class="col-md-4 center">
									<label class="checkbox-inline">
										<input type="radio" name="m_ipb" id="m_ipb_p" value="p" checked> Presencial
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="m_ipb" id="m_ipb_d" value="d" hidden>
									</label>
								</div>
							</div>

							<div class="row"><div class="col-md-12"><hr></div></div>-->

							<div class="row">
								<div class="col-md-6">
									<label>
										<input type="checkbox" class="casilla_comprobable" name="epp" id="epp">
										Evaluaci&oacute;n Psicol&oacute;gica y Psicodiagn&oacute;stico
									</label>
								</div>

								<div class="col-md-2 center">
									<label class="checkbox-inline">
										<input type="radio" name="u_epp" id="u_epp_s" value="s"> S&iacute;
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="u_epp" id="u_epp_n" value="n" checked> No
									</label>
								</div>

								<div class="col-md-4 center">
									<label class="checkbox-inline">
										<input type="radio" name="m_epp" id="m_epp_p" value="p" checked> Presencial
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="m_epp" id="m_epp_d" value="d" hidden>
									</label>
								</div>
							</div>

							<div class="row"><div class="col-md-12"><hr></div></div>

							<div class="row">
								<div class="col-md-6">
									<label>
										<input type="checkbox" class="casilla_comprobable" name="cit" id="cit">
										Cl&iacute;nica e Intervenci&oacute;n en Trauma con EMDR
									</label>
								</div>

								<div class="col-md-2 center">
									<label class="checkbox-inline">
										<input type="radio" name="u_cit" id="u_cit_s" value="s"> S&iacute;
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="u_cit" id="u_cit_n" value="n" checked> No
									</label>
								</div>

								<div class="col-md-4 center">
									<label class="checkbox-inline">
										<input type="radio" name="m_cit" id="m_cit_p" value="p" checked> Presencial
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="m_cit" id="m_cit_d" value="d" hidden>
									</label>
								</div>
							</div>

							<div class="row"><div class="col-md-12"><hr></div></div>

							<div class="row">
								<div class="col-md-6">
									<label>
										<input type="checkbox" class="casilla_comprobable" name="cit" id="cit">
										Formación Superior en EMDR
									</label>
								</div>

								<div class="col-md-2 center">
									<label class="checkbox-inline">
										<input type="radio" name="u_fs" id="u_fs_s" value="s"> S&iacute;
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="u_fs" id="u_fs_n" value="n" checked> No
									</label>
								</div>

								<div class="col-md-4 center">
									<label class="checkbox-inline">
										<input type="radio" name="m_fs" id="m_fs_p" value="p" checked> Presencial
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="m_fs" id="m_fs_d" value="d" hidden>
									</label>
								</div>
							</div>

							<div class="row"><div class="col-md-12"><hr></div></div>

							<div class="row">
								<div class="col-md-6">
									<label>
										<input type="checkbox" class="casilla_comprobable" name="pb" id="pb">
										Psicoterapia Breve
									</label>
								</div>

								<div class="col-md-2 center">
									<label class="checkbox-inline">
										<input type="radio" name="u_pb" id="u_pb_s" value="s"> S&iacute;
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="u_pb" id="u_pb_n" value="n" checked> No
									</label>
								</div>

								<div class="col-md-4 center">
									<label class="checkbox-inline">
										<input type="radio" name="m_pb" id="m_pb_p" value="p" checked> Presencial
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="m_pb" id="m_pb_d" value="d"> On line
									</label>
								</div>
							</div>

							<div class="row"><div class="col-md-12"><hr></div></div>

							<div class="row">
								<div class="col-md-6">
									<label>
										<input type="checkbox" class="casilla_comprobable" name="mp" id="mp">
										Medicina Psicosom&aacute;tica y Psicolog&iacute;a de la Salud
									</label>
								</div>

								<div class="col-md-2 center">
									<label class="checkbox-inline">
										<input type="radio" name="u_mp" id="u_mp_s" value="s"> S&iacute;
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="u_mp" id="u_mp_n" value="n" checked> No
									</label>
								</div>

								<div class="col-md-4 center">
									<label class="checkbox-inline">
										<input type="radio" name="m_mp" id="m_mp_p" value="p" checked> Presencial
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="m_mp" id="m_mp_d" value="d"> On line
									</label>
								</div>
							</div>

							<div class="row"><div class="col-md-12"><hr></div></div>

							<div class="row">
								<div class="col-md-6">
									<label>
										<input type="checkbox" class="casilla_comprobable" name="pbn" id="pbn">
										Psicoterapia Breve con Ni&ntilde;os y Adolescentes
									</label>
								</div>

								<div class="col-md-2 center">
									<label class="checkbox-inline">
										<input type="radio" name="u_pbn" id="u_pbn_s" value="s"> S&iacute;
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="u_pbn" id="u_pbn_n" value="n" checked> No
									</label>
								</div>

								<div class="col-md-4 center">
									<label class="checkbox-inline">
										<input type="radio" name="m_pbn" id="m_pbn_p" value="p" checked> Presencial
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="m_pbn" id="m_pbn_d" value="d" > On line
									</label>
								</div>
							</div>

							<div class="row"><div class="col-md-12"><hr></div></div>

							<div class="row">
								<div class="col-md-6">
									<label>
										<input type="checkbox" class="casilla_comprobable" name="pp" id="pp">
										Psicopatolog&iacute;a y Psiquiatr&iacute;a
									</label>
								</div>

								<div class="col-md-2 center">
									<label class="checkbox-inline">
										<input type="radio" name="u_pp" id="u_pp_s" value="s"> S&iacute;
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="u_pp" id="u_pp_n" value="n" checked> No
									</label>
								</div>

								<div class="col-md-4 center">
									<label class="checkbox-inline">
										<input type="radio" name="m_pp" id="m_pp_p" value="p" checked> Presencial
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="m_pp" id="m_pp_d" value="d"> On line
									</label>
								</div>
							</div>

							<div class="row"><div class="col-md-12"><hr></div></div>

							<div class="row">
								<div class="col-md-6">
									<label>
										<input type="checkbox" class="casilla_comprobable" name="tp" id="tp">
										Trastornos de Personalidad
									</label>
								</div>

								<div class="col-md-2 center">
									<label class="checkbox-inline">
										<input type="radio" name="u_tp" id="u_tp_s" value="s"> S&iacute;
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="u_tp" id="u_tp_n" value="n" checked> No
									</label>
								</div>

								<div class="col-md-4 center">
									<label class="checkbox-inline">
										<input type="radio" name="m_tp" id="m_tp_p" value="p" hidden>
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="m_tp" id="m_tp_d" value="d" checked> On line
									</label>
								</div>
							</div>

							<div class="row"><div class="col-md-12"><hr></div></div>

							<div class="row">
								<div class="col-md-6">
									<label>
										<input type="checkbox" class="casilla_comprobable" name="pc" id="pc">
										Psicofarmacolog&iacute;a Cl&iacute;nica
									</label>
								</div>

								<div class="col-md-2 center">
									<label class="checkbox-inline">
										<input type="radio" name="u_pc" id="u_pc_s" value="s" hidden>
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="u_pc" id="u_pc_n" value="n" checked> No
									</label>
								</div>

								<div class="col-md-4 center">
									<label class="checkbox-inline">
										<input type="radio" name="m_pc" id="m_pc_p" value="p" hidden>
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="m_pc" id="m_pc_d" value="d" checked> On line
									</label>
								</div>
							</div>

								<div class="row"><div class="col-md-12"><hr></div></div>

							<div class="row">
								<div class="col-md-6">
									<label>
										<input type="checkbox" class="casilla_comprobable" name="pg" id="pg">
										Psicogeriatr&iacute;a
									</label>
								</div>

								<div class="col-md-2 center">
									<label class="checkbox-inline">
										<input type="radio" name="u_pg" id="u_pg_s" value="s" hidden>
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="u_pg" id="u_pg_n" value="n" checked> No
									</label>
								</div>

								<div class="col-md-4 center">
									<label class="checkbox-inline">
										<input type="radio" name="m_pg" id="m_pg_p" value="p" hidden>
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="m_pg" id="m_pg_d" value="d" checked> On line
									</label>
								</div>
							</div>

							<div class="row"><div class="col-md-12"><hr></div></div>

							<div class="row">
								<div class="col-md-6">
									<label>
										<input type="checkbox" class="casilla_comprobable" name="tca" id="tca">
										Trastornos del Comportamiento Alimentario
									</label>
								</div>

								<div class="col-md-2 center">
									<label class="checkbox-inline">
										<input type="radio" name="u_tca" id="u_tca_s" value="s" hidden>
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="u_tca" id="u_tca_n" value="n" checked> No
									</label>
								</div>

								<div class="col-md-4 center">
									<label class="checkbox-inline">
										<input type="radio" name="m_tca" id="m_tca_p" value="p" hidden>
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="m_tca" id="m_tca_d" value="d" checked> On line
									</label>
								</div>
							</div>

							<div class="row"><div class="col-md-12"><hr></div></div>

							<div class="row">
								<div class="col-md-12">
									<label>
										<input type="checkbox" name="politica" id="politica" value="S" onchange="aceptarPolitica(this.value);">
										He leído y acepto la <a href="../nosotros/subSeccion.php?mIdDeSubseccion=38" target="_blank">política de privacidad</a>
									</label>
								</div>
							</div>

							<div id="botonMatricula" style="display:none;">
                <button class="btn btn-lg u-btn-primary g-font-weight-600 g-font-size-default rounded-3 text-uppercase g-py-5 g-px-20" id="boton_envio" type="submit" role="button">Reralizar matrícula</button>
							</div>

            </div>
          </div>

        </form>

        <div>
					<!--<p>*Acceso limitado a alumnos con un m&iacute;nimo de dos cursos de Experto realizados.</p>-->
					<p>De conformidad con la actual normativa de Protecci&oacute;n de Datos de Car&aacute;cter Personal,
					le informamos de que los datos obtenidos por medio de este formulario ser&aacute;n incorporados a un fichero titularidad de
					la SEMPyP y ser&aacute;n gestionados de acuerdo a dicha Ley.</p>
				</div>

        </div>

      </div>

    </section>

    <?php include ("../pie.php"); ?>

    <a class="js-go-to u-go-to-v1" href="#!" data-type="fixed" data-position='{
     "bottom": 15,
     "right": 15
   }' data-offset-top="400" data-compensation="#js-header" data-show-effect="zoomIn">
      <i class="hs-icon hs-icon-arrow-top"></i>
    </a>
  </main>

  <div class="u-outer-spaces-helper"></div>

  <!-- JS Global Compulsory -->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/jquery-migrate/jquery-migrate.min.js"></script>
  <script src="../assets/vendor/popper.min.js"></script>
  <script src="../assets/vendor/bootstrap/bootstrap.min.js"></script>


  <!-- JS Implementing Plugins -->
  <script src="../assets/vendor/hs-megamenu/src/hs.megamenu.js"></script>
  <script src="../assets/vendor/dzsparallaxer/dzsparallaxer.js"></script>

  <!-- JS Unify -->
  <script src="../assets/js/hs.core.js"></script>
  <script src="../assets/js/components/hs.header.js"></script>
  <script src="../assets/js/helpers/hs.hamburgers.js"></script>
  <script src="../assets/js/components/hs.tabs.js"></script>
  <script src="../assets/js/components/hs.go-to.js"></script>

  <!-- JS Plugins Init. -->
  <script>

      $(window).on('load', function () {
        // initialization of header
        $.HSCore.components.HSHeader.init($('#js-header'));
        $.HSCore.helpers.HSHamburgers.init('.hamburger');

        // initialization of HSMegaMenu component
        $('.js-mega-menu').HSMegaMenu({
          event: 'hover',
          pageContainer: $('.container'),
          breakpoint: 991
        });
      });

    /* Funciones para el formulario */

		function comprobarFormulario() {
			document.getElementById("apellidos").value = document.getElementById("apellidos").value.trim();
			if (document.getElementById("apellidos").value == "") {
				alert("El apellido no puede estar en blanco.");
				document.getElementById("apellidos").focus();
				return false;
			}
			document.getElementById("nombre").value = document.getElementById("nombre").value.trim();
			if (document.getElementById("nombre").value == "") {
				alert("El nombre no puede estar en blanco.");
				document.getElementById("nombre").focus();
				return false;
			}
			document.getElementById("fechaNac").value = document.getElementById("fechaNac").value.trim();
			if (document.getElementById("fechaNac").value == "") {
				alert("La fecha de nacimiento no puede estar en blanco.");
				document.getElementById("fechaNac").focus();
				return false;
			}
			document.getElementById("nacionalidad").value = document.getElementById("nacionalidad").value.trim();
			if (document.getElementById("nacionalidad").value == "") {
				alert("La nacionalidad no puede estar en blanco.");
				document.getElementById("nacionalidad").focus();
				return false;
			}
			document.getElementById("domicilio").value = document.getElementById("domicilio").value.trim();
			if (document.getElementById("domicilio").value == "") {
				alert("El domicilio no puede estar en blanco.");
				document.getElementById("domicilio").focus();
				return false;
			}
			document.getElementById("ciudad").value = document.getElementById("ciudad").value.trim();
			if (document.getElementById("ciudad").value == "") {
				alert("La ciudad no puede estar en blanco.");
				document.getElementById("ciudad").focus();
				return false;
			}
			document.getElementById("provincia").value = document.getElementById("provincia").value.trim();
			if (document.getElementById("provincia").value == "") {
				alert("La provincia no puede estar en blanco.");
				document.getElementById("provincia").focus();
				return false;
			}
			document.getElementById("cp").value = document.getElementById("cp").value.trim();
			if (document.getElementById("cp").value == "") {
				alert("El codigo postal no puede estar en blanco.");
				document.getElementById("cp").focus();
				return false;
			}
			document.getElementById("dni").value = document.getElementById("dni").value.trim();
			if (document.getElementById("dni").value == "") {
				alert("El DNI / Pasaporte no puede estar en blanco.");
				document.getElementById("dni").focus();
				return false;
			}
			document.getElementById("movil").value = document.getElementById("movil").value.trim();
			if (document.getElementById("movil").value == "") {
				alert("El telefono movil no puede estar en blanco.");
				document.getElementById("movil").focus();
				return false;
			}
			document.getElementById("mail").value = document.getElementById("mail").value.trim();
			if (document.getElementById("mail").value == "") {
				alert("El email no puede estar en blanco.");
				document.getElementById("mail").focus();
				return false;
			}
			document.getElementById("grado").value = document.getElementById("grado").value.trim();
			if (document.getElementById("grado").value == "") {
				alert("La Licenciatura / Grado no puede estar en blanco.");
				document.getElementById("grado").focus();
				return false;
			}
			document.getElementById("fin").value = document.getElementById("fin").value.trim();
			if (document.getElementById("fin").value == "") {
				alert("la fecha de fin no puede estar en blanco.");
				document.getElementById("fin").focus();
				return false;
			}
			document.getElementById("especialidad").value = document.getElementById("especialidad").value.trim();
			if (document.getElementById("especialidad").value == "") {
				alert("La especialidad no puede estar en blanco.");
				document.getElementById("especialidad").focus();
				return false;
			}
			document.getElementById("dia").value = document.getElementById("dia").value.trim();
			if (document.getElementById("dia").value == "") {
				alert("La fecha de ingreso no puede estar en blanco.");
				document.getElementById("dia").focus();
				return false;
			}
			opciones = document.getElementsByName("pago");
			var seleccionado = false;
			for(var i=0; i<opciones.length; i++) {
				if(opciones[i].checked) {
				  seleccionado = true;
				  break;
				}
			}
			if(!seleccionado) {
				alert("La modalidad de pago no puede estar en blanco.");
				return false;
			}
			var foto =  document.getElementById("f_foto").value;
			 if (foto == "" ) {
				alert("Por favor, adjunte la fotografia solicitada");
				return false;
			}
			var formatoFoto =  (foto.substring(foto.lastIndexOf("."))).toLowerCase();
			if (formatoFoto != ".jpg") {
				alert("El formato de la foto no es jpg");
				return false;
			}
			var dni =  document.getElementById("f_dni").value;
			 if (dni == "" ) {
				alert("Por favor, adjunte el dni / pasaporte solicitado");
				return false;
			}
			var formatoDni =  (dni.substring(dni.lastIndexOf("."))).toLowerCase();
			if (formatoDni != ".pdf") {
				alert("El formato del DNI no es pdf");
				return false;
			}
			var titulo =  document.getElementById("f_titulo").value;
			 if (titulo == "" ) {
				alert("Por favor, adjunte el titulo solicitado");
				return false;
			}
			var formatoTitulo =  (titulo.substring(titulo.lastIndexOf("."))).toLowerCase();
			if (formatoTitulo != ".pdf") {
				alert("El formato del Titulo no es pdf");
				return false;
			}
			var matricula =  document.getElementById("f_matricula").value;
			 if (matricula == "" ) {
				alert("Por favor, adjunte el justificante solicitado");
				return false;
			}
			var formatoMatricula =  (matricula.substring(matricula.lastIndexOf("."))).toLowerCase();
			if (formatoMatricula != ".pdf") {
				alert("El formato del justificante no es pdf");
				return false;
			}
			return true;
		}

		function datosDomiciliacion(dato){
			if(dato=="P"){
				document.getElementById("datosDomiciliacion").style.display = "block";
			}
			if(dato=="D"){
				document.getElementById("datosDomiciliacion").style.display = "block";
			}
			if(dato=="E"){
				document.getElementById("datosDomiciliacion").style.display = "none";
			}
			if(dato=="P2"){
				document.getElementById("datosDomiciliacion").style.display = "block";
			}
			if(dato=="E2"){
				document.getElementById("datosDomiciliacion").style.display = "none";
			}
			if(dato=="P3"){
				document.getElementById("datosDomiciliacion").style.display = "block";
			}
			if(dato=="E3"){
				document.getElementById("datosDomiciliacion").style.display = "none";
			}

		}

		function aceptarPolitica(dato){
			if(dato=="S"){
				document.getElementById("botonMatricula").style.display = "block";
			}
		}

		$(function(){
			$('#boton_envio').on('click', function(e){
				e.preventDefault();

				var checkboxMarcados = 0;
				$('.casilla_comprobable').each(function(){
					if ($(this).prop('checked')) checkboxMarcados ++;
				});
				if (checkboxMarcados == 0) alert("Seleccione, al menos, un curso.");

				if (checkboxMarcados > 0) $('#form').submit();
			});
		});

	</script>


</body>

</html>
