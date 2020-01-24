<?php
/**
 * My Awesome Wordpress theme functions and definitions
 * 
 * @link https://developer.wordpress.org/themes/basics/the-functions/
 * 
 * @package Wordpres
 * @subpackage mawt
 * @since 1.0.0
 * @version 1.0.0
 */

//  OJO :> Aqui solo va configuracion basica: invocacion de  menu dada de alta de widget configuraciones iniciales de tema e invocacion de scripts de ahi afuera es mejor tenerlo en archivos diferentes para que se amas facil la moficacion del codigo


 if(!function_exists("mawt_scripts")):
   function mawt_scripts(){
      // esta funcion permite registrar una hoja de stylos, hay que darle un alias para que wordpress reconosca, el otro parametro es la url de la hoja de estylos, el parametro final null si no tenemos dependencia si en caso depende por ejemplo como google-font para que carge primero el google-fonts y luego carge la hoja de stylos,el siguiente parametro la version que es, el siguiente es para que medios es esn este caso para todos
      wp_register_style('google-fonts', "https://fonts.googleapis.com/css?family=Ubuntu&display=swap",array(),'1.0.0','all');
      wp_register_style('style',get_stylesheet_uri() , array('google-fonts'),'1.0.0','all');

      // luego llamamos a invocar  en la cola de invocacion de hoja de stylos
      wp_enqueue_style("google-fonts");
      wp_enqueue_style("style");

      // llamamos el script js, con la misma funcion solo que envez de style es script, los parametros son similares , salvo del ultimo el cual es true para que melo traiga en el footer y false para que me lo traiga en el header, get_template_directory_uri() me trae la ruta completa asta mi template
      wp_register_script('scripts', get_template_directory_uri()."/script.js",array("jquery"),'1.0.0',true );

      // lo mandamos a llamar
      // jquery no nesesita que la registremos ya que ya viene registrado solo la mandamos a llamar
      wp_enqueue_script('jQuery');
      wp_enqueue_script('scripts');

   }
endif;

// luego llamamos a la funcion mawt_script ya sea por un filtro o una accion de wordpress en este caso utilizamos add_action('') por que la accion recomendada para mandar a llamar los archivos de programacion js y css es un evento que exita en la lista de acciones el cual es wp_enqueue_scripts
add_action( 'wp_enqueue_scripts', 'mawt_scripts' );


if(!function_exists("mawt_setup")):
   function mawt_setup(){
      // funcion para configurar cosas adicionales de nuestro temas para que funcione en wordpress, adicionalmente esta direccion nos ayudara a que mas acepta como parametro la funcion ya que no solo es post-thumbnails sino que acepta otras cosas para poder activar otras tipos de cosas 
      //https://developer.wordpress.org/reference/functions/add_theme_support/
      add_theme_support("post-thumbnails");
      
      // activamos las etiquetas de  html5
      add_theme_support("html5",array(
         'comment-list',
         'comment-form',
         'search-form',
         'gallery'
      ));
      
      // activacion de logo configurable para la personalizacion
      add_theme_support("custom-logo", array(
         'height' => 100,
         'width' => 100,
         // activacion de recorte
         'flex-height' => true,
         'flex-width' =>true
      ));

      // fondo y cabezera multimedia configurable para la personalizacion
      add_theme_support("custom-background",array(
         'default-color' => "DDD",
         'default-image' => get_template_directory_uri()."/img/background-img.png",
         'default-repeat' => 'repeat',
         'default-position-x' =>"", 
         'default-position-y' =>"",
         'default-size'=>"",
         'default-attachment'=> 'fixed'
      ));

      // activa la actualizaciòn selectiva de widget en el personalizador para que aparesca el lapicito
      add_theme_support('customize-selective-refresh-widgets');
   }
endif;
// agregamos la funcion para que se ejecute despues de la accion after_setup_theme(despues de cargar el setup de wordpress)
add_action("after_setup_theme","mawt_setup");

// invocacion del menu, validamos si no existe 
if(!function_exists("mawt_menus")):
   function mawt_menus(){
      // declaramos ubicaciones de menu para la plantilla y esta ala vez activa la opcion de menu en apariencia en el dashboard
      register_nav_menus(array(
         // funcion espacial lo que hace es imprimir y tambien es para que se tradusca cierta parta de mi template
         // 
         'main_menu' => __("Menú Principal",'mawt'),
         'social_menu' => __('Menú redes sociales', 'mawt')
      ));

   }

endif;
// ejecutar la funcion al comienzo
add_action("init","mawt_menus");

// activacion de widgets y widgets personalizados
if(!function_exists("mawt_register_sidebar")){
   function mawt_register_sidebar(){
      register_sidebar(array(
         'name' => __('Sidebar Principal', 'mawt'),
         'id' => 'main_sidebar',
         'description' => __('Este es el sidebar principal','mawt'),
         
         //este parametro que le pasamos es la etiqueta que queremos que encapsule al widget before inico <> after fin 
         'before_widget' => '<article id = "%1$s" class="widget %2$s">',
         'after_widget' => '</article>',

         // lo mismo para poner que etiqueta html queremos que encierre el titulo del widget
         'before_title' => '<h3>',
         'after_title' => '</h3>'
      ));

      register_sidebar(array(
         'name' => __('Sidebar Footer', 'mawt'),
         'id' => 'footer_sidebar',
         'description' => __('Este es el sidebar del footer', 'mawt'),
         'before_widget' => '<article id="%1$s" class="widget %2$s">',
         'after_widget' => '</article>',
         'before_title' => '<h3>',
         'after_title' => '</h3>',
      )); 
 
   }   
}
// el evento donde se ejecutara la funcion de activacion de widget
add_action('widgets_init','mawt_register_sidebar');

// cambiar a editor anterior y no tener el gutenberg
add_filter('use_block_editor_for_post_type', '__return_false', 100);

// importamos otro archivo para no hacer mas codigo
// importante abeses esto en local no funciona tenemos que activar en el php.ini
require_once get_template_directory().'/inc/custom-header.php';
require_once get_template_directory().'/inc/customizer.php';

// creamos do archivos mas que nos servira para la modificacion del login al dashboard de wordpress y el mismo dashboard
 
require_once get_template_directory().'/inc/custom-login.php';
require_once get_template_directory().'/inc/custom-admin.php';  
 