<?php
//// Create Image maping CPT
function imagemaping_post_type() {
  register_post_type( 'dwk-image-maping',
      array(
          'labels' => array(
              'name' => __( 'Image Maping' ),
              'singular_name' => __( 'Image Maping' )
          ),
          'public' => true,
          'show_in_rest' => true,
      'supports' => array('title', 'editor', 'custom-fields'),
      'has_archive' => true,
      'rewrite'   => array( 'slug' => 'dwk-image-maping' ),
          'menu_position' => 5,
      'menu_icon' => 'dashicons-location',
      )
  );
}
add_action( 'init', 'imagemaping_post_type' );

// Enable Custom Fields Support For Custom Post Type
function dwk_enable_custom_fields(){
	// Replace 'events' with your custom post type name
	add_post_type_support( 'Image Maping', 'custom-fields' );
}
add_action( 'init', 'dwk_enable_custom_fields' );

// Remove Add New From the menu
// add_action('admin_menu', 'dwk_hide_add_new_menu');

function dwk_hide_add_new_menu() {
    global $submenu;
    if (is_admin() && isset($submenu['edit.php?post_type=dwk-image-maping'][10])) {
        unset($submenu['edit.php?post_type=dwk-image-maping'][10]);
    }
}
