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
<!-- modificamos esta parte comentando el dynamic_sidear para ver que si se puede modificar en el tema hijo creando el mismo archivo en este caso footer.php -->
<!-- <?php dynamic_sidebar('footer_sidebar')?> -->
</aside>
   <small>&copy; 2019 por @jeyson</small>
</footer>
<?= wp_footer();?>
</body>
</html>              