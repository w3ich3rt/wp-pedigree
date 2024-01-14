<?php
    /**
    ** Add my new menu to the Admin Control Panel
    **/

    // Hook the 'admin_menu' action hook, run the function named 'wpped_Add_My_Admin_Link()'
    add_action( 'admin_menu', 'wpped_Add_My_Admin_Link' );
    // Add a new top level menu link to the ACP
    function wpped_Add_My_Admin_Link()
    {
        add_menu_page(
            'Dog Pedigree - Plugin', // Title of the page
            'Dog Pedigree', // Text to show on the menu link
            'manage_options', // Capability requirement to see the link
            'includes/wpped-menu-page.php' // The 'slug' - file to display when clicking the link
        );
    }
