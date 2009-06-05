=== NewPosts ===
Contributors: chabliuc
Donate link: http://ibean.org
Tags: new, posts, image, cookie, visitor, first, time, display
Requires at least: 2.7.1
Tested up to: 2.7.1
Stable tag: 1.3

This plugin enables your visitors to quickly spot new posts by displaying a "new" icon next to the post's title

== Description ==

Whenever a visitor sees your blog, a cookie is stored on his browser so there is a
way to detect the last time that she visited it. Based upon this information, the next time
she views your blog, the newest posts will have a "new" image attached to their title,
so the novelties will catch the user's attention.

== Installation ==
1. Unzip the `newposts` folder from the downloaded `.zip` archive.  
1. Upload that folder to your `/wp-content/plugins/` directory on your server
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to the Plugins menu and click on NewPosts - it will take you to the configuration. Choose the image you want displayed and click `Update Options`
1. Place `<?php newposts_display(); ?>` in your templates right next to the post title (in `index.php`) e.g. find the piece of code `<?php the_title(); ?>` and insert the following piece of code in front of or after it `<?php newposts_display() ?>`

== Frequently Asked Questions ==

= The provided images aren't enough for me. How can I add more? =

Just upload them to the `/wp-content/plugins/newposts` directory and then go back to the
Configuration page. The changes should be reflected now in the image combobox.

= In the configuration page the combobox has no entries. What happened? =

It's most likely that you didn't upload the `newposts` folder along with the plugin. Please read
installation.

== Screenshots ==
1. The main idea :)

