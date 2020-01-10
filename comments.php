<aside class="Comments">
<?php 
   // imprimimos los comentarios con esta funcion ojo no solo es para las entradas tambien puede tener comentarios la entrada
   echo"<ol>";
   wp_list_comments();
   echo"</ol>";
   
   // activamos el formulario de comentario para que nos aparesca
   comment_form();
?>
</aside>