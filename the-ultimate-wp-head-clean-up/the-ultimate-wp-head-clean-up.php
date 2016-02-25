<?php
/*
=== the ULTIMATE WP Head Cleanup ===
Plugin Name: The ULTIMATE WP Head Cleanup
Plugin URI: http://www.chicagocomputerclasses.com/
Donate link: http://www.chicagocomputerclasses.com/
Tags: wordpress head cleanup, wp_head cleanup, cleaner, remove head junk
Version: 1.0
Author: Chi Bramder Inc.
Description: The ULTIMATE WP Head Cleanup plugin is all you need to remove all the unnecessary lines in the head section of your WordPress website.
Author URI: http://www.chicagocomputerclasses.com/
Requires at least: 3.0
Tested up to: 4.0
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// create custom plugin settings menu
add_action('admin_menu', 'wphead_cleanup_create_menu');
add_action( 'init', 'wphead_init' );		

function wphead_cleanup_create_menu() {

	//create new top-level menu
	add_options_page('WP Head Cleanup Settings', 'WP head Cleanup', 'administrator', __FILE__, 'wphead_Cleanup_settings_page');

	//call register settings function
	add_action( 'admin_init', 'register_wphead_settings' );
}





	function wphead_init() {
		
		/* This will remove Really Simple Discovery link from the header */
		if(get_option( 'remove_rsd_link' ) == true ){
			remove_action('wp_head', 'rsd_link');
		}
		
		/* This will remove the Wordpress generator tag  */
        if(get_option( 'remove_wp_generator' ) == true ){
			remove_action('wp_head', 'wp_generator');
		}
		
		/* This will remove the standard feed links */
        if(get_option( 'remove_feed_links' ) == true ){
			remove_action( 'wp_head', 'feed_links', 2 );
		}
		
		/* This will remove the extra feed links */
		if(get_option( 'remove_feed_links_extra' ) == true ){
			remove_action( 'wp_head', 'feed_links_extra', 3 );
		}
		
		/* This will remove index link */
        if(get_option( 'remove_index_rel_link' ) == true ){
			remove_action('wp_head', 'index_rel_link');
		}

		/* This will remove wlwmanifest */
		if(get_option( 'remove_wlwmanifest_link' ) == true ){
			remove_action('wp_head', 'wlwmanifest_link');
		}	
		
		/* This will remove parent post link */
		if(get_option( 'remove_parent_post_rel_link' ) == true ){
			remove_action('wp_head', 'parent_post_rel_link', 10, 0);
		}
		
		/*This will remove start post link */
		if(get_option( 'remove_start_post_rel_link' ) == true ){
			remove_action('wp_head', 'start_post_rel_link');
		}

		/* This will remove the prev and next post link */
		if(get_option( 'remove_adjacent_posts_rel_link' ) == true ){
			remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
		}	

        /* This will remove shortlink for the page */
		if(get_option( 'remove_wp_shortlink_wp_head' ) == true ){
			remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
		}			
        
        
        // Changes starts here
        
        /* This will remove canonical reference */
        if(get_option( 'remove_rel_canonical' ) == true ){
            remove_action( 'wp_head', 'rel_canonical');
        }	
        
        /* This will remove emoji references */
        if(get_option( 'remove_emoji' ) == true ){
            remove_action( 'wp_head', 'print_emoji_detection_script', 7);
            remove_action( 'wp_print_styles','print_emoji_styles');
        }
		
        /* This will remove REST references. Ex. json */
        if(get_option( 'remove_rest_output_link_wp_head' ) == true ){
            remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
        }

        /* This will remove oEmbed references. */
        if(get_option( 'remove_oembed' ) == true ){
            remove_action( 'wp_head', 'wp_oembed_add_discovery_links');
            remove_action( 'wp_head', 'wp_oembed_add_host_js');
        }        
        
        
        //add_filter('show_admin_bar', '__return_false');
        
        //potentail future implementations
        //remove_action( 'wp_footer',           'wp_print_footer_scripts',         20    );
        //remove_action( 'template_redirect',   'wp_shortlink_header',             11, 0 );
        //remove_action( 'wp_print_footer_scripts', '_wp_footer_scripts'                 );
        
        
        
        
        //remove_action( 'wp_head',             '_wp_render_title_tag',            1     );
        //remove_action( 'wp_head',             'wp_enqueue_scripts',              1     );
        //remove_action( 'wp_head',             'locale_stylesheet'                      );
        //remove_action( 'wp_head',             'noindex',                          1    );

        //remove_action( 'wp_head',             'wp_print_styles',                  8    );
        //remove_action( 'wp_head',             'wp_print_head_scripts',            9    );

        //remove_action( 'wp_head',             'wp_site_icon',                    99    );
   
        
        
}		
function register_wphead_settings() {
	//register our settings
	register_setting( 'wphead_cleanup-settings-group', 'remove_rsd_link' );
	register_setting( 'wphead_cleanup-settings-group', 'remove_wp_generator' );
	register_setting( 'wphead_cleanup-settings-group', 'remove_feed_links' );
	register_setting( 'wphead_cleanup-settings-group', 'remove_feed_links_extra' );
	register_setting( 'wphead_cleanup-settings-group', 'remove_index_rel_link' );
	register_setting( 'wphead_cleanup-settings-group', 'remove_wlwmanifest_link' );
	register_setting( 'wphead_cleanup-settings-group', 'remove_parent_post_rel_link' );
	register_setting( 'wphead_cleanup-settings-group', 'remove_start_post_rel_link' );
	register_setting( 'wphead_cleanup-settings-group', 'remove_adjacent_posts_rel_link' );
	register_setting( 'wphead_cleanup-settings-group', 'remove_wp_shortlink_wp_head' );
    
    
    
    register_setting( 'wphead_cleanup-settings-group', 'remove_rel_canonical' );
    register_setting( 'wphead_cleanup-settings-group', 'remove_emoji' );
    register_setting( 'wphead_cleanup-settings-group', 'remove_rest_output_link_wp_head' );
    register_setting( 'wphead_cleanup-settings-group', 'remove_oembed' );
    
    
}


