<?php
    /**
    * Import needed files
    **/
    require_once plugin_dir_path(__FILE__) . 'wp-dog-pedigree-activation-hook.php';
    require_once plugin_dir_path(__FILE__) . 'wp-dog-pedigree-deactivation-hook.php';

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
            __('Dog Pedigree - Plugin','wp-pedigree'),
            __('Dog Pedigree','wp-pedigree'),
            'manage_options',
            'wp_dog_pedigree_Admin',
            'wp_dog_pedigree_Admin_Contents',
            'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pg0KPCEtLSBVcGxvYWRlZCB0bzogU1ZHIFJlcG8sIHd3dy5zdmdyZXBvLmNvbSwgR2VuZXJhdG9yOiBTVkcgUmVwbyBNaXhlciBUb29scyAtLT4NCjxzdmcgZmlsbD0iIzAwMDAwMCIgaGVpZ2h0PSI4MDBweCIgd2lkdGg9IjgwMHB4IiB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiANCgkgdmlld0JveD0iMCAwIDUxMiA1MTIiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPGc+DQoJPGc+DQoJCTxnPg0KCQkJPHBhdGggZD0iTTExNS42NTIsMzA2LjMwNGM0LjE4MSwyLjA3NCw5LjI4NCwwLjQwMSwxMS40MDEtMy43ODljMi4xMjUtNC4xODEsMC40NDQtOS4zMS0zLjcyOS0xMS40Ng0KCQkJCWMtMS4yMzctMC42NC0zMC40NTUtMTYuMTcxLTM4LjExLTYyLjA2M2MtMC42MjMtMy43NzItMy42ODYtNi42NjQtNy41MDEtNy4wNzRjLTMuOS0wLjQzNS03LjQxNSwxLjc2Ni04Ljg0MSw1LjMwOA0KCQkJCWMtMTguNTE3LDQ2LjMxLDE2LjQwMSw5OS41MzMsMTcuODk0LDEwMS43NzdjMS42MzgsMi40NjYsNC4zNTIsMy43OTcsNy4xLDMuNzk3YzEuNjIxLDAsMy4yNjgtMC40NjksNC43MjctMS40MzQNCgkJCQljMy45MTctMi42MTEsNC45ODMtNy45MDIsMi4zODEtMTEuODI3Yy0wLjIxMy0wLjMyNC0xNC42Ni0yMi40MTctMTkuMTE1LTQ4LjQzNUM5NS44OTgsMjk2LjEzMiwxMTQuNTUxLDMwNS43NDksMTE1LjY1MiwzMDYuMzA0DQoJCQkJeiIvPg0KCQkJPHBhdGggZD0iTTE1NS4yNzMsMzI0LjA5NmM0LjYxNy0wLjkyMiw3LjYyLTUuNDE5LDYuNjk5LTEwLjAzNWMtMC45My00LjYxNy01LjM3Ni03LjYyLTEwLjA0NC02LjY5DQoJCQkJYy0xNy4xMjYsMy40MjItNDkuNTI4LDIyLjA2Ny00OS41MjgsNjguMDk2YzAsMzMuMzk5LDYuOTk3LDU2LjU2OCwxMi4zOTksNjkuNDUzYy0xOC42OCwzLjYyNy0yOS40NjYsMTUuMzc3LTI5LjQ2NiwzMi45NDcNCgkJCQlDODUuMzMzLDQ5Ny42NDcsMTAzLjI3OSw1MTIsMTI4LDUxMmg4LjUzM2MxNC4xNDgsMCwyMi44NTItMTAuNjA3LDIzLjc5MS0xMS44MWMyLjkwMS0zLjcxMiwyLjI0NC05LjA3OS0xLjQ3Ni0xMS45ODENCgkJCQljLTMuNzEyLTIuOTEtOS4wNzktMi4yMzYtMTEuOTcyLDEuNDY4Yy0wLjA0MywwLjA2LTQuMzc4LDUuMjU3LTEwLjM0Miw1LjI1N0gxMjhjLTEyLjcyMywwLTI1LjYtNS44NjItMjUuNi0xNy4wNjcNCgkJCQljMC00LjIyNCwwLTE3LjA2NywyNS42LTE3LjA2N2MzLjEzMiwwLDUuOTk5LTEuNzMyLDcuNDkyLTQuNDg5YzEuNDkzLTIuNzU2LDEuMzQtNi4xMTgtMC4zNjctOC43MzgNCgkJCQljLTAuMTYyLTAuMjQ3LTE1LjY1OS0yNC41NTktMTUuNjU5LTcyLjEwN0MxMTkuNDY3LDMzMi4xOTQsMTUzLjg1NiwzMjQuNDAzLDE1NS4yNzMsMzI0LjA5NnoiLz4NCgkJCTxwYXRoIGQ9Ik0zOTcuMjAxLDQ0NC45MTljNS40MDItMTIuODg1LDEyLjM5OS0zNi4wNTMsMTIuMzk5LTY5LjQ1M2MwLTQ2LjAyOS0zMi40MDEtNjQuNjc0LTQ5LjUyNy02OC4wOTYNCgkJCQljLTQuNjI1LTAuOTEzLTkuMTE0LDIuMDY1LTEwLjA0NCw2LjY5Yy0wLjkyMiw0LjYxNywyLjA4Miw5LjExNCw2LjY5OSwxMC4wMzVjMS40NjgsMC4yOTksMzUuODA2LDcuNjcyLDM1LjgwNiw1MS4zNzENCgkJCQljMCw0Ny41NDgtMTUuNDk3LDcxLjg1OS0xNS42MzMsNzIuMDY0Yy0xLjc0MSwyLjYyLTEuOTExLDUuOTktMC40MjcsOC43NjRjMS40ODUsMi43NzMsNC4zNzgsNC41MDYsNy41MjYsNC41MDYNCgkJCQljMjUuNiwwLDI1LjYsMTIuODQzLDI1LjYsMTcuMDY3YzAsMTEuMjA0LTEyLjg3NywxNy4wNjctMjUuNiwxNy4wNjdoLTguNTMzYy01Ljg4OCwwLTEwLjIyMy01LjExMS0xMC4zOTQtNS4zMTYNCgkJCQljLTIuOTEtMy42NDQtOC4yMjYtNC4yOTItMTEuOTIxLTEuNDA4Yy0zLjcyMSwyLjkwMS00LjM3OCw4LjI2OS0xLjQ3NiwxMS45ODFjMC45MzksMS4yMDMsOS42NDMsMTEuODEsMjMuNzkxLDExLjgxSDM4NA0KCQkJCWMyNC43MywwLDQyLjY2Ny0xNC4zNTMsNDIuNjY3LTM0LjEzM0M0MjYuNjY3LDQ2MC4yOTcsNDE1Ljg4MSw0NDguNTQ2LDM5Ny4yMDEsNDQ0LjkxOXoiLz4NCgkJCTxwYXRoIGQ9Ik0zMDguNjM0LDQ0NC4zODJsMTUuNTE0LTkzLjEwN2MwLjc3Ni00LjY1MS0yLjM2NC05LjA0NS03LjAxNC05LjgyMmMtNC42NjgtMC43NjgtOS4wNDUsMi4zNjQtOS44MTMsNy4wMDYNCgkJCQlsLTE1Ljg4MSw5NS4yNzVoLTEuMzA2Yy00LjcxOSwwLTguNTMzLDMuODIzLTguNTMzLDguNTMzYzAsNC43MSwzLjgxNCw4LjUzMyw4LjUzMyw4LjUzM2g4LjUzM2MyNS42LDAsMjUuNiwxMi44NDMsMjUuNiwxNy4wNjcNCgkJCQljMCwxMS4yMDQtMTIuODc3LDE3LjA2Ny0yNS42LDE3LjA2N2gtOC41MzNjLTE0LjExNCwwLTI1LjYtMTEuNDg2LTI1LjYtMjUuNlYzNDkuODY3YzAtNC43MS0zLjgxNC04LjUzMy04LjUzMy04LjUzMw0KCQkJCWMtNC43MTksMC04LjUzMywzLjgyMy04LjUzMyw4LjUzM3YxMTkuNDY3YzAsMTQuMTE0LTExLjQ4NiwyNS42LTI1LjYsMjUuNmgtOC41MzNjLTEyLjcyMywwLTI1LjYtNS44NjItMjUuNi0xNy4wNjcNCgkJCQljMC00LjIyNCwwLTE3LjA2NywyNS42LTE3LjA2N2g4LjUzM2M0LjcxOSwwLDguNTMzLTMuODIzLDguNTMzLTguNTMzYzAtNC43MS0zLjgxNC04LjUzMy04LjUzMy04LjUzM2gtMS4zMDZsLTE1Ljg4LTk1LjI3NQ0KCQkJCWMtMC43NTktNC42NDItNS4xNTQtNy43NzQtOS44MTMtNy4wMDZjLTQuNjUxLDAuNzc3LTcuNzkxLDUuMTcxLTcuMDE0LDkuODIybDE1LjUxNCw5My4xMDcNCgkJCQljLTIwLjY2OCwyLjg1OS0zMi43LDE0LjkyNS0zMi43LDMzLjQ4NWMwLDE5Ljc4LDE3Ljk0NiwzNC4xMzMsNDIuNjY3LDM0LjEzM2g4LjUzM2MxMy45NDMsMCwyNi4zNDItNi43MjQsMzQuMTMzLTE3LjA5Mg0KCQkJCUMyNjMuNzkxLDUwNS4yNzYsMjc2LjE5LDUxMiwyOTAuMTMzLDUxMmg4LjUzM2MyNC43MywwLDQyLjY2Ny0xNC4zNTMsNDIuNjY3LTM0LjEzMw0KCQkJCUMzNDEuMzMzLDQ1OS4zMDcsMzI5LjMwMSw0NDcuMjQxLDMwOC42MzQsNDQ0LjM4MnoiLz4NCgkJCTxwYXRoIGQ9Ik00NjguNDI5LDcyLjk4NkM0NDkuNjczLDM1LjQ2NSw0MDQuNDg5LDAsMzc1LjQ2NywwYy0xNi40NzgsMC00NC44MzQsMjUuNTQ5LTU5LjA3NiwzOS40NzUNCgkJCQlDMjk5LjkzLDI1LjM3LDI3OS44OTMsMTcuMDY3LDI1NiwxNy4wNjdzLTQzLjkzLDguMzAzLTYwLjM5LDIyLjQwOUMxODEuMzY3LDI1LjU0OSwxNTMuMDExLDAsMTM2LjUzMywwDQoJCQkJYy0yOS4wMjIsMC03NC4yMDYsMzUuNDY1LTkyLjk2Miw3Mi45ODZjLTUuNjQ5LDExLjI4MS05LjQzOCwyNi41My05LjQzOCwzNy45NDhjMCwyMy41MjYsMTkuMTQsNDIuNjY3LDQyLjY2Nyw0Mi42NjcNCgkJCQljMjEuMjA1LDAsMzAuNjk0LTEzLjk0MywzOC4zMDYtMjUuMTQ4YzAuOTMtMS4zNTcsMS44NTItMi43MjIsMi45MjctNC4yNWwzNC4xMzMtNTEuMmMyLjYyLTMuOTI1LDEuNTYyLTkuMjI1LTIuMzY0LTExLjgzNg0KCQkJCWMtMy45NDItMi42MjgtOS4yMjUtMS41NjItMTEuODM2LDIuMzY0bC0zNC4wMDUsNTEuMDEyYy0xLjAwNywxLjQyNS0xLjk4OCwyLjg2Ny0yLjk3LDQuMzA5DQoJCQkJYy03LjY3MiwxMS4yOTgtMTIuNTg3LDE3LjY4MS0yNC4xOTIsMTcuNjgxYy0xNC4xMTQsMC0yNS42LTExLjQ4Ni0yNS42LTI1LjZjMC04Ljg2NiwzLjE0LTIxLjMzMyw3LjYzNy0zMC4zMTkNCgkJCQljMTYuODExLTMzLjYzLDU3LjQ1NS02My41NDgsNzcuNjk2LTYzLjU0OGM3LjI3OSwwLDI4Ljk0NSwxNi45NDcsNDcuMDEsMzQuNTA5Yy0zMi4wNiwzNy4yNzQtNDcuMDEsOTkuNjc4LTQ3LjAxLDE2MS43NTgNCgkJCQljMCw3OC43ODgsMzQuNjExLDExMC45MzMsMTE5LjQ2NywxMTAuOTMzczExOS40NjctMzIuMTQ1LDExOS40NjctMTEwLjkzM2MwLTYyLjA4OS0xNC45NS0xMjQuNDg0LTQ3LjAxLTE2MS43NTgNCgkJCQljMTguMDY1LTE3LjU2MiwzOS43MjMtMzQuNTA5LDQ3LjAxLTM0LjUwOWMyMC4yNDEsMCw2MC44ODUsMjkuOTE4LDc3LjcwNSw2My41NDhjNC40ODksOC45ODYsNy42MjksMjEuNDUzLDcuNjI5LDMwLjMxOQ0KCQkJCWMwLDE0LjExNC0xMS40ODYsMjUuNi0yNS42LDI1LjZjLTEyLjAyMywwLTE2Ljc2OC02LjMxNS0yNC43NzItMTguNDA2bC0zNi4zOTUtNTQuNTk2Yy0yLjYxMS0zLjkyNS03LjkxLTQuOTkyLTExLjgzNi0yLjM2NA0KCQkJCWMtMy45MjUsMi42MTEtNC45ODMsNy45MS0yLjM2NCwxMS44MzZsMzYuMzYxLDU0LjU0NWM4LjA5LDEyLjIxMSwxNy4yNDYsMjYuMDUyLDM5LjAwNiwyNi4wNTINCgkJCQljMjMuNTI2LDAsNDIuNjY3LTE5LjE0LDQyLjY2Ny00Mi42NjdDNDc3Ljg2Nyw5OS41MTYsNDc0LjA3OCw4NC4yNjcsNDY4LjQyOSw3Mi45ODZ6IE0zNTguNCwyMTMuMzMzDQoJCQkJYzAsNjkuMzA4LTI2LjgwMyw5My44NjctMTAyLjQsOTMuODY3cy0xMDIuNC0yNC41NTktMTAyLjQtOTMuODY3YzAtODkuMTk5LDMxLjY2Ny0xNzkuMiwxMDIuNC0xNzkuMg0KCQkJCVMzNTguNCwxMjQuMTM0LDM1OC40LDIxMy4zMzN6Ii8+DQoJCQk8cGF0aCBkPSJNMjk5LjYxNCwyNTIuMDkyYy0xLjQ1OSwyLjg0Mi03LjE1OSwzLjg3NC05LjQ4MSwzLjkwOGMtOS45OTIsMC0yMC4zMTgtOC41MDgtMjQuMDQ3LTE4LjI4Nw0KCQkJCWMxNC4wMjktMy4xNzQsMjQuMDQ3LTEyLjY4OSwyNC4wNDctMjQuMzhjMC0xNC4zNTMtMTQuOTkzLTI1LjYtMzQuMTMzLTI1LjZzLTM0LjEzMywxMS4yNDctMzQuMTMzLDI1LjYNCgkJCQljMCwxMS42OTEsMTAuMDE4LDIxLjIwNSwyNC4wNDcsMjQuMzhDMjQyLjE5MywyNDcuNDkyLDIzMS44NjgsMjU2LDIyMS45MjYsMjU2Yy0yLjQ0OS0wLjAzNC04LjAzLTEuMDY3LTkuNTkxLTQuMDAyDQoJCQkJYy0yLjIxLTQuMTY0LTcuMzczLTUuNzQzLTExLjUzNy0zLjUzM3MtNS43NTEsNy4zNzMtMy41MzMsMTEuNTM3YzYuNzQxLDEyLjY5OCwyMi43OTMsMTMuMDY1LDI0LjYwMiwxMy4wNjUNCgkJCQljMTMuMjUyLDAsMjYuMDY5LTcuNTY5LDM0LjEzMy0xOC4zOThjOC4wNjQsMTAuODI5LDIwLjg4MSwxOC4zOTgsMzQuMTMzLDE4LjM5OGMxLjgyNiwwLDE4LjA1Ny0wLjM3NSwyNC42NTMtMTMuMTU4DQoJCQkJYzIuMTU5LTQuMTksMC41MTItOS4zMzUtMy42NzgtMTEuNDk0UzMwMS43ODEsMjQ3Ljg5MywyOTkuNjE0LDI1Mi4wOTJ6IE0yNTYsMjIxLjg2N2MtMTAuMjU3LDAtMTcuMDY3LTUuMTM3LTE3LjA2Ny04LjUzMw0KCQkJCWMwLTMuMzk2LDYuODEtOC41MzMsMTcuMDY3LTguNTMzYzEwLjQxOSwwLDE3LjA2Nyw1LjA1MiwxNy4wNjcsOC41MzNDMjczLjA2NywyMTYuODE1LDI2Ni40MTksMjIxLjg2NywyNTYsMjIxLjg2N3oiLz4NCgkJCTxwYXRoIGQ9Ik0yOTQuNCwxNTMuNmM3LjA1NywwLDEyLjgtNS43NDMsMTIuOC0xMi44cy01Ljc0My0xMi44LTEyLjgtMTIuOGMtNy4wNTcsMC0xMi44LDUuNzQzLTEyLjgsMTIuOA0KCQkJCVMyODcuMzQzLDE1My42LDI5NC40LDE1My42eiIvPg0KCQkJPHBhdGggZD0iTTIxNy42LDE1My42YzcuMDU3LDAsMTIuOC01Ljc0MywxMi44LTEyLjhzLTUuNzQzLTEyLjgtMTIuOC0xMi44cy0xMi44LDUuNzQzLTEyLjgsMTIuOFMyMTAuNTQzLDE1My42LDIxNy42LDE1My42eiIvPg0KCQk8L2c+DQoJPC9nPg0KPC9nPg0KPC9zdmc+',
            6
        );
    }

    /**
    * Add the content for the admin menu
    **/
    function wp_dog_pedigree_Admin_Contents() {
        include_once('wp-dog-pedigree-admin.php');
    }


    /**
    * Add a new pedigree to database_table
    **/
    add_action( 'admin_post_submit_add_pedigree', 'wp_dog_pedigree_admin_add_pedigree' );
    function wp_dog_pedigree_admin_add_pedigree() {
        global $wpdb;
        if (
            !empty($_POST)
            && $_POST['name'] != ''
            && $_POST['owner'] != ''
            && $_POST['breeder'] != ''
            && $_POST['gender'] != ''
            && $_POST['color'] != ''
            && $_POST['hdvalue'] != ''
            && $_POST['fur_type'] != ''
            && $_POST['champion'] != ''
            && $_POST['mchamp'] != ''
            && $_POST['father'] != ''
            && $_POST['mother'] != ''
        ) {

            $table_name = $wpdb->prefix . 'dogpedigree';
            $dog_name = sanitize_text_field($_POST['name']);
            $owner = sanitize_text_field($_POST['owner']);
            $breeder = sanitize_text_field($_POST['breeder']);
            $gender = $_POST['gender'];
            $color = sanitize_text_field($_POST['color']);
            $hd_value = sanitize_text_field($_POST['hdvalue']);
            $fur_type = sanitize_text_field($_POST['fur_type']);
            $champion = $_POST['champion'];
            $multi = $_POST['mchamp'];
            $father = sanitize_text_field($_POST['father']);
            $mother = sanitize_text_field($_POST['mother']);

            $success=$wpdb->insert(
                $table_name,
                array(
                    'name' => $dog_name,
                    'owner' => $owner,
                    'breeder' => $breeder,
                    'gender' => $gender,
                    'color' => $color,
                    'HD_value' => $hd_value,
                    'fur_type' => $fur_type,
                    'champion' => $champion,
                    'multi' => $multi,
                    'father' => $father,
                    'mother' => $mother
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
            $wpdb->prefix . 'dogpedigree',
            array( 'ID' => $_GET['id'] )
        );
        if ($success) {
            wp_redirect( admin_url( 'admin.php?page=wp_dog_pedigree_Admin&success=true' ) );
        } else {
            wp_redirect( admin_url( 'admin.php?page=wp_dog_pedigree_Admin&success=false' ) );
        }
    }


