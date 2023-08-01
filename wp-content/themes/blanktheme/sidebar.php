<?php

/*
Template name: Sidebar
*/

get_header();
?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div class="width">
<div class="left-content">
<h2><?php the_title(); ?></h2>
<?php the_content(); ?>
</div>

<div class="right-sidebar">

    <?php
    if(is_active_sidebar('sidebar_widget')):
    ?>
    <div class="head_wrap">
        <?php dynamic_sidebar('sidebar_widget'); ?>
    </div>

    <?php endif; ?>
        
</div>
</div>

<?php endwhile; else : ?>
	<p><?php esc_html_e( 'Sorry, no pages found.' ); ?></p>
<?php endif; ?>

<?php 
get_footer();
?>