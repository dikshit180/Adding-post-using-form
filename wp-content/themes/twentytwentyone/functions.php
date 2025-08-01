<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

// This theme requires WordPress 5.3 or later.
if ( version_compare( $GLOBALS['wp_version'], '5.3', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twenty_twenty_one_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @return void
	 */
	function twenty_twenty_one_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary menu', 'twentytwentyone' ),
				'footer'  => esc_html__( 'Secondary menu', 'twentytwentyone' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/*
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 300;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		$background_color = get_theme_mod( 'background_color', 'D1E4DD' );
		if ( 127 > Twenty_Twenty_One_Custom_Colors::get_relative_luminance_from_hex( $background_color ) ) {
			add_theme_support( 'dark-editor-style' );
		}

		$editor_stylesheet_path = './assets/css/style-editor.css';

		// Note, the is_IE global variable is defined by WordPress and is used
		// to detect if the current browser is internet explorer.
		global $is_IE;
		if ( $is_IE ) {
			$editor_stylesheet_path = './assets/css/ie-editor.css';
		}

		// Enqueue editor styles.
		add_editor_style( $editor_stylesheet_path );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Extra small', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XS', 'Font size', 'twentytwentyone' ),
					'size'      => 16,
					'slug'      => 'extra-small',
				),
				array(
					'name'      => esc_html__( 'Small', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'S', 'Font size', 'twentytwentyone' ),
					'size'      => 18,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'M', 'Font size', 'twentytwentyone' ),
					'size'      => 20,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'L', 'Font size', 'twentytwentyone' ),
					'size'      => 24,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Extra large', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XL', 'Font size', 'twentytwentyone' ),
					'size'      => 40,
					'slug'      => 'extra-large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XXL', 'Font size', 'twentytwentyone' ),
					'size'      => 96,
					'slug'      => 'huge',
				),
				array(
					'name'      => esc_html__( 'Gigantic', 'twentytwentyone' ),
					'shortName' => esc_html_x( 'XXXL', 'Font size', 'twentytwentyone' ),
					'size'      => 144,
					'slug'      => 'gigantic',
				),
			)
		);

		// Custom background color.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'd1e4dd',
			)
		);

		// Editor color palette.
		$black     = '#000000';
		$dark_gray = '#28303D';
		$gray      = '#39414D';
		$green     = '#D1E4DD';
		$blue      = '#D1DFE4';
		$purple    = '#D1D1E4';
		$red       = '#E4D1D1';
		$orange    = '#E4DAD1';
		$yellow    = '#EEEADD';
		$white     = '#FFFFFF';

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__( 'Black', 'twentytwentyone' ),
					'slug'  => 'black',
					'color' => $black,
				),
				array(
					'name'  => esc_html__( 'Dark gray', 'twentytwentyone' ),
					'slug'  => 'dark-gray',
					'color' => $dark_gray,
				),
				array(
					'name'  => esc_html__( 'Gray', 'twentytwentyone' ),
					'slug'  => 'gray',
					'color' => $gray,
				),
				array(
					'name'  => esc_html__( 'Green', 'twentytwentyone' ),
					'slug'  => 'green',
					'color' => $green,
				),
				array(
					'name'  => esc_html__( 'Blue', 'twentytwentyone' ),
					'slug'  => 'blue',
					'color' => $blue,
				),
				array(
					'name'  => esc_html__( 'Purple', 'twentytwentyone' ),
					'slug'  => 'purple',
					'color' => $purple,
				),
				array(
					'name'  => esc_html__( 'Red', 'twentytwentyone' ),
					'slug'  => 'red',
					'color' => $red,
				),
				array(
					'name'  => esc_html__( 'Orange', 'twentytwentyone' ),
					'slug'  => 'orange',
					'color' => $orange,
				),
				array(
					'name'  => esc_html__( 'Yellow', 'twentytwentyone' ),
					'slug'  => 'yellow',
					'color' => $yellow,
				),
				array(
					'name'  => esc_html__( 'White', 'twentytwentyone' ),
					'slug'  => 'white',
					'color' => $white,
				),
			)
		);

		add_theme_support(
			'editor-gradient-presets',
			array(
				array(
					'name'     => esc_html__( 'Purple to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'purple-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to purple', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'yellow-to-purple',
				),
				array(
					'name'     => esc_html__( 'Green to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $green . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'green-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to green', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $green . ' 100%)',
					'slug'     => 'yellow-to-green',
				),
				array(
					'name'     => esc_html__( 'Red to yellow', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $yellow . ' 100%)',
					'slug'     => 'red-to-yellow',
				),
				array(
					'name'     => esc_html__( 'Yellow to red', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $yellow . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'yellow-to-red',
				),
				array(
					'name'     => esc_html__( 'Purple to red', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $purple . ' 0%, ' . $red . ' 100%)',
					'slug'     => 'purple-to-red',
				),
				array(
					'name'     => esc_html__( 'Red to purple', 'twentytwentyone' ),
					'gradient' => 'linear-gradient(160deg, ' . $red . ' 0%, ' . $purple . ' 100%)',
					'slug'     => 'red-to-purple',
				),
			)
		);

		/*
		* Adds starter content to highlight the theme on fresh sites.
		* This is done conditionally to avoid loading the starter content on every
		* page load, as it is a one-off operation only needed once in the customizer.
		*/
		if ( is_customize_preview() ) {
			require get_template_directory() . '/inc/starter-content.php';
			add_theme_support( 'starter-content', twenty_twenty_one_get_starter_content() );
		}

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom line height controls.
		add_theme_support( 'custom-line-height' );

		// Add support for link color control.
		add_theme_support( 'link-color' );

		// Add support for experimental cover block spacing.
		add_theme_support( 'custom-spacing' );

		// Add support for custom units.
		// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
		add_theme_support( 'custom-units' );

		// Remove feed icon link from legacy RSS widget.
		add_filter( 'rss_widget_feed_link', '__return_empty_string' );
	}
}
add_action( 'after_setup_theme', 'twenty_twenty_one_setup' );

/**
 * Registers widget area.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @return void
 */
function twenty_twenty_one_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', 'twentytwentyone' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'twentytwentyone' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'twenty_twenty_one_widgets_init' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global int $content_width Content width.
 *
 * @return void
 */
function twenty_twenty_one_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twenty_twenty_one_content_width', 750 );
}
add_action( 'after_setup_theme', 'twenty_twenty_one_content_width', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @global bool       $is_IE
 * @global WP_Scripts $wp_scripts
 *
 * @return void
 */
function twenty_twenty_one_scripts() {
	// Note, the is_IE global variable is defined by WordPress and is used
	// to detect if the current browser is internet explorer.
	global $is_IE, $wp_scripts;
	if ( $is_IE ) {
		// If IE 11 or below, use a flattened stylesheet with static values replacing CSS Variables.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/assets/css/ie.css', array(), wp_get_theme()->get( 'Version' ) );
	} else {
		// If not IE, use the standard stylesheet.
		wp_enqueue_style( 'twenty-twenty-one-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	}

	// RTL styles.
	wp_style_add_data( 'twenty-twenty-one-style', 'rtl', 'replace' );

	// Print styles.
	wp_enqueue_style( 'twenty-twenty-one-print-style', get_template_directory_uri() . '/assets/css/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	// Threaded comment reply styles.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Register the IE11 polyfill file.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills-asset',
		get_template_directory_uri() . '/assets/js/polyfills.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		array( 'in_footer' => true )
	);

	// Register the IE11 polyfill loader.
	wp_register_script(
		'twenty-twenty-one-ie11-polyfills',
		null,
		array(),
		wp_get_theme()->get( 'Version' ),
		array( 'in_footer' => true )
	);
	wp_add_inline_script(
		'twenty-twenty-one-ie11-polyfills',
		wp_get_script_polyfill(
			$wp_scripts,
			array(
				'Element.prototype.matches && Element.prototype.closest && window.NodeList && NodeList.prototype.forEach' => 'twenty-twenty-one-ie11-polyfills-asset',
			)
		)
	);

	// Main navigation scripts.
	if ( has_nav_menu( 'primary' ) ) {
		wp_enqueue_script(
			'twenty-twenty-one-primary-navigation-script',
			get_template_directory_uri() . '/assets/js/primary-navigation.js',
			array( 'twenty-twenty-one-ie11-polyfills' ),
			wp_get_theme()->get( 'Version' ),
			array(
				'in_footer' => false, // Because involves header.
				'strategy'  => 'defer',
			)
		);
	}

	// Responsive embeds script.
	wp_enqueue_script(
		'twenty-twenty-one-responsive-embeds-script',
		get_template_directory_uri() . '/assets/js/responsive-embeds.js',
		array( 'twenty-twenty-one-ie11-polyfills' ),
		wp_get_theme()->get( 'Version' ),
		array( 'in_footer' => true )
	);
}
add_action( 'wp_enqueue_scripts', 'twenty_twenty_one_scripts' );

/**
 * Enqueues block editor script.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_block_editor_script() {

	wp_enqueue_script( 'twentytwentyone-editor', get_theme_file_uri( '/assets/js/editor.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), array( 'in_footer' => true ) );
}

add_action( 'enqueue_block_editor_assets', 'twentytwentyone_block_editor_script' );

/**
 * Fixes skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @since Twenty Twenty-One 1.0
 * @deprecated Twenty Twenty-One 1.9 Removed from wp_print_footer_scripts action.
 *
 * @link https://git.io/vWdr2
 */
function twenty_twenty_one_skip_link_focus_fix() {

	// If SCRIPT_DEBUG is defined and true, print the unminified file.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		echo '<script>';
		include get_template_directory() . '/assets/js/skip-link-focus-fix.js';
		echo '</script>';
	} else {
		// The following is minified via `npx terser --compress --mangle -- assets/js/skip-link-focus-fix.js`.
		?>
		<script>
		/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",(function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())}),!1);
		</script>
		<?php
	}
}

/**
 * Enqueues non-latin language styles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twenty_twenty_one_non_latin_languages() {
	$custom_css = twenty_twenty_one_get_non_latin_css( 'front-end' );

	if ( $custom_css ) {
		wp_add_inline_style( 'twenty-twenty-one-style', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'twenty_twenty_one_non_latin_languages' );

// SVG Icons class.
require get_template_directory() . '/classes/class-twenty-twenty-one-svg-icons.php';

// Custom color classes.
require get_template_directory() . '/classes/class-twenty-twenty-one-custom-colors.php';
new Twenty_Twenty_One_Custom_Colors();

// Enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/template-functions.php';

// Menu functions and filters.
require get_template_directory() . '/inc/menu-functions.php';

// Custom template tags for the theme.
require get_template_directory() . '/inc/template-tags.php';

// Customizer additions.
require get_template_directory() . '/classes/class-twenty-twenty-one-customize.php';
new Twenty_Twenty_One_Customize();

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

// Block Styles.
require get_template_directory() . '/inc/block-styles.php';

// Dark Mode.
require_once get_template_directory() . '/classes/class-twenty-twenty-one-dark-mode.php';
new Twenty_Twenty_One_Dark_Mode();

/**
 * Enqueues scripts for the customizer preview.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_preview_init() {
	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		array( 'in_footer' => true )
	);

	wp_enqueue_script(
		'twentytwentyone-customize-preview',
		get_theme_file_uri( '/assets/js/customize-preview.js' ),
		array( 'customize-preview', 'customize-selective-refresh', 'jquery', 'twentytwentyone-customize-helpers' ),
		wp_get_theme()->get( 'Version' ),
		array( 'in_footer' => true )
	);
}
add_action( 'customize_preview_init', 'twentytwentyone_customize_preview_init' );

/**
 * Enqueues scripts for the customizer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_customize_controls_enqueue_scripts() {

	wp_enqueue_script(
		'twentytwentyone-customize-helpers',
		get_theme_file_uri( '/assets/js/customize-helpers.js' ),
		array(),
		wp_get_theme()->get( 'Version' ),
		array( 'in_footer' => true )
	);
}
add_action( 'customize_controls_enqueue_scripts', 'twentytwentyone_customize_controls_enqueue_scripts' );

/**
 * Calculates classes for the main <html> element.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_the_html_classes() {
	/**
	 * Filters the classes for the main <html> element.
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @param string The list of classes. Default empty string.
	 */
	$classes = apply_filters( 'twentytwentyone_html_classes', '' );
	if ( ! $classes ) {
		return;
	}
	echo 'class="' . esc_attr( $classes ) . '"';
}

/**
 * Adds "is-IE" class to body if the user is on Internet Explorer.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @return void
 */
function twentytwentyone_add_ie_class() {
	?>
	<script>
	if ( -1 !== navigator.userAgent.indexOf( 'MSIE' ) || -1 !== navigator.appVersion.indexOf( 'Trident/' ) ) {
		document.body.classList.add( 'is-IE' );
	}
	</script>
	<?php
}
add_action( 'wp_footer', 'twentytwentyone_add_ie_class' );

if ( ! function_exists( 'wp_get_list_item_separator' ) ) :
	/**
	 * Retrieves the list item separator based on the locale.
	 *
	 * Added for backward compatibility to support pre-6.0.0 WordPress versions.
	 *
	 * @since 6.0.0
	 */
	function wp_get_list_item_separator() {
		/* translators: Used between list items, there is a space after the comma. */
		return __( ', ', 'twentytwentyone' );
	}
endif;
function enqueue_jquery_for_form() {
   
        wp_enqueue_script('jquery');
   
}
add_action('wp_enqueue_scripts', 'enqueue_jquery_for_form');

function handle_ajax_register_user() {
    // Sanitize & validate core fields
    $first_name       = sanitize_text_field( $_POST['first_name'] );
    $last_name        = sanitize_text_field( $_POST['last_name'] );
    $email            = sanitize_email( $_POST['email'] );
    $password         = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone            = sanitize_text_field( $_POST['phone'] );

    if ( $password !== $confirm_password ) {
        echo "<p style='color:red;'>Passwords do not match.</p>";
        wp_die();
    }

    if ( email_exists( $email ) ) {
        echo "<p style='color:red;'>Email already exists.</p>";
        wp_die();
    }

    // Create the user
    $user_id = wp_insert_user( [
        'user_login'   => $email,
        'user_email'   => $email,
        'user_pass'    => $password,
        'first_name'   => $first_name,
        'last_name'    => $last_name,
        'role'         => 'subscriber',
    ] );

    if ( is_wp_error( $user_id ) ) {
        echo "<p style='color:red;'>User registration failed: " . esc_html( $user_id->get_error_message() ) . "</p>";
        wp_die();
    }

    update_user_meta( $user_id, 'phone', $phone );

   
    if ( ! empty( $_FILES['image']['name'] ) ) {
       
        if ( ! function_exists( 'media_handle_upload' ) ) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/image.php';
            require_once ABSPATH . 'wp-admin/includes/media.php';
        }

       
        $attachment_id = media_handle_upload(
            'image',
            0,
            [],
            [ 'test_form' => false ]
        );

        if ( is_wp_error( $attachment_id ) ) {
            echo "<p style='color:red;'>Image upload failed: " . esc_html( $attachment_id->get_error_message() ) . "</p>";
            wp_die();
        }

        
        update_user_meta( $user_id, 'profile_image', $attachment_id );
    }

    echo "<p style='color:green;'>User registered successfully!</p>";
    wp_die();
}
add_action( 'wp_ajax_ajax_register_user', 'handle_ajax_register_user' );
add_action( 'wp_ajax_nopriv_ajax_register_user', 'handle_ajax_register_user' );
function custom_user_profile_avatar( $avatar, $id_or_email, $size, $default, $alt ) {
    $user = false;

    if ( is_numeric( $id_or_email ) ) {
        $user = get_user_by( 'id', $id_or_email );
    } elseif ( is_object( $id_or_email ) && ! empty( $id_or_email->user_id ) ) {
        $user = get_user_by( 'id', $id_or_email->user_id );
    } elseif ( is_string( $id_or_email ) ) {
        $user = get_user_by( 'email', $id_or_email );
    }

    if ( $user && $user instanceof WP_User ) {
        $attachment_id = get_user_meta( $user->ID, 'profile_image', true );
        if ( $attachment_id ) {
            $image_url = wp_get_attachment_image_url( $attachment_id, 'thumbnail' );
            if ( $image_url ) {
                $avatar = "<img alt='" . esc_attr( $alt ) . "' src='" . esc_url( $image_url ) . "' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
            }
        }
    }

    return $avatar;
}
add_filter( 'get_avatar', 'custom_user_profile_avatar', 10, 5 );
// Register Custom Post Type: Toys
function register_toys_post_type() {
    $labels = array(
        'name' => 'Toys',
        'singular_name' => 'Toy',
        'menu_name' => 'Toys',
        'name_admin_bar' => 'Toy',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Toy',
        'new_item' => 'New Toy',
        'edit_item' => 'Edit Toy',
        'view_item' => 'View Toy',
        'all_items' => 'All Toys',
        'search_items' => 'Search Toys',
    );

    $args = array(
        'label' => 'Toys',
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'toys'),
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'menu_icon' => 'dashicons-smiley',
    );

    register_post_type('toys', $args);
}
add_action('init', 'register_toys_post_type');


