<?php
   // este codigo es para poder agregar nuestro nuev custom post type que hemos creado, al loop principal y haci lograr que se muestre con las demas publicaciones

   if(!function_exists('maw_show_post_types_in_loop')){
      function maw_show_post_types_in_loop($query){
         // is_admin() usamos esto para verificar o para que no se haga este cambio en el dashboard en la parte de listado de entradas > todas las entradas
         if(!is_admin() && $query->is_main_query()){
            // agregamos los post que va asoportar
            $query->set('post_type',array('post','page','mazos'));
         }
      }
   }
   add_action('pre_get_posts','maw_show_post_types_in_loop');
?>