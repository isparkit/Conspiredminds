<?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', [] );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles', 20 );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';	
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );

/* Create User Role */
add_role(
    'property_manager', //  System name of the role.
    __( 'Property Manager'  ), // Display name of the role.
    array(
        'read'  => true,
        // 'delete_posts'  => true,
        // 'delete_published_posts' => true,
        // 'edit_posts'   => true,
        // 'publish_posts' => true,
        // 'edit_published_posts'   => true,
        // 'upload_files'  => true,
        // 'moderate_comments'=> true, // This user will be able to moderate the comments.
    )
);
