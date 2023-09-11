<?php

/*
Plugin Name: Seed Social
Plugin URI: https://github.com/SeedWebs/seed-social
Description: Minimal Social Sharing WordPress Plugin
Version: 3.0.0-beta
Author: Seed Webs
Author URI: https://seedwebs.com
License: GPL2
Text Domain: seed-social
*/

/*
Copyright 2016-2022 Seed Webs  (email : support@seedwebs.com)

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

if (!class_exists('Seed_Social')) {
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

if (class_exists('Seed_Social')) {
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('Seed_Social', 'activate'));
    register_deactivation_hook(__FILE__, array('Seed_Social', 'deactivate'));

    // instantiate the plugin class
    $seed_social = new Seed_Social();
}

add_action('wp_head', 'seed_social_fb_og');

function seed_social_fb_og()
{
    $is_open_graph = get_option('seed_social_is_open_graph');

    if ($is_open_graph) {
        global $post;

        /* FB Open Graph */

        $fb_og = '';

        $large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');

        $featured_image = '';

        if (! empty($large_image_url[0])) {
            $featured_image = esc_url($large_image_url[0]);
        }

        $fb_og .= '<meta property="og:url" content="' . home_url('/') . $post->post_name . '" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="' . htmlspecialchars($post->post_title) . '" />
		<meta property="og:description" content="' . htmlspecialchars($post->post_excerpt) . '" />
		<meta property="og:image" content="' . $featured_image . '" />';

        echo $fb_og;
    }
}

add_action('wp_enqueue_scripts', 'seed_social_scripts');

function seed_social_scripts()
{
    if (!is_admin()) {
        wp_enqueue_script('seed-social', plugin_dir_url(__FILE__) . 'script.js', array(), '2023.04', true);
        wp_enqueue_style('seed-social', plugin_dir_url(__FILE__) . 'style.css', array(), '2023.04');
    }
}

