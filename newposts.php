<?php
/*
Plugin Name: NewPosts
Plugin URI: http://ibean.org/projects/wp-newposts
Description: This plugin checks some cookie on the visitor's pc (which has the last visit date set), so it can determine whether an entry is new for a user. Use <code>&lt;?php newposts_display() ?&gt;</code> right before/after the post's title.
Author: Cristi Habliuc
Version: 1.3
Author URI: http://ibean.org
*/

define('NP_DEF_IMAGE_PATH', '/wp-content/plugins/newposts/');
define('NP_DEF_IMAGE', 'icon_new1.gif');

define('NP_IMAGE_OPT', 'newposts_imagepath');
define('NP_COOKIE_NAME', 'wp-newposts-lastvisit');

/**
 * @return array the list of available images in the plugin folder 
 */
function newposts_get_images() {
	$dir = dirname(__FILE__);
	$ext = array('png', 'jpg', 'jpeg' ,'gif');
	$dir_handle = @opendir($dir) or die("Unable to open $dir");
	
	$files = array();
	while ($file = readdir($dir_handle)) {
		$fileSplit = split("\.", $file);
   		if (in_array(strtolower($fileSplit[count($fileSplit) - 1]), $ext)) {
   			$files[] = $file;
   		}
	}
	return $files;
}

/**
 * Adds the Configuration submenu to the plugins menu
 */
function newposts_add_page()
{
	add_submenu_page('plugins.php', 'NewPosts', 'NewPosts', 8, __FILE__, 'newposts_options');
}

/**
 * The configuration form
 */
function newposts_options() 
{
    // variables for the field and option names 
    $hidden_field_name = 'newposts_hidden';
    $data_field_name = 'newposts_welcome';

    $imgUrlDir = NP_DEF_IMAGE_PATH;

    // Read in existing option value from database
    $opt_val = stripslashes(get_option(NP_IMAGE_OPT));
    if (!$opt_val) {
    	$opt_val = $imgUrlDir . NP_DEF_IMAGE;
    }

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = $imgUrlDir . $_POST[ $data_field_name ];

        // Save the posted value in the database
        update_option(NP_IMAGE_OPT, $opt_val);
        
        // Put an options updated message on the screen
		?>
		<div class="updated">
			<p><strong><?php _e('Options saved.', 'newposts_domain' ); ?></strong></p>
		</div>
<?php
    }
?>
		
<div class="wrap">
		
	<h2><?php echo __( 'NewPosts Options', 'newposts_domain' )?></h2>
		
	<form name="form1" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
		
		<p><?php _e("The <b>new</b> image:", 'newposts_domain' ); ?> 
		
		<select name="<?php echo $data_field_name; ?>" onchange="document.getElementById('previewImg').src='<?php echo get_option('siteurl') . $imgUrlDir ?>' + this.options[this.selectedIndex].value">
			<?php foreach (newposts_get_images() as $file): ?>
			<option value="<?php echo $file?>" <?php if ($opt_val == $imgUrlDir . $file) echo "selected='selected'" ?>><?php echo $file?></option>
			<?php endforeach; ?>
		</select>
		
		<img id="previewImg" src="<?php echo get_option('siteurl') . $opt_val ?>"/>
		</p>
		<hr />
		
		<p class="submit">
		<input type="submit" name="Submit" value="<?php _e('Update Options', 'newposts_domain' ) ?>" />
		</p>
		
	</form>
</div>
		
	<?php
 
}

/**
 * Displays the "new" image if the post date is later than the last visit date.
 * Call this function in yout template's index.php right before displaying the post title
 * @see description
 */
function newposts_display() 
{
	$post_date = the_date('F jS, Y H:i:s', '', '', false);
	$time = strtotime($post_date);
	if (!isset($_REQUEST[NP_COOKIE_NAME]) ||
			$_REQUEST[NP_COOKIE_NAME] < $time) { 
		$content .=
			'<img src="' . stripslashes(get_option('siteurl')) . stripslashes(get_option('newposts_imagepath')) . '" />';
	}
	echo $content . $title;
}

/**
 * Sets the last visit time cookie and retains the current value in the 
 * $_REQUEST object
 */
function newposts_cookie()
{
	// save the current cookie value in the request object
	$_REQUEST[NP_COOKIE_NAME] = $_COOKIE[NP_COOKIE_NAME];
	
	// save the new cookie
	$timeVar = time();
	setcookie(NP_COOKIE_NAME, $timeVar, time() + 10*365*24*3600);
}

// add a hook to the init action so the cookie gets manipulated
add_action('init','newposts_cookie');

// add a hook to the admin menu so the configuration gets shown
add_action('admin_menu','newposts_add_page');

?>