<?php
/**
 * Plugin Name: My Custom WooCommerce Modifications
 * Description: Customizations to WooCommerce functionality.
 * Version: 1.0
 * Author: Your Name
 */

 // Enqueue custom CSS file
 function my_enqueue_scripts() {
    
    wp_enqueue_style('style', plugin_dir_url(__FILE__) . 'css/style.css');

    wp_enqueue_script('script', plugin_dir_url(__FILE__) . 'js/script.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');



// // Get the global product object
// global $product;

// $product = get_field('product_im age');

// // Display the product image
// add_filter( 'woocommerce_product_thumbnails', $callback:callable, $priority:integer, $accepted_args:integer );


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// function custom_product_title($var) {
//     return $var . ' - Special Offer'; // Append "Special Offer" to the product title
// }
// add_filter('the_title', 'custom_product_title', 10, 2);


// function custom_content_before_product_description() {
//     echo '<p>This is placeholder added before the product description.</p>';
// }
// add_action('woocommerce_before_single_product_summary', 'custom_content_before_product_description', 20);


function add_text_input() {
    global $post;
    
    if ( 'product' === $post->post_type ) {
        $text_input_value = get_post_meta( $post->ID, '_text_input', true );
        ?>
        <div class="options_group">
            <?php woocommerce_wp_text_input( array(
                'id'          => '_text_input',
                'label'       => __( 'Plugin Text Input', 'woocommerce-text-input-plugin' ),
                'placeholder' => __( 'Enter your plugin text here', 'woocommerce-text-input-plugin' ),
                'desc_tip'    => true,
                'description' => __( 'Enter additional information here.', 'woocommerce-text-input-plugin' ),
                'value'       => $text_input_value,
            ) ); ?>
        </div>
        <?php
    }
}
add_action( 'woocommerce_product_options_general_product_data', 'add_text_input' );

// Save the text input data
function save_text_input( $post_id ) {
    $text_input = isset( $_POST['_text_input'] ) ? sanitize_text_field( $_POST['_text_input'] ) : '';
    update_post_meta( $post_id, '_text_input', $text_input );
}
add_action( 'woocommerce_process_product_meta', 'save_text_input' );


function test(){
    $product_id = get_the_ID();

// Get the value of the ACF field "product_description" for the current product
$product_description = get_field('product_description', $product_id);

$text_input_value = get_post_meta( $product_id, '_text_input', true );

echo '<h5>ACF Description</h5>';
    echo $product_description;


    if ( ! empty( $text_input_value ) ) {
        echo '<h5>Plugin Description</h5>';
        echo '<p>' . esc_html( $text_input_value ) . '</p>';
}

}

add_action( 'woocommerce_single_product_summary', 'test', 10 );


function display_desired_product() {
    $id = get_the_ID();

    $desired_product = get_field('desired_product', $id);

    if ($desired_product) {
        echo '<div class="product-slider-container">';
    echo '<div class="product-slider">';

    foreach ($desired_product as $product_id_or_sku) {
        // Get the product object using the product ID or SKU
        $product = wc_get_product($product_id_or_sku);

        if ($product) {
            // Get the product URL for the product's single page
            $product_url = $product->get_permalink();
            echo '<div class="slide">';
            // Display the desired product information with a clickable link to the product's single page
            echo '<a href="' . $product_url . '">';
            
            echo '<h2>' . $product->get_name() . '</h2>';
            
            // Display the product image
            echo '<div class="product-image">';

                // Check if the product is out of stock
                if (!$product->is_in_stock()) {
                    // If the product is out of stock, display an "Out of Stock" badge
                    echo '<div class="out-of-stock-badge"><strike>Sale!</strike></div>';
                } elseif ($product->is_on_sale()) {
                    // If the product is not out of stock and is on sale, display the sale icon
                    echo '<div class="sale-icon">Sale!</div>';
                }

            echo $product->get_image(''); // 'full' is the image size, you can use other sizes if needed
            echo '</div>';

            // Display the product description
            echo '<div class="product-description">';
            echo '<p>' . $product->get_description() . '</p>';
            echo '</div>';

            // Display the product ratings
            $average_rating = $product->get_average_rating();
            $rating_count = $product->get_rating_count();

            if ($average_rating > 0) {
                echo '<div class="product-ratings">';
                echo '<p>Rating: ' . $average_rating . ' (' . $rating_count . ' reviews)</p>';
                echo '</div>';
            }
            echo '<p><strong>' . $product->get_price_html() . '</strong></p>';
            
            echo '<button class="addonify-qvm-button" data-product_id="' . $product->get_id() . '">Quick view</button>';

            echo '</div>';
            echo '</a>';
        }
    }
    echo '</div>';
    echo '</div>';
    }
}
add_action('woocommerce_after_main_content', 'display_desired_product', 2);

// deactivate new block editor
function phi_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
    }
    add_action('after_setup_theme', 'phi_theme_support');
