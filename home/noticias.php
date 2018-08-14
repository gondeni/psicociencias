<!-- Latest News -->
    <section class="g-py-50">
      <div class="container">
        <header class="text-center g-width-60x--md mx-auto g-mb-10">
          <div class="g-mb-20">
            <h2 class="h4 u-heading-v2__title g-color-gray-dark-v2 g-font-weight-600 text-uppercase">Últimas noticias</h2>
          </div>
        </header>
        
        <div class="row">
          
          <?php
          
            foreach ($matrizDeNoticias as $noticia) {
              
              //Variables para las redes sociales
              // Imagen para mostrar en redes sociales
              if ($noticia["imagen_de_noticia"] != "") {
                $imagenRS = $noticia["imagen_de_noticia"];
              } else {
                $imagenRS = "logotipo.jpg";
              }
              
              $tituloSM = str_replace("<br>", "", $noticia["titulo_de_noticia"]);
              $descripcionSM = "Sociedad Espa&ntilde;ola de Medicina Psicosom&aacute;tica y Psicoterapia";
              $urlSM = "http://www.psicociencias.com/noticias/ver_noticia.php?mIdDeNoticia=".$noticia["id_de_noticia"];
              $imagenSM = "http://www.psicociencias.com/imagenes/noticias/".$imagenRS;
                        
              // Se limita la longitud del cuerpo de la noticis / post que se muestra
              $cuerpoDeNoticia = $noticia["cuerpo_de_noticia"];
              $cuerpoPlanoDeNoticia = strip_tags($cuerpoDeNoticia); //Se limpia el texto de caracteres que puedan dar problemas
              for ($i=180; $i>0; $i--) //Se establece la longitud maxima de la cadena en i caracteres 
                  if ($cuerpoPlanoDeNoticia[$i]==' ') break; //se evita el corte de palabras y se corta en el primer punto.
              $cuerpoCortoDeNoticia = substr($cuerpoPlanoDeNoticia, 0, $i); //se corta el texto y se guarda en una variable
              
              echo "<div class=\"col-lg-4 g-mb-30\">";
              echo "<article class=\"u-shadow-v21 g-bg-white g-brd-around g-brd-gray-light-v4 g-brd-top-2 g-brd-primary-top rounded g-pa-25\">";
              
              echo "<div class=\"u-heading-v2-6--bottom g-mb-10\" style=\"height:160px;\">";
              echo "<h3 class=\"h4 u-heading-v2__title g-font-weight-300 g-mb-0\">";
              echo "<a class=\"u-link-v5 g-color-main g-color-primary--hover\" href=\"javascript:saltarANoticia('".$noticia["id_de_noticia"]."');\">";
              echo $noticia["titulo_de_noticia"];
              echo "</a>";
              echo "</h3>";
              echo "</div>";
              
              echo "<div class=\"fechaNoticia naranja\">".date("d-m-Y", strtotime($noticia["fecha_de_creacion"]))."</div>";
              
              echo "<div class=\"g-font-size-14\">";
              echo "<p>".$cuerpoCortoDeNoticia."...</p>";
              echo "</div>";
              
              echo "<div class=\"leer-mas\"><a href=\"javascript:saltarANoticia('".$noticia["id_de_noticia"]."');\">////// Leer más</a></div>";
              
              echo "<hr class=\"g-mt-10 g-mb-10\">";
              
              echo "<div class=\"media-body align-self-center\">";
              echo "<a href=\"#\" data-type=\"facebook\" data-url=\"".$urlSM."\" data-title=\"".$tituloSM."\" data-description=\"".$tituloSM."\" data-media=\"".$imagenSM."\" class=\"prettySocial fa fa-facebook\"></a>";
              echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
              echo "<a href=\"#\" data-type=\"twitter\" data-url=\"".$urlSM."\" data-description=\"".$tituloSM."\" data-via=\"SEMPyP\" class=\"prettySocial fa fa-twitter\"></a>";
              echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
              echo "<a href=\"#\" data-type=\"googleplus\" data-url=\"".$urlSM."\" data-description=\"".$tituloSM."\" class=\"prettySocial fa fa-google-plus\"></a>";
              echo "</div>";
              echo "</article>";
              echo "</div>";
            }
          
          ?>
          
        </div>
        
      </div>
    </section>
    
    <!-- End Latest News -->