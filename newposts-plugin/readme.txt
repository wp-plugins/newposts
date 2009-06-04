=== Plugin Name ===
Contributors: chabliuc
Donate link: http://ibean.org
Tags: new, posts, image, cookie, visitor, first, time, display
Requires at least: 2.7.1
Tested up to: 2.7.1
Stable tag: /trunk/

This plugin enables your visitors to quickly spot new posts by displaying a "new" icon next to the post's title

== Description ==

Whenever a visitor sees your blog, a cookie is stored on his browser so there is a
way to detect the last time that she visited it. Based upon this information, the next time
she views your blog, the newest posts will have a "new" image attached to their title,
so the novelties will catch the user's attention.

== Installation ==

After you have unzipped the archive, go through the following steps to 
1. Upload `newposts.php` AND the `newposts` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to the Plugins menu and click on NewPosts - it will take you to the configuration. Choose the image you want displayed and click `Update Options`
1. Place `<?php newposts_display(); ?>` in your templates right next to the post title

== Frequently Asked Questions ==

= The provided images aren't enough for me. How can I add more? =

Just upload them to the `/wp-content/plugins/newposts` directory and then go back to the
Configuration page. The changes should be reflected now in the image combobox.

= In the configuration page the combobox has no entries. What happened? =

It's most likely that you didn't upload the `newposts` folder along with the plugin. Please read
installation.

== Screenshots ==

1. The main idea :)

