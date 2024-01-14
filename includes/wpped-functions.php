<?php
    /**
    ** Add the stylesheet for the plugin
    **/
        // Add the stylesheet for the plugin
    add_action('wp_enqueue_scripts', 'prefix_add_my_stylesheet');
    function prefix_add_my_stylesheet()
    {
        wp_register_style('prefix-style', plugins_url('public/css/wp-pedigree-style.css', __FILE__));
        wp_enqueue_style('prefix-style');
    }

    /**
    ** Add my new menu to the Admin Control Panel
    **/
    // Hook the 'admin_menu' action hook, run the function named 'wpped_ACP_Menu_Page()'
    add_action( 'admin_menu', 'wpped_ACP_Menu_Page' );
    function wpped_ACP_Menu_Page()
    {
        add_menu_page(
            __('Dog Pedigree - Plugin','wp-pedigree'),
            __('Dog Pedigree','wp-pedigree'),
            'manage_options',
            'wpped_Admin',
            'wpped_Admin_Contents',
            plugins_url( '/public/images/dog.svg', __FILE__ ),
            6
        );
    }

    /**
    ** Add the content for the admin menu
    **/
    function wpped_Admin_Contents() {
        include('wpped-admin.php');
    }