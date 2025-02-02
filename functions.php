<?php
	/**
	 * Bootstrap on WordPress functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
	 * @package     WordPress
	 * @subpackage  Bootstrap 5.2.0
	 * @autor       Babobski
	 */

	define( 'BOOTSTRAP_VERSION', '5.2.0' );
	define( 'BOOTSTRAP_ICON_VERSION', '1.9.1' );

	/*
	========================================================================================================================

	01. Add language support to theme

	======================================================================================================================== */

	add_action( 'after_setup_theme', 'my_theme_setup' );

function my_theme_setup() {
	load_theme_textdomain( 'wp_babobski', get_template_directory() . '/language' );
}

	/*
	========================================================================================================================

	02. Required external files

	======================================================================================================================== */

	require_once 'external/bootstrap-utilities.php';
	require_once 'external/bs5navwalker.php';
	require_once 'external/class-wp-bootstrap-navwalker.php';

	/*
	========================================================================================================================

    03. Add html 5 support to WordPress elements

	======================================================================================================================== */

	add_theme_support(
		'html5',
		array(
			'comment-list',
			'search-form',
			'comment-form',
			'gallery',
			'caption',
		)
	);

	/*
	========================================================================================================================

	04. Theme specific settings

	======================================================================================================================== */

	add_theme_support( 'post-thumbnails' );

	// add_image_size( 'name', width, height, crop true|false );

	register_nav_menus(
		array(
			'primary' => 'Primary Navigation',
		)
	);

	/*
	========================================================================================================================

	05. Actions and Filters

	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'bootstrap_script_init' );

	$BsWp = new BsWp();
	add_filter( 'body_class', array( $BsWp, 'add_slug_to_body_class' ) );

	/*
	========================================================================================================================

	06. Custom Post Types - include custom post types and taxonomies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );

	======================================================================================================================== */



	/*
	========================================================================================================================

	07. Scripts

	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	if ( ! function_exists( 'bootstrap_script_init' ) ) {
		function bootstrap_script_init() {

			// Get theme version number (located in style.css)
			$theme = wp_get_theme();

			wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array( 'jquery' ), BOOTSTRAP_VERSION, true );
			wp_enqueue_script( 'site', get_template_directory_uri() . '/js/app.js', array( 'jquery', 'bootstrap' ), $theme->get( 'Version' ), true );

			// wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), BOOTSTRAP_VERSION, 'all' );
			// wp_enqueue_style( 'bootstrap_icons', get_template_directory_uri() . '/css/bootstrap-icons.css', array(), BOOTSTRAP_ICON_VERSION, 'all' );
			wp_enqueue_style( 'main_theme', get_template_directory_uri() . '/style.css', array(), $theme->get( 'Version' ), 'all' );
		}
	}

	/*
	========================================================================================================================

	08. Security & cleanup wp admin

	======================================================================================================================== */

	// remove wp version
	function theme_remove_version() {
		return '';
	}

	add_filter( 'the_generator', 'theme_remove_version' );

	// remove default footer text
	function remove_footer_admin() {
		echo '';
	}

	add_filter( 'admin_footer_text', 'remove_footer_admin' );

	// remove WordPress logo from adminbar
	function wp_logo_admin_bar_remove() {
		global $wp_admin_bar;

		/* Remove their stuff */
		$wp_admin_bar->remove_menu( 'wp-logo' );
	}

	add_action( 'wp_before_admin_bar_render', 'wp_logo_admin_bar_remove', 0 );

	// Remove default Dashboard widgets
	if ( ! function_exists( 'disable_default_dashboard_widgets' ) ) {
		function disable_default_dashboard_widgets() {

			// remove_meta_box('dashboard_right_now', 'dashboard', 'core');
			remove_meta_box( 'dashboard_activity', 'dashboard', 'core' );
			remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'core' );
			remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'core' );
			remove_meta_box( 'dashboard_plugins', 'dashboard', 'core' );

			remove_meta_box( 'dashboard_quick_press', 'dashboard', 'core' );
			remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'core' );
			remove_meta_box( 'dashboard_primary', 'dashboard', 'core' );
			remove_meta_box( 'dashboard_secondary', 'dashboard', 'core' );
		}
	}
	add_action( 'admin_menu', 'disable_default_dashboard_widgets' );

	remove_action( 'welcome_panel', 'wp_welcome_panel' );

	// Disable the emoji's
	if ( ! function_exists( 'disable_emojis' ) ) {
		function disable_emojis() {
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );
			remove_action( 'admin_print_styles', 'print_emoji_styles' );
			remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
			remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
			remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

			// Remove from TinyMCE
			add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
		}
	}
	add_action( 'init', 'disable_emojis' );

	// Filter out the tinymce emoji plugin.
	function disable_emojis_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
			return array();
		}
	}

	add_action( 'admin_head', 'custom_logo_guttenberg' );

	if ( ! function_exists( 'custom_logo_guttenberg' ) ) {
		function custom_logo_guttenberg() {
			echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo( 'stylesheet_directory' ) .
			'/css/admin-custom.css?v=1.0.0" />';
		}
	}

	/*
	========================================================================================================================

	09. Disabeling Guttenberg

	======================================================================================================================== */

	// Optional disable guttenberg block editor
	// add_filter( 'use_block_editor_for_post', '__return_false' );


	// Remove Gutenberg Block Library CSS from loading on the frontend
	// function smartwp_remove_wp_block_library_css() {
	// wp_dequeue_style('wp-block-library');
	// wp_dequeue_style('wp-block-library-theme');
	// wp_dequeue_style('wc-block-style'); // Remove WooCommerce block CSS
	// wp_dequeue_style( 'storefront-gutenberg-blocks' ); // Storefront
	// }
	// add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);

	/*
	========================================================================================================================

	10. Custom login

	======================================================================================================================== */

	// Add custom css
	if ( ! function_exists( 'my_custom_login' ) ) {
		function my_custom_login() {
			echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo( 'stylesheet_directory' ) . '/css/custom-login-style.css?v=1.0.0" />';
		}
	}
	add_action( 'login_head', 'my_custom_login' );

	// Link the logo to the home of our website
	if ( ! function_exists( 'my_login_logo_url' ) ) {
		function my_login_logo_url() {
			return get_bloginfo( 'url' );
		}
	}
	add_filter( 'login_headerurl', 'my_login_logo_url' );

	// Change the title text
	if ( ! function_exists( 'my_login_logo_url_title' ) ) {
		function my_login_logo_url_title() {
			return get_bloginfo( 'name' );
		}
	}
	add_filter( 'login_headertext', 'my_login_logo_url_title' );


	/*
	========================================================================================================================

	11. Comments

	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	if ( ! function_exists( 'bootstrap_comment' ) ) {
		function bootstrap_comment( $comment, $args, $depth ) {
			$GLOBALS['comment'] = $comment;
			?>
			<?php if ( $comment->comment_approved == '1' ) : ?>
			<li class="row">
				<div class="col-4 col-md-2">
					<?php echo get_avatar( $comment ); ?>
				</div>
				<div class="col-8 col-md-10">
					<h4><?php comment_author_link(); ?></h4>
					<time><a href="#comment-<?php comment_ID(); ?>" pubdate><?php comment_date(); ?> at <?php comment_time(); ?></a></time>
					<?php comment_text(); ?>
				</div>
				<?php
			endif;
		}
	}


	/**
	 * Register Custom Navigation Walker
	 */
	function register_navwalker() {
		require_once get_template_directory() . '/external/class-wp-bootstrap-navwalker.php';
	}

	add_action( 'after_setup_theme', 'register_navwalker' );

	// Register Shows Post Type
	function register_show_post_type() {
		$labels = array(
			'name'                  => _x( 'Shows', 'Post Type General Name', 'westferry' ),
			'singular_name'         => _x( 'Show', 'Post Type Singular Name', 'westferry' ),
			'menu_name'             => __( 'Shows', 'westferry' ),
			'name_admin_bar'        => __( 'Shows', 'westferry' ),
			'archives'              => __( 'Show Archives', 'westferry' ),
			'attributes'            => __( 'Show Attributes', 'westferry' ),
			'parent_item_colon'     => __( 'Parent Item:', 'westferry' ),
			'all_items'             => __( 'All Shows', 'westferry' ),
			'add_new_item'          => __( 'Add New Show', 'westferry' ),
			'add_new'               => __( 'Add New', 'westferry' ),
			'new_item'              => __( 'New Show', 'westferry' ),
			'edit_item'             => __( 'Edit Show', 'westferry' ),
			'update_item'           => __( 'Update Show', 'westferry' ),
			'view_item'             => __( 'View Show', 'westferry' ),
			'view_items'            => __( 'View Shows', 'westferry' ),
			'search_items'          => __( 'Search Show', 'westferry' ),
			'not_found'             => __( 'Not found', 'westferry' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'westferry' ),
			'featured_image'        => __( 'Featured Image', 'westferry' ),
			'set_featured_image'    => __( 'Set featured image', 'westferry' ),
			'remove_featured_image' => __( 'Remove featured image', 'westferry' ),
			'use_featured_image'    => __( 'Use as featured image', 'westferry' ),
			'insert_into_item'      => __( 'Insert into item', 'westferry' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'westferry' ),
			'items_list'            => __( 'Items list', 'westferry' ),
			'items_list_navigation' => __( 'Items list navigation', 'westferry' ),
			'filter_items_list'     => __( 'Filter items list', 'westferry' ),
		);
		$args   = array(
			'label'               => __( 'Shows', 'westferry' ),
			'description'         => __( 'Shows', 'westferry' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail', 'custom-fields' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-calendar-alt',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);
		register_post_type( 'show', $args );
	}
	add_action( 'init', 'register_show_post_type', 0 );

	// Register Album Post Type
	function register_album_post_type() {

		$labels = array(
			'name'                  => _x( 'Albums', 'Post Type General Name', 'westferry' ),
			'singular_name'         => _x( 'Album', 'Post Type Singular Name', 'westferry' ),
			'menu_name'             => __( 'Albums', 'westferry' ),
			'name_admin_bar'        => __( 'Albums', 'westferry' ),
			'archives'              => __( 'Album Archives', 'westferry' ),
			'attributes'            => __( 'Album Attributes', 'westferry' ),
			'parent_item_colon'     => __( 'Parent Album:', 'westferry' ),
			'all_items'             => __( 'All Albums', 'westferry' ),
			'add_new_item'          => __( 'Add New Album', 'westferry' ),
			'add_new'               => __( 'Add New', 'westferry' ),
			'new_item'              => __( 'New Album', 'westferry' ),
			'edit_item'             => __( 'Edit Album', 'westferry' ),
			'update_item'           => __( 'Update Album', 'westferry' ),
			'view_item'             => __( 'View Album', 'westferry' ),
			'view_items'            => __( 'View Albums', 'westferry' ),
			'search_items'          => __( 'Search Album', 'westferry' ),
			'not_found'             => __( 'Not found', 'westferry' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'westferry' ),
			'featured_image'        => __( 'Featured Image', 'westferry' ),
			'set_featured_image'    => __( 'Set featured image', 'westferry' ),
			'remove_featured_image' => __( 'Remove featured image', 'westferry' ),
			'use_featured_image'    => __( 'Use as featured image', 'westferry' ),
			'insert_into_item'      => __( 'Insert into item', 'westferry' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'westferry' ),
			'items_list'            => __( 'Items list', 'westferry' ),
			'items_list_navigation' => __( 'Items list navigation', 'westferry' ),
			'filter_items_list'     => __( 'Filter items list', 'westferry' ),
		);
		$args   = array(
			'label'               => __( 'Album', 'westferry' ),
			'description'         => __( 'Albums', 'westferry' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'thumbnail', 'custom-fields' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 6,
			'menu_icon'           => 'dashicons-album',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
		);
		register_post_type( 'album', $args );
	}
	add_action( 'init', 'register_album_post_type', 0 );

	// // Converts the Structure Tags in our permalink.
	// function post_type_link($url, $post)
	// {
	// if ('show' === get_post_type($post)) {
	// $show = get_field('show');
	// $date = DateTime::createFromFormat("Ymd", $show['date']);

	// $year = $date->format("Y");
	// $month = $date->format("m");
	// $day = $date->format("d");

	// $url = str_replace("%year%", $year, $url);
	// $url = str_replace("%month%", $month, $url);
	// $url = str_replace("%day%", $day, $url);
	// echo $url;
	// }
	// return $url;
	// }

	// add_filter('post_type_link', 'post_type_link', 10, 2);


	if ( function_exists( 'acf_add_local_field_group' ) ) :

		acf_add_local_field_group(
			array(
				'key'                   => 'group_620843de71376',
				'title'                 => 'Albums',
				'fields'                => array(
					array(
						'key'               => 'field_620843f4f2d8b',
						'label'             => 'Description',
						'name'              => 'description',
						'type'              => 'radio',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'choices'           => array(
							'Single' => 'Single',
							'EP'     => 'EP',
						),
						'allow_null'        => 0,
						'other_choice'      => 0,
						'default_value'     => '',
						'layout'            => 'vertical',
						'return_format'     => 'value',
						'save_other_choice' => 0,
					),
					array(
						'key'               => 'field_62084400f2d8c',
						'label'             => 'Year',
						'name'              => 'year',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					),
					array(
						'key'               => 'field_62084414f2d8d',
						'label'             => 'Label',
						'name'              => 'label',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					),
					array(
						'key'               => 'field_6208442ff2d8e',
						'label'             => 'Bandcamp',
						'name'              => 'bandcamp',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					),
					array(
						'key'               => 'field_6208528b4daba',
						'label'             => 'Bandcamp Track ID',
						'name'              => 'bandcamp_track_id',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					),
					array(
						'key'               => 'field_620855f3e825a',
						'label'             => 'Bandcamp ID Type',
						'name'              => 'bandcamp_id_type',
						'type'              => 'select',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'choices'           => array(
							'album' => 'Album',
							'track' => 'Track',
						),
						'default_value'     => false,
						'allow_null'        => 0,
						'multiple'          => 0,
						'ui'                => 0,
						'return_format'     => 'value',
						'ajax'              => 0,
						'placeholder'       => '',
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'album',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => '',
				'active'                => true,
				'description'           => '',
				'show_in_rest'          => 0,
			)
		);

		acf_add_local_field_group(
			array(
				'key'                   => 'group_62043549b32a6',
				'title'                 => 'Branding and Social',
				'fields'                => array(
					array(
						'key'               => 'field_6204356eeebf7',
						'label'             => 'Band name',
						'name'              => 'band_name',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					),
					array(
						'key'               => 'field_6209900f79899',
						'label'             => 'Social Media',
						'name'              => 'social_media',
						'type'              => 'group',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'layout'            => 'block',
						'sub_fields'        => array(
							array(
								'key'               => 'field_620990497989b',
								'label'             => 'Facebook',
								'name'              => 'facebook',
								'type'              => 'link',
								'instructions'      => '',
								'required'          => 0,
								'conditional_logic' => 0,
								'wrapper'           => array(
									'width' => '',
									'class' => '',
									'id'    => '',
								),
								'return_format'     => 'array',
							),
							array(
								'key'               => 'field_620990577989c',
								'label'             => 'Instagram',
								'name'              => 'instagram',
								'type'              => 'link',
								'instructions'      => '',
								'required'          => 0,
								'conditional_logic' => 0,
								'wrapper'           => array(
									'width' => '',
									'class' => '',
									'id'    => '',
								),
								'return_format'     => 'array',
							),
						),
					),
					array(
						'key'               => 'field_620990277989a',
						'label'             => 'Streaming Services',
						'name'              => 'streaming_services',
						'type'              => 'group',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'layout'            => 'block',
						'sub_fields'        => array(
							array(
								'key'               => 'field_620990785468b',
								'label'             => 'Spotify',
								'name'              => 'spotify',
								'type'              => 'link',
								'instructions'      => '',
								'required'          => 0,
								'conditional_logic' => 0,
								'wrapper'           => array(
									'width' => '',
									'class' => '',
									'id'    => '',
								),
								'return_format'     => 'array',
							),
							array(
								'key'               => 'field_620990855468c',
								'label'             => 'Apple Music',
								'name'              => 'apple_music',
								'type'              => 'link',
								'instructions'      => '',
								'required'          => 0,
								'conditional_logic' => 0,
								'wrapper'           => array(
									'width' => '',
									'class' => '',
									'id'    => '',
								),
								'return_format'     => 'array',
							),
							array(
								'key'               => 'field_620990955468d',
								'label'             => 'Bandcamp',
								'name'              => 'bandcamp',
								'type'              => 'link',
								'instructions'      => '',
								'required'          => 0,
								'conditional_logic' => 0,
								'wrapper'           => array(
									'width' => '',
									'class' => '',
									'id'    => '',
								),
								'return_format'     => 'array',
							),
						),
					),
					array(
						'key'               => 'field_620a8ca163dbc',
						'label'             => 'Contact Email',
						'name'              => 'contact_email',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					),
					array(
						'key'               => 'field_620a8f7713d16',
						'label'             => 'Footer Text',
						'name'              => 'footer_text',
						'type'              => 'wysiwyg',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'tabs'              => 'all',
						'toolbar'           => 'full',
						'media_upload'      => 1,
						'delay'             => 0,
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'page',
							'operator' => '==',
							'value'    => '5',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => '',
				'active'                => true,
				'description'           => '',
				'show_in_rest'          => 0,
			)
		);

		acf_add_local_field_group(
			array(
				'key'                   => 'group_620a8cdf1379f',
				'title'                 => 'Email',
				'fields'                => array(
					array(
						'key'               => 'field_620a8cee1d9c5',
						'label'             => 'email',
						'name'              => 'email',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'page',
							'operator' => '==',
							'value'    => '19',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => '',
				'active'                => true,
				'description'           => '',
				'show_in_rest'          => 0,
			)
		);

		acf_add_local_field_group(
			array(
				'key'                   => 'group_62055b7ed73eb',
				'title'                 => 'Featured Video',
				'fields'                => array(
					array(
						'key'               => 'field_62055bab554c7',
						'label'             => 'Featured Video',
						'name'              => 'featured_video',
						'type'              => 'wysiwyg',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'tabs'              => 'all',
						'toolbar'           => 'full',
						'media_upload'      => 1,
						'delay'             => 0,
					),
					array(
						'key'               => 'field_62056a233e648',
						'label'             => 'Description',
						'name'              => 'featured_video_desc',
						'type'              => 'text',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'page',
							'operator' => '==',
							'value'    => '5',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => '',
				'active'                => true,
				'description'           => '',
				'show_in_rest'          => 0,
			)
		);

		acf_add_local_field_group(
			array(
				'key'                   => 'group_6205849248fe8',
				'title'                 => 'Shows',
				'fields'                => array(
					array(
						'key'               => 'field_6205849ae8664',
						'label'             => 'Show',
						'name'              => 'show',
						'type'              => 'group',
						'instructions'      => '',
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => array(
							'width' => '',
							'class' => '',
							'id'    => '',
						),
						'layout'            => 'block',
						'sub_fields'        => array(
							array(
								'key'               => 'field_620584bde8665',
								'label'             => 'City',
								'name'              => 'city',
								'type'              => 'text',
								'instructions'      => '',
								'required'          => 0,
								'conditional_logic' => 0,
								'wrapper'           => array(
									'width' => '',
									'class' => '',
									'id'    => '',
								),
								'default_value'     => '',
								'placeholder'       => '',
								'prepend'           => '',
								'append'            => '',
								'maxlength'         => '',
							),
							array(
								'key'               => 'field_62058517e8668',
								'label'             => 'Venue',
								'name'              => 'venue',
								'type'              => 'text',
								'instructions'      => '',
								'required'          => 0,
								'conditional_logic' => 0,
								'wrapper'           => array(
									'width' => '',
									'class' => '',
									'id'    => '',
								),
								'default_value'     => '',
								'placeholder'       => '',
								'prepend'           => '',
								'append'            => '',
								'maxlength'         => '',
							),
							array(
								'key'               => 'field_620584d4e8666',
								'label'             => 'Date',
								'name'              => 'date',
								'type'              => 'date_picker',
								'instructions'      => '',
								'required'          => 0,
								'conditional_logic' => 0,
								'wrapper'           => array(
									'width' => '',
									'class' => '',
									'id'    => '',
								),
								'display_format'    => 'F j, Y',
								'return_format'     => 'Ymd',
								'first_day'         => 1,
							),
							array(
								'key'               => 'field_62058507e8667',
								'label'             => 'Supporting Acts',
								'name'              => 'support',
								'type'              => 'text',
								'instructions'      => '',
								'required'          => 0,
								'conditional_logic' => 0,
								'wrapper'           => array(
									'width' => '',
									'class' => '',
									'id'    => '',
								),
								'default_value'     => '',
								'placeholder'       => '',
								'prepend'           => '',
								'append'            => '',
								'maxlength'         => '',
							),
							array(
								'key'               => 'field_62058564e8669',
								'label'             => 'Event Page',
								'name'              => 'url',
								'type'              => 'url',
								'instructions'      => '',
								'required'          => 0,
								'conditional_logic' => 0,
								'wrapper'           => array(
									'width' => '',
									'class' => '',
									'id'    => '',
								),
								'default_value'     => '',
								'placeholder'       => '',
							),
						),
					),
				),
				'location'              => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'show',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => '',
				'active'                => true,
				'description'           => '',
				'show_in_rest'          => 0,
			)
		);

		endif;


	function bsik_get_page_by_title( $page_title, $output = OBJECT, $post_type = 'page' ) {

		global $wpdb;

		if ( is_array( $post_type ) ) {
			$post_type           = esc_sql( $post_type );
			$post_type_in_string = "'" . implode( "','", $post_type ) . "'";
			$sql                 = $wpdb->prepare(
				"
            SELECT ID
            FROM $wpdb->posts
            WHERE post_title = %s
            AND post_type IN ($post_type_in_string)
        ",
				$page_title
			);
		} else {
			$sql = $wpdb->prepare(
				"
            SELECT ID
            FROM $wpdb->posts
            WHERE post_title = %s
            AND post_type = %s
        ",
				$page_title,
				$post_type
			);
		}

		$page = $wpdb->get_var( $sql );

		if ( $page ) {
			return get_post( $page, $output );
		}

		return null;
	}
