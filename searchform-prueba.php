<!-- quitale al nombre de este archivo es "-prueba". este archivo es el que se remplaza por el buscador tradicional de widget, con esto podemos reemplazarlo al que tu desees -->
<form action="/" method="get">
    <label for="search">Search in <?php echo home_url( '/' ); ?></label>
    <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
    <input type="image" alt="Search" src="<?php bloginfo( 'template_url' ); ?>/images/search.png" />
</form>