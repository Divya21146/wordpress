<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="site-header">
        <div class="container">
        <div class="site-branding">
                <h1 class="site-title"><?php bloginfo('name'); ?></h1>
        </div>
            
        <nav class="main-navigation">
                <?php
     $mainmenu = array(
        'container' => false,
        'theme_location' => 'primary-menu',
     );

     wp_nav_menu($mainmenu);
?>
            </nav>
        </div>
    </header>