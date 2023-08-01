<?php


get_header();
?>

<div class="style left-content">

    <?php if (have_posts()):
        while (have_posts()):
            the_post(); ?>

            <div>
                <?php the_content(); ?>
            </div><br>

        <?php endwhile; endif; ?>

    <?php
    $args = array(
        'post_type' => 'product'
    );

    $query = new WP_Query($args);

    ?>

    <?php if ($query->have_posts()):
        while ($query->have_posts()):
            $query->the_post(); ?>

            <div class="image-container">
                
                <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail('full'); ?> </a>

                <h3>
                    <?php the_title(); ?>
                </h3>

                <?php
                $additional_information = get_field('additional_information');
                $sale_price = get_field('sale_price');
                ?>

                <?php if ($additional_information): ?>
                    <p>
                        <?php echo $additional_information; ?>
                    </p>
                <?php endif; ?>

                <?php if ($sale_price): ?>
                        <p><strong><sup>₹</sup>
                            <?php echo $sale_price; ?></strong>
                        </p>
                    <?php endif; ?>

            </div>

        <?php endwhile; endif;
    wp_reset_postdata(); ?>

<?php
 echo "Fine";
?>
</div>
<?php
get_footer();
?>