<?php
/*
Plugin Name: Mobile Call Now
Plugin URI: http://seosthemes.com/mobile-call-now
Description: Mobile Call Now plugin places a Call Now button to the bottom of the screen which is only visible for your mobile visitors. 
Version: 1.1
Contributors: seosbg
Author: seosbg
Author URI: http://seosthemes.com/
Text Domain: mobile-call-now
*/


/*****************************************************
Menu Section
*****************************************************/

	add_action('admin_menu', 'mobile_calL_now_menu');

	function mobile_calL_now_menu() {
		add_menu_page('Mobile Call Now', 'Mobile Call Now', 'administrator', 'mobile-call-now-settings', 'mobile_calL_now_plugin_settings_page', plugins_url( 'images/icon.png' , __FILE__  ));
	}

/*****************************************************
Settings
*****************************************************/

	add_action( 'admin_init', 'mobile_calL_now_plugin_settings' );

	function mobile_calL_now_plugin_settings() {
		for($i=1;$i<=4;$i++) {
			register_setting( 'mobile-call-now-settings-group', 'color'.$i );
		}
		register_setting( 'mobile-call-now-settings-group', 'mobile_calL_now' );	
		register_setting( 'mobile-call-now-settings-group', 'mobile_calL_now_activation' );
		register_setting( 'mobile-call-now-settings-group', 'mobile_calL_now_text' );
	}

/*****************************************************
Activation
*****************************************************/

	function mobile_calL_now_activation() {
		if (get_option( 'mobile_calL_now_activation' ) == 1) { ?>
			<div class="mcn-footer">
				<a href="tel:[<?php echo get_option('mobile_calL_now'); ?>]">
					<?php if (get_option('mobile_calL_now_text')) : echo get_option('mobile_calL_now_text');  else :  ?>
					<img src="<?php echo plugin_dir_url(__FILE__) . '/images/phone9.png'; ?>">
					<?php  endif; ?>
				</a>
			</div>
		<?php 
		}
	}		
	
	add_action('wp_head','mobile_calL_now_activation');
	
/*****************************************************
Admin Scripts and Styles 
*****************************************************/

function mobile_calL_now_admin_scripts() {
	wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wp-color-picker-script', plugins_url('js/script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );	
	wp_enqueue_style( 'mobile-call-now-admin-css', plugin_dir_url(__FILE__) . '/css/admin.css' );
}
 
add_action( 'admin_enqueue_scripts', 'mobile_calL_now_admin_scripts' );

/*****************************************************
Front-end Styles
*****************************************************/

function mobile_calL_now_admin_styles() {
	wp_enqueue_style( 'mobile-call-now-style-css', plugin_dir_url(__FILE__) . '/css/style.css' );
}
 
add_action( 'wp_enqueue_scripts', 'mobile_calL_now_admin_styles' );	

/***************************************************** 
Settings Page
*****************************************************/


function mobile_calL_now_plugin_settings_page() {
?>

<form action="options.php" method="post" role="form" name="mobile-call-now-form">

	<?php settings_fields( 'mobile-call-now-settings-group' ); ?>
	<?php do_settings_sections( 'mobile-call-now-settings-group' ); ?>
			
	<div class="mobile-call-now">

		<div class="mobile-call-now-seos">
			<div>
				<a target="_blank" href="http://seosthemes.com/mobile-call-now/">
					<div class="btn s-red">
						 <?php _e('BUY ', 'mobile-call-now'); echo ' <img class="ss-logo" src="' . plugins_url( 'images/logo.png' , __FILE__ ) . '" alt="logo" />';  _e(' PREMIUM', 'mobile-call-now'); ?>
					</div>
				</a>
			</div>
		</div>	
		
		<h2>Mobile Call Now</h2>
		<table>
			<tr>
				<td><label><?php _e('Activate Button','mobile-call-now'); ?></label></td>

				<td><?php $mcn_activation = get_option( 'mobile_calL_now_activation' ); ?>	
				<input type="checkbox" name="mobile_calL_now_activation" value="1"<?php checked( 1 == $mcn_activation); ?> /></td>
			</tr>
			<tr>
				<td><label><?php _e('Phone Number','mobile-call-now'); ?></label></td>
				<td>
					<input type="text" value="<?php echo get_option('mobile_calL_now'); ?>" name="mobile_calL_now" />
				</td>
			</tr>
			<tr>
				<td><label><?php _e('Button Text','mobile-call-now'); ?></label></td>
				<td>
					<input type="text" value="<?php echo get_option('mobile_calL_now_text'); ?>" name="mobile_calL_now_text" />
				</td>
			</tr>			
			<tr>
				<td><label><?php _e('Button Background Color','mobile-call-now'); ?></label></td>
				<td><input type="text" value="<?php echo get_option('color1'); ?>" name="color1" class="wp-color-picker-field" data-default-color="" /></td>
			</tr>
			<tr>
				<td><label><?php _e('Button Background Hover Color','mobile-call-now'); ?></label></td>
				<td><input type="text" value="<?php echo get_option('color2'); ?>" name="color2" class="wp-color-picker-field" data-default-color="" /></td>
			</tr>			
			<tr>
				<td><label><?php _e('Button Color','mobile-call-now'); ?></label></td>
				<td><input type="text" value="<?php echo get_option('color3'); ?>" name="color3" class="wp-color-picker-field" data-default-color="" /></td>
			</tr>
			<tr>
				<td><label><?php _e('Button Hover Color','mobile-call-now'); ?></label></td>
				<td><input type="text" value="<?php echo get_option('color4'); ?>" name="color4" class="wp-color-picker-field" data-default-color="" /></td>
			</tr>		
		</table>
	<?php submit_button(); ?>
	</div>
</form>
<?php }

/***************************************************** 
Load Language
*****************************************************/

	function mobile_calL_now_language_load() {
		load_plugin_textdomain('mobile_calL_now_language_load', FALSE, basename(dirname(__FILE__)) . '/languages');
	}
	add_action('init', 'mobile_calL_now_language_load');

/***************************************************** 
Colors
*****************************************************/

function mobile_calL_now_colors () { ?>
			<style>
				@media screen and (max-width: 480px) {
				<?php if (get_option('color1')) { ?> .mcn-footer {background: <?php echo get_option('color1'); ?> !important;} <?php } ?>
				<?php if (get_option('color2')) { ?> .mcn-footer:hover {background: <?php echo get_option('color2'); ?> !important;} <?php } ?>
				<?php if (get_option('color3')) { ?> .mcn-footer a {color: <?php echo get_option('color3'); ?> !important;} <?php } ?>
				<?php if (get_option('color4')) { ?> .mcn-footer a:hover {color: <?php echo get_option('color4'); ?> !important;} <?php } ?>	
			}				
			</style>
	<?php
}

add_action ('wp_head','mobile_calL_now_colors');
