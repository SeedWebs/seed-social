<?php
/*
Plugin Name: Seed Social
Plugin URI: https://github.com/SeedThemes/seed-social
Description: Minimal Social Sharing WordPress Plugin
Version: 1.4.0
Author: SeedThemes
Author URI: https://www.seedthemes.com
License: GPL2
*/

/*
Copyright 2016-2017 SeedThemes  (email : info@seedthemes.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if(!class_exists('Seed_Social'))
{
	class Seed_Social
	{
        /**
         * Construct the plugin object
         */
        public function __construct()
        {

        }

        /**
         * Activate the plugin
         */
        public static function activate()
        {

        }

        /**
         * Deactivate the plugin
         */     
        public static function deactivate()
        {

        }
    } // END class Seed_Social
} // END if(!class_exists('Seed_Social'))

if(class_exists('Seed_Social'))
{
    // Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('Seed_Social', 'activate'));
	register_deactivation_hook(__FILE__, array('Seed_Social', 'deactivate'));

    // instantiate the plugin class
	$seed_social = new Seed_Social();
}

add_action('wp_head','seed_social_fb_og');

function seed_social_fb_og() {
	$is_open_graph = get_option( 'seed_social_is_open_graph' );

	if( $is_open_graph ) {
		global $post;

		/* FB Open Graph */

		$fb_og = '';

		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );

		$featured_image = '';

		if ( ! empty( $large_image_url[0] ) ) $featured_image = esc_url( $large_image_url[0] );

		$fb_og .= '<meta property="og:url" content="'.home_url('/').$post->post_name.'" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="'.htmlspecialchars($post->post_title).'" />
		<meta property="og:description" content="'.htmlspecialchars($post->post_excerpt).'" />
		<meta property="og:image" content="'.$featured_image.'" />';

		echo $fb_og;
	}
}

add_action( 'wp_enqueue_scripts', 'seed_social_scripts' );

function seed_social_scripts() {
	if(!is_admin()) {
		wp_enqueue_script( 'seed-social', plugin_dir_url( __FILE__ ) . 'seed-social.js' , array('jquery'), '2016-1', true );
		wp_enqueue_style( 'seed-social', plugin_dir_url( __FILE__ ) . 'seed-social.css' , array() );
	}
}

function seed_social( $echo = true , $css_class = '') {
	$is_facebook = get_option( 'seed_social_is_facebook', array( 'on' ) );
	$is_twitter = get_option( 'seed_social_is_twitter', array( 'on' ) );
	$is_line = get_option( 'seed_social_is_line', array( 'on' ) );

	$facebook_text = get_option( 'seed_social_facebook_text', 'Facebook' );
	$twitter_text = get_option( 'seed_social_twitter_text', 'Twitter' );
	$line_text = get_option( 'seed_social_line_text', 'Line' );

	if( $facebook_text == '' ) $facebook_text = 'Facebook';
	if( $twitter_text == '' ) $twitter_text = 'Twitter';
	if( $line_text == '' ) $line_text = 'Line';		

	global $post;

	$seed_social_echo = '';

	if( $is_facebook || $is_twitter || $is_line ) {

		/* Facebook Button */
		if( $is_facebook )
			$fbshare = '<a href="https://www.facebook.com/share.php?u='.urlencode( get_the_permalink( $post->ID ) ).'" target="seed-social"><i class="ss-facebook"></i><span class="text">'. $facebook_text . '</span><span class="count"></span></a>';

		/* Twitter Button */
		if( $is_twitter )
			$tweet = '<a href="https://twitter.com/share?url='.urlencode( get_the_permalink( $post->ID ) ).'&text='.urlencode($post->post_title).'" target="seed-social"><i class="ss-twitter"></i><span class="text">' . $twitter_text . '</span><span class="count"></span></a>';

		/* Line */
		if( $is_line )
			$line = '<a href="https://lineit.line.me/share/ui?url='.urlencode( get_the_permalink( $post->ID ) ).'" target="seed-social"><i class="ss-line"></i><span class="text">' . $line_text . '</span><span class="count"></span></a>';

		$seed_social_echo .= '<div class="seed-social '. $css_class . '">';

		if( $is_facebook )
			$seed_social_echo .= '<div class="facebook">'.$fbshare.'</div>';

		if( $is_twitter )
			$seed_social_echo .= '<div class="twitter">'.$tweet.'</div>';

		if( $is_line )
			$seed_social_echo .= '<div class="line">'.$line.'</div>';

		$seed_social_echo .= '</div>';
	}

	if( $echo )
		echo $seed_social_echo;

	return $seed_social_echo;
}

