<?php 
if(!function_exists("plain_encuesta_db")){
      function plain_encuesta_db(){
         // utilizamos la variable global de wordpres "wpdb" para poder utilizarla
         global $wpdb;
         
         //asemos global la variable la cual tendra nuestra version de la tabla 
         global $encuesta_table_version;

         // para el manejo de nuestra version de la tala
         $encuesta_table_version='1.0.0';
         
         // creamos el nombre que tendra nuestra tabla pero nesesitamos obtender el prefijo que le pusimos y concatenarlo con el nombre que queramos 
         $table = $wpdb->prefix.'encuesta_form';

         // obtenemos el caracter que tendra nuestra tabla
         $charset_collate = $wpdb->get_charset_collate();

         // creamos el query para la creacion de nuestra nueva tabla
         $sql = "
            CREATE TABLE $table(
               encuesta_id MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
               id_tecnico CHAR(10) NOT NULL,
               pregunta1 CHAR(10) NOT NULL,
               pregunta2 CHAR(10) NOT NULL,
               pregunta3 CHAR(10) NOT NULL,
               PRIMARY KEY(encuesta_id)
            )$charset_collate
         ";
         
         require_once ABSPATH.'wp-admin/includes/upgrade.php';
         //para ejecutar codigo sql CUANDO ESTAMOS TRABAJANDO DIRECTAMENTE CON LA BASE DE DATOS DE WORDPRESS, cada modificacion que le quiero hacer ala base de datos la tengo la que hacer con esta funcion
         dbDelta($sql);

         // esto es para guardar la version de mi tabla es para un mejor control
         add_option('encuesta_table_version',$encuesta_table_version);
      }
   }
   
   add_action("after_setup_theme","plain_encuesta_db");

   if(!function_exists("plain_encuesta_form_menu")){
      // creamos la funcion el cual no creara en el menu principal de dashboard una seccion para las opciones de nuestro menu
      function plain_encuesta_form_menu(){
         // esta funcion recive nombre de la pagina que se mostrara, nombre que tendra en el menu, que tipo de usuario la vera o accedera, nombre de variable url (?page=custom_theme_options), funcion que se ejecutara al precionar click en el item del menu que se creara, el nombre del icono qu wordpress tiene reservado una lista completa, y en que posicion estara esta va de 5 en 5
         add_menu_page('Encuesta', 'Encuesta', 'administrator', 'encuesta_form', 'plain_encuesta_form_comments', 'dashicons-id-alt', 20);

         // agregar un sub menu como los otros tienes en el dashboard de wordpress
         // el primer parametro recive el slug del padre, el segundo nombre igual que tercero,cuarto quien lo vera, el slug del este submenu tiene que ser diferente al de su padre y la funcion que ejecutara que por ende como estamos copiando la misma funcionalidad de los otros submenu del dashboard entonses llevara al mismo lugar que el padre
         add_submenu_page('encuesta_form', 'Todas las Encuestas', 'Todas las Encuestas', 'administrator', 'encuesta_form_comments', 'plain_encuesta_form_comments');


      }

   }
   // hook en donde se ejecutara la funcion en este caso admin_menu y se ejecuta la funcion creada
   add_action('admin_menu','plain_encuesta_form_menu');

   // esta es la funcion que llama add_menu_page
   if(!function_exists("plain_encuesta_form_comments")){
      function plain_encuesta_form_comments(){    
         // crearemos una tabla de datos para recibir la informacion de nuestro formulario que crearemos mas adelante
         ?>
         <style>
            .myth{
               background-color:#E70033;
            }
            .myth tr th.manage-column{
               color:#fff;
            }
            .btn-contacto-propio{
               float:right;
               background-color: #217346;
               border: none;
               padding: 6px 10px;
               border-radius: 5px;
               color: #fff;
               cursor: pointer;
            }     
         </style>
         <div class="wrap">
            <button class="btn-contacto-propio">Descargar excel</button>
            <h1><?php _e('Encuesta de los tecnicos','movedo'); ?></h1>
         </div>
         <table class="wp-list-table widefat striped">
            <thead class="myth">
               <tr>
                  <th class="manage-column"><?php _e('Id_encuesta','movedo'); ?></th>
                  <th class="manage-column"><?php _e('Nombre tecnico','movedo'); ?></th>
                  <th class="manage-column"><?php _e('Pregunta1','movedo'); ?></th>
                  <th class="manage-column"><?php _e('Pregunta2','movedo'); ?></th>
                  <th class="manage-column"><?php _e('Pregunta3','movedo'); ?></th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>1</td>
                  <td>Valor2</td>
                  <td>Valor3</td>
                  <td>Valor4</td>
                  <td>Valor5</td>
               </tr>
            </tbody>
         </table>
               
<?php 

      }
   }

?>