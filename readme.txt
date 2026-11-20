=== Seed Social ===
Contributors: seedwebs
Donate link: https://seedwebs.com/
Tags: social, facebook, twitter, line, share
Requires at least: 4.9
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 2.0.7
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Minimal Social Sharing WordPress Plugin (Just Facebook, X and LINE)

== Description ==

Just upload this plugin to WordPress and activate it. The plugin will add social sharing buttons under post content.

You can enable each social network and change settings via Settings → Seed Social.

Official development of Seed Social is on GitHub, with official stable releases published on WordPress.org. The GitHub repo can be found at https://github.com/SeedWebs/seed-social. Please use the Support tab for potential bugs, issues, or enhancement ideas.

== External services ==

Seed Social does not send data from your server to any other service, and it does not contact any service when a page loads.

The share buttons are links. Nothing is sent to Facebook, X or LINE until a visitor clicks a button. The click opens that service's share page and sends it the address of the page being shared. X also receives the post title. On mobile devices, the LINE button sends the page title and the full page address. Each service also receives the visitor's IP address, browser information and any cookies it has set for that visitor.

* Facebook share dialog (https://www.facebook.com/share.php), provided by Meta Platforms, Inc.: [Terms of Service](https://www.facebook.com/terms.php), [Privacy Policy](https://www.facebook.com/privacy/policy/).
* X share page (https://twitter.com/share), provided by X Corp.: [Terms of Service](https://x.com/en/tos), [Privacy Policy](https://x.com/en/privacy).
* LINE share pages (https://lineit.line.me/share/ui and https://line.me/R/msg/text/), provided by LY Corporation: [Terms of Use](https://terms.line.me/line_terms?lang=en), [Privacy Policy](https://www.lycorp.co.jp/en/company/privacypolicy/).


== Installation ==


1. Upload the plugin files to the `/wp-content/plugins/seed-social` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress


== Frequently Asked Questions ==

= Where is the Facebook share count? =

* Seed Social no longer shows the Facebook share count (removed in 2.0.7). Earlier versions needed your Facebook App Secret for it and exposed that secret in your site's HTML.
* If you entered a Facebook App ID and App Secret, reset the App Secret of that app in Meta for Developers. Then clear both fields in Settings → Seed Social and save.

= How to disable some social networks =

* Go to Settings → Seed Social.

= Image not shown on social network / facebook post? =

* Go to Settings → Seed Social and check "Share featured image?". This adds Open Graph tags. Or use an SEO plugin such as Yoast SEO or All in One SEO.
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
.seed-social svg {
    width: 20px;
    height: 20px;
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

= 2.0.7 =
* Date: 20 Nov 2026
* Security: Versions 2.0.0 to 2.0.6 printed the Facebook App ID and App Secret in every page (only base64-encoded) and sent them from visitors' browsers to the Facebook Graph API. This version no longer does. If you entered an App Secret, reset it in Meta for Developers, then clear the old values in Settings → Seed Social.
* Security: Escape button labels, settings and Open Graph tags on output.
* Security: Saving "Disable social sharing button" now checks a nonce and the user's permission.
* Security: Open Graph tags no longer show the excerpt of password-protected posts.
* Security: The share popup opens only Facebook, X and LINE share addresses.
* Removed: Facebook share count. The Facebook button still shares as before.
* Fix: Quick Edit, Bulk Edit, scheduled publishing and the REST API no longer clear "Disable social sharing button". Please check posts where you had turned the buttons off.
* Fix: PHP 8 fatal error on bbPress topics when no post type is selected.
* Fix: PHP warnings from Open Graph tags on 404 and empty search pages.
* Fix: seed_social() and [seed_social] show nothing when there is no post, instead of buttons that share an empty address.
* Fix: Button labels accept spaces and non-English text such as Thai again.
* Fix: The second set of buttons (Top and Bottom) opens the share popup too.
* Fix: The LINE button on mobile uses https.
* Fix: Button labels no longer appear inside automatic excerpts.
* Fix: The "Disable social sharing button" checkbox is visible in the block editor.
* Fix: The WooCommerce setting shows the position the shop really uses (Show after summary).
* Tweak: CSS and JS versions follow the plugin version, so caches refresh after updates.
* Tweak: Removed unused files (qrcode.js, qrcode.min.js, close.html) and the old translation template.
* Tweak: Removed the global functions facebook_key_encrypt() and sanitize_this_value() (now seed_social_sanitize_value()). is_woo_activated() is kept.
* Tweak: Requires WordPress 4.9 and PHP 7.4. Tested up to WordPress 7.1.
* Tweak: License is GPLv2 or later in all files.

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

= 2.0.7 =
Security release. Versions 2.0.0 to 2.0.6 exposed the Facebook App Secret in page HTML. If you entered one, reset it in Meta for Developers. The Facebook share count is removed.

= 1.3.0 =
* New: Support BBPress
* New: Change buttons CSS, easier to modify.
* New: Example CSS in readme.
* Tweak: Settings description.
* Fix: Position setting disappeared if WooCommerce is not activate.