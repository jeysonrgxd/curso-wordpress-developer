<?php
/**
 * My Awesome Wordpress child theme functions and definitions
 * 
 * @link https://developer.wordpress.org/themes/basics/the-functions/
 * 
 * @package mawt
 * @subpackage child_mawt
 * @since 1.0.0
 * @version 1.0.0
 * 
 */

//  Más info
// http://codex.wordpress.org/Child_Themes
// https://make.wordpress.org/training/handbook/theme-school/child-themes/
// https://developer.wordpress.org/themes/advanced-topics/child-themes

//  OJO RECORDAR QUE LA FUNCION get_template_directory_uri() ASE REFERENCIA A LA CARPETA PADRE MAS NO EN ESTA CARPETA DE CHILD PARA QUE PODAMOS TRAER NUESTROS ARCHIVOS DE ESTE TEMA HIJO TENEMOS QUE TULIZAR EN TODO get_stylesheet_directory_uri()

// al yamarse igual que la funcion que tenemos declarada en function.php del padre, esta funcion que creamos de nuevo quitara el del padre y pondra esta
  if(!function_exists("mawt_scripts")):
   function mawt_scripts(){

      wp_register_style('google-fonts', "https://fonts.googleapis.com/css?family=Ubuntu&display=swap",array(),'1.0.0','all');

      // aca estaba el get_stylesheet_uri() pero lo cambiamos a get_template_directory_uri() por que estamos en el function.php del hijo
      wp_register_style('parent-style',get_template_directory_uri().'/style.css' , array('google-fonts'),'1.0.0','all');

      wp_register_style('style',get_stylesheet_uri(), array('google-fonts','parent-style'),'1.0.0','all');


      wp_enqueue_style("google-fonts");
      wp_enqueue_style("parent-style");
      wp_enqueue_style("style");

      wp_register_script('parent-scripts', get_template_directory_uri()."/script.js",array("jquery"),'1.0.0',true );

      // recordar no es get_stylesheet_uri() sino es get_stylesheet_directory_uri()
      wp_register_script('scripts', get_stylesheet_directory_uri()."/scripts.js",array("jquery","parent-scripts"),'1.0.0',true );

      wp_enqueue_script('jQuery');
      wp_enqueue_script('scripts');
      wp_enqueue_script('parent-scripts');

   }
endif;

add_action( 'wp_enqueue_scripts', 'mawt_scripts' );

// al resto de funcion que crearemos para este child tema es preferibel usar como nombre ejemplo child_mawt_scripts
// asi evitaremos sobreescribir las funciones del padre declardo en su function.php