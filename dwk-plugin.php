<?php

/**
 * Plugin Name: Dwk Plugin
 * Plugin URI: https://niresh.com.np/
 * Description: A custom made plugin for image mapping
 * Version:1.0
 * Author: Niresh Shrestha
 * Text Domain: Dwk_Plugin
 * License: GPLv3 or later
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


/**
 * Initialize Dwk_Plugin class
 */
if (!class_exists('Dwk_Plugin')) {

    class Dwk_Plugin {

        /**
         * Class constructor
         */
        function __construct() {

            add_action('admin_menu', array($this, 'Dwk_Plugin_register_menu_page'));
            add_action('admin_enqueue_scripts', array($this, 'Dwk_Plugin_admin_scripts_style'));
        }

        /**
         * Enqueue required admin styles and scripts.
         */
        public function Dwk_Plugin_admin_scripts_style() {
            wp_enqueue_style('admin-style', plugin_dir_url(__FILE__) . 'assets/css/admin-style.css');
            wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap');

            wp_enqueue_script('jquery');
           
        }

        /**
         * Add menu page.
         */
        public function Dwk_Plugin_register_menu_page() {
           // add_menu_page(__('Settings', 'Dwk_Plugin'), 'Image maping', 'manage_options', 'dwk-plugin', array($this, 'Dwk_Plugin_add_setting_page'), '', 20);
          //  add_submenu_page('edit.php?post_type=dwk-image-maping', __('Settings', 'Dwk_Plugin'), __('Settings', 'Dwk_Plugin'), 'manage_options', 'dwk-plugin-settings', array($this, 'Dwk_Plugin_add_setting_page'));
           // add_submenu_page('edit.php?post_type=dwk-image-maping',__('Settings','dwk-plugin'), __('Settings','dwk-plugin'), 'manage_options', 'dwk-plugins', 'dwk-plugins');

        }
        

        /**
         * Callback function of add_menu_page. Displays the page's content.
         */
        public function Dwk_Plugin_add_setting_page() {
            require plugin_dir_path(__FILE__) . 'dwk-plugin-settings.php';
            
        }

        
    }

    add_action('wp_enqueue_scripts', 'dwk_styles1');

    function dwk_styles1() {
        wp_register_style('dwk_example1', plugin_dir_url(__FILE__) . 'assets/css/public.css');
        wp_enqueue_style('dwk_example1');
    }

    function dwk_scripts() {

        wp_enqueue_script('jquery','https://code.jquery.com/jquery-2.2.4.min.js','','',true);
            wp_enqueue_script('imagemapster', 'https://www.pindi.ee/wp-content/themes/newtime/vendor/imagemapster/js/jquery.imagemapster.js?ver=1.2','','',true);
        wp_enqueue_script('dwk-script', plugin_dir_url(__FILE__) . 'assets/js/script.js','','',true);
        wp_enqueue_script('map-script', plugin_dir_url(__FILE__) . 'assets/js/map.js','','',true);

    }

    add_action('wp_enqueue_scripts', 'dwk_scripts');

    require_once(dirname(__FILE__).'/image-maping.php');
    require_once(dirname(__FILE__).'/dwk-plugin-settings.php');
    require_once(dirname(__FILE__).'/shortcode.php');
    require_once(dirname(__FILE__).'/meta-box.php');

    $Dwk_Plugin = new Dwk_Plugin();
}