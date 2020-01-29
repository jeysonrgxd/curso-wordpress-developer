<!-- 
LOOP de wordpress clase WP_Query: 
" nos sirve para poder lanzar loop personalizados inclusive si en una misma plantilla en diferentes partes yo nesesito diferente informacion de mi wordpress"

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
   wp_reset_postdata();
   ?>
</section>