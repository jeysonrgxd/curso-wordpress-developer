<?php
if(is_404()){
   echo "<mark>El resultado no se encontro :( </mark>";
   // en esta parte podemos poner que no redireccione a cualquier parte siempre cuando tenemos que ponerlo despues del get_header() de wordpress
   // header("Location:https://www.google.com.pe");
}
// estas son funciones que permiten para invocar los archivos llamados header footer sidebar
get_header();

// validamos los templates para saber en que pagina o template estamos
if(is_home()){
   echo "<mark>Estoy en el home</mark>";
}
else if(is_category()){
   echo "<mark>Estoy en el resultado de la categoria</mark>";

}
else if(is_page()){
   echo "<mark>Estoy mostrando una pagina</mark>";

}

// .
// .
// . hay mas para validar como el search single category tags etc


// para cualquier otro archivo para traerlo get_template_part() recive el slug (el nombre del archivo pero sin .php ya que este reconoce que es con .php)
get_template_part('loop-wp-query');
// esto nos permite limpiar los parametros que ha dejado el loop de la clase wp-query para asi en nuestro content usar el loop tradicional sin la clase wp-query o si deseamos utilizar en el content query_posts(arg)
// documentacion: https://developer.wordpress.org/reference/functions/query_posts
query_posts(null);
get_template_part("content");
get_sidebar();
get_footer();
?>