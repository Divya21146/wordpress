<?php get_header(); ?>

<div class="index">
<?php
if (have_posts()) {
    while (have_posts()) {
        the_post();
?>
<article>
    <h2><?php the_title(); ?></h2>
    <?php the_content(); ?><br>
</article>
<?php
    }
} else {
    echo '<p>No content found.</p>';
}
?>
</div>

<?php get_footer(); 

?> 

