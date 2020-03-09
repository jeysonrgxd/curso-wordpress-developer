<?php
   get_header();

   while(have_posts()):
      the_post();
?>
      <main>
         <?php the_content();?>
      </main>
      
<?php 
   endwhile; 

   //esta funcion manda a llamar un archivo que deve existir en nuestra plantilla el cual se deve llamar comments.php(es el archivo donde podemos escribir el codigo o plantilla de los comenteraios)
   comments_template();
   get_footer()
?> 