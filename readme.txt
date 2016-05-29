=== Seed Social ===
Contributors: SeedThemes
Donate link: https://seedthemes.com/
Tags: social, facebook, twitter, google plus, line, share
Requires at least: 4.0.1
Tested up to: 4.5.2
Stable tag: 1.1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Minimal Social Sharing WordPress Plugin (Just Facebook, Twitter, Google Plus and Line)

== Description ==

Just upload this plugin to WordPress and activate it. The plugin will add social sharing buttons under post content.

You can enable each social network via Settings -> Seed Social.


== Installation ==


1. Upload the plugin files to the `/wp-content/plugins/seed-social` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress

There is no settings right now.


== Frequently Asked Questions ==

= How to disable some social networks =

* Go to Settings -> Seed Social.

= How to add buttons manually in template files? =

1) Remove buttons by putting this code to functions.php

`remove_filter('the_content', 'seed_social_auto', 15);`

2) Add this code after "The Loop" in template files, such as page.php, single.php or archive.php.

`<?php if(function_exists('seed_social')) {seed_social();} ?>`

== Screenshots ==

1. Desktop Version
2. Mobile Version

== Changelog ==

= 1.1.0 =
* Add options page (Settings -> Seed Social).

= 1.0.0 =
* Change to new FB Share URL
* Increase the priority to avoid conflct with Page Bullder by SiteOrigin

= 0.9.2 =
* First public version.


== Upgrade Notice ==

= 1.1.0 =
Add options page (Settings -> Seed Social).

= 1.0.0 =
Change to new FB Share URL and support Page Bullder by SiteOrigin

= 0.9.2 =
Just start basic functions.