/**
 * Check if WooCommerce plugin is installed and activated.
 * @return bool
 */
if ( ! function_exists( 'is_woo_activated' ) ) {
	function is_woo_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}

function seed_social_auto( $content ) {
	$is_disable = get_post_meta(get_the_ID(), '_seed_social_disable', true);

	if( $is_disable != 'on' ) {
		$positions = get_option( 'seed_social_positions', array( 'bottom' ) );
		$post_types = get_option( 'seed_social_post_types' , array( 'post', 'page' ) );

		if( ! empty( $positions ) && ! empty( $post_types ) && in_array( get_post_type() , $post_types ) && ! is_front_page() && is_singular() )  {
			if ( $GLOBALS['post']->ID == get_the_ID() ) {
				if( in_array( 'top' , $positions ) )
					$content = seed_social( false, '-top' ) . $content;

				if( in_array( 'bottom' , $positions ) )
					$content .= seed_social( false, '-bottom' );
			}
		}
	}

	return $content;
}

add_filter('the_content', 'seed_social_auto', 15);

function seed_social_bbpress_auto_bottom() {
	$is_disable = get_post_meta(get_the_ID(), '_seed_social_disable', true);

	if( $is_disable != 'on' ) {
		$positions = get_option( 'seed_social_positions', array( 'bottom' ) );
		$post_types = get_option( 'seed_social_post_types' , array( 'post', 'page' ) );

		if( ! empty( $positions ) && in_array( get_post_type() , $post_types ) && ! is_front_page() && is_singular() )  {
			if ( $GLOBALS['post']->ID == get_the_ID() ) {
				if( in_array( 'bottom' , $positions ) )
					seed_social( true, '-bbpress-bottom' );
			}
		}
	}
}

add_action( 'bbp_template_after_single_topic', 'seed_social_bbpress_auto_bottom', 15, 0);

function seed_social_bbpress_auto_top() {
	$is_disable = get_post_meta(get_the_ID(), '_seed_social_disable', true);

	if( $is_disable != 'on' ) {
		$positions = get_option( 'seed_social_positions', array( 'bottom' ) );
		$post_types = get_option( 'seed_social_post_types' , array( 'post', 'page' ) );

		if( ! empty( $positions ) && in_array( get_post_type() , $post_types ) && ! is_front_page() && is_singular() )  {
			if ( $GLOBALS['post']->ID == get_the_ID() ) {
				if( in_array( 'top' , $positions ) )
					seed_social( true, '-bbpress-top' );
			}
		}
	}
}

add_action( 'bbp_template_before_single_topic', 'seed_social_bbpress_auto_top', 15, 0);

function seed_social_woocommerce_after_product_content() {
	$is_disable = get_post_meta(get_the_ID(), '_seed_social_disable', true);

	if( $is_disable != 'on' ) {
		$woocommerce = get_option( 'seed_social_woocommerce', array( 'after-summary' ) );

		if( ! empty( $woocommerce ) ) {
			if( in_array( 'after-product-content' , $woocommerce ) ) {
				seed_social( true , '-product-content');
			}
		}
	}
}

add_action( 'woocommerce_after_single_product', 'seed_social_woocommerce_after_product_content', 10);

