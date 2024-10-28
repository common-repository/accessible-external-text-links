=== Accessible External Text Links ===
Contributors: Myshock
Tags: accessibility, links
Requires at least: 3.3.1
Tested up to: 6.1.1
Stable tag: 2.0

I created this plugin to make external text links more accessible to people with disabilities

== Description ==

I created this plugin to make external text links more accessible to people with disabilities by displaying an image with an alternative that informs the user that the link will open in a new window. Thanks to Romain Gervois.

== Installation ==

1. Upload `accessible_external_links` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go into the admin panel of the plugin and fill the 'Image alternative text (alt attribute content)' field with the alternative you fish to display default : "Opens in a new window" 
4. add a class of "external" on the links you wish to open in a new window. 

For example use `<a class='external' href='your link url'>My Link</a>`

If you encounter some problems with icon positionning you can add a class of :
`a.external img{}` in your theme `style.css` file to control the image positionning

== Screenshots ==

1. The plugin in action

== Frequently Asked Questions ==

= Does it works with ie6 =
Actually not, and it's not planned at the moment.

== Changelog ==

= 1.0 [2012-01-22] =
* Initial release

= 1.1 [2012-07-15] =
* Fixed not working with Internet Explorer 8

= 1.2 [2013-10-20] =
* Added inline style on img tag so image displays correctly right to external link

= 1.3 [2013-10-20] =
* Modified alternative text input width
* Added screenshot in readme.txt

= 1.4 [2013-10-20] =
* fixed JavaScript error

= 2.0 [2023-02-19]
* Added translation support
* Added french version
* Plugin code rewrite
* Enhanced security
* Added uninstall script