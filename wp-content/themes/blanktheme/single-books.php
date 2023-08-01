<?php get_header();?>

<div class="style index">
    <?php 
if (have_posts()) :
    while (have_posts()) :
        the_post();
        ?>

        
<article>
    <div>
    <h2><?php the_title(); ?></h2>
    <p><?php echo get_post_meta(get_the_ID(), 'description', true); ?></p>
    </div>

    <div>
    <?php
$gallery_images = get_post_meta(get_the_ID(), 'gallery_images', true);

if ($gallery_images) {
    $image_ids = explode(',', $gallery_images);
    ?>
    <div class="gallery">
        <?php
        foreach ($image_ids as $image_id) {
            $image_url = wp_get_attachment_image_url($image_id, 'thumbnail');
            if ($image_url) {
                ?>
                <div class="custom-gallery-item">
                    <img src="<?php echo esc_url($image_url); ?>">
                </div>
                <?php
            }
        }
        ?>
    </div>
    <?php
} else {
    echo '<p>No images in the gallery.</p>';
}
?>

    </div>

</article>

<?php 
endwhile; 
else : 
?>
	<p><?php esc_html_e( 'Sorry, no pages found.' ); ?></p>
<?php endif; ?>
</div>

<?php get_footer(); 

?> 

