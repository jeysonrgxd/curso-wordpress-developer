<?php
   //activacion de cabecera dinamica para personalizacion del tema userfreanli 
 if(!function_exists('mawt_custom_header')):
      function mawt_custom_header(){
         // activar cabecera configurable
         // https://developer.wordpress.org/themes/functionality/custom-headers
         add_theme_support('custom-header',apply_filters('mawt_custom_header_args',
         array(
            'default-image' => get_template_directory_uri().'/img/header-img.jpg',
            'default-text-color' => 'F60',
            // 'width' => 1000, 
            'height' => 400,
            'flex-width' => true,
            'flex-height' => true,
            'video' => true,
            'wp-head-callback' => 'mawt_wp_header_style'
         )
         ));
      }
   endif;
   
   add_action("after_setup_theme", "mawt_custom_header");
   
   if(!function_exists('mawt_wp_header_style')):
      function mawt_wp_header_style(){
         $header_text_color = get_header_textcolor();
      ?>
   <style>
      .WP-Header-branding *{
         /* color: <?="#{$header_text_color}" ?>; */
         color: #<?= esc_attr($header_text_color);?>
      }
      </style>
   <?php
      echo get_header_textcolor();
   }
      endif;
      
?>