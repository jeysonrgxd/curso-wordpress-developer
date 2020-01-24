<?php

 if(!function_exists("mawt_login_scripts")):
   function mawt_login_scripts(){
      wp_register_style('google-fonts', "https://fonts.googleapis.com/css?family=Ubuntu&display=swap",array(),'1.0.0','all');
      wp_register_style('custom-properties',get_template_directory_uri()."/css/custom_properties.css" , array(),'1.0.0','all');
      wp_register_style('login-page', get_template_directory_uri()."/css/login_page.css", array("google-fonts","custom-properties"), '1.0.0','all');

      wp_enqueue_style("google-fonts");
      wp_enqueue_style("custom-properties");
      wp_enqueue_style("login-page");


      wp_register_script('login-page-script', get_template_directory_uri()."/js/login_page.js",array("jquery"),'1.0.0',true );

      wp_enqueue_script('jQuery');
      wp_enqueue_script('login-page-script');

   }
endif;
// este filtro es para agregarlo en el login
add_action( 'login_enqueue_scripts', 'mawt_login_scripts' );

//cambiamos el link de del icono del login para ingresar al dashboard de wordpress
if(!function_exists('mawt_login_logo_url')):
   function mawt_login_logo_url(){
      return home_url();
   }
endif;

add_action("login_headerurl", "mawt_login_logo_url");

// filtro para modificar el title de logo
if(!function_exists('mawt_login_logo_url_title')):
   function mawt_login_logo_url_title(){
      return get_bloginfo('title'). '|' .get_bloginfo('description');
   }
endif;

add_action("login_headertitle",'mawt_login_logo_url_title');

?>