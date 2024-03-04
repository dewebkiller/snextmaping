<?php
// load css into the admin pages
function dwk_style() {
    wp_enqueue_style( 'dwk_style', plugin_dir_url( __FILE__ ) . 'css/admin-style.css' );
}
add_action( 'admin_enqueue_scripts', 'dwk_style' );

 

 // Settings page
add_action('admin_menu', 'dwk_plugin_settings');

function dwk_plugin_settings() {
    add_submenu_page('edit.php?post_type=dwk-image-maping', __('Docoumentation','menu-test'), __('Docoumentation','menu-test'), 'manage_options', 'dwk_docoumentation', 'dwk_display_docoumentation');
    

    function dwk_display_docoumentation() {?>
        <div class="wrap dwk-wrap">
            <h2>Front End Plugin Usage</h2>
            <p><strong>Plugin shortcode: (Use this on a post or page)</strong></p>
            <p>[dwk_imagemaping]</p>
            <hr>
            <p><strong>Template Tag: (Use this in a template)</strong></p>
            <pre>&lt;?php echo do_shortcode('[dwk_imagemaping]');?&gt;</pre>
            <hr>
            Author: Niresh Shrestha <a href="https://www.dewebkiller.com" target="_blank">Blog</a> | 
            <a href="https://niresh.com.np/" target="_blank">Website</a> | 
            <a href="https://facebook.com/dewebkiller" target="_blank">Facebook</a> | 
            <a href="https://www.linkedin.com/in/dewebkiller/" target="_blank">Linkedin</a>
        </div>
    <?php }
}