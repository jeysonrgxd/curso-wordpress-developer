<?php
   // https://codex.wordpress.org/Class_Reference/wpdb
   // https://developer.wordpress.org/reference/classes/wpdb/

   if(!function_exists("mawt_contact_table")){
      function mawt_contact_table(){
         // utilizamos la variable global de wordpres "wpdb" para poder utilizarla
         global $wpdb;
         
         //asemos global la variable la cual tendra nuestra version de la tabla 
         global $contact_table_version;

         // para el manejo de nuestra version de la tala
         $contact_table_version='1.0.0';
         
         // creamos el nombre que tendra nuestra tabla pero nesesitamos obtender el prefijo que le pusimos y concatenarlo con el nombre que queramos 
         $table = $wpdb->prefix.'contact_form';

         // obtenemos el caracter que tendra nuestra tabla
         $charset_collate = $wpdb->get_charset_collate();

         // creamos el query para la creacion de nuestra nueva tabla
         $sql = "
            CREATE TABLE $table(
               contact_id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
               name VARCHAR(50) NOT NULL,
               email VARCHAR(50) NOT NULL,
               subject VARCHAR(50) NOT NULL,
               comments LONGTEXT NOT NULL,
               contact_date DATETIME NOT NULL,
               PRIMARY KEY(contact_id)
            )$charset_collate
         ";
         
         require_once ABSPATH.'wp-admin/includes/upgrade.php';
         //para ejecutar codigo sql CUANDO ESTAMOS TRABAJANDO DIRECTAMENTE CON LA BASE DE DATOS DE WORDPRESS, cada modificacion que le quiero hacer ala base de datos la tengo la que hacer con esta funcion
         dbDelta($sql);

         // esto es para guardar la version de mi tabla es para un mejor control
         add_option('contact_table_version',$contact_table_version);
      }
   }
   
   add_action("after_setup_theme","mawt_contact_table");


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
         // crearemos una tabla de datos para recibir la informacion de nuestro formulario que crearemos mas adelante
         ?>
         <style>
            .myth{
               background-color:#1D1D1D;
            }
            .myth tr th.manage-column{
               color:#fff;
            }
         </style>
         <div class="wrap">
            <h1><?php _e('Comentarios de la página de Contacto','mawt'); ?></h1>
         </div>
         <table class="wp-list-table widefat striped">
            <thead class="myth">
               <tr>
                  <th class="manage-column"><?php _e('Id','mawt'); ?></th>
                  <th class="manage-column"><?php _e('Nombre','mawt'); ?></th>
                  <th class="manage-column"><?php _e('Email','mawt'); ?></th>
                  <th class="manage-column"><?php _e('Asunto','mawt'); ?></th>
                  <th class="manage-column"><?php _e('Comentarios','mawt'); ?></th>
                  <th class="manage-column"><?php _e('Fecha','mawt'); ?></th>
                  <th class="manage-column"><?php _e('Elimnar','mawt'); ?></th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>Valor1</td>
                  <td>Valor2</td>
                  <td>Valor3</td>
                  <td>Valor4</td>
                  <td>Valor5</td>
                  <td>Valor6</td>
                  <td>Valor7</td>
               </tr>
            </tbody>
         </table>
               
<?php 

      }
   }

   //creamos nuestro shortcode
   if(!function_exists("mawt_contact_form")){
      function mawt_contact_form($atts){
         // echo"
         //    <div>
         //       <h1>".$atts['title'] ."</h1>
         //    </div>
         // ";?>
         <!-- el action se va auto procesar por eso no lo ponemos -->
         <form class="ContactForm" method="POST">
            <legend><?php echo $atts['title']?></legend>
            <input type="text" name="name" placeholder="Escribe tu nombre">
            <input type="email" name="email" placeholder="Escribe tu email">
            <input type="text" name="subject" placeholder="Asunto a tratar">
            <textarea name="comments" cols="50" rows="5" placeholder="Escribe tus comentarios"></textarea>
            <input type="submit" value="Enviar">
         </form>

<?php
      }

   }

   add_shortcode('contact_form','mawt_contact_form');

// traemos las hojas de stylos y los archivos js

 if(!function_exists("mawt_contact_scripts")):

   function mawt_contact_scripts(){

      // especificamos que si es cierta pagina cargame los estylos y scripts en este caso lo validamos por su slug
      if(is_page("contacto")){

         wp_register_style('contact-form-style',get_template_directory_uri().'/css/contact_form.css' , array(),'1.0.0','all');

         wp_enqueue_style("contact-form-style");

         wp_register_script('contact-form-script', get_template_directory_uri()."/js/contact_form.js",array(),'1.0.0',true );

         wp_enqueue_script('contact-form-script');

      }
      
   }

endif;

add_action( 'wp_enqueue_scripts', 'mawt_contact_scripts' );


?>

       
   


   

