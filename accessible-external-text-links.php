<?php
/*
Plugin Name: Accessible External Text Links
Plugin URI: https://jeanmarcdelisle.fr
Text Domain: accessible-external-text-links
Domain Path: /languages/
Description: I created this plugin to make external text links more accessible to people with disabilities by displaying an image with an alternative that informs the user that the link will open in a new window. Thanx to Romain Gervois for help.
Version: 2.0
Author: Jean-Marc Delisle
Author URI: https://jeanmarcdelisle.fr
*/

// jmd_load_plugin_textdomain() loads plugin translation
function jmd_load_plugin_textdomain() {
	
	$domain = 'accessible-external-text-links';
	$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
	// wp-content/plugins/plugin-name/languages/accessible-external-text-links-fr_FR.mo
	load_plugin_textdomain( $domain, FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );

}
add_action( 'init', 'jmd_load_plugin_textdomain' );

add_action ("wp_enqueue_scripts", "jmd_load_js_links");
// jmd_load_js_links() loads javascript
function jmd_load_js_links() {
	wp_enqueue_script( 'accessible_external_links', plugins_url('/external-links.js', __FILE__), array(), '1.0',false );
}
add_action('admin_menu', 'jmd_accessible_external_links_menu');

function jmd_generate_output(){
	
	$img_src= plugins_url('/images/external_link.gif', __FILE__);
	
echo '<script>if(window.addEventListener){function fire(event){externalLink(\''.$img_src.'\',\''.addslashes(get_option('jmd_external_links_alternative')).'\')}window.addEventListener("DOMContentLoaded", fire, false);}
	else if (window.attachEvent) {function fire(event){externalLink(\''.$img_src.'\',\''.addslashes(get_option('jmd_external_links_alternative')).'\')}window.attachEvent("onload", fire, false);}</script>';
}

add_action('wp_footer', 'jmd_generate_output');//outputs script in footer

function jmd_accessible_external_links_menu() {
	add_options_page('Accessible Links Options', 'Accessible Links', 'manage_options', 'my-unique-identifier', 'jmd_settings_page');
}
// jmd_settings_page() displays the page content for the Accessible Links settings submenu
function jmd_settings_page() { 
	//must check that the user has the required capability
	if (!current_user_can('manage_options'))
	{
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	// variables for the field and option names
	$opt_name = 'jmd_external_links_alternative';
	$hidden_field_name = 'mt_submit_hidden';
	$data_field_name = 'jmd_external_links_alternative';
	// Read in existing option value from database
	$opt_val = get_option( $opt_name );
	// See if the user has posted us some information
	// If they did, this hidden field will be set to 'Y'
	
	if (empty($opt_val))
	{
		update_option( $opt_name, "Opens in a new window" );
	}

	if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
		// Read their posted value		
		$opt_val = stripslashes($_POST[ $data_field_name ]);
		// Save the posted value in the database
		update_option( $opt_name, sanitize_text_field($opt_val) );
		// Put an settings updated message on the screen
		?>
<div class="updated">
	<p>
		<strong><?php _e('Options saved.', 'accessible-external-text-links' ); ?> </strong>
	</p>
</div>

<?php
	}
	// Now display the settings editing screen
	echo '<div class="wrap">';
	// header
	echo "<h2>" . __( 'Accessible external links settings', 'accessible-external-text-links' ) . "</h2>";
	// settings form

	?>
<form name="form1" method="post" action="">

<table class="form-table">
	<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y"/>
	

<tr valign="top">
	<th scope="row"><label for="<?php echo $data_field_name; ?>"><?php _e("Image alternative text (alt attribute content):", 'accessible-external-text-links' ); ?></label></th>
	<td><input type="text" id="<?php echo $data_field_name; ?>" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" size="40"/></td>
</tr>	
</table>
	<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
		<input type="reset" name="Reset" class="button" value="<?php _e('Reset', 'accessible-external-text-links' ); ?>" />
	</p>
</form>
<div></div>
<?php
}?>