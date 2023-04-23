<?php
/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

$storefront = (object) array(
	'version'    => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);

require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';
require 'inc/wordpress-shims.php';

if ( class_exists( 'Jetpack' ) ) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if ( storefront_is_woocommerce_activated() ) {
	$storefront->woocommerce            = require 'inc/woocommerce/class-storefront-woocommerce.php';
	$storefront->woocommerce_customizer = require 'inc/woocommerce/class-storefront-woocommerce-customizer.php';

	require 'inc/woocommerce/class-storefront-woocommerce-adjacent-products.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
	require 'inc/woocommerce/storefront-woocommerce-functions.php';
}

if ( is_admin() ) {
	$storefront->admin = require 'inc/admin/class-storefront-admin.php';

	require 'inc/admin/class-storefront-plugin-install.php';
}

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if ( version_compare( get_bloginfo( 'version' ), '4.7.3', '>=' ) && ( is_admin() || is_customize_preview() ) ) {
	require 'inc/nux/class-storefront-nux-admin.php';
	require 'inc/nux/class-storefront-nux-guided-tour.php';
	require 'inc/nux/class-storefront-nux-starter-content.php';
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */


// Add action change background color on woocommerce add to cart buttons
add_action( 'wp_enqueue_scripts', 'custom_enqueue_styles' );
function custom_enqueue_styles() {
    wp_enqueue_style( 'custom-woocommerce-style', get_stylesheet_directory_uri() . '/custom-woocommerce.css' );
}

add_action( 'wp_head', 'custom_woocommerce_css' );
function custom_woocommerce_css() {
    echo '<style>
        a.product_type_simple,
		a.product_type_variable
		 {
            background-color: seagreen!important;
			color: #fff !important;
        }
    </style>';
}


// Remove a product button to delete a product
// Create a button for each product
function custom_remove_button() {
    global $product;
    echo '<button class="custom-remove-btn" style="background-color: red; color: #fff";" data-product-id="' . $product->get_id() . '">Ta bort Produkt</button>';
}
add_action( 'woocommerce_after_shop_loop_item', 'custom_remove_button', 15 );

// Delete product when button is clicked
function custom_delete_product() {
    if ( isset( $_POST['product_id'] ) ) {
        $product_id = intval( $_POST['product_id'] );
        wp_delete_post( $product_id, true ); // Delete the product
    }
}
add_action( 'wp_ajax_custom_delete_product', 'custom_delete_product' );
add_action( 'wp_ajax_nopriv_custom_delete_product', 'custom_delete_product' );

// Add JavaScript to handle the button click event
function custom_button_click_handler() {
    ?>
    <script>
        jQuery(document).ready(function($) {
            $('.custom-remove-btn').click(function(e) {
                e.preventDefault();
                var product_id = $(this).data('product-id');
                $.ajax({
                    type: 'POST',
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    data: {
                        action: 'custom_delete_product',
                        product_id: product_id,
                    },
                    success: function(response) {
						alert("Produkten raderad!");
                        window.location.reload(); 
                    },
                });
            });
        });
    </script>
    <?php
}
add_action( 'wp_footer', 'custom_button_click_handler' );

