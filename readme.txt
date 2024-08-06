=== Seed Social ===
Contributors: seedwebs
Donate link: https://seedwebs.com/
Tags: social, facebook, twitter, line, share
Requires at least: 4.5
Tested up to: 6.6
Requires PHP: 5.3
Stable tag: 2.0.6
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Minimal Social Sharing WordPress Plugin (Just Facebook, Twitter and Line)

== Description ==

Just upload this plugin to WordPress and activate it. The plugin will add social sharing buttons under post content.

You can enable each social network and change settings via Settings → Seed Social.

Official development of Seed Social is on GitHub, with official stable releases published on WordPress.org. The GitHub repo can be found at https://github.com/SeedThemes/seed-social. Please use the Support tab for potential bugs, issues, or enhancement ideas.


== Installation ==


1. Upload the plugin files to the `/wp-content/plugins/seed-social` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress


== Frequently Asked Questions ==

= How to disable some social networks =

* Go to Settings → Seed Social.

= Image not shown on social network / facebook post? =

* Go to Settings → Seed Social and enable Open Graph. Or use Yoast SEO / All in one SEO plugin.
* After setup, go to https://developers.facebook.com/tools/debug/ put your link and click Scrape Again button.

= How to add buttons manually in template files? =

* Add `seed_social()` function after "The Loop" in template files, such as page.php, single.php or archive.php.

```
if(function_exists('seed_social')) {seed_social();}
```

= How to add buttons manually in content? =

* Add this short code in the content box (Visual Editor or WYSIWYG Editor.)

```
[seed_social]
```

= Can you suggest CSS to align buttons center? =

* You can add this CSS code in Appearance → Customize → Additional CSS

```
.seed-social {
    text-align: center;
}
```
= Can you suggest CSS to make buttons rounded? =

* You can add this CSS code in Appearance → Customize → Additional CSS

```
.seed-social a {
    min-width: 40px;
    width: 40px;
    height: 40px;
    border-radius: 50%;
}
.seed-social i {
    width: 20px;
    height: 20px;
    background-size: 100%;
}
.seed-social span.text,
.seed-social span.count {
    display: none;
}
```

== Screenshots ==

1. Desktop Version
2. Mobile Version
3. Settings

== Changelog ==

= 2.0.6 =
* Date: 15 May 2024
* Tweak: Change Twitter to X icon

= 2.0.5 =
* Date: 21 Feb 2023
* Fix: Unable to save button text.
* Fix: Fix "Facebook API" to be able to get count shared to show.

= 2.0.4 =
* Date: 9 Nov 2022
* Fix: Sanitize all settings. Security issues when using unfiltered_html on multisite.

= 2.0.3 =
* Date: 7 Nov 2022
* Fix: Sanitize Settings. Security issues when using unfiltered_html on multisite.

= 2.0.2 =
* Date: 21 Feb 2021
* Tweak: Inline SVG instead of CSS. Make it easier to override style.
* Fix: Remove url parameters for correct shared count

= 2.0.1 =
* Date: 18 Nov 2020
* Tweak: Rename JS and CSS files. Make it easy for people who can't clear cache.

= 2.0.0 =
* Date: 13 Nov 2020
* New: Rewrite JS in Vanilla JS. No jQuery needed.
* New: Rewrite CSS, now using SVG base64 CSS background. No icon fonts loaded.
* New: Support Facebook Graph API v9.0. Require App ID and App Secret.

= 1.4.0 =
* New: Facebook API v2.12, will be available until May 1, 2020. (If using v3.2, our plugin need App ID).
* Tweak: Remove Google Plus (Shut down on April 2, 2019).
* Tweak: Align center on mobile.

= 1.3.5 =
* Fix: Facebook Deprecated Sharer URL.

= 1.3.4 =
* Fix: "Google Plus" Misspelled.

= 1.3.3 =
* Fix: Empty button text.

= 1.3.2 =
* Fix: Support PHP5.3

= 1.3.1 =
* New: Buttons can be disabled on any Post/Page.
* New: Button text can be changed.
* Tweak: Buttons CSS on bbPress topic.

= 1.3.0 =
* New: Support bbPress topic.
* New: Change buttons CSS, easier to modify.
* New: Example CSS in readme.
* Tweak: Settings description.
* Fix: Position setting disappeared if WooCommerce is not activate.
* Fix: Support PHP7.
* Fix: Some mobile browsers don't close properly.

= 1.2.9 =
* New: Add CSS Classes for button positions (-top, -bottom, -product-summary, -product-content).
* Tweak: Settings description.
* Fix: Conflict with Flatsome theme.
* Fix: Wrong WooCommerce position setting names.

= 1.2.8 =
* New: Woocommerce positions.
* Tweak: remove Woocommerce and Seed Confirm post types.

= 1.2.7 =
* New: Google Plus share count.

= 1.2.6 =
* Fix: Close window after shared on Facebook (Mobile Chrome).

= 1.2.6 =
* New: hide on some WooCommerce pages by default. (Cart, Checkout, Account pages.)
* Fix: Facebook has more space than others. Now we can use inline-block and align-center.

= 1.2.5 =
* Tweak: use post title when share to Line for mobile.
* Tweak: use share + comment in Facebook button.

= 1.2.4 =
* Tweak: use new Facebook Graph API.

= 1.2.3 =
* Fix: use San-Serif font instead of theme font in sharing buttons.

= 1.2.2 =
* New: Positions options.
* New: short code [seed_social].

= 1.2.1 =
* Fix: hide the buttons in archive pages.

= 1.2.0 =
* New: Post Types options.

= 1.1.0 =
* New: options page (Settings → Seed Social).

= 1.0.0 =
* Change to new FB Share URL.
* Increase the priority to avoid conflct with Page Bullder by SiteOrigin.

= 0.9.2 =
* First public version.


== Upgrade Notice ==

= 1.3.0 =
* New: Support BBPress
* New: Change buttons CSS, easier to modify.
* New: Example CSS in readme.
* Tweak: Settings description.
* Fix: Position setting disappeared if WooCommerce is not activate.