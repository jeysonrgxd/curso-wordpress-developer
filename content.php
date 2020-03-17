<article>
<style>
   .tituloh3{
      color:red;
   }
   .link a{
      color:#fff;
   }
   .contenido-total{
      /* probando agregado de php en css */
      border:<?= "1px solid red"?>;
      margin: 10px 0;
   }
   .pagination {

    margin:10px 0;
   }
   .pagination a{
     
      color:#7cdf31;
      text-decoration:none
   }
</style>
<h3>Loop de wordpress</h3>
<!-- cuando no especificamos y utilizamos have_post ps saber que es lo mismo que decir $wp_query->have_posts(), ya que no estamos redifiniendo el objeto wp_query que en el futuro se reeescribira, por ende $wp_query es un objeto global ya definido en el core de wordpress -->
<?php //var_dump($wp_query)?>

<!--Ojo:  recordar que sin el get muestra(imprime de frente), con el get(recupera mas no imprime)  -->
   <?php

   // query personalizado para el loo principal osea sin en wp-query podemos hacer ojo esto nos dara la paginacion si esta llamado pero no funcionara para eso tenemos que realizar otros tipos de cosas en las funciones de paginacion que se encuentra mas abajo esta mas detallado el porque xD.!
   // query_posts(array(
   //    'posts_per_page'=> 1,
   //    'orderby'=>'desc'
   // ));

   // validamos si hay publicaciones
      if(have_posts()){
         // ahora rrecoremos las publicaciones
         while(have_posts()){
            //La función the_post () verifica si el ciclo se ha iniciado y luego establece la publicación actual moviéndose, cada vez, a la siguiente publicación en la cola. (obtenemos la publicacion)
            the_post();
   ?>
   <!-- funcion para obtener el titulo de la publicacion -->
   <article>
      <h2><?php the_title()?></h2>

      <!-- aora con parametros before antes del titulo y after despues del titulo-->
      <?php the_title("<h3 class='tituloh3'>","</h3>")?>
   <!-- su contraparte es get_the_title() el cual obtenemos pero no imprime ya que se nesesita el echo, se puede hacer cosas como estas-->
      <h3>
         <?php
            $concat ="Este titulo es: ". get_the_title();
            echo $concat;
         ?>
      </h3>
      <!-- opcion2 -->
      <!-- <h3><?= get_the_title();?></h3> -->

      <!-- Traer imagen destacada -->
      <!-- me trae la imagen ya con la etiqueta img -->
      <p>funcion de traer imagen destacada sin get el cual nos crea ya un img con la url de la imagen</p>
      <div class="img-destacada">
            <?= the_post_thumbnail()?>
      </div>
      <br>
      <p>obtenemos url y la pasamos a una etqueta img</p>
      <!-- obtenemos la ruta de la imagen para poder ponerlo en una etiqueta o pasarlo como fondo a un div -->
      <img src="<?= get_the_post_thumbnail_url()?>" title="<?= get_the_title()?>">

      <!-- links de la publicion -->
      <!-- con get_the_permalink() -->
      <!-- <p class="link"><a href="<?= get_the_permalink()?>">Click.!</a></p> -->
      <!-- sin get -->
      <p class="link"><a href="<?= the_permalink()?>">Click.!</a></p>


      <!-- texto introductorio o resumen -->
      <?= the_excerpt()?>
      <!-- con get -->
      <em><?= get_the_excerpt();?></em>


      <!-- categorias -->
      <!-- en ambos casos ya me crea un ancla con su href el cual hace referencia a las publicaciones que tienen dicha categoria -->
      <p>Las categorias por lista : <?= the_category()?></p>
      <p>Las categorias separadas por coma : <?= the_category(", ")?></p>
      <!-- usando el get nos devuelve un array que contiene objetos de acuerdo ala cantidad de categorias que tenga dicho post el cual podemos acceder asu name(nombre normal) o slug(nombre sin espacion el cual sirve para hacer las consultas con wp_query enviandolo como parametro en las condiciones) ejmplo:-->
      <!-- se podria rrecorrer con un foreach -->
      <p>Las categorias con get: <?= get_the_category()[0]->slug?></p>
      <p>Las categorias con get: <?= get_the_category()[0]->name?></p>

      <!-- obtener id de la publicacion -->
      <?= get_the_ID();?>
      
      <!-- obtener taxonomias personalizadas de una publicacion o de un custom post type -->
      <?= get_the_term_list( get_the_ID(), 'tipo_mazos', '<p>', ', ', '</p>' ); ?>

      <!-- etiquetas -->
      <p>Las etiquetas son : <?= the_tags()?></p>
      <!-- al usar el get_the_tags me devuelve un objeto que debemos rrecorer para sacar la informacion -->
      <p>Las etiquetas son : <?  var_dump(get_the_tags())?></p>
      

      <!-- Los datos de fecha y hora -->
      <!-- the_date() trae la fecha de acuerdo al formato que si no le pasamos ni un parametro tomara el formato que se encuentra en el dashboard/ajustes/generales/formato de fecha, o si le pasamos los parametro teiene que ser parametro de date de php ya que wordpress esta echo con php, pero lo malo es que esta funcion nos da la fecha del de publicacion pero solo imprimira uno solo si es que en un solo dia su publicaron muchos post-->
      <p>La fecha fue: <?= the_date("d-m-y")?></p>
      <!-- <p>La fecha sin parametro fue: <?= the_date()?></p> -->

      <!-- devuelve la hora de la publicacion, pero lo podemos usar para resolver el inconveniente que tiene the_date() de acuerdo ala cantidad de post publicados ese dia, para eso se usara unas funciones-->
      <p>La hora fue: <?= the_time()?></p>
      <p>the_time mostrando fecha al pasar parametros: <?= the_time("d-M-Y")?></p>
      <!-- nos devuelve opciones del dashboar de wordpress revisar developer-wordpress -->
      <p>the_time mostrando fecha al pasar funcion option de wordpress: <?= the_time("j F, Y")?></p>
      <p>the_time mostrando fecha al pasar funcion option de wordpress: <?= the_time(get_option("date_format"))?></p>

      <!-- autor de la publicacion  -->
      <!-- nos trae en nombre del autor -->
      <p>Autor: <?= the_author();?></p>
      <!-- nombre del autor con un ancla para poder mostrar la pagina del autor si es que la crearamos -->
      <p>Autor con link: <?= the_author_posts_link();?></p>

      <!-- contenido: nos imprime todo el contenido que hayamos puesto en la publicacion podemos meterlo en un div darle una clase y luego darle stylos al contenido que nos trae ya que nos trae en etiquetas html -->
      <div class="contenido-total">
         <?= the_content()?>
      </div>
   </article>
   <?php 
         }
      } else{
   ?> 
   <p>El contenido solicitado no exite</p>
   <?php }
   // esto es por buena practicar limpiar el query y los argumentos
      wp_reset_postdata();
      wp_reset_query();
      
   ?>   
      
