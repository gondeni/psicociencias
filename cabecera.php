    <!-- Header -->
    <header id="js-header" class="u-header u-header--sticky-top u-header--toggle-section u-header--change-appearance" data-header-fix-moment="300">
            
      <!-- Menu -->
      <div class="u-header__section u-header__section--light g-bg-white g-transition-0_3 g-py-10 g-py-0--lg marco-menu-psico" data-header-fix-moment-classes="u-shadow-v18">
        <nav class="js-mega-menu navbar navbar-expand-lg py-0 menu-psico">
          <div class="container">
            <!-- Responsive Toggle Button -->
            <button class="navbar-toggler navbar-toggler-right btn g-line-height-1 g-brd-none g-pa-0 g-pos-abs g-top-3 g-right-0" type="button" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
              <span class="hamburger hamburger--slider">
            <span class="hamburger-box">
              <span class="hamburger-inner"></span>
              </span>
              </span>
            </button>
            <!-- End Responsive Toggle Button -->
            <!-- Logo -->
            <a href="../index.php" class="navbar-brand">
              <img src="../imagenes/logo200.png" alt="Logotipo de la SEMPyP">
            </a>
            <!-- End Logo -->

            <!-- Navigation -->
            <div class="collapse navbar-collapse align-items-center flex-sm-row g-pt-10 g-pt-5--lg" id="navBar">
              <ul class="navbar-nav ml-auto text-uppercase g-font-weight-600 u-main-nav-v3 u-sub-menu-v3">
                
                <li class="nav-item hs-has-sub-menu g-mx-2--md g-mx-5--xl g-mb-5 g-mb-0--lg">
                  <a href="#!" class="nav-link" id="nav-link-1" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-1">NOSOTROS</a>
                  <!-- Submenu -->
                  <ul class="hs-sub-menu list-unstyled" id="nav-submenu-1" aria-labelledby="nav-link-1">
                    <li>
                      <a href="../nosotros/centro_clinico.php">CENTRO CLÍNICO</a>
                    </li>
                    <li>
                      <a href="../nosotros/profesores.php">PROFESORES</a>
                    </li>
                    <li>
                      <a href="../nosotros/miembros.php">MIEMBROS DE LA SOCIEDAD</a>
                    </li>
                    <li>
                      <a href="../nosotros/entidades.php">ENTIDADES COLABORADORAS</a>
                    </li>
                  </ul>
                  <!-- End Submenu -->
                </li>
                
                <li class="nav-item hs-has-sub-menu g-mx-2--md g-mx-5--xl g-mb-5 g-mb-0--lg">
                  <a href="!#" class="nav-link" id="nav-link-1" aria-haspopup="true" aria-expanded="false" aria-controls="nav-submenu-1">MÁSTER</a>
                  <!-- Submenu -->
                  <ul class="hs-sub-menu list-unstyled" id="nav-submenu-1" aria-labelledby="nav-link-1">
                    <li>
                      <a href="javascript:saltarACurso(9);">MÁSTER EN PSICOTERAPIA BREVE</a>
                    </li>
                    <li>
                      <a href="javascript:saltarACurso(8);">MÁSTER EN PSICOLOGÍA CLÍNICA Y PSICOTERAPIA</a>
                    </li>
                    <li>
                      <a href="javascript:saltarACurso(20);">MÁSTER EN CLÍNICA E INTERVENCIÓN EN TRAUMA CON E.M.D.R.</a>
                    </li>
                  </ul>
                  <!-- End Submenu -->
                </li>
                
                <li class="nav-item g-mx-2--md g-mx-5--xl g-mb-5 g-mb-0--lg">
                  <a href="../formacion/experto.php" class="nav-link">CURSOS DE EXPERTO</a>
                </li>
                
                <li class="nav-item g-mx-2--md g-mx-5--xl g-mb-5 g-mb-0--lg">
                  <a href="../formacion/fcontinua.php" class="nav-link">FORMACIÓN CONTÍNUA</a>
                </li>
                
                <li class="nav-item g-mx-2--md g-mx-5--xl g-mb-5 g-mb-0--lg">
                  <a href="../noticias/noticias.php" class="nav-link">NOTICIAS</a>
                </li>
                
                <li class="nav-item g-mx-2--md g-mx-5--xl g-mb-5 g-mb-0--lg">
                  <a href="#!" class="nav-link">REVISTA DIGITAL</a>
                </li>
                
                <li class="nav-item g-mx-2--md g-mx-5--xl g-mb-5 g-mb-0--lg">
                  <a href="../contacto/contacto.php" class="nav-link">CONTACTO</a>
                </li>
                
              </ul>
            </div>
            <!-- End Navigation -->
          </div>
        </nav>
      </div>

      <!-- Fin menu -->

    </header>
    <!-- End Header -->
    
    <div style="margin-bottom:50px;">&nbsp;</div>
    
    <!-- Formulario de salto -->
    <form action="" id="formularioDeSalto" method="post">
        <input type="hidden" name="id_de_curso" id="id_de_curso" value="" />
    </form>
    
    <script>
        // Paso a curso individual
		function saltarACurso (id) {
			document.getElementById("id_de_curso").value = id;
			document.getElementById("formularioDeSalto").action = "../formacion/curso.php";
			document.getElementById("formularioDeSalto").submit();
		}
    </script>