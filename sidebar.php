<aside>
 <!-- <h1>Side bar</h1>
 <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas, necessitatibus accusamus id deserunt dolor deleniti nesciunt modi. Incidunt expedita reiciendis autem hic at molestiae. Aperiam deserunt aut enim quod perspiciatis.</p> -->
 <?php
   if(is_active_sidebar('main_sidebar')){
      dynamic_sidebar('main_sidebar');
      
   }
   else{?>
      <article class="widget">
         <h3><?php _e('Buscar','mawt')?></h3>
         <?php get_search_from();?>
      </article>
<?php } ?>

</aside>