<?php
/**
** child theme
**/
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0.0', 'all' );
}


add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );


/**
 ** customize theme   
 */
function montheme_customize_register($wp_customize)
{
    // Ajout d'une section pour le logo personnalisé
    $wp_customize->add_section('montheme_logo_section', array(
        'title'      => __('Custom logo here', 'montheme'),
        'priority'   => 30,
    ));

    // Ajout de la fonctionnalité de logo personnalisé
    $wp_customize->add_setting('montheme_log');

    // Ajout du contrôle pour téléverser le logo personnalisé
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'montheme_log', array(
        'label'    => __('Téléverser votre logo', 'montheme'),
        'section'  => 'montheme_logo_section',
        'settings' => 'montheme_log',
    )));
}
add_action('customize_register', 'montheme_customize_register');

add_filter( 'wp_nav_menu_objects', 'remove_menu_item', 10, 2 );

function remove_menu_item( $items, $args ) {
    $user = wp_get_current_user();
    if( ! ($user && isset($user->user_login)) ) {  //user qui n'a pas de login on recree les items sans Admin
        $new_items = array();
        foreach ( $items as $item ) {
            if ( $item->title != 'Admin' ) { // On enlève l'Item de l'admin.
               
                array_push( $new_items, $item );
            }
        }
        return $new_items;
    }
    return $items;
}

?>