<?php
   if(!function_exists("mawt_custom_theme_options_menu")){
      // creamos la funcion el cual no creara en el menu principal de dashboard una seccion para las opciones de nuestro menu
      function mawt_custom_theme_options_menu(){
         // esta funcion recive nombre de la pagina que se mostrara, nombre que tendra en el menu, que tipo de usuario la vera o accedera, nombre de variable url (?page=custom_theme_options), funcion que se ejecutara al precionar click en el item del menu que se creara, el nombre del icono qu wordpress tiene reservado una lista completa, y en que posicion estara esta va de 5 en 5
         add_menu_page('Ajustes del Tema', 'Ajustes del Tema', 'administrator', 'custom_theme_options', 'mawt_custom_theme_options_form', 'dashicons-admin-generic', 20);
      }

   }
   // hook en donde se ejecutara la funcion en este caso admin_menu y se ejecuta la funcion creada
   add_action('admin_menu','mawt_custom_theme_options_menu');

   // esta es la funcion que llama add_menu_page
   if(!function_exists("mawt_custom_theme_options_form")){
      function mawt_custom_theme_options_form(){ ?>
      <!-- construimos el fomulario que queremos que se muestre, estas clases que utilizamos son clases de wordpress que podemos usar libremente para los estylos de nuestro formularios -->
         <div class = "wrap">
            <h1><?php _e("Ajustes y Opciones del Tema","mawt")?></h1>
            <form action="options.php" method = "post">

               <?php 
                  //tenemos que decirle al formulario que creamos un grupo de opciones
                  settings_fields('mawt_options_group') ;

                  // para que pueda imprimir en este pantalla y cuando el formulario se envie me regrese a esta misma pagina
                  do_settings_sections("mawt_options_group")
               ?>

               <table class="form-table">
                  <tr valign="top">
                     <th scope="row">Texto del Footer:</th>
                     <td>
                     <!-- para obtener el valor de una opcion del tema lo asemos con get_option('name de variable')-->
                        <input type="text" name="mawt_footer_text" value="<?= esc_attr(get_option('mawt_footer_text'))?>">

                     </td>
                  </tr>
               </table>
               <!-- esto nos genera un botton submit personalizado al estylos wordpress le podemos pasar varios parametros pero se puede dejar vacio o pordefecto submit_button("guardar")  -->
               <?php submit_button(); ?>
            </form>
         </div>
         
      
      <?php }
   } 
   
   if(!function_exists("mawt_custom_theme_optiom_register")){
      function mawt_custom_theme_optiom_register(){
         // el registro seda por opcion osea que tenemos que llamar ala funcion por cada campo creado de diferente name
         // grupo de opcion e cual nos sirven para registrar varios campos
         register_setting('mawt_options_group','mawt_footer_text');
      }
   }
   
   add_action('admin_init', 'mawt_custom_theme_optiom_register');
   
   ?>
