<?php
get_header();
   if(have_posts()){
      while(have_posts()){
         the_post();
         echo "<h3>".get_the_title()."</h3>";
         echo "<main>";
            the_content();
         echo "</main>";

      }
   }
get_footer();

?>