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
    $customerTable = $table_prefix . 'conspiremind';

    // Create Customer Table if not exist
    if( $wpdb->get_var( "show tables like '$customerTable'" ) != $customerTable ) {

        // Query - Create Table
        $sql = "CREATE TABLE `$customerTable` (";
        $sql .= " `id` int(11) NOT NULL auto_increment, ";
        $sql .= " `bin` varchar(500) NOT NULL, ";
        $sql .= " `isn_dob_bis_viol` varchar(500) NOT NULL, ";
        $sql .= " `boro` varchar(500), ";
        $sql .= " `block` varchar(500) NOT NULL, ";
        $sql .= " `lot` varchar(500), ";
        $sql .= " `issue_date` varchar(500), ";
        $sql .= " `violation_type_code` varchar(150) NOT NULL, ";
        $sql .= " `violation_number` varchar(500), ";
        $sql .= " `house_number` varchar(500), ";
        $sql .= " `street` varchar(500) NOT NULL, ";
        $sql .= " `disposition_date` varchar(500) NOT NULL, ";
        $sql .= " `device_number` varchar(500) NOT NULL, ";
        $sql .= " `description` varchar(500) NOT NULL, ";
        $sql .= " `disposition_comments` varchar(500) NOT NULL, ";
        $sql .= " `number` varchar(500) NOT NULL, ";
        $sql .= " `violation_category` varchar(500) NOT NULL, ";
        $sql .= " `violation_type` varchar(500) NOT NULL, ";
        $sql .= " `status` varchar(1) NOT NULL, ";
        $sql .= " PRIMARY KEY `customer_id` (`id`) ";
        $sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";

        // Include Upgrade Script
        require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
    
        // Create Table
        dbDelta( $sql );
    }
}

register_activation_hook( __FILE__, 'init_db_myplugin' );

function insertData() {     
    global $wpdb; 
    $table_name = $wpdb->prefix . 'conspiremind';     

    $db = conspiredminds_restapi_callback();

    foreach ($db as $key => $value) {
        $result = $wpdb->insert( 
            $table_name, 
            array(  
              'bin' => $value->bin, 
              'isn_dob_bis_viol' => $value->isn_dob_bis_viol, 
              'boro' => $value->boro,
              'block' => $value->block, 
              'lot' => $value->lot, 
              'issue_date' => $value->issue_date, 
              'violation_type_code' => $value->violation_type_code, 
              'violation_number' => $value->violation_number, 
              'house_number' => $value->house_number, 
              'street' => $value->street, 
            //   'disposition_date' => $value->disposition_date,
            //   'device_number' => $value->device_number,
            //   'description' => $value->description, 
              // 'disposition_comments' => $value->disposition_comments, 
              // 'number' => $value->number,
              // 'violation_category' => $value->violation_category, 
              // 'violation_type' => $value->violation_type, 
              // 'status' => $value->status, 
            ),
        );        
        // if (!$result) {
        //     print 'There was an error';
        // }
    }
}

add_action( 'init', 'insertData' );

function conspiredminds_restapi_callback(){
    $url = 'https://data.cityofnewyork.us/resource/3h2n-5cm9.json?bin=1079062';   
        $arguments = array(
         'method' => 'GET'
        );
        $response = wp_remote_get( $url, $arguments );
        if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        return "Something went wrong: $error_message";
        } 
        else { 
        $data = json_decode(wp_remote_retrieve_body($response));
        } 
    return $data;
}

//Add cron event on data
add_action( 'conspiredminds', 'insertData' );
// function cw_function() {
// wp_mail( 'nishita@demolink.info', 'Cloudways Cron', 'conspiredminds - a Managed Properties Data!' );
// }
 
//plugin menu page 
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

// Shortcode for Front view
function rest_front_data()
{
    ?>
<?php require_once __DIR__ . '/templates/admin.php'; ?>
<?php
}

add_shortcode('api-data', 'rest_front_data');

//Display data into Admin Panel
function my_admin_page_contents()
{
    ?>
<?php require_once __DIR__ . '/templates/admin.php'; ?>
<?php
}

// Register scripts and css 
function load_custom_wp_admin_style()
{
   
    wp_register_style( 'custom_wp_admin_css',  plugin_dir_url( __FILE__ ) . '/assets/main.css');
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

// Register scripts and css for Front View
function front_table(){

    wp_register_style( 'front_table_css1','https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css');
    wp_enqueue_style('front_table_css1'); 

    wp_register_style( 'front_table_css2', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css');
    wp_enqueue_style('front_table_css2'); 

    wp_register_style( 'front_table_css3','https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css');
    wp_enqueue_style('front_table_css3'); 


    wp_register_script( 'front_front_js','https://code.jquery.com/jquery-3.5.1.js');
    wp_enqueue_script('front_front_js'); 

    wp_register_script( 'front_front_js2','https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js');
    wp_enqueue_script('front_front_js2'); 

    wp_register_script( 'front_front_js3','https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js');
    wp_enqueue_script('front_front_js3'); 

    
    wp_register_script( 'custom_wp_front_js',  plugin_dir_url( __FILE__ ) . '/assets/main.js');
    wp_enqueue_script( 'custom_wp_front_js' ); 

}
add_action('wp_enqueue_scripts','front_table');
?>