<?php
if ( ! function_exists( 'throne_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function throne_theme_setup() {
	
	wp_enqueue_script("jquery");
    wp_enqueue_style( 'style', get_stylesheet_uri() );
    wp_enqueue_style( 'styles', get_template_directory_uri() . '/compiled/app.css' );
	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/throne.js', array ( 'jquery' ), 1.1, true);
	
    add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'style', 'script' ) );

	add_theme_support( 'woocommerce' );
	
    register_nav_menus(
        array(
        'main-menu' => __( 'Main Menu' ),
        'footer-menu' => __( 'Footer Menu' )
        )
    );
    
}
endif;
add_action( 'after_setup_theme', 'throne_theme_setup' );


add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );


/* ADMIN STYLES */
add_action('admin_head', 'throne_admin_styles');

function throne_admin_styles() {
  echo '<style>

    body {
      font-size: 14px;
    }

    body, td, textarea, input, select {
      
    } 

	.show_if_simple {
		color: #000000;
	}

    span {
      color: #000000;
    }

    label, th {
      color: #ffffff;
    }

	#poststuff label {
		color: #000000;
	}

	a {
		text-decoration: underline !important;
		cursor: pointer !important;
	}

  </style>';
}

// rename the coupon field on the cart page
function woocommerce_rename_coupon_field_on_cart( $translated_text, $text, $text_domain ) {
	// bail if not modifying frontend woocommerce text
	if ( is_admin() || 'woocommerce' !== $text_domain ) {
		return $translated_text;
	}
	if ( 'Coupon:' === $text ) {
		$translated_text = 'Promo Code';
	}
	return $translated_text;
}
add_filter( 'gettext', 'woocommerce_rename_coupon_field_on_cart', 10, 3 );

// rename the "Have a Coupon?" message on the checkout page
function woocommerce_rename_coupon_message_on_checkout() {
	return ' <a href="#" class="showcoupon">' . __( 'Promo Code', 'woocommerce' ) . '</a>';
}

add_filter( 'woocommerce_checkout_coupon_message', 'woocommerce_rename_coupon_message_on_checkout' );
// rename the coupon field on the checkout page
function woocommerce_rename_coupon_field_on_checkout( $translated_text, $text, $text_domain ) {
	// bail if not modifying frontend woocommerce text
	if ( is_admin() || 'woocommerce' !== $text_domain ) {
		return $translated_text;
	}
	if ( 'Coupon code' === $text ) {
		$translated_text = 'Promo Code';
	
	} elseif ( 'Apply coupon' === $text ) {
		$translated_text = 'Apply';
	}
	return $translated_text;
}
add_filter( 'gettext', 'woocommerce_rename_coupon_field_on_checkout', 10, 3 );


/* Remove Additional Info from Checkout */
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

function custom_override_checkout_fields( $fields ) {
	unset($fields['order']['order_comments']);
	return $fields;
}

/**
 * Trim zeros in price decimals
 **/
add_filter( 'woocommerce_price_trim_zeros', '__return_true' );