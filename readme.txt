=== Seed Social ===
Contributors: SeedThemes
Donate link: http://seedthemes.com/
Tags: social, facebook, twitter, google plus, line, share
Requires at least: 4.0.1
Tested up to: 4.5
Stable tag: 0.9.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Minimal Social Sharing WordPress Plugin (Just Facebook / Twitter / Google Plus and Line)

== Description ==

Just upload this plugin to WordPress and activate it. The plugin will add social sharing buttons under post content.

In this version, Seed Social has no options page yet. If you need to remove any button, just hide it with CSS.


== Installation ==


1. Upload the plugin files to the `/wp-content/plugins/seed-social` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress

There is no settings right now.


== Frequently Asked Questions ==

= How to add buttons manually? =

1) Remove buttons by putting this code to functions.php

`remove_filter('the_content', 'seed_social_auto');`

2) Add this code after "The Loop" in template files, such as page.php, single.php or archive.php.

`<?php if(function_exists('seed_social')) {seed_social();} ?>`

= How to let seed_social add opengraph? =

1) putting this code to functions.php

`add_action('wp_head','seed_social_fb_og');`

== Screenshots ==

1. Desktop Version
2. Mobile Version

== Changelog ==

= 0.9.2 =
* First public version.


== Upgrade Notice ==

= 0.9.2 =
Just start basic functions.