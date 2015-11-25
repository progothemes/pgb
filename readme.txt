=== ProGo Base ===
Contributors: ProGo
Tags: custom-colors, custom-header, custom-menu, featured-images, full-width-template, light, post-formats, responsive-layout, theme-options
Requires at least: 4.1
Tested up to: 4.3.1
Stable tag: 4.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==
ProGo Base is WordPress, Underscores, Bootstrap, Theme Hook Alliance, get-out-the-way-lemme-do-it all-in-one "Theme Framework".

Useful as a Base theme, stand-alone, starting point to fork and rename and build on, or a combination of any ideas.

Built by ProGo, a collection of Developers and Designers and Marketers working together to create a pure foundation that we could use, with hopes that others might find it useful as well.

== Installation ==

1. In your admin panel, go to Appearance -> Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's ZIP file. Click Install Now.
3. Click Activate to use your new theme right away.

== Frequently Asked Questions ==



== Change Log ==

### Version 1.1.1
* Fix bug preventing custom page width overrides
* Added additional filters to the custom page width process `'pgb_default_page_width', 'pgb_page_width_class', 'pgb_page_width', 'pgb_page_width_options'`

### Version 1.1.0
* Updated title tag support per https://make.wordpress.org/themes/2015/08/25/title-tag-support-now-required/
* Added theme text domain
* Updated string translation support
* Added .pot file
* Removed `upload-theme.php`

### Version 1.0.2
* Updated navbar customizer layouts

### Version 1.0.1
* Page post titles updated, archive titles added and formatted
* Search Results page titles fixed
* CSS cleaned up and more efficient for navbars
* JS updated to OOP

### Version 1.0.0
* New functions to return specific pages, page arrays, and more
* New validate.js for form validation (beta)
* New admin-side pgb.js
* Login/Logout menu link now part of Menu Customizer
* Updated bootstrap nav-walker
* Updated customizer options and organization for WP 4.3
* Renamed Nav positions for better compatibility
* Page layout with header for each page (moving toward material design)
* Footer updates to include menu position and copyright section
* Page and post titles moved to masthead
* Subtitles for pages
* Renamed files: header to masthead, navtop to navbar

### Version 0.8.0
* Added WooCommerce Support

### Version 0.7.0
* New Login/LogOut menu item and controller class
* New Customizer Multi-Select Controller

### Version 0.6.3
* Added custom breadcrumbs functionality
* Breadcrumbs include Schema markup

### Version 0.6.2
* Added Google Rich Snippets action to header https://developers.google.com/structured-data/rich-snippets/?hl=en

### Version 0.6.1
* Rewrite "Add Media" HTML output to include Bootstrap classes

### Version 0.6.0
* Post formats functionality rebuilt - now finds first instance of type and displays on blog page
* Updated JS for centering main nav logo

### Version 0.5.4
* Customizer updates for legibility
* Removed customized actions, rely on priority instead
* More CSS updates for themes and Jumbo compatibility

### Version 0.5.3

* Fixed customizer error calling sanitize functions statically
* Body classes and CSS added for Bootstrap theme specific CSS
* Updated customizer labels for better clarity
* Updated customizer CSS for image rendering in sidebar
* New customizeable actions after each `block-{name}.php`
* Commented out Post formats meta boxes

### Version 0.5.2

* Changed `pgb_posted_on` template tag to action for better control