function seed_social_woocommerce_after_summary() {
	$is_disable = get_post_meta(get_the_ID(), '_seed_social_disable', true);

	if( $is_disable != 'on' ) {
		$woocommerce = get_option( 'seed_social_woocommerce', array( 'after-summary' ) );
		if( ! empty( $woocommerce ) ) {
			if( in_array( 'after-summary' , $woocommerce ) ) {
				seed_social( true , '-product-summary');
			}
		}
	}
}

add_action( 'woocommerce_share', 'seed_social_woocommerce_after_summary', 10);

/* [seed_social] */
function seed_social_shortcode( $atts ){
	return seed_social( false , '-shortcode');
}

add_shortcode( 'seed_social', 'seed_social_shortcode' );

function seed_social_setup_menu() {
	$seed_social_page = add_submenu_page ( 'options-general.php', __( 'Seed Social', 'seed-social' ), __( 'Seed Social', 'seed-social' ), 'manage_options', 'seed-social', 'seed_social_init' );
}

add_action( 'admin_menu', 'seed_social_setup_menu' );

function seed_social_init() { 
	?><style>
		form label{
			display: inline-block; min-width: 60px; margin-right: 10px;
		}
		.form-table th,.form-table td {
			padding: 0;line-height: 4em;
		}
		.form-table td p.description {
			margin-top: -10px;
		}
		input#seed-social-facebook-text,
		input#seed-social-twitter-text,
		input#seed-social-line-text {
			position: absolute;margin: -3em 0 0 24px;width: 100px;
		}</style>
		<div class="wrap">
			<div class="icon32" id="icon-options-general"></div>
			<h2><?php esc_html_e( 'Seed Social', 'seed-social' ); ?></h2>
			<p>
				<?php printf( wp_kses( __( 'For more information, please visit <a href="%1s" target="_blank">FAQ on WordPress.org</a>.', 'seed-social' ), array( 'a' => array( 'href' => array(), 'target' => array() ) ) ), esc_url( 'https://wordpress.org/plugins/seed-social/#faq' ) ); ?>
			</p>
			<form action="<?php echo admin_url( 'options.php' ); ?>" method="post" id="seed-social-form">
				<?php
				settings_fields( 'seed-social' );
				do_settings_sections( 'seed-social' );
				submit_button();
				?>
			</form>
		</div>
		<?php 
	}

/**
 * Quick helper function that prefixes an option ID
 *
 * This makes it easier to maintain and makes it super easy to change the options prefix without breaking the options
 * registered with the Settings API.
 *
 * @since 0.10.0
 *
 * @param string $name Unprefixed name of the option
 *
 * @return string
 */
function seed_social_get_option_id( $name ) {
	return 'seed_social_' . $name;
}