</article>
<!-- en esta seccion imprimimos el formulario generado atravez de un shortcode de contact-form-7 -->
<section class="contact-form-7">
<?= do_shortcode('[contact-form-7 id="75" title="Formulario de contacto 1"]');?>
</section>

<section class="pagination">
   <!-- esto asi como esta solo funcion en el loop tradicional no funcionara tanto como para query_posts(array(
      'posts_per_page'=> 1,
      'orderby'=>'asc'
   )); y como para Wp_Quey
   si desea hacerlo con esas dos nesesitara revisar el blog de new_autoland desarrollado_ ai realize una paginacion con wp_query osea loop personalizado o revisar la sigueinte url
   https://wordpress.stackexchange.com/questions/160175/pagination-on-a-wp-query-not-showing-navigation-links
-->
<!-- estas dos primera funciones nos forma siguienta post y anterior post sin paginado -->
   <!-- <?= previous_post_link();?>
   <?= next_post_link();?> -->
   <br>
   <!-- este funcion nos pagina con numeros y al final un siguiente pero funcionara deacuerdo ala cantidad que se desa mostrar en ajustes/lectura/Número máximo de entradas a mostrar en el sitio, siempre y cuando tengamos en nuestro wordpress la cantidad requerida a mas de entradas (publicaciones) -->
   <?= paginate_links();?>
</section>