function seed_social($echo = true, $css_class = '')
{

    $facebook_icon = '<svg role="img" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="currentColor"><title>Facebook icon</title><path d="M23.9981 11.9991C23.9981 5.37216 18.626 0 11.9991 0C5.37216 0 0 5.37216 0 11.9991C0 17.9882 4.38789 22.9522 10.1242 23.8524V15.4676H7.07758V11.9991H10.1242V9.35553C10.1242 6.34826 11.9156 4.68714 14.6564 4.68714C15.9692 4.68714 17.3424 4.92149 17.3424 4.92149V7.87439H15.8294C14.3388 7.87439 13.8739 8.79933 13.8739 9.74824V11.9991H17.2018L16.6698 15.4676H13.8739V23.8524C19.6103 22.9522 23.9981 17.9882 23.9981 11.9991Z"/></svg>';

    $twitter_icon = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.97222 1C2.782 1 1 2.782 1 4.97222V19.0278C1 21.218 2.782 23 4.97222 23H19.0278C21.218 23 23 21.218 23 19.0278V4.97222C23 2.782 21.218 1 19.0278 1H4.97222ZM5.78385 5.88889H9.71787L12.6863 10.1321L16.3614 5.88889H17.5836L13.2377 10.921L18.2687 18.1111H14.3347L11.0655 13.4371L7.02876 18.1111H5.78027L10.5116 12.6457L5.78385 5.88889ZM7.68283 6.92492L14.8037 17.075H16.3697L9.2488 6.92492H7.68283Z" fill="currentColor"/></svg>';

    $line_icon = '<svg role="img" width="24" height="24" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>LINE icon</title><path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63h2.386c.346 0 .627.285.627.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63.346 0 .628.285.628.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.63 0 .344-.282.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/></svg>';

    $copy_icon = '<svg role="img" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.5 1C5.84375 1 4.5 2.34375 4.5 4V5H4C2.34635 5 1 6.34635 1 8V20C1 21.6536 2.34635 23 4 23H16C17.6536 23 19 21.6536 19 20V19.5H20C21.6563 19.5 23 18.1563 23 16.5V4C23 2.34375 21.6563 1 20 1H7.5ZM7.5 3H20C20.5495 3 21 3.45052 21 4V16.5C21 17.0495 20.5495 17.5 20 17.5H19V8C19 6.34635 17.6536 5 16 5H6.5V4C6.5 3.45052 6.95052 3 7.5 3ZM4 7H16C16.5521 7 17 7.44792 17 8V20C17 20.5521 16.5521 21 16 21H4C3.44792 21 3 20.5521 3 20V8C3 7.44792 3.44792 7 4 7ZM12.1615 8.5C11.3073 8.5 10.4531 8.82813 9.79948 9.48177L8.5 10.776C7.84896 11.4297 7.52604 12.2786 7.52604 13.1406C7.52604 13.9896 7.84896 14.849 8.5 15.5C8.98177 15.9792 9.57552 16.2813 10.1927 16.4063L9.13802 17.4609C8.01302 18.5833 6.42708 17.5729 6.53906 17.4609C5.82031 16.7448 5.82031 15.5807 6.53906 14.8646L6.77083 14.6354C6.59375 14.1693 6.5 13.6693 6.5 13.1432C6.5 13.0156 6.50521 12.8854 6.51563 12.7604C6.47917 12.7943 6.46354 12.8125 6.42969 12.8464L5.47917 13.7995C4.17448 15.1042 4.17448 17.2214 5.47917 18.5208C6.13021 19.1719 6.98177 19.4974 7.83594 19.4974C8.69271 19.4974 9.54687 19.1719 10.1979 18.5234L11.4974 17.224C12.7969 15.9219 12.7969 13.8047 11.4974 12.5026C11.5365 12.4635 10.849 11.8229 9.79948 11.6068L10.8646 10.5391C11.5807 9.82552 12.7448 9.82031 13.4609 10.5391C14.1797 11.2552 14.1797 12.4193 13.4609 13.1354L13.2318 13.3646C13.4063 13.8307 13.5 14.3307 13.5 14.8542C13.5 14.9844 13.4948 15.1146 13.4844 15.2396C13.5208 15.2057 13.526 15.2005 13.5521 15.1719L14.5182 14.2005C15.8255 12.8958 15.8255 10.7813 14.5182 9.47917C13.8698 8.82813 13.0156 8.5 12.1615 8.5ZM9.13542 13.013C9.91667 13.013 10.3984 13.6016 10.4375 13.5625C10.8203 13.9479 10.9922 14.4609 10.9635 14.9661C10.4609 14.9948 9.95052 14.8203 9.5651 14.4349C9.17448 14.0469 9.0026 13.526 9.03646 13.0182C9.07031 13.0156 9.10417 13.0104 9.13542 13.013Z" fill="currentColor"/></svg>';

    global $post;

    $seed_social_echo =  $share_text = $facebook = $twitter = $line = $copy = $copied_text = '';
    $share_text = get_option('seed_social_share_text', 'Share') ;
    $copied_text = get_option('seed_social_copied_text', 'Link Copied!') ;
    if ($share_text) {
        $share_text = '<li class="share-text">' . $share_text . '</li>';
    }
    $socials = get_option('seed_social_socials', ['facebook', 'twitter', 'line', 'copy']);

    if ($socials) {
        $url = urlencode(get_the_permalink($post->ID));
        $title = urlencode($post->post_title);


        /* Facebook Button */
        if (in_array('facebook', $socials)) {
            $facebook = '<li><a href="https://www.facebook.com/share.php?u=' . $url . '" data-href="https://www.facebook.com/share.php?u=' . $url . '" class="ss-facebook"  aria-label="Facebook Share">' . $facebook_icon . '</a></li>';
        }

        /* Twitter Button */
        if (in_array('twitter', $socials)) {
            $twitter = '<li><a href="https://twitter.com/share?url=' . $url . '&text=' . $title . '" data-href="https://twitter.com/share?url=' . $url . '&text=' . $title . '" class="ss-twitter" aria-label="Tweet">' . $twitter_icon . '</a></li>';
        }

        /* Line */
        if (in_array('line', $socials)) {
            $line = '<li><a href="https://lineit.line.me/share/ui?url=' . $url . '" data-href="https://lineit.line.me/share/ui?url=' . $url . '" class="ss-line" aria-label="Send to Line">' . $line_icon . '</a></li>';
        }

        /* Copy */
        if (in_array('copy', $socials)) {
            $copy = '<li><a href="#" class="ss-copy" data-link="' . get_permalink($post->ID) . '" aria-label="Copy URL">' . $copy_icon . '<span class="ss-copied hide">' . $copied_text . '</span></a></li>';
        }

        $seed_social_echo .= '<ul data-list="seed-social" class="seed-social ' . $css_class . '">';
        $seed_social_echo .= $share_text . $facebook . $twitter . $line . $copy;
        $seed_social_echo .= '</ul>';
    }

    if ($echo) {
        echo $seed_social_echo;
    }

    return $seed_social_echo;
}