function seed_social_get_settings() {

	$settings = array(
		array(
			'id'      => 'seed_social_settings',
			'title'   => __( 'Social Sharing Buttons', 'seed-social' ),
			'options' => array(
				array(
					'id'      => seed_social_get_option_id( 'post_types' ),
					'title'   => esc_html__( 'Post Type to show:', 'seed-social' ),
					'type'    => 'checkbox',
					'options' => seed_social_get_post_types_option_list(),
					'default' => array( 'post', 'page' )
				),
				array(
					'id'      => seed_social_get_option_id( 'positions' ),
					'title'   => esc_html__( 'Position to show:', 'seed-social' ),
					'type'    => 'checkbox',
					'options' => array( 'top' => esc_html__( 'Top', 'seed-social' ) , 'bottom' => esc_html__( 'Bottom', 'seed-social' ) ),
					'default' => array( 'bottom' )
				),
				array(
					'id'      => seed_social_get_option_id( 'woocommerce' ),
					'title'   => esc_html__( 'WooCommerce', 'seed-social' ),
					'type'    => 'checkbox',
					'options' => array( 'after-summary' => esc_html__( 'Show after summary', 'seed-social' ) , 'after-product-content' => esc_html__( 'Show after product content', 'seed-social' ) ),
					'default' => array( 'after-product-content' )
				),	
				array(
					'id'      => seed_social_get_option_id( 'is_facebook' ),
					'title'   => esc_html__( 'Facebook', 'seed-social' ),
					'type'    => 'checkbox',
					'options' => array( 'on' => esc_html__( '', 'seed-social' ) ),
					'default' => array( 'on' )
				),
				array(
					'id'      => seed_social_get_option_id( 'facebook_text' ),
					'title'   => esc_html__( '', 'seed-social' ),
					'type'    => 'text',
					'default' => 'Facebook'
				),
				array(
					'id'      => seed_social_get_option_id( 'is_twitter' ),
					'title'   => esc_html__( 'Twitter', 'seed-social' ),
					'type'    => 'checkbox',
					'options' => array( 'on' => esc_html__( '', 'seed-social' ) ),
					'default' => array( 'on' )
				),
				array(
					'id'      => seed_social_get_option_id( 'twitter_text' ),
					'title'   => esc_html__( '', 'seed-social' ),
					'type'    => 'text',
					'default' => 'Twitter'
				),
				array(
					'id'      => seed_social_get_option_id( 'is_line' ),
					'title'   => esc_html__( 'Line', 'seed-social' ),
					'type'    => 'checkbox',
					'options' => array( 'on' => esc_html__( '', 'seed-social' ) ),
					'default' => array( 'on' )
				),
				array(
					'id'      => seed_social_get_option_id( 'line_text' ),
					'title'   => esc_html__( '', 'seed-social' ),
					'type'    => 'text',
					'default' => 'Line'
				),
				array(
					'id'      => seed_social_get_option_id( 'is_open_graph' ),
					'title'   => esc_html__( 'Share featured image?', 'seed-social' ),
					'desc'    => esc_html__( 'This will add Open Graph meta tags. Do not check this if SEO plugin is installed.', 'seed-social' ),
					'type'    => 'checkbox',
					'options' => array( 'on' => esc_html__( 'Yes', 'seed-social' ) )
				),
			),
		),
	);

	if( ! is_woo_activated() ) {
		unset( $settings [0]['options'][2] );
	}
	return $settings;

}

add_action( 'admin_init', 'seed_social_register_plugin_settings' );

/**
 * Register plugin settings
 *
 * This function dynamically registers plugin settings.
 *
 * @since 0.10.0
 * @see   seed_social_get_settings
 * @return void
 */
function seed_social_register_plugin_settings() {

	$settings = seed_social_get_settings();

	foreach ( $settings as $key => $section ) {

		/* We add the sections and then loop through the corresponding options */
		add_settings_section( $section['id'], $section['title'], false, 'seed-social' );

		/* Get the options now */
		foreach ( $section['options'] as $k => $option ) {

			$field_args = array(
				'name'    => $option['id'],
				'title'   => $option['title'],
				'type'    => $option['type'],
				'desc'    => isset( $option['desc'] ) ? $option['desc'] : '',
				'default' => isset( $option['default'] ) ? $option['default'] : '',
				'options' => isset( $option['options'] ) ? $option['options'] : array(),
				'group'   => 'seed-social'
			);

			register_setting( 'seed-social', $option['id'] );
			add_settings_field( $option['id'], $option['title'], 'seed_social_output_settings_field', 'seed-social', $section['id'], $field_args );

		}
	}

}

/**
 * Generate the option field output
 *
 * @since 0.10.0
 *
 * @param array $option The current option array
 *
 * @return void
 */
function seed_social_get_post_types_option_list(  ) {
	$list = array();

	$list[ 'post' ] = 'Posts';
	$list[ 'page' ] = 'Pages';

	foreach ( get_post_types( array( '_builtin' => false, 'public' => true ), 'objects') as $_slug => $_post_type ) {
		if( ( ( ! is_woo_activated() ) || ( $_post_type->name != 'product' ) ) &&
			( $_post_type->name != 'seed_confirm_log' ) )
			$list[ $_slug ] = $_post_type->labels->name ;
	}

	return $list;
}