function wphead_Cleanup_settings_page() {
?>
    <div class="wrap">
        <h2>WP Head Cleanup</h2>
        <h3>Select the elements you want to remove from the head section:</h3>

        <form method="post" action="options.php">
            <?php settings_fields( 'wphead_cleanup-settings-group' ); ?>

                <table class="form-table">
                    <tr valign="top">

                        <th scope="row">Really Simple Discovery</th>
                        <td>

                            <input type="checkbox" name="remove_rsd_link" value="1" <?php if (get_option( 'remove_rsd_link')==true) echo 'checked="checked" '; ?>" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Wordpress generator tag</th>
                        <td>
                            <input type="checkbox" name="remove_wp_generator" value="1" <?php if (get_option( 'remove_wp_generator')==true) echo 'checked="checked" '; ?>" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Remove the standard feed links</th>
                        <td>
                            <input type="checkbox" name="remove_feed_links" value="1" <?php if (get_option( 'remove_feed_links')==true) echo 'checked="checked" '; ?>" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Extra feeds such as category feeds</th>
                        <td>
                            <input type="checkbox" name="remove_feed_links_extra" value="1" <?php if (get_option( 'remove_feed_links_extra')==true) echo 'checked="checked" '; ?>" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Post Relational Links - Index</th>
                        <td>
                            <input type="checkbox" name="remove_index_rel_link" value="1" <?php if (get_option( 'remove_index_rel_link')==true) echo 'checked="checked" '; ?>" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Remove wlwmanifest</th>
                        <td>
                            <input type="checkbox" name="remove_wlwmanifest_link" value="1" <?php if (get_option( 'remove_wlwmanifest_link')==true) echo 'checked="checked" '; ?>" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Remove parent post link</th>
                        <td>
                            <input type="checkbox" name="remove_parent_post_rel_link" value="1" <?php if (get_option( 'remove_parent_post_rel_link')==true) echo 'checked="checked" '; ?>" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Post Relational Links - Start</th>
                        <td>
                            <input type="checkbox" name="remove_start_post_rel_link" value="1" <?php if (get_option( 'remove_start_post_rel_link')==true) echo 'checked="checked" '; ?>" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Remove the prev and next post link</th>
                        <td>
                            <input type="checkbox" name="remove_adjacent_posts_rel_link" value="1" <?php if (get_option( 'remove_adjacent_posts_rel_link')==true) echo 'checked="checked" '; ?>" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Remove shortlink for the page</th>
                        <td>
                            <input type="checkbox" name="remove_wp_shortlink_wp_head" value="1" <?php if (get_option( 'remove_wp_shortlink_wp_head')==true) echo 'checked="checked" '; ?>" /></td>
                    </tr>






                    <tr valign="top">
                        <th scope="row">Remove canonical reference</th>
                        <td>
                            <input type="checkbox" name="remove_rel_canonical" value="1" <?php if (get_option( 'remove_rel_canonical')==true) echo 'checked="checked" '; ?>" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Remove emoji references</th>
                        <td>
                            <input type="checkbox" name="remove_emoji" value="1" <?php if (get_option( 'remove_emoji')==true) echo 'checked="checked" '; ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Remove REST references.</th>
                        <td>
                            <input type="checkbox" name="remove_rest_output_link_wp_head" value="1" <?php if (get_option( 'remove_rest_output_link_wp_head')==true) echo 'checked="checked" '; ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Remove oEmbed references</th>
                        <td>
                            <input type="checkbox" name="remove_oembed" value="1" <?php if (get_option( 'remove_oembed')==true) echo 'checked="checked" '; ?>" /></td>
                    </tr>


                </table>

                <?php submit_button(); ?>

        </form>
    </div>
    <?php } ?>
