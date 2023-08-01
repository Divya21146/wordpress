<?php get_header(); ?>
<div class="index">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div>
            <h2 style="text-align: center;"><?php the_title(); ?></h2>
        <div style="font-size: 25px;">
            <strong><?php the_field('portfolio_title'); ?></strong>
        </div>

		<div class="gallery" style="padding: 10px;">
        <?php if (has_post_thumbnail()) : ?>
    <div>
        <?php the_post_thumbnail(); ?>
    </div>
<?php endif; ?>


    </div>

        <div style="padding: 10px;">
            <?php the_field('portfolio_description'); ?>
        </div>
        <div style="float: right;">
		<strong><?php the_field('portfolio_date'); ?></strong>
        </div>

    </div>


    <?php endwhile; else : ?>
    <p><?php esc_html_e( 'Sorry, no pages found.' ); ?></p>
    <?php endif; ?>

</div>
<?php 
get_footer();
?>