// Register Custom Taxonomy: Categories
function register_toys_categories_taxonomy() {
    $labels = array(
        'name'              => 'Categories',
        'singular_name'     => 'Category',
        'search_items'      => 'Search Categories',
        'all_items'         => 'All Categories',
        'edit_item'         => 'Edit Category',
        'update_item'       => 'Update Category',
        'add_new_item'      => 'Add New Category',
        'new_item_name'     => 'New Category Name',
        'menu_name'         => 'Toy Categories',
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true, // like categories
        'public'            => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'toy-category'),
    );

    register_taxonomy('toy_category', 'toys', $args);
}
add_action('init', 'register_toys_categories_taxonomy');

function toy_ajax_submission_form() {
    ob_start();

    // Enqueue the JS for AJAX
    wp_enqueue_script('toy-ajax-script', get_template_directory_uri() . '/js/toy-ajax.js', array('jquery'), null, true);
    wp_localize_script('toy-ajax-script', 'toy_ajax_obj', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('toy_nonce')
    ));

    // Get categories
    $terms = get_terms(array(
        'taxonomy' => 'toy_category',
        'hide_empty' => false,
    ));
    ?>
    <form id="toy-form" enctype="multipart/form-data">
        <p><label>Toy Name</label><br>
            <input type="text" name="toy_title" required></p>
        <p><label>Toy Category</label><br>
            <select name="toy_category" required>
                <option value="">Select Category</option>
                <?php foreach ($terms as $term): ?>
                    <option value="<?php echo esc_attr($term->term_id); ?>"><?php echo esc_html($term->name); ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p><label>Toy Content</label><br>
            <textarea name="toy_content" rows="4" required></textarea></p>
        <p><label>Toy Feature Image</label><br>
            <input type="file" name="toy_image" accept="image/*"></p>
        <input type="hidden" name="action" value="submit_toy_form">
        <input type="hidden" name="security" value="<?php echo wp_create_nonce('toy_nonce'); ?>">
        <p><button type="submit">Submit Toy</button></p>
        <div id="toy-response"></div>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('toy_form_ajax', 'toy_ajax_submission_form');
