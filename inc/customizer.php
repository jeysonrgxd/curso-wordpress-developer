<?php 
   if(!function_exists('mawtcustomize_register')):
      // creamos el argumento que recivira y que es el uno de los objetos globales de wordpress
      // el cual contiene contenido que podemos utilizar investigar luego
      function mawt_customize_register($wp_customize){
         // obtenemos lo valores del nombre del blog y description y los trasladamos 
         // el postMessage es la capacidad que tiene el personalizacio actualizarla en tiempo real
         $wp_customize->get_setting('blogname')->transport = 'postMessage';
         $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
      }
      
      //si esta activado el refres que activamos en functions.php en los setup theme 
      if(isset($wp_customize->selective_refresh)){
         // ponemos los lapicistos para que los usuarios puedan cambiar si eyos los desean y yamamos a un callback que permita modificar el nombre del blog y description
         $wp_customize->selective_refresh->add_partial('blogname',array(
            'selector' => '.WP-Header-title',
            'render_callback' => 'mawt_customize_blogname'
         ));
         $wp_customize->selective_refresh->add_partial('blogdescription',array(
            'selector' => '.WP-Header-description',
            'render_callback' => 'mawt_customize_blogdescription'
         ));
      }
   
   
   endif;
   
// creamos las funciones que iran en el render_callback
   if(!function_exists('mawt_customize_blogname')):
      function mawt_customize_blogname(){
         bloginfo('name');
      }
   endif;

   if(!function_exists('mawt_customize_blogdescription')):
      function mawt_customize_blogdescription(){
         bloginfo('description');
      }
   endif;
?>