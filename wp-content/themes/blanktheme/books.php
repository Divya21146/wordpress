<?php get_header();

/**
 * Template name: Books
 */
?>

<div>
        <?php 
if (have_posts()) :
    while (have_posts()) :
        the_post();
        ?>

        <article>
            <h2><?php the_title(); ?></h2>
            <?php the_content(); ?>

        </article>

        <?php

    endwhile;
else:
?>
        <p><?php esc_html_e('Sorry, no pages found.'); ?></p>
        <?php
    endif;
    ?>


    <?php
$args = array(
    'post_type' => 'books'
);

$query = new WP_Query($args);

?>

    <div>
        <?php if($query->have_posts()) : while( $query->have_posts()) :$query->the_post();?>
        <div>
            <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail('full'); ?> </a>
        </div>
        <?php endwhile; endif; wp_reset_postdata(); ?>
    </div>

</div>

<?php get_footer(); 

?>