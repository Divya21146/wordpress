<?php


add_theme_support('menus');

add_theme_support('widgets');

add_theme_support('post-thumbnails');

//Register Main Menu
function register_theme_menus(){
    register_nav_menus(
        array(
            'primary-menu' => __('Primary Menu')
        )
    );
}

add_action('init','register_theme_menus');

// Register footer menu location
function register_footer_menu() {
    register_nav_menu('footer-menu', 'Footer Menu');
}
add_action('after_setup_theme', 'register_footer_menu');


function sidebar_widget(){
    register_sidebar(array(
        'name' => 'Sidebar Widget',
        'id' => 'sidebar_widget',
        'description' => 'will displayed in sidebar',
        'before_widget' => '<div class="sidebar_widget">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget_title">',
        'after_title' => '</h2>'
    ));
}

add_action('widgets_init',"sidebar_widget");




// Creating the clock widget
class Clock_Widget extends WP_Widget {
    // Constructor
    public function __construct() {
        parent::__construct(
            'clock_widget', // Widget ID
            'Clock Widget', // Widget Name
            array('description' => 'Displays a simple clock.') // Widget Description
        );
    }

    // Widget Frontend Display
    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo $args['before_title'] . $instance['title'] . $args['after_title'];
        echo '<div id="clock-widget"></div>';
        echo $args['after_widget'];
    }

    // Widget Backend Form
    public function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    // Widget Update
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        return $instance; 
    }
}

function register_clock_widget() {
    register_widget('Clock_Widget');
}
add_action('widgets_init', 'register_clock_widget');





// Enqueue the custom stylesheet
function enqueue_blank_style() {
    wp_enqueue_style('blank-style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_script('clock-widget', get_template_directory_uri() . '/myscript.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_blank_style');



// Function to remove the admin bar for all users.
function remove_admin_bar_for_all() {
    show_admin_bar(false);
}
add_action('after_setup_theme', 'remove_admin_bar_for_all');

// Register Custom Post Type
function custom_post() {
    $labels = array(
        'name' => 'Books',
        'singular_name' => 'Book',
        'menu_name' => 'Books',
        'all_items' => 'All Books',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Book',
        'edit_item' => 'Edit Book',
        'new_item' => 'New Book',
        'view_item' => 'View Book',
        'search_items' => 'Search Books',
        'not_found' => 'No books found',
        'not_found_in_trash' => 'No books found in Trash',
        'parent_item_colon' => 'Parent Book:',
        'featured_image' => 'Book Cover',
        'set_featured_image' => 'Set book cover',
        'remove_featured_image' => 'Remove book cover',
        'use_featured_image' => 'Use as book cover',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'books'), // Change 'books' to your desired slug
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'excerpt'),
    );

    register_post_type('books', $args);
}
add_action('init', 'custom_post');

// Function to add the custom meta box for gallery images
function add_custom_gallery_meta_box() {
    add_meta_box(
        'custom_gallery_meta_box',
        'Gallery Images',
        'display_custom_gallery_meta_box',
        'books', // Replace 'books' with your custom post type slug
        'normal',
        'high'
    );
}
add_action('admin_init', 'add_custom_gallery_meta_box');

// Callback function to display the custom meta box content
function display_custom_gallery_meta_box($post) {
    $gallery_images = get_post_meta($post->ID, 'gallery_images', true);
    ?>
    <label for="gallery_images">Gallery Images</label>
    <input type="text" id="gallery_images" name="gallery_images" value="<?php echo esc_attr($gallery_images); ?>" />
    <p>Enter image attachment IDs separated by commas. Example: 12,34,56</p>
    <?php
}

// Function to save the custom meta box data
function save_custom_gallery_meta_box($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['gallery_images'])) {
        $gallery_images = sanitize_text_field($_POST['gallery_images']);
        update_post_meta($post_id, 'gallery_images', $gallery_images);
    }
}
add_action('save_post', 'save_custom_gallery_meta_box');

