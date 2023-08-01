
    <footer>
    <div class="footer-menu-container">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'footer-menu',
            'container' => false,
        ));
        ?>
    </div>
        <h3>
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
    </h3>

    </footer>
    <?php wp_footer(); ?>
</body>
</html>
