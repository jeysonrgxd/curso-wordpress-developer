<?php
   if(!function_exists("maw_contact_form_menu")){
      // creamos la funcion el cual no creara en el menu principal de dashboard una seccion para las opciones de nuestro menu
      function maw_contact_form_menu(){
         // esta funcion recive nombre de la pagina que se mostrara, nombre que tendra en el menu, que tipo de usuario la vera o accedera, nombre de variable url (?page=custom_theme_options), funcion que se ejecutara al precionar click en el item del menu que se creara, el nombre del icono qu wordpress tiene reservado una lista completa, y en que posicion estara esta va de 5 en 5
         add_menu_page('Contacto', 'Contacto', 'administrator', 'contact_form', 'mawt_contact_form_comments', 'dashicons-id-alt', 20);

         // agregar un sub menu como los otros tienes en el dashboard de wordpress
         // el primer parametro recive el slug del padre, el segundo nombre igual que tercero,cuarto quien lo vera, el slug del este submenu tiene que ser diferente al de su padre y la funcion que ejecutara que por ende como estamos copiando la misma funcionalidad de los otros submenu del dashboard entonses llevara al mismo lugar que el padre
         add_submenu_page('contact_form', 'Todos los Contactos', 'Todos los contactos', 'administrator', 'contact_form_comments', 'mawt_contact_form_comments');


      }

   }
   // hook en donde se ejecutara la funcion en este caso admin_menu y se ejecuta la funcion creada
   add_action('admin_menu','maw_contact_form_menu');

   // esta es la funcion que llama add_menu_page
   if(!function_exists("mawt_contact_form_comments")){
      function mawt_contact_form_comments(){ 
        echo "HOla";
      }
   } 
   


   
   ?>
