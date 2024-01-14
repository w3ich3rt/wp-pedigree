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
    // Hook the 'admin_menu' action hook, run the function named 'wpped_Menu_Page()'
    add_action( 'admin_menu', 'wpped_Menu_Page' );
    // Add a new top level menu link to the ACP
    function wpped_Menu_Page()
    {
        add_menu_page(
            __('Dog Pedigree - Plugin','wp-pedigree'), // Title of the page
            __('Dog Pedigree','wp-pedigree'), // Text to show on the menu link
            'manage_options', // Capability requirement to see the link
            'wpped_Admin', // The 'slug' - file to display when clicking the link
            'wpped_Admin_Contents',
            'public/images/dog.svg',
            6
        );
    }

    /**
    ** Add the content for the admin menu
    **/
    function wpped_Admin_Contents() {
        include_once('includes/wpped-admin.php');
    }