/**
 * Generate the option field output
 *
 * @since 0.10.0
 *
 * @param array $option The current option array
 *
 * @return void
 */
function seed_social_output_settings_field( $option ) {

	$current    = get_option( $option['name'], $option['default'] );
	$field_type = $option['type'];
	$id         = str_replace( '_', '-', $option['name'] );

	switch( $field_type ):

		case 'text': ?>
		<input type="text" name="<?php echo $option['name']; ?>" id="<?php echo $id; ?>" value="<?php echo $current; ?>" class="regular-text" />
		<?php break;

		case 'checkbox':
		foreach( $option['options'] as $val => $choice ):

			if ( count( $option['options'] ) > 1 ) {
				$id = "{$id}_{$val}";
			}

			$selected = is_array( $current ) && in_array( $val, $current ) ? 'checked="checked"' : '';  
			?>
			<label for="<?php echo $id; ?>">
				<input type="checkbox" name="<?php echo $option['name']; ?>[]" value="<?php echo $val; ?>" id="<?php echo $id; ?>" <?php echo $selected; ?> />
				<?php echo $choice; ?>
			</label>
			<?php 
		endforeach;
		break;

		case 'dropdown': ?>
		<label for="<?php echo $option['name']; ?>">
			<select name="<?php echo $option['name']; ?>" id="<?php echo $id; ?>">
				<?php 
				foreach( $option['options'] as $val => $choice ):
					if( $val == $current ) {
						$selected = 'selected="selected"';
					}
					else {
						$selected = ''; ?><option value="<?php echo $val; ?>" <?php echo $selected; ?>><?php echo $choice; ?></option><?php 
					}
				endforeach; 
				?>
			</select>
		</label>
		<?php break;

		case 'textarea':
		if( !$current && isset($option['std']) ) { $current = $option['std']; } ?>
		<textarea name="<?php echo $option['name']; ?>" id="<?php echo $id; ?>" rows="8" cols="70"><?php echo $current; ?></textarea>
		<?php break;

		case 'textarea_code':
		if( !$current && isset($option['std']) ) { $current = $option['std']; } ?>
		<textarea name="<?php echo $option['name']; ?>" id="<?php echo $id; ?>" rows="4" cols="60" class="code" readonly><?php echo $current; ?></textarea>
		<?php break;

	endswitch;

	if ( isset( $option['desc'] ) && $option['desc'] != '' ) {
		echo wp_kses_post( sprintf( '<p class="description">%1$s</p>', $option['desc'] ) );
	};

}

function seed_social_box()
{

	if( is_woo_activated() ) {
		$screens =  array('post', 'page', 'product');
	} else {
		$screens = array('post', 'page');
	}
	foreach ($screens as $screen) {
		add_meta_box(
			'seed_social_box',/* Unique ID */
			'Seed Social',  /* Box title */
			'seed_social_custom_box_html',  /* Content callback, must be of type callable */
			$screen, /* Post type */
			'advanced',
			'low'
		);
	}
}
add_action('add_meta_boxes', 'seed_social_box');

function seed_social_custom_box_html($post)
{
	$value = get_post_meta(get_the_ID(), '_seed_social_disable', true);
	?>
	<input type="checkbox" name="seed_social_disable" id="seed_social_disable" class="postbox" <?php checked( $value, 'on' ); ?> />
	<label for="seed_social_disable">Disable social sharing button</label>
	<?php
}

function seed_social_save_postdata($post_id)
{
	if (array_key_exists('seed_social_disable', $_POST)) {
		update_post_meta(
			$post_id,
			'_seed_social_disable',
			$_POST['seed_social_disable']
		);
	} else {
		delete_post_meta(
			$post_id,
			'_seed_social_disable'    		
		);
	}
}
add_action('save_post', 'seed_social_save_postdata');

load_plugin_textdomain('seed-social', false, basename( dirname( __FILE__ ) ) . '/languages' );