add_action('wp_ajax_submit_toy_form', 'handle_toy_form_submission');
add_action('wp_ajax_nopriv_submit_toy_form', 'handle_toy_form_submission');

function handle_toy_form_submission() {
    check_ajax_referer('toy_nonce', 'security');

    $title   = sanitize_text_field($_POST['toy_title']);
    $content = sanitize_textarea_field($_POST['toy_content']);
    $cat_id  = intval($_POST['toy_category']);

    $post_id = wp_insert_post(array(
        'post_title'   => $title,
        'post_content' => $content,
        'post_type'    => 'toys',
        'post_status'  => 'publish'
    ));

    if (!$post_id) {
        wp_send_json_error('Failed to create post');
    }

    if ($cat_id) {
        wp_set_post_terms($post_id, array($cat_id), 'toy_category');
    }

    // Handle Image Upload
    if (!empty($_FILES['toy_image']['name'])) {
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        $attachment_id = media_handle_upload('toy_image', $post_id);
        if (!is_wp_error($attachment_id)) {
            set_post_thumbnail($post_id, $attachment_id);
        }
    }

    wp_send_json_success('Toy submitted successfully!');
}
add_action('wp_ajax_load_toy_posts', 'ajax_load_toy_posts');
add_action('wp_ajax_nopriv_load_toy_posts', 'ajax_load_toy_posts');