/**
 * Check if WooCommerce plugin is installed and activated.
 * @return bool
 */
if (! function_exists('is_woo_activated')) {
    function is_woo_activated()
    {
        if (class_exists('woocommerce')) {
            return true;
        } else {
            return false;
        }
    }
}

function seed_social_auto($content)
{
    $is_disable = get_post_meta(get_the_ID(), '_seed_social_disable', true);

    if ($is_disable != 'on') {
        $positions = get_option('seed_social_positions', array( 'bottom' ));
        $post_types = get_option('seed_social_post_types', array( 'post', 'page' ));

        if (! empty($positions) && ! empty($post_types) && in_array(get_post_type(), $post_types) && ! is_front_page() && is_singular()) {
            if ($GLOBALS['post']->ID == get_the_ID()) {
                if (in_array('top', $positions)) {
                    $content = seed_social(false, '-top') . $content;
                }

                if (in_array('bottom', $positions)) {
                    $content .= seed_social(false, '-bottom');
                }
            }
        }
    }

    return $content;
}

add_filter('the_content', 'seed_social_auto', 15);

function seed_social_bbpress_auto_bottom()
{
    $is_disable = get_post_meta(get_the_ID(), '_seed_social_disable', true);

    if ($is_disable != 'on') {
        $positions = get_option('seed_social_positions', array( 'bottom' ));
        $post_types = get_option('seed_social_post_types', array( 'post', 'page' ));

        if (! empty($positions) && in_array(get_post_type(), $post_types) && ! is_front_page() && is_singular()) {
            if ($GLOBALS['post']->ID == get_the_ID()) {
                if (in_array('bottom', $positions)) {
                    seed_social(true, '-bbpress-bottom');
                }
            }
        }
    }
}

add_action('bbp_template_after_single_topic', 'seed_social_bbpress_auto_bottom', 15, 0);

function seed_social_bbpress_auto_top()
{
    $is_disable = get_post_meta(get_the_ID(), '_seed_social_disable', true);

    if ($is_disable != 'on') {
        $positions = get_option('seed_social_positions', array( 'bottom' ));
        $post_types = get_option('seed_social_post_types', array( 'post', 'page' ));

        if (! empty($positions) && in_array(get_post_type(), $post_types) && ! is_front_page() && is_singular()) {
            if ($GLOBALS['post']->ID == get_the_ID()) {
                if (in_array('top', $positions)) {
                    seed_social(true, '-bbpress-top');
                }
            }
        }
    }
}

add_action('bbp_template_before_single_topic', 'seed_social_bbpress_auto_top', 15, 0);

function seed_social_woocommerce_after_product_content()
{
    $is_disable = get_post_meta(get_the_ID(), '_seed_social_disable', true);

    if ($is_disable != 'on') {
        $woocommerce = get_option('seed_social_woocommerce', array( 'after-summary' ));

        if (! empty($woocommerce)) {
            if (in_array('after-product-content', $woocommerce)) {
                seed_social(true, '-product-content');
            }
        }
    }
}

add_action('woocommerce_after_single_product', 'seed_social_woocommerce_after_product_content', 10);

function seed_social_woocommerce_after_summary()
{
    $is_disable = get_post_meta(get_the_ID(), '_seed_social_disable', true);

    if ($is_disable != 'on') {
        $woocommerce = get_option('seed_social_woocommerce', array( 'after-summary' ));
        if (! empty($woocommerce)) {
            if (in_array('after-summary', $woocommerce)) {
                seed_social(true, '-product-summary');
            }
        }
    }
}

add_action('woocommerce_share', 'seed_social_woocommerce_after_summary', 10);

/* [seed_social] */
function seed_social_shortcode($atts)
{
    return seed_social(false, '-shortcode');
}

add_shortcode('seed_social', 'seed_social_shortcode');

function seed_social_setup_menu()
{
    $seed_social_page = add_submenu_page('options-general.php', __('Seed Social', 'seed-social'), __('Seed Social', 'seed-social'), 'manage_options', 'seed-social', 'seed_social_init');
}

add_action('admin_menu', 'seed_social_setup_menu');

