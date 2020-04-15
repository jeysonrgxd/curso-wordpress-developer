<!-- esta funcion es para que nos traiga los archivos js o los que especifiquemos en el functions.php -->
</main>
<footer>
<?php
   if(has_nav_menu("social_menu")){
      wp_nav_menu(array(
         'theme_location'=>'social_menu',
         'container'=>'div',
         'container_class' => 'fooMenu',
         'container_id'=>'fooMenu'
      ));
   } 
   else{ ?>
      <nav>
         <ul>
            <li>Redes1</li>
            <li>Redes1</li>
            <li>Redes1</li>
            <li>Redes1</li>
         </ul>
      </nav>
<?php 
   } 
?>
<aside>
   <?php dynamic_sidebar('footer_sidebar')?>
</aside>
   <p>
      <small>
      <!-- de esta forma inprimimos una opcion que guardamos en option.phph -->
         <?php 
         if(get_option('mawt_footer_text') !== ""):
            echo "<strong>".esc_html(get_option('mawt_footer_text'))."</strong>";
         else:?>
            &copy; 2019 por @jeyson
         
         <?php  
            endif;
         ?>
      </small>
   </p>
</footer>
<?= wp_footer();?>
</body>
</html>              