<?php
/**
** child theme
**/
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0.0', 'all' );
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );