<!-- 
LOOP de wordpress clase WP_Query: 
" nos sirve para poder lanzar loop personalizados inclusive si en una misma plantilla en diferentes partes yo nesesito diferente informacion de mi wordpress"

nos podemos fijar los datos que recive el array para el WP_Query en https://gist.github.com/luetkemj/2023628
 -->

<section class="section-WP-Query">
<h2>Este es una muestra del loop de wordpress personalizado</h2>
   <?php


   $wp_query = new WP_Query([
   'posts_per_page' => 3,
   'orderby' => 'rand'    
   ]);

   if($wp_query->have_posts()):
      while($wp_query->have_posts()):
         $wp_query->the_post();
   ?>
      <figure>
         <a href="<?php the_permalink()?>">
            <?php the_post_thumbnail('thumbnail')?>
            <?php the_title('<figcaption>','</figcaption>')?>
         </a>
      </figure>
   <?php      
         
      endwhile;

   endif;
   // limpiamos todas las variables del loop
   wp_reset_postdata();

   // limpiar la variable de la consulta osea el args que recive el wp-query
   wp_reset_query();
   ?>
</section>