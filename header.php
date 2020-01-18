<!DOCTYPE html>
<!-- este es para especificar el lengiage language_attributes puede recibir otras cosas tambien -->
<html <?= language_attributes();?>>
<head>
   <meta charset="<?= bloginfo('charset');?>">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title><?= wp_title('|',true,'right');?></title>
   <!-- esta funcion es para que nos traiga los archivos js o los que especifiquemos en el functions.php -->
   <?= wp_head();?>
   <!-- <title>hola como estas</title> -->
   <?php
   // al haber nosotros creado un page entonses especificamos en header si estamos en la plantilla general de page.php ps podemos traer stylos o agregar los script que queramos xD

      //if(is_page(19)){ por id de publicacion
      //if(is_page("titulo de pagina")){ por titulo de pagina  
      
      //para todas las paginas 
      if(is_page()){ ?>
         <style>
            *{
               color:red;
            }
         </style>
   <?php } ?> 
      
  
</head>
<body <?php echo body_class("mi_clase1 miclase2");?> >

<header>
<!-- si hay header dinamico que se puso en la personalizacion del tema el userfreandli ps lo traemos -->
<?php
   get_header("wordpress")
?>

<!-- esta funcion con el parametro "/" nos da la url exta donde fue instalado el wordpress para saber mas sobre la funcion investigar en wordpress developer-->

<!--esc_url(..) limpiar y que la url se balida espcios en blanco caracteres especiales y con esto satinisamos la url -->
<?php
// si existe un logo configurable
   if(has_custom_logo()){
      // mandamos allamar ese logo configurable
      the_custom_logo();
   }else{
      echo "<a href='".esc_url(home_url("/"))."'>".get_bloginfo('name')."</a>";
   }
?>

<?php
// traemos el menu que definimos en functions php y creamos con el dashboard de wordpress
 if(has_nav_menu('main_menu')){
   wp_nav_menu(array(
      'theme_location' => 'main_menu',
      'container' => 'nav',
      'container_class'=>'Menu',
      'container_id'=>'Menu'
   ));
}else
{?>
   <nav>
      <ul>
      <!-- imprimimos la lista de paginas, el parametro que le asignamos es para elininar el titulo que le da y el contendor ul que tambien leda. ya que nosotros ya estamos definiendo nuestro propia maqueta-->
         <?php wp_list_pages("title_li");?>
      </ul>
   </nav>
<?php } ?>

</header>
<main>