<?php
/*
Plugin Name: Seed Social
Plugin URI: http://seedthemes.github.com/seed-social
Description: A plugin for sharing social
Version: 0.8.1
Author: Seed Themes
Author URI: http://www.seedthemes.com
License: GPL2
*/

/*
Copyright 2016 SeedThemes  (email : info@seedthemes.com)

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
            // register actions
        } // END public function __construct
    
        /**
         * Activate the plugin
         */
        public static function activate()
        {
            // Do nothing
        } // END public static function activate
    
        /**
         * Deactivate the plugin
         */     
        public static function deactivate()
        {
            // Do nothing
        } // END public static function deactivate
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
		global $post;

		// FB Open Graph

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

	add_action( 'wp_enqueue_scripts', 'seed_social_scripts' );

	function seed_social_scripts() {
		if(!is_admin()) {
			wp_enqueue_script( 'seed-social-js', plugins_url( 'seed-social/seed-social.js' ), array('jquery'), '2016-1', true );
			wp_enqueue_style( 'seed-social-css', plugins_url( 'seed-social/seed-social.css' ), array() );
		}
	}

	function seed_social( $echo = true ) {
		global $post;

// 	Share Button	

		$fbshare = '<a href="https://www.facebook.com/share.php?u='.urlencode( get_the_permalink( $post->ID ) ).'"><i class="ss-facebook"></i><span class="text">Facebook</span><span class="count"></span></a>';

// Twitter Button		

		$tweet = '<a href="https://twitter.com/share?url='.urlencode( get_the_permalink( $post->ID ) ).'&text='.urlencode($post->post_title).'"><i class="ss-twitter"></i><span class="text">Twitter</span></a>';

// Google Plus Share

//		$plus_share = '<!-- Place this tag in your head or just before your close body tag. -->
// <script src="https://apis.google.com/js/platform.js" async defer></script>

// <!-- Place this tag where you want the share button to render. -->
// <div class="g-plus" data-action="share" data-annotation="bubble"></div>';

//		echo '<div class="seed-social-plus-share">'.$plus_share.'</div>';

		$gplus = '<a href="https://plus.google.com/share?url='.urlencode( get_the_permalink( $post->ID ) ).'"><i class="ss-google-plus"></i><span class="text">Google+</span></a>';

// Line

		$line_it = '<a href="https://lineit.line.me/share/ui?url='.urlencode( get_the_permalink( $post->ID ) ).'"><i class="ss-line"></i><span class="text">Line</span></a>';

//		echo '<div class="seed-social-line-it">'.$line_it.'</div>';

//		echo '</div>';

		$seed_social_echo = '';

		$seed_social_echo .= '<div class="seed-social">';
		$seed_social_echo .= '<div class="facebook">'.$fbshare.'</div>';
		$seed_social_echo .= '<div class="twitter">'.$tweet.'</div>';
		$seed_social_echo .= '<div class="google-plus">'.$gplus.'</div>';
		$seed_social_echo .= '<div class="line">'.$line_it.'</div>';
		$seed_social_echo .= '</div>';

		if( $echo )
			echo $seed_social_echo;

		return $seed_social_echo;
}

function seed_social_auto( $content ) {
    if( is_single() || is_page() )  {
        if ( $GLOBALS['post']->ID == get_the_ID() ) {
            $content .= seed_social( false );
        }
    }

    return $content;
}
add_filter('the_content', 'seed_social_auto');