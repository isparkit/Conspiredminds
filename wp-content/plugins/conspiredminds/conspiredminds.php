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
 * Author:            John Smith
 * Author URI:        #
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        #
 * Text Domain:       conspiredminds
 */
 
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

    // add_menu_page(
    //     __('Conspiredminds - Conspiredminds', 'my-textdomain'),
    //     __('Conspiredminds', 'my-textdomain'),
    //     'manage_options',
    //     'sample-page',
    //     'api_get_send_data',
    //     'dashicons-book',
    //     3
    // );

    // add_submenu_page('sample-page',
    //     __('Page Title - Detail Page', 'my-textdomain'),
    //     __('Detail Page', 'my-textdomain'),
    //     'manage_options',
    //     'sample-page-sub-menu',
    //     'my_sub_menu_admin_page_contents');
}

add_action('admin_menu', 'admin_menu');


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

    // wp_register_style( 'custom_bootstrap_image_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
    // wp_enqueue_style('custom_bootstrap_image_css');

    wp_register_script( 'bs_datatable_js', 'https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js');
    wp_enqueue_script('bs_datatable_js');

    // wp_register_style( 'bs_datatable_css', ' https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css');
    // wp_enqueue_style('bs_datatable_css');


   
   
}

add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style');


//Create DB
// function myPluginCreateTable() {

//     global $wpdb;

//     $waiting_table_name = $wpdb->prefix . 'wp_';
//     $waitinglist_sql = "CREATE TABLE `$waiting_table_name` (
//         `id` int(11) NOT NULL AUTO_INCREMENT,
//         `pid` int(220) DEFAULT NULL,
//         `bsid` varchar(220) DEFAULT NULL,
//         `campid` int(220) DEFAULT NULL,
//         `note` varchar(550) DEFAULT NULL,
//         `inquirydate` varchar(55) DEFAULT '1',
//         PRIMARY KEY(id)

//         ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
//     ";
//     if ($wpdb->get_var("SHOW TABLES LIKE '$waiting_table_name'") != $waiting_table_name) {
//         require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
//         dbDelta($waitinglist_sql);
//     }    
// }

// register_activation_hook( _FILE_, 'myPluginCreateTable');
