<?php
/**
    * @package  ConspiredmindsPlugin
    */
/*
 * Plugin Name:       Conspiredminds
 * Plugin URI:        #
 * Description:       Handle the basics with this plugin.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Conspiredminds
 * Author URI:        #
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        #
 * Text Domain:       conspiredminds
 */

if ( !defined( 'ABSPATH' ) ) exit;

// Act on plugin activation
register_activation_hook( __FILE__, "activate_myplugin" );

// Act on plugin de-activation
register_deactivation_hook( __FILE__, "deactivate_myplugin" );

// Activate Plugin
function activate_myplugin() {
         
    init_db_myplugin();
}

// De-activate Plugin
function deactivate_myplugin() {
    
    // Do something on Deactivation.       
}

// Initialize DB Tables
function init_db_myplugin() {

    // WP Globals
    global $table_prefix, $wpdb;

    // Customer Table
    $customerTable = $table_prefix . 'wp_conspiremind_data';

    // Create Customer Table if not exist
    if( $wpdb->get_var( "show tables like '$customerTable'" ) != $customerTable ) {

        // Query - Create Table
        $sql = "CREATE TABLE `$customerTable` (";
        $sql .= " `id` int(11) NOT NULL auto_increment, ";
        $sql .= " `email` varchar(500) NOT NULL, ";
        $sql .= " `fname` varchar(500) NOT NULL, ";
        $sql .= " `sname` varchar(500), ";
        $sql .= " `line1` varchar(500) NOT NULL, ";
        $sql .= " `line2` varchar(500), ";
        $sql .= " `line3` varchar(500), ";
        $sql .= " `city` varchar(150) NOT NULL, ";
        $sql .= " `state` varchar(150), ";
        $sql .= " `area` varchar(15), ";
        $sql .= " `country` varchar(5) NOT NULL, ";
        $sql .= " PRIMARY KEY `customer_id` (`id`) ";
        $sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

        // Include Upgrade Script
        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
    
        // Create Table
        dbDelta( $sql );
    }
}

 
function admin_menu()
{
    add_menu_page(
        __('Conspiredminds - Conspiredminds', 'my-textdomain'),
        __('Conspiredminds', 'my-textdomain'),
        'manage_options',
        'sample-page',
        'my_admin_page_contents',
        'dashicons-book',
        3
    );

    // add_submenu_page('sample-page',
    //     __('Page Title - Detail Page', 'my-textdomain'),
    //     __('Detail Page', 'my-textdomain'),
    //     'manage_options',
    //     'sample-page-sub-menu',
    //     'my_sub_menu_admin_page_contents');
}

add_action('admin_menu', 'admin_menu');

// Shortcode for Front Show 
function rest_front_data()
{
    ?>
    <?php require_once __DIR__ . '/templates/admin.php'; ?>
    <?php
}

add_shortcode('api-data', 'rest_front_data');



function my_admin_page_contents()
{
    ?>
    <?php require_once __DIR__ . '/templates/admin.php'; ?>
    <?php
}


function load_custom_wp_admin_style()
{
   
    wp_register_style( 'custom_wp_admin_css',  plugin_dir_url( __FILE__ ) . '/assets/main.css' );
    wp_enqueue_style( 'custom_wp_admin_css' );

    wp_register_script( 'custom_external_admin_js', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js' );
    wp_enqueue_script( 'custom_external_admin_js' );

    wp_register_script( 'custom_wp_admin_js',  plugin_dir_url( __FILE__ ) . '/assets/main.js');
    wp_enqueue_script( 'custom_wp_admin_js' );

    wp_register_style( 'custom_bootstrap_admin_css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' );
    wp_enqueue_style('custom_bootstrap_admin_css');

    wp_register_style( 'custom_bootstrap_admin_style_2', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css');
    wp_enqueue_style('custom_bootstrap_admin_style_2');

    wp_register_script( 'custom_bootstrap_admin_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js');
    wp_enqueue_script('custom_bootstrap_admin_js');

    wp_register_script( 'custom_bootstrap_admin_js_2', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js');
    wp_enqueue_script('custom_bootstrap_admin_js_2'); 

    wp_register_style( 'bs_datatable_css', 'https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css');
    wp_enqueue_style('bs_datatable_css');  

    wp_register_style( 'd_datatable_css', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css');
    wp_enqueue_style('d_datatable_css');  

    wp_register_style( 'd_datatable_css2','https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css');
    wp_enqueue_style('d_datatable_css2');  

    wp_register_script( 'bs_datatable_js','https://code.jquery.com/jquery-3.5.1.js');
    wp_enqueue_script('bs_datatable_js'); 

    wp_register_script( 'bs_datatable_j2','https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js');
    wp_enqueue_script('bs_datatable_j2'); 

    wp_register_script( 'bs_datatable_j3','https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js');
    wp_enqueue_script('bs_datatable_j3');  
}
add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style');
?>




