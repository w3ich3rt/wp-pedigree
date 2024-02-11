<?php
    /**
    * Get the dog's pedigree
    **/
    function wp_dog_pedigree_get_pedigree($dog_id) {
        global $wpdb;
        $result = $wpdb->get_results( "SELECT name,father,mother FROM {$wpdb->prefix}dogpedigree WHERE ID = $dog_id" );
        return $result;
    }

    /**
    * Get informations about the dog
    **/
    function wp_dog_pedigree_get_dog($dog_name) {
        global $wpdb;
        $result = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}dogpedigree WHERE name = '$dog_name'" );
        return $result;
    }

    /**
    * Get parents by name
    **/
    function wp_dog_pedigree_get_parents_by_name($dog_name) {
        global $wpdb;
        $result = $wpdb->get_results( "SELECT father,mother FROM {$wpdb->prefix}dogpedigree WHERE name = '$dog_name'" );
        return $result;
    }

    /**
    * Generate pedigree dictionary
    **/
    function wp_dog_pedigree_generate_pedigree_dictionary($dog_id) {
        $pedigree = wp_dog_pedigree_get_pedigree($dog_id);
        $father = $pedigree[0]->father;
        $mother = $pedigree[0]->mother;
        $dictionary = array();
        $dictionary['father'] = $father;
        $dictionary['mother'] = $mother;
        $dictionary['father_father'] = wp_dog_pedigree_get_parents_by_name($father)[0]->father;
        $dictionary['father_mother'] = wp_dog_pedigree_get_parents_by_name($father)[0]->mother;
        $dictionary['mother_father'] = wp_dog_pedigree_get_parents_by_name($mother)[0]->father;
        $dictionary['mother_mother'] = wp_dog_pedigree_get_parents_by_name($mother)[0]->mother;
        $dictionary['father_father_father'] = wp_dog_pedigree_get_parents_by_name($dictionary['father_father'])[0]->father;
        $dictionary['father_father_mother'] = wp_dog_pedigree_get_parents_by_name($dictionary['father_father'])[0]->mother;
        $dictionary['father_mother_father'] = wp_dog_pedigree_get_parents_by_name($dictionary['father_mother'])[0]->father;
        $dictionary['father_mother_mother'] = wp_dog_pedigree_get_parents_by_name($dictionary['father_mother'])[0]->mother;
        $dictionary['mother_father_father'] = wp_dog_pedigree_get_parents_by_name($dictionary['mother_father'])[0]->father;
        $dictionary['mother_father_mother'] = wp_dog_pedigree_get_parents_by_name($dictionary['mother_father'])[0]->mother;
        $dictionary['mother_mother_father'] = wp_dog_pedigree_get_parents_by_name($dictionary['mother_mother'])[0]->father;
        $dictionary['mother_mother_mother'] = wp_dog_pedigree_get_parents_by_name($dictionary['mother_mother'])[0]->mother;
        return $dictionary;
    }

    /**
    * Generate the columns of the pedigree table
    **/
    function wp_dog_pedigree_build_parent($dog_name) {
        $dog_data = wp_dog_pedigree_get_dog($dog_name)[0];
        switch ($dog_data->color) {
            case "Red":
                $color = __('wp_dog_pedigree_lang_furcolor_red','wp-dog-pedigree');
                break;
            case "Black":
                $color = __('wp_dog_pedigree_lang_furcolor_black','wp-dog-pedigree');
                break;
            case "Blue":
                $color = __('wp_dog_pedigree_lang_furcolor_blue','wp-dog-pedigree');
                break;
            case "Cream":
                $color = __('wp_dog_pedigree_lang_furcolor_cream','wp-dog-pedigree');
                break;
            case "Fawn":
                $color = __('wp_dog_pedigree_lang_furcolor_fawn','wp-dog-pedigree');
                break;
            default:
                $color = __('wp_dog_pedigree_lang_furcolor_no','wp-dog-pedigree');
        }
        if($dog_data->fur_type == 0){ $furtype = '<p class="dog-pedigree-furtype">' . __('wp_dog_pedigree_lang_shorthair','wp-dog-pedigree') . '</p>';} else { $furtype = "" ;}
        if($dog_data->champion == 1){ $champion = __('wp_dog_pedigree_table_champion_short','wp-dog-pedigree');}
        if($dog_data->multi == 1){ $champion = __('wp_dog_pedigree_table_mchamp_short','wp-dog-pedigree');} else { $champion = "" ;}
        $output = '<p class="dog-pedigree-champ">'. $champion . '</p><p class="dog-pedigree-dogname">' . $dog_name . '</p><p class="dog-pedigree-color">' . $color . '</p>' . $furtype;
        return $output;
    }

    /**
    * shortcode to display the dog's pedigree
    **/
    add_shortcode('dog_pedigree_by_dog', 'wp_dog_pedigree_shortcode');
    function wp_dog_pedigree_shortcode($atts) {
        extract(shortcode_atts(array(
            'id' => '',
        ), $atts));

        $pedigree = wp_dog_pedigree_generate_pedigree_dictionary($id);

        $output = wp_dog_pedigree_build_htmltable($pedigree);

        return $output;
    }

    /**
    * Build pedigree html table
    **/
    function wp_dog_pedigree_build_htmltable($pedigree) {
        $output = '<div class="dog-pedigree">';
        $output .= '<table class="dog-pedigree-table">';
        $output .= '<tr>';
        $output .= '<td rowspan="4" class="dog-pedigree-name" style="background:#A9CEEA">' . wp_dog_pedigree_build_parent($pedigree['father']) . '</td>';
        $output .= '<td rowspan="2" class="dog-pedigree-name" style="background:#A9CEEA">' . wp_dog_pedigree_build_parent($pedigree['father_father']) . '</td>';
        $output .= '<td class="dog-pedigree-name" style="background:#A9CEEA">' . wp_dog_pedigree_build_parent($pedigree['father_father_father']) . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td class="dog-pedigree-name" style="background:#F4D4E6">' . wp_dog_pedigree_build_parent($pedigree['father_father_mother']) . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td rowspan="2" class="dog-pedigree-name" style="background:#F4D4E6">' . wp_dog_pedigree_build_parent($pedigree['father_mother']) . '</td>';
        $output .= '<td class="dog-pedigree-name" style="background:#A9CEEA">' . wp_dog_pedigree_build_parent($pedigree['father_mother_father']) . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td class="dog-pedigree-name" style="background:#F4D4E6">' . wp_dog_pedigree_build_parent($pedigree['father_mother_mother']) . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td rowspan="4" class="dog-pedigree-name" style="background:#F4D4E6">' . wp_dog_pedigree_build_parent($pedigree['mother']) . '</td>';
        $output .= '<td rowspan="2" class="dog-pedigree-name" style="background:#A9CEEA">' . wp_dog_pedigree_build_parent($pedigree['mother_father']) . '</td>';
        $output .= '<td class="dog-pedigree-name" style="background:#A9CEEA">' . wp_dog_pedigree_build_parent($pedigree['mother_father_father']) . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td class="dog-pedigree-name" style="background:#F4D4E6">' . wp_dog_pedigree_build_parent($pedigree['mother_father_mother']) . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td rowspan="2" class="dog-pedigree-name" style="background:#F4D4E6">' . wp_dog_pedigree_build_parent($pedigree['mother_mother']) . '</td>';
        $output .= '<td class="dog-pedigree-name" style="background:#A9CEEA">' . wp_dog_pedigree_build_parent($pedigree['mother_mother_father']) . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td class="dog-pedigree-name" style="background:#F4D4E6">' . wp_dog_pedigree_build_parent($pedigree['mother_mother_mother']) . '</td>';
        $output .= '</tr>';
        $output .= '</table>';
        $output .= '</div>';

        return $output;
    }


    /**
    * Get all infos of a studdog for the male stud list
    **/
    function wp_dog_pedigree_get_studdog($furtype, $color) {
        global $wpdb;
        if ($color == NULL) {
            $result = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}dogpedigree_dogs INNER JOIN {$wpdb->prefix}dogpedigree_owners ON {$wpdb->prefix}dogpedigree_dogs.owner = {$wpdb->prefix}dogpedigree_owners.ID WHERE {$wpdb->prefix}dogpedigree_dogs.gender = 0 AND WHERE {$wpdb->prefix}dogpedigree_dogs.fur_type = $furtype ORDER BY {$wpdb->prefix}dogpedigree_dogs.birthday ASC" );
            return $result;
        } else {
            $result = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}dogpedigree_dogs INNER JOIN {$wpdb->prefix}dogpedigree_owners ON {$wpdb->prefix}dogpedigree_dogs.owner = {$wpdb->prefix}dogpedigree_owners.ID WHERE {$wpdb->prefix}dogpedigree_dogs.gender = 0 AND WHERE {$wpdb->prefix}dogpedigree_dogs.color = $color AND WHERE {$wpdb->prefix}dogpedigree_dogs.fur_type = $furtype ORDER BY {$wpdb->prefix}dogpedigree_dogs.birthday ASC" );
            return $result;
        }
    }

    /**
    * Build studdog html list
    **/
    function wp_dog_pedigree_build_studdog_list() {
        $studdogs_shorthair = wp_dog_pedigree_get_studdog(0);
        $studdogs_black = wp_dog_pedigree_get_studdog(1, 'Black');
        $studdogs_blue = wp_dog_pedigree_get_studdog(1, 'Blue');
        $studdogs_cream = wp_dog_pedigree_get_studdog(1, 'Cream');
        $studdogs_fawn = wp_dog_pedigree_get_studdog(1, 'Fawn');
        $studdogs_red = wp_dog_pedigree_get_studdog(1, 'Red');
        foreach ($studdogs_shorthair as $studdog) {
            $output .= '<div class="studdog">';
            $output .= '<img src="' . $studdog->dog_image . '" />';
            $output .= '<p>' . $studdog->name . '</p>';
            $output .= '<p>' . $studdog->birthday . '</p>';
            $output .= '<p>' . $studdog->shoulderheight . '</p>';
            $output .= '<p>' . $studdog->owner . '</p>';
            $output .= '</div>';
        }
        return $output;
    }

    /**
    * shortcode to display studdogs
    **/
    add_shortcode('dog_pedigree_studdog_list', 'wp_dog_pedigree_shortcode_studdog_list');
    function wp_dog_pedigree_shortcode_studdog_list($atts) {
        extract(shortcode_atts(array(
            'id' => '',
        ), $atts));

        $studdogs_html = wp_dog_pedigree_build_studdog_list();
        return $studdogs_html;
    }