function ajax_load_toy_posts() {
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $per_page = 4;

    $query = new WP_Query(array(
        'post_type'      => 'toys',
        'posts_per_page' => $per_page,
        'paged'          => $paged,
    ));

    ob_start();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <div class="toy-post">
                <h3><?php the_title(); ?></h3>
                <?php if (has_post_thumbnail()) {
                    the_post_thumbnail('medium');
                } ?>
                <div><?php //the_excerpt(); ?></div>
            </div>
            <hr>
            <?php
        }
    } else {
        echo '<p>No toys found.</p>';
    }
    wp_reset_postdata();
    $posts_html = ob_get_clean();

    // Pagination
    $pagination_html = '';
    $total_pages = $query->max_num_pages;
    if ($total_pages > 1) {
        for ($i = 1; $i <= $total_pages; $i++) {
            $active = $i == $paged ? 'style="font-weight:bold;"' : '';
            $pagination_html .= "<a class='toy-page-link' href='#' data-page='{$i}' {$active}>{$i}</a> ";
        }
    }

    wp_send_json_success(array(
        'posts' => $posts_html,
        'pagination' => $pagination_html
    ));
}
// Enqueue JS for AJAX
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('custom-auth', get_template_directory_uri() . '/js/auth.js', ['jquery'], null, true);
    wp_localize_script('custom-auth', 'auth_ajax_obj', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('auth_nonce')
    ]);
});

// Shortcode for Signup Form
add_shortcode('custom_signup_form', function () {
    ob_start(); ?>
    <form id="signup-form">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Sign Up</button>
    </form>
    <div id="signup-response"></div>
    <?php return ob_get_clean();
});

// Shortcode for Login Form
add_shortcode('custom_login_form', function () {
    ob_start(); ?>
    <form id="login-form">
        <input type="text" name="username" placeholder="Username or Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Log In</button>
    </form>
    <div id="login-response"></div>
    <?php return ob_get_clean();
});

// Handle Signup
add_action('wp_ajax_nopriv_custom_signup', 'handle_custom_signup');
function handle_custom_signup() {
    check_ajax_referer('auth_nonce', 'nonce');

    $username = sanitize_user($_POST['username']);
    $email    = sanitize_email($_POST['email']);
    $password = $_POST['password'];

    if (username_exists($username) || email_exists($email)) {
        wp_send_json_error('Username or email already exists.');
    }

    $user_id = wp_create_user($username, $password, $email);
    if (is_wp_error($user_id)) {
        wp_send_json_error($user_id->get_error_message());
    }

    wp_send_json_success('Signup successful. You can now log in.');
}

// Handle Login
add_action('wp_ajax_nopriv_custom_login', 'handle_custom_login');
function handle_custom_login() {
    check_ajax_referer('auth_nonce', 'nonce');

    $creds = [
        'user_login'    => $_POST['username'],
        'user_password' => $_POST['password'],
        'remember'      => true,
    ];

    $user = wp_signon($creds, false);
    if (is_wp_error($user)) {
        wp_send_json_error($user->get_error_message());
    }

    wp_send_json_success('Login successful. Redirecting...');
}





