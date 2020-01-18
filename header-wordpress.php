<div>

   <?php
      if(has_custom_header()):
         the_custom_header_markup();
      endif
   ?>
   <div class="WP-Header-branding">
      <h1 class="WP-Header-title">
      <!-- estas dos funciones la podemos encontrar en el dashboard de wordpress en Ajustes/Generales  -->
         <a href="<?php echo esc_url(home_url('/'));?>">
         <!-- impirmimos el nombre del sitio -->
            <?php echo bloginfo('name');?>
         </a>
      </h1>
      <p class="WP-Header-description">
      <!-- imprimimos el titulo del sitio  -->
         <?php echo bloginfo('description');?>
      </p>
   </div>
</div>