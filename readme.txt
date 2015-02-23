=== TNK SNS share link buttons ===
Contributors: TNK Software(Tanaka Yusuke)
Donate link: http://www.tnksoft.com/soft/internet/sharegen/
Tags: sns, button, link, facebook, twitter, share
Requires at least: 3.0
Tested up to: 4.1
Stable tag: 1.0
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

It creates link buttons to the target blog article page for sharing SNS services.


== Description ==

It creates link buttons to the target blog article page for sharing 17 major services and those links are created by javascript, so it's not a burden to the server and page loding. And if you need, it will append an Open Graph Protocol information to the your article automatically.


== Installation ==
1. Upload the folder includes program files to your WordPress plugin folder.
2. Activate the plugin through the plugins menu in WordPress.
3. Select "TNK SNS links" from the plugins menu and change the setting.

*Output target
Specify the place which outputs buttons' HTML. "On tnksns() function called" outputs buttons to the place of tnksns PHP function.
ex) <div class="share">Share this article : <?php tnksns(); ?></div>

*Services
Select target services. You need the developer key for Mixi.

*Open Graph
Append Open Graph protocol into head tag. The image url of "default thumbnail" will be applied to it if a thumbnail does not exist in an article.


== Frequently Asked Questions ==
*I have a question(or a request).
If you have any questions or requests. Please send a mail. It's free.

*How much the amount of a donation?
From 1$. There is no maximum :-).


== Screenshots ==
1. Support services
2. setting page


== Changelog ==

= 1.0 =
* First release
