<?php
    /**
    * Import needed files
    **/
    require_once plugin_dir_path(__FILE__) . 'wp-dog-pedigree-activation-hook.php';
    require_once plugin_dir_path(__FILE__) . 'wp-dog-pedigree-deactivation-hook.php';
    include_once('wp-dog-pedigree-public.php');

    /**
    * Add the stylesheet for the public pages
    **/
    add_action('wp_enqueue_scripts', 'prefix_add_wp_dog_stylesheet');
    function prefix_add_wp_dog_stylesheet()
    {
        wp_register_style('prefix-style', plugins_url('../public/css/wp-pedigree-style.css', __FILE__));
        wp_enqueue_style('prefix-style');
    }
    /**
    * Add the stylesheet for the admin pages
    **/
    add_action('admin_enqueue_scripts', 'prefix_add_wp_dog_adminstyle_css_and_js');
    function prefix_add_wp_dog_adminstyle_css_and_js($hook) {
        $current_screen = get_current_screen();

        if ( strpos($current_screen->base, 'wp_dog_pedigree_Admin') === false) {
            return;
        } else {

            wp_enqueue_style('boot_css', plugins_url('../public/css/wp-pedigree-style.css',__FILE__ ));
            //wp_enqueue_script('boot_js', plugins_url('inc/bootstrap.js',__FILE__ ));
            //wp_enqueue_script('ln_script', plugins_url('inc/main_script.js', __FILE__), ['jquery'], false, true);
            }
    }

    /**
    * Add WPPED Menu to the Admin Control Panel
    **/
    add_action( 'admin_menu', 'wp_dog_pedigree_ACP_Menu_Page' );
    function wp_dog_pedigree_ACP_Menu_Page()
    {
        add_menu_page(
            __('Dog Pedigree - Plugin','wp-dog-pedigree'),
            __('Dog Pedigree','wp-dog-pedigree'),
            'manage_options',
            'wp_dog_pedigree_Admin',
            'wp_dog_pedigree_Admin_Contents',
            'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBVcGxvYWRlZCB0bzogU1ZHIFJlcG8sIHd3dy5zdmdyZXBvLmNvbSwgR2VuZXJhdG9yOiBTVkcgUmVwbyBNaXhlciBUb29scyAtLT4NCjxzdmcgZmlsbD0iIzAwMDAwMCIgaGVpZ2h0PSI4MDBweCIgd2lkdGg9IjgwMHB4IiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiANCgkgdmlld0JveD0iMCAwIDUxMiA1MTIiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPGc+DQoJCTxnPg0KCQkJPHBhdGggZD0iTTExNS42NTIsMzA2LjMwNGM0LjE4MSwyLjA3NCw5LjI4NCwwLjQwMSwxMS40MDEtMy43ODljMi4xMjUtNC4xODEsMC40NDQtOS4zMS0zLjcyOS0xMS40Ng0KCQkJCWMtMS4yMzctMC42NC0zMC40NTUtMTYuMTcxLTM4LjExLTYyLjA2M2MtMC42MjMtMy43NzItMy42ODYtNi42NjQtNy41MDEtNy4wNzRjLTMuOS0wLjQzNS03LjQxNSwxLjc2Ni04Ljg0MSw1LjMwOA0KCQkJCWMtMTguNTE3LDQ2LjMxLDE2LjQwMSw5OS41MzMsMTcuODk0LDEwMS43NzdjMS42MzgsMi40NjYsNC4zNTIsMy43OTcsNy4xLDMuNzk3YzEuNjIxLDAsMy4yNjgtMC40NjksNC43MjctMS40MzQNCgkJCQljMy45MTctMi42MTEsNC45ODMtNy45MDIsMi4zODEtMTEuODI3Yy0wLjIxMy0wLjMyNC0xNC42Ni0yMi40MTctMTkuMTE1LTQ4LjQzNUM5NS44OTgsMjk2LjEzMiwxMTQuNTUxLDMwNS43NDksMTE1LjY1MiwzMDYuMzA0DQoJCQkJeiIvPg0KCQkJPHBhdGggZD0iTTE1NS4yNzMsMzI0LjA5NmM0LjYxNy0wLjkyMiw3LjYyLTUuNDE5LDYuNjk5LTEwLjAzNWMtMC45My00LjYxNy01LjM3Ni03LjYyLTEwLjA0NC02LjY5DQoJCQkJYy0xNy4xMjYsMy40MjItNDkuNTI4LDIyLjA2Ny00OS41MjgsNjguMDk2YzAsMzMuMzk5LDYuOTk3LDU2LjU2OCwxMi4zOTksNjkuNDUzYy0xOC42OCwzLjYyNy0yOS40NjYsMTUuMzc3LTI5LjQ2NiwzMi45NDcNCgkJCQlDODUuMzMzLDQ5Ny42NDcsMTAzLjI3OSw1MTIsMTI4LDUxMmg4LjUzM2MxNC4xNDgsMCwyMi44NTItMTAuNjA3LDIzLjc5MS0xMS44MWMyLjkwMS0zLjcxMiwyLjI0NC05LjA3OS0xLjQ3Ni0xMS45ODENCgkJCQljLTMuNzEyLTIuOTEtOS4wNzktMi4yMzYtMTEuOTcyLDEuNDY4Yy0wLjA0MywwLjA2LTQuMzc4LDUuMjU3LTEwLjM0Miw1LjI1N0gxMjhjLTEyLjcyMywwLTI1LjYtNS44NjItMjUuNi0xNy4wNjcNCgkJCQljMC00LjIyNCwwLTE3LjA2NywyNS42LTE3LjA2N2MzLjEzMiwwLDUuOTk5LTEuNzMyLDcuNDkyLTQuNDg5YzEuNDkzLTIuNzU2LDEuMzQtNi4xMTgtMC4zNjctOC43MzgNCgkJCQljLTAuMTYyLTAuMjQ3LTE1LjY1OS0yNC41NTktMTUuNjU5LTcyLjEwN0MxMTkuNDY3LDMzMi4xOTQsMTUzLjg1NiwzMjQuNDAzLDE1NS4yNzMsMzI0LjA5NnoiLz4NCgkJCTxwYXRoIGQ9Ik0zOTcuMjAxLDQ0NC45MTljNS40MDItMTIuODg1LDEyLjM5OS0zNi4wNTMsMTIuMzk5LTY5LjQ1M2MwLTQ2LjAyOS0zMi40MDEtNjQuNjc0LTQ5LjUyNy02OC4wOTYNCgkJCQljLTQuNjI1LTAuOTEzLTkuMTE0LDIuMDY1LTEwLjA0NCw2LjY5Yy0wLjkyMiw0LjYxNywyLjA4Miw5LjExNCw2LjY5OSwxMC4wMzVjMS40NjgsMC4yOTksMzUuODA2LDcuNjcyLDM1LjgwNiw1MS4zNzENCgkJCQljMCw0Ny41NDgtMTUuNDk3LDcxLjg1OS0xNS42MzMsNzIuMDY0Yy0xLjc0MSwyLjYyLTEuOTExLDUuOTktMC40MjcsOC43NjRjMS40ODUsMi43NzMsNC4zNzgsNC41MDYsNy41MjYsNC41MDYNCgkJCQljMjUuNiwwLDI1LjYsMTIuODQzLDI1LjYsMTcuMDY3YzAsMTEuMjA0LTEyLjg3NywxNy4wNjctMjUuNiwxNy4wNjdoLTguNTMzYy01Ljg4OCwwLTEwLjIyMy01LjExMS0xMC4zOTQtNS4zMTYNCgkJCQljLTIuOTEtMy42NDQtOC4yMjYtNC4yOTItMTEuOTIxLTEuNDA4Yy0zLjcyMSwyLjkwMS00LjM3OCw4LjI2OS0xLjQ3NiwxMS45ODFjMC45MzksMS4yMDMsOS42NDMsMTEuODEsMjMuNzkxLDExLjgxSDM4NA0KCQkJCWMyNC43MywwLDQyLjY2Ny0xNC4zNTMsNDIuNjY3LTM0LjEzM0M0MjYuNjY3LDQ2MC4yOTcsNDE1Ljg4MSw0NDguNTQ2LDM5Ny4yMDEsNDQ0LjkxOXoiLz4NCgkJCTxwYXRoIGQ9Ik0zMDguNjM0LDQ0NC4zODJsMTUuNTE0LTkzLjEwN2MwLjc3Ni00LjY1MS0yLjM2NC05LjA0NS03LjAxNC05LjgyMmMtNC42NjgtMC43NjgtOS4wNDUsMi4zNjQtOS44MTMsNy4wMDYNCgkJCQlsLTE1Ljg4MSw5NS4yNzVoLTEuMzA2Yy00LjcxOSwwLTguNTMzLDMuODIzLTguNTMzLDguNTMzYzAsNC43MSwzLjgxNCw4LjUzMyw4LjUzMyw4LjUzM2g4LjUzM2MyNS42LDAsMjUuNiwxMi44NDMsMjUuNiwxNy4wNjcNCgkJCQljMCwxMS4yMDQtMTIuODc3LDE3LjA2Ny0yNS42LDE3LjA2N2gtOC41MzNjLTE0LjExNCwwLTI1LjYtMTEuNDg2LTI1LjYtMjUuNlYzNDkuODY3YzAtNC43MS0zLjgxNC04LjUzMy04LjUzMy04LjUzMw0KCQkJCWMtNC43MTksMC04LjUzMywzLjgyMy04LjUzMyw4LjUzM3YxMTkuNDY3YzAsMTQuMTE0LTExLjQ4NiwyNS42LTI1LjYsMjUuNmgtOC41MzNjLTEyLjcyMywwLTI1LjYtNS44NjItMjUuNi0xNy4wNjcNCgkJCQljMC00LjIyNCwwLTE3LjA2NywyNS42LTE3LjA2N2g4LjUzM2M0LjcxOSwwLDguNTMzLTMuODIzLDguNTMzLTguNTMzYzAtNC43MS0zLjgxNC04LjUzMy04LjUzMy04LjUzM2gtMS4zMDZsLTE1Ljg4LTk1LjI3NQ0KCQkJCWMtMC43NTktNC42NDItNS4xNTQtNy43NzQtOS44MTMtNy4wMDZjLTQuNjUxLDAuNzc3LTcuNzkxLDUuMTcxLTcuMDE0LDkuODIybDE1LjUxNCw5My4xMDcNCgkJCQljLTIwLjY2OCwyLjg1OS0zMi43LDE0LjkyNS0zMi43LDMzLjQ4NWMwLDE5Ljc4LDE3Ljk0NiwzNC4xMzMsNDIuNjY3LDM0LjEzM2g4LjUzM2MxMy45NDMsMCwyNi4zNDItNi43MjQsMzQuMTMzLTE3LjA5Mg0KCQkJCUMyNjMuNzkxLDUwNS4yNzYsMjc2LjE5LDUxMiwyOTAuMTMzLDUxMmg4LjUzM2MyNC43MywwLDQyLjY2Ny0xNC4zNTMsNDIuNjY3LTM0LjEzMw0KCQkJCUMzNDEuMzMzLDQ1OS4zMDcsMzI5LjMwMSw0NDcuMjQxLDMwOC42MzQsNDQ0LjM4MnoiLz4NCgkJCTxwYXRoIGQ9Ik00NjguNDI5LDcyLjk4NkM0NDkuNjczLDM1LjQ2NSw0MDQuNDg5LDAsMzc1LjQ2NywwYy0xNi40NzgsMC00NC44MzQsMjUuNTQ5LTU5LjA3NiwzOS40NzUNCgkJCQlDMjk5LjkzLDI1LjM3LDI3OS44OTMsMTcuMDY3LDI1NiwxNy4wNjdzLTQzLjkzLDguMzAzLTYwLjM5LDIyLjQwOUMxODEuMzY3LDI1LjU0OSwxNTMuMDExLDAsMTM2LjUzMywwDQoJCQkJYy0yOS4wMjIsMC03NC4yMDYsMzUuNDY1LTkyLjk2Miw3Mi45ODZjLTUuNjQ5LDExLjI4MS05LjQzOCwyNi41My05LjQzOCwzNy45NDhjMCwyMy41MjYsMTkuMTQsNDIuNjY3LDQyLjY2Nyw0Mi42NjcNCgkJCQljMjEuMjA1LDAsMzAuNjk0LTEzLjk0MywzOC4zMDYtMjUuMTQ4YzAuOTMtMS4zNTcsMS44NTItMi43MjIsMi45MjctNC4yNWwzNC4xMzMtNTEuMmMyLjYyLTMuOTI1LDEuNTYyLTkuMjI1LTIuMzY0LTExLjgzNg0KCQkJCWMtMy45NDItMi42MjgtOS4yMjUtMS41NjItMTEuODM2LDIuMzY0bC0zNC4wMDUsNTEuMDEyYy0xLjAwNywxLjQyNS0xLjk4OCwyLjg2Ny0yLjk3LDQuMzA5DQoJCQkJYy03LjY3MiwxMS4yOTgtMTIuNTg3LDE3LjY4MS0yNC4xOTIsMTcuNjgxYy0xNC4xMTQsMC0yNS42LTExLjQ4Ni0yNS42LTI1LjZjMC04Ljg2NiwzLjE0LTIxLjMzMyw3LjYzNy0zMC4zMTkNCgkJCQljMTYuODExLTMzLjYzLDU3LjQ1NS02My41NDgsNzcuNjk2LTYzLjU0OGM3LjI3OSwwLDI4Ljk0NSwxNi45NDcsNDcuMDEsMzQuNTA5Yy0zMi4wNiwzNy4yNzQtNDcuMDEsOTkuNjc4LTQ3LjAxLDE2MS43NTgNCgkJCQljMCw3OC43ODgsMzQuNjExLDExMC45MzMsMTE5LjQ2NywxMTAuOTMzczExOS40NjctMzIuMTQ1LDExOS40NjctMTEwLjkzM2MwLTYyLjA4OS0xNC45NS0xMjQuNDg0LTQ3LjAxLTE2MS43NTgNCgkJCQljMTguMDY1LTE3LjU2MiwzOS43MjMtMzQuNTA5LDQ3LjAxLTM0LjUwOWMyMC4yNDEsMCw2MC44ODUsMjkuOTE4LDc3LjcwNSw2My41NDhjNC40ODksOC45ODYsNy42MjksMjEuNDUzLDcuNjI5LDMwLjMxOQ0KCQkJCWMwLDE0LjExNC0xMS40ODYsMjUuNi0yNS42LDI1LjZjLTEyLjAyMywwLTE2Ljc2OC02LjMxNS0yNC43NzItMTguNDA2bC0zNi4zOTUtNTQuNTk2Yy0yLjYxMS0zLjkyNS03LjkxLTQuOTkyLTExLjgzNi0yLjM2NA0KCQkJCWMtMy45MjUsMi42MTEtNC45ODMsNy45MS0yLjM2NCwxMS44MzZsMzYuMzYxLDU0LjU0NWM4LjA5LDEyLjIxMSwxNy4yNDYsMjYuMDUyLDM5LjAwNiwyNi4wNTINCgkJCQljMjMuNTI2LDAsNDIuNjY3LTE5LjE0LDQyLjY2Ny00Mi42NjdDNDc3Ljg2Nyw5OS41MTYsNDc0LjA3OCw4NC4yNjcsNDY4LjQyOSw3Mi45ODZ6IE0zNTguNCwyMTMuMzMzDQoJCQkJYzAsNjkuMzA4LTI2LjgwMyw5My44NjctMTAyLjQsOTMuODY3cy0xMDIuNC0yNC41NTktMTAyLjQtOTMuODY3YzAtODkuMTk5LDMxLjY2Ny0xNzkuMiwxMDIuNC0xNzkuMg0KCQkJCVMzNTguNCwxMjQuMTM0LDM1OC40LDIxMy4zMzN6Ii8+DQoJCQk8cGF0aCBkPSJNMjk5LjYxNCwyNTIuMDkyYy0xLjQ1OSwyLjg0Mi03LjE1OSwzLjg3NC05LjQ4MSwzLjkwOGMtOS45OTIsMC0yMC4zMTgtOC41MDgtMjQuMDQ3LTE4LjI4Nw0KCQkJCWMxNC4wMjktMy4xNzQsMjQuMDQ3LTEyLjY4OSwyNC4wNDctMjQuMzhjMC0xNC4zNTMtMTQuOTkzLTI1LjYtMzQuMTMzLTI1LjZzLTM0LjEzMywxMS4yNDctMzQuMTMzLDI1LjYNCgkJCQljMCwxMS42OTEsMTAuMDE4LDIxLjIwNSwyNC4wNDcsMjQuMzhDMjQyLjE5MywyNDcuNDkyLDIzMS44NjgsMjU2LDIyMS45MjYsMjU2Yy0yLjQ0OS0wLjAzNC04LjAzLTEuMDY3LTkuNTkxLTQuMDAyDQoJCQkJYy0yLjIxLTQuMTY0LTcuMzczLTUuNzQzLTExLjUzNy0zLjUzM3MtNS43NTEsNy4zNzMtMy41MzMsMTEuNTM3YzYuNzQxLDEyLjY5OCwyMi43OTMsMTMuMDY1LDI0LjYwMiwxMy4wNjUNCgkJCQljMTMuMjUyLDAsMjYuMDY5LTcuNTY5LDM0LjEzMy0xOC4zOThjOC4wNjQsMTAuODI5LDIwLjg4MSwxOC4zOTgsMzQuMTMzLDE4LjM5OGMxLjgyNiwwLDE4LjA1Ny0wLjM3NSwyNC42NTMtMTMuMTU4DQoJCQkJYzIuMTU5LTQuMTksMC41MTItOS4zMzUtMy42NzgtMTEuNDk0UzMwMS43ODEsMjQ3Ljg5MywyOTkuNjE0LDI1Mi4wOTJ6IE0yNTYsMjIxLjg2N2MtMTAuMjU3LDAtMTcuMDY3LTUuMTM3LTE3LjA2Ny04LjUzMw0KCQkJCWMwLTMuMzk2LDYuODEtOC41MzMsMTcuMDY3LTguNTMzYzEwLjQxOSwwLDE3LjA2Nyw1LjA1MiwxNy4wNjcsOC41MzNDMjczLjA2NywyMTYuODE1LDI2Ni40MTksMjIxLjg2NywyNTYsMjIxLjg2N3oiLz4NCgkJCTxwYXRoIGQ9Ik0yOTQuNCwxNTMuNmM3LjA1NywwLDEyLjgtNS43NDMsMTIuOC0xMi44cy01Ljc0My0xMi44LTEyLjgtMTIuOGMtNy4wNTcsMC0xMi44LDUuNzQzLTEyLjgsMTIuOA0KCQkJCVMyODcuMzQzLDE1My42LDI5NC40LDE1My42eiIvPg0KCQkJPHBhdGggZD0iTTIxNy42LDE1My42YzcuMDU3LDAsMTIuOC01Ljc0MywxMi44LTEyLjhzLTUuNzQzLTEyLjgtMTIuOC0xMi44cy0xMi44LDUuNzQzLTEyLjgsMTIuOFMyMTAuNTQzLDE1My42LDIxNy42LDE1My42eiIvPg0KCQk8L2c+DQoJPC9nPg0KPC9nPg0KPC9zdmc+',
            6
        );
        //add submenu
        add_submenu_page(
            'wp_dog_pedigree_Admin',
            __('Add Dogs','wp-dog-pedigree'),
            __('Add Dogs','wp-dog-pedigree'),
            'manage_options',
            'wp_dog_pedigree_Admin',
            'wp_dog_pedigree_Admin_Contents');
        add_submenu_page(
            'wp_dog_pedigree_Admin',
            __('List Dogs','wp-dog-pedigree'),
            __('List Dogs','wp-dog-pedigree'),
            'manage_options',
            'wp_dog_pedigree_Admin_ListDogs',
            'wp_dog_pedigree_Admin_ListDogs');
        add_submenu_page(
            'wp_dog_pedigree_Admin',
            __('List Owner','wp-dog-pedigree'),
            __('List Owner','wp-dog-pedigree'),
            'manage_options',
            'wp_dog_pedigree_Admin_ListOwner',
            'wp_dog_pedigree_Admin_ListOwner');
        add_submenu_page(
            'wp_dog_pedigree_Admin',
            __('List Titles','wp-dog-pedigree'),
            __('List Titles','wp-dog-pedigree'),
            'manage_options',
            'wp_dog_pedigree_Admin_ListTitles',
            'wp_dog_pedigree_Admin_ListTitles');
    }


    /**
    * Add the content for the admin menu
    **/
    function wp_dog_pedigree_Admin_Contents() {
        include_once('wp-dog-pedigree-admin.php');
    }

    function wp_dog_pedigree_Admin_ListDogs() {
        include_once('wp-dog-pedigree-admin-listdogs.php');
    }

    function wp_dog_pedigree_Admin_ListOwner() {
        include_once('wp-dog-pedigree-admin-listowner.php');
    }

    function wp_dog_pedigree_Admin_ListTitles() {
        include_once('wp-dog-pedigree-admin-listtitles.php');
    }

    /**
    * Import csv file to database_table
    **/
    add_action( 'admin_post_import_csv', 'wp_dog_pedigree_admin_import_csv' );
    

    /**
    * Add a new pedigree to database_table
    **/
    add_action( 'admin_post_submit_add_pedigree', 'wp_dog_pedigree_admin_add_pedigree' );
    function wp_dog_pedigree_admin_add_pedigree() {
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' );
        global $wpdb;
        if (
            !empty($_POST)
            && $_POST['name'] != ''
            && $_FILES['dogimage'] != ''
            && $_POST['owner'] != ''
            && $_POST['breeder'] != ''
            && $_POST['gender'] != ''
            && $_POST['color'] != ''
            && $_POST['HD_value'] != ''
            && $_POST['fur_type'] != ''
            && $_POST['champion'] != ''
            && $_POST['mchampion'] != ''
            && $_POST['stud_dog'] != ''
            && $_POST['father'] != ''
            && $_POST['mother'] != ''
            && $_POST['dog_breed_conditions'] != ''
            && $_POST['dog_miss_tooth'] != ''
            && $_POST['birthday_date'] != ''
            && $_POST['deathday_date'] != ''
            && $_POST['studbook_nr'] != ''
            && $_POST['shoulder_height'] != ''
        ) {
            $table_name = $wpdb->prefix . 'dogpedigree_dogs';
            $dog_name = sanitize_text_field($_POST['name']);
            $attachment_id = media_handle_upload('dogimage', 0 );
            $owner = sanitize_text_field($_POST['owner']);
            $breeder = sanitize_text_field($_POST['breeder']);
            $gender = sanitize_text_field($_POST['gender']);
            $color = sanitize_text_field($_POST['color']);
            $hd_value = sanitize_text_field($_POST['HD_value']);
            $fur_type = sanitize_text_field($_POST['fur_type']);
            $champion = sanitize_text_field($_POST['champion']);
            $multi = sanitize_text_field($_POST['mchampion']);
            $father = sanitize_text_field($_POST['father']);
            $mother = sanitize_text_field($_POST['mother']);
            $stud_dog = sanitize_text_field($_POST['stud_dog']);
            $dog_breed_conditions = sanitize_text_field($_POST['dog_breed_conditions']);
            $dog_miss_tooth = sanitize_text_field($_POST['dog_miss_tooth']);
            $birthday_date = sanitize_text_field($_POST['birthday_date']);
            $deathday_date = sanitize_text_field($_POST['deathday_date']);
            $studbook_nr = sanitize_text_field($_POST['studbook_nr']);
            $shoulder_height = sanitize_text_field($_POST['shoulder_height']);

            if(is_wp_error($attachment_id)){
                echo "Error uploading file: " . $attachment_id->get_error_message();
            }else{
                echo "File upload successful!";
            }

            $file_url = wp_get_attachment_url($attachment_id);

            $success=$wpdb->insert(
                $table_name,
                array(
                    'name' => $dog_name,
                    'owner' => $owner,
                    'dog_image' => $file_url,
                    'breeder' => $breeder,
                    'gender' => $gender,
                    'color' => $color,
                    'HD_value' => $hd_value,
                    'fur_type' => $fur_type,
                    'champion' => $champion,
                    'multi' => $multi,
                    'father' => $father,
                    'mother' => $mother,
                    'stud_dog' => $stud_dog,
                    'dog_breed_conditions' => $dog_breed_conditions,
                    'dog_miss_tooth' => $dog_miss_tooth,
                    'birthday' => $birthday_date,
                    'deathday' => $deathday_date,
                    'studbook_nr' => $studbook_nr,
                    'shoulder_height' => $shoulder_height
                )
            );
            if ($success) {
                wp_redirect( admin_url( 'admin.php?page=wp_dog_pedigree_Admin&success=true' ) );
            } else {
                wp_redirect( admin_url( 'admin.php?page=wp_dog_pedigree_Admin&success=false' ) );
            }
        }
    }

    /**
    * Add a new title to the dog_title database_table
    **/
    add_action( 'admin_post_submit_add_title', 'wp_dog_pedigree_admin_add_pedigree_dog_title' );
    function wp_dog_pedigree_admin_add_pedigree_dog_title() {
        global $wpdb;
        if (
            !empty($_POST)
            && $_POST['dogname'] != ''
            && $_POST['title'] != ''
        ) {

            $table_name = $wpdb->prefix . 'dogpedigree_dog_title';
            $title = sanitize_text_field($_POST['title']);
            $dogname = sanitize_text_field($_POST['dogname']);
            
            $success=$wpdb->insert(
                $table_name,
                array(
                    'title' => $title,
                    'dogid' => $dogname
                )
            );
            if ($success) {
                wp_redirect( admin_url( 'admin.php?page=wp_dog_pedigree_Admin&success=true' ) );
            } else {
                wp_redirect( admin_url( 'admin.php?page=wp_dog_pedigree_Admin&success=false' ) );
            }
        }
    }

    /**
    * Add a new owner to the database_table
    **/
    add_action( 'admin_post_submit_add_pedigree_dog_owner', 'wp_dog_pedigree_admin_add_pedigree_dog_owner' );
    function wp_dog_pedigree_admin_add_pedigree_dog_owner() {
        global $wpdb;
        if (
            !empty($_POST)
            && $_POST['name'] != ''
            && $_POST['street'] != ''
            && $_POST['zip'] != ''
            && $_POST['city'] != ''
            && $_POST['country'] != ''
            && $_POST['phone'] != ''
            && $_POST['mobile'] != ''
            && $_POST['email'] != ''
        ) {

            $table_name = $wpdb->prefix . 'dogpedigree_owners';
            $owner_name = sanitize_text_field($_POST['name']);
            $street = sanitize_text_field($_POST['street']);
            $zip = sanitize_text_field($_POST['zip']);
            $city = sanitize_text_field($_POST['city']);
            $country = sanitize_text_field($_POST['country']);
            $phone = sanitize_text_field($_POST['phone']);
            $mobile = sanitize_text_field($_POST['mobile']);
            $email = sanitize_text_field($_POST['email']);
            
            $success=$wpdb->insert(
                $table_name,
                array(
                    'name' => $owner_name,
                    'street' => $street,
                    'zip' => $zip,
                    'city' => $city,
                    'country' => $country,
                    'phone' => $phone,
                    'mobile' => $mobile,
                    'email' => $email
                )
            );
            if ($success) {
                wp_redirect( admin_url( 'admin.php?page=wp_dog_pedigree_Admin&success=true' ) );
            } else {
                wp_redirect( admin_url( 'admin.php?page=wp_dog_pedigree_Admin&success=false' ) );
            }
        }
    }

    /**
    * Delete a pedigree from the database_table
    **/
    add_action( 'admin_post_delete_pedigree', 'wp_dog_pedigree_admin_delete_pedigree' );
    function wp_dog_pedigree_admin_delete_pedigree() {
        global $wpdb;
        $success=$wpdb->delete(
            $wpdb->prefix . 'dogpedigree_dogs',
            array( 'ID' => $_GET['id'] )
        );
        if ($success) {
            wp_redirect( admin_url( 'admin.php?page=wp_dog_pedigree_Admin&success=true' ) );
        } else {
            wp_redirect( admin_url( 'admin.php?page=wp_dog_pedigree_Admin&success=false' ) );
        }
    }