function seed_social_init()
{
    ?>
<style>
	form label {
		display: inline-block;
		min-width: 60px;
		margin-right: 10px;
	}

	.form-table th,
	.form-table td {
		padding: 0;
		line-height: 4em;
	}

	.form-table td p.description {
		margin-top: -10px;
	}
</style>
<div class="wrap">
	<div class="icon32" id="icon-options-general"></div>
	<h2><?php esc_html_e('Seed Social', 'seed-social'); ?>
	</h2>
	<p>
		<?php printf(wp_kses(__('For more information, please visit <a href="%1s" target="_blank">FAQ on WordPress.org</a>.', 'seed-social'), array( 'a' => array( 'href' => array(), 'target' => array() ) )), esc_url('https://wordpress.org/plugins/seed-social/#faq')); ?>
	</p>
	<form
		action="<?php echo admin_url('options.php'); ?>"
		method="post" id="seed-social-form">
		<?php
                settings_fields('seed-social');
    do_settings_sections('seed-social');
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
function seed_social_get_option_id($name)
{
    return 'seed_social_' . $name;
}

function seed_social_get_settings()
{

    $settings = array(
        array(
            'id'      => 'seed_social_settings',
            'title'   => __('Social Sharing Buttons', 'seed-social'),
            'options' => array(
                array(
                    'id'      => seed_social_get_option_id('post_types'),
                    'title'   => esc_html__('Post Type to show:', 'seed-social'),
                    'type'    => 'checkbox',
                    'options' => seed_social_get_post_types_option_list(),
                    'default' => array( 'post', 'page' )
                ),
                array(
                    'id'      => seed_social_get_option_id('positions'),
                    'title'   => esc_html__('Position to show:', 'seed-social'),
                    'type'    => 'checkbox',
                    'options' => array(
                        'top' => esc_html__('Top', 'seed-social') ,
                        'bottom' => esc_html__('Bottom', 'seed-social')
                    ),
                    'default' => array( 'bottom' )
                ),
                array(
                    'id'      => seed_social_get_option_id('woocommerce'),
                    'title'   => esc_html__('WooCommerce', 'seed-social'),
                    'type'    => 'checkbox',
                    'options' => array(
                        'after-summary' => esc_html__('Show after summary', 'seed-social') ,
                        'after-product-content' => esc_html__('Show after product content', 'seed-social')
                    ),
                    'default' => array( 'after-product-content' )
                ),

                array(
                    'id'      => seed_social_get_option_id('share_text'),
                    'title'   => esc_html__('Share Text', 'seed-social'),
                    'type'    => 'text',
                    'default' => esc_html__('Share', 'seed-social'),
                ),
                array(
                    'id'      => seed_social_get_option_id('socials'),
                    'title'   => esc_html__('Social', 'seed-social'),
                    'type'    => 'checkbox',
                    'options' => array(
                        'facebook'   => esc_html__('Facebook', 'seed-social') ,
                        'twitter'    => esc_html__('Twitter', 'seed-social'),
                        'line'       => esc_html__('Line', 'seed-social'),
                        'copy'       => esc_html__('Copy Link', 'seed-social'),
                        ),
                    'default' => array( 'facebook', 'twitter', 'line', 'copy' ),
                ),
                array(
                    'id'      => seed_social_get_option_id('copied_text'),
                    'title'   => esc_html__('Copied Text', 'seed-social'),
                    'type'    => 'text',
                    'default' => esc_html__('Link Copied!', 'seed-social')
                ),
                array(
                    'id'      => seed_social_get_option_id('is_open_graph'),
                    'title'   => esc_html__('Share featured image?', 'seed-social'),
                    'desc'    => esc_html__('This will add Open Graph meta tags. Do not check this if SEO plugin is installed.', 'seed-social'),
                    'type'    => 'checkbox',
                    'options' => array( 'on' => esc_html__('Yes', 'seed-social') )
                ),
            ),
        ),
    );

    if (!is_woo_activated()) {
        unset($settings [0]['options'][2]);
    }
    return $settings;
}

/**
 * Register plugin settings
 *
 * This function dynamically registers plugin settings.
 *
 * @since 2.0.5
 * @see   seed_social_get_settings
 * @return void
 */

function seed_social_register_plugin_settings()
{

    $settings = seed_social_get_settings();

    foreach ($settings as $key => $section) {
        /* We add the sections and then loop through the corresponding options */
        add_settings_section($section['id'], $section['title'], false, 'seed-social');

        /* Get the options now */
        foreach ($section['options'] as $k => $option) {
            $field_args = array(
                'name'    => $option['id'],
                'title'   => $option['title'],
                'type'    => $option['type'],
                'desc'    => isset($option['desc']) ? $option['desc'] : '',
                'default' => isset($option['default']) ? $option['default'] : '',
                'options' => isset($option['options']) ? $option['options'] : array(),
                'group'   => 'seed-social'
            );

            if (
                $option['id'] == seed_social_get_option_id('share_text') ||
                $option['id'] == seed_social_get_option_id('copied_text')
            ) {
                $args = array(
                    'type' => 'string',
                    'sanitize_callback' => 'sanitize_this_value',
                    'default' => '',
                );
            } else {
                $args = array(
                    'type' => 'boolean',
                    'default' => true,
                );
            }

            register_setting('seed-social', $option['id'], $args);
            add_settings_field($option['id'], $option['title'], 'seed_social_output_settings_field', 'seed-social', $section['id'], $field_args);
        }
    }
}
add_action('admin_init', 'seed_social_register_plugin_settings');

/**
 * Remove all special characters but allow Thai characters and ? ! - space
 *
 * @since 3.0.0
 */
function sanitize_this_value($value)
{
    $value = preg_replace('/[^ก-๙a-zA-Z0-9\?\!\-\s]/u', '', $value);
    return $value;
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
function seed_social_get_post_types_option_list()
{
    $list = array();

    $list[ 'post' ] = 'Posts';
    $list[ 'page' ] = 'Pages';

    foreach (get_post_types(array( '_builtin' => false, 'public' => true ), 'objects') as $_slug => $_post_type) {
        if (
            ((! is_woo_activated()) || ($_post_type->name != 'product')) &&
            ($_post_type->name != 'seed_confirm_log')
        ) {
            $list[ $_slug ] = $_post_type->labels->name ;
        }
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
function seed_social_output_settings_field($option)
{

    $current    = get_option($option['name'], $option['default']);
    $field_type = $option['type'];
    $id         = str_replace('_', '-', $option['name']);

    switch ($field_type) :
        case 'text':
            ?><input type="text"
	name="<?php echo $option['name']; ?>"
	id="<?php echo $id; ?>"
	value="<?php echo sanitize_text_field($current); ?>"
	class="regular-text" />
<?php
            break;

        case 'checkbox':
            foreach ($option['options'] as $val => $choice) :
                if (count($option['options']) > 1) {
                    $id = "{$id}_{$val}";
                }

                $selected = is_array($current) && in_array($val, $current) ? 'checked="checked"' : '';
                ?><label
	for="<?php echo $id; ?>"><input type="checkbox"
		name="<?php echo $option['name']; ?>[]"
		value="<?php echo $val; ?>"
		id="<?php echo $id; ?>"
		<?php echo $selected; ?> />
	<?php echo $choice; ?></label><?php
            endforeach;
            break;

        case 'dropdown':
            ?>
<label for="<?php echo $option['name']; ?>">
	<select name="<?php echo $option['name']; ?>"
		id="<?php echo $id; ?>">
		<?php
            foreach ($option['options'] as $val => $choice) :
                if ($val == $current) {
                    $selected = 'selected="selected"';
                } else {
                    $selected = ''; ?>
		<option value="<?php echo $val; ?>" <?php echo $selected; ?>><?php echo $choice; ?>
		</option><?php
                }
            endforeach;
            ?>
	</select>
</label>
<?php
            break;

        case 'textarea':
            if (!$current && isset($option['std'])) {
                $current = $option['std'];
            } ?>
<textarea name="<?php echo $option['name']; ?>"
	id="<?php echo $id; ?>" rows="8"
	cols="70"><?php echo $current; ?></textarea>
<?php
            break;

        case 'textarea_code':
            if (!$current && isset($option['std'])) {
                $current = $option['std'];
            } ?>
<textarea name="<?php echo $option['name']; ?>"
	id="<?php echo $id; ?>" rows="4" cols="60" class="code"
	readonly><?php echo $current; ?></textarea>
<?php
            break;
    endswitch;

    if (isset($option['desc']) && $option['desc'] != '') {
        echo wp_kses_post(sprintf('<p class="description">%1$s</p>', $option['desc']));
    };
}

function seed_social_box()
{

    if (is_woo_activated()) {
        $screens =  array('post', 'page', 'product');
    } else {
        $screens = array('post', 'page');
    }
    foreach ($screens as $screen) {
        add_meta_box(
            'seed_social_box', /* Unique ID */
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
<input type="checkbox" name="seed_social_disable" id="seed_social_disable" class="postbox"
	<?php checked($value, 'on'); ?> />
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

load_plugin_textdomain('seed-social', false, basename(dirname(__FILE__)) . '/languages');
?>