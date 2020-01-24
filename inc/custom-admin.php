<?php

// //https://codex.wordpress.org/Dashboard_widgets_API
// //https://codex.wordpress.org/Plugin_API/Admin_Screen_Reference
// //https://codex.wordpress.org/Administration_Screens
// //https://codex.wordpress.org/Adding_Administration_Menus

 if(!function_exists("mawt_admin_scripts")):
   function mawt_admin_scripts(){

      wp_register_style('google-fonts', "https://fonts.googleapis.com/css?family=Ubuntu&display=swap",array(),'1.0.0','all');
      
      wp_register_style('custom-properties',get_template_directory_uri()."/css/custom_properties.css" , array(),'1.0.0','all');

      wp_register_style('admin-page', get_template_directory_uri()."/css/admin_page.css", array("google-fonts","custom-properties"), '1.0.0','all');

      wp_enqueue_style("google-fonts");
      wp_enqueue_style("custom-properties");
      wp_enqueue_style("admin-page");


      wp_register_script('admin-page-script', get_template_directory_uri()."/js/admin_page.js",array("jquery"),'1.0.0',true );

      wp_enqueue_script('jQuery');
      wp_enqueue_script('admin-page-script');

   }
endif;
// este filtro es para agregarlo en el login
add_action('admin_enqueue_scripts', 'mawt_admin_scripts');


//esto es para poder cambiar stylos en editor de entradas como la fuenta de texto de lo que escriben en las entradas
// Ojo esto sirve sola mente para a vercion anterio del editor osea no para la nueva vercion de editor de bloques Gutenberg
if(!function_exists("mawt_add_editor_styles")):
   function mawt_add_editor_styles(){
      add_editor_style('https://fonts.googleapis.com/css?family=Ubuntu&display=swap');
      add_editor_style(get_template_directory_uri()."/css/custom_properties.css");
      add_editor_style(get_template_directory_uri()."/css/custom_editor_style.css");

   }

endif;

add_action('admin_init','mawt_add_editor_styles');

//admin menu para remover los ya existentes osea el menu del sidebar
if(!function_exists('mawt_admin_menu')):
   function mawt_admin_menu(){
      remove_menu_page('edit.php');//entradas
      remove_menu_page('upload.php');//Multimedia
      //remove_menu_page('link-manager.php');//Enlaces
      //remove_menu_page('edit.php?post_type=page');//Páginas
      //remove_menu_page('edit-comments.php');//comentarios
      //remove_menu_page('themes.php');//Apariencia
      //remove_menu_page('plugins.php');//Plugin
      //remove_menu_page('users.php');//Usuarios
      //remove_menu_page('tools.php');//Herramientas
      //remove_menu_page('option-general.php');//Ajustes
   } 
endif;

// el evento o hook 
add_action("admin_menu","mawt_admin_menu");
// extra. investigar de los manager option para designar que perfil puede ver cierto menu o no



//menu de la cabezera del dashboard
if(!function_exists('mawt_before_admin_bar')):
   function mawt_before_admin_bar(){
      // representa el objeto global con toda la caracteristicas de la barra de menu de wordpress
      global $wp_admin_bar;
      
      /*
         search: Para eliminar la caja de busqueda
         comments: Para eliminar el aviso de comentarios
         update: Eliminar el aviso de actualizaciones
         edit: Elimina editar entrada y paginas
         get-shortlink: proporciona un enlace corto a esa página/post
         my-sites: Elimina el menu my sitios, si utilizas la función multisitios de wordpress
         site-name: Elimina el nombre de la web
         wp-logo: Elimina el logo (y el sub Menú)
         my-account: Elimina los enlaces a su cuenta. El ID depende de si usted tiene Avatar habilitado o no
         view-site: Elimina el sub menú que aparece al pasar el cursor sobre el nombre de la web
         about: Elimina el enlace "Sobre Wordpress"
         wporg: Elimina el enlace a wordpress.org
         documentation: Elimina el enlace a la documentacion oficial(codex)
         support-forem: Elimina el enlace a alos foros de ayuda
         feddback: Elimina el enlace Segurencias

      */

      // $wp_admin_bar->remove_menu('wp-logo');
      // $wp_admin_bar->remove_menu('new_content');
      // $wp_admin_bar->remove_menu('comments');
   }
endif;
add_action('wp_before_admin_bar_render','mawt_before_admin_bar');

// agregar menu nuevo en la barra superior
if(!function_exists('mawt_admin_bar_menu')):
   function mawt_admin_bar_menu(){
      global $wp_admin_bar;

      $wp_admin_bar->add_menu(array(
         'id'=>'mi_menu',
         'title'=>__('Mi menu','mawt'),
         'href'=>false
      ));

      $wp_admin_bar->add_menu(array(
         'parent'=>'mi_menu',
         'id'=>'repo-git',
         'title'=>__('Github-repo','mawt'),
         'href'=>__('https://github.com/jeysonrgxd')
      ));
      $wp_admin_bar->add_menu(array(
         'parent'=>'mi_menu',
         'id'=>'facebook',
         'title'=>__('Facebook','mawt'),
         'href'=>__('https://www.facebook.com/')
      ));
   }
endif;

//hook para agregar la funcion que me agregara el menu que estoy creando
add_action('admin_bar_menu','mawt_admin_bar_menu');

// agregar campos adicionales alos usuarios de wordpress
if(!function_exists('mawt_user_contactmethods')):
   // asemos uso de una variable globar y la especificamos en el parametro de la funcion
   function mawt_user_contactmethods($data_user){
      // agregamos dos campos
      $data_user['facebook']= __('Facebook');
      $data_user['twitter']= __('Twitter');

      // retornamos esta misma variable por que despues wordpress la utilizara para crear parte de contactos del dashborad
      return $data_user;
   }
endif;
// agregamos la funcion en un filtro
add_filter('user_contactmethods', 'mawt_user_contactmethods');

//cambiar el nombre de  sitio creado con wordpress
if(!function_exists('mawt_admin_footer_text')):
   function mawt_admin_footer_text(){
      return '
         <i>
            Sitio creado por
            <a href="https://github.com/jeysonrgxd" target="_blank">@jeysonrgxd</a>
         </i>
      ';
   }
endif;

// agregamos esta funcion en el filtro
add_filter('admin_footer_text','mawt_admin_footer_text');

// para quitar los widget del dashboard principal
if(!function_exists('mawt_wp_dashboard_setup')):
   function mawt_wp_dashboard_setup(){
      //actividad
      remove_meta_box('dashboard_activity', 'dashboard', 'normal');
      
      // Deun vistazo
      remove_meta_box('dashboard_right_now', 'dashboard', 'normal');

      // Comentarios recientes
      remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

      // Enlaces entrantes
      remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');

      // Plugin
      remove_meta_box('dashboard_plugins', 'dashboard', 'normal');

      // publicaciones rápida
      remove_meta_box('dashboard_quick_press', 'dashboard', 'side');

      // Borradores recientes
      remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');

      // Noticias del blog de wordpress
      remove_meta_box('dashboard_primary', 'dashboard', 'side');

      // Otras noticias de Wordpress
      remove_meta_box('dashboard_secondary', 'dashboard', 'side');
   }
endif;

// el hook del dashboard setup es
add_action('wp_dashboard_setup','mawt_wp_dashboard_setup');




?>