<?php
/*
Template name: Portfolio
*/

get_header();
?>
<div class="index">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <h2 style="text-align: center;"><?php the_title(); ?></h2>
    <div><?php the_content(); ?></div><br>

    <?php endwhile; endif; ?>

    <?php
$args = array(
    'post_type' => 'portfolio'
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
<?php 
get_footer();
?>