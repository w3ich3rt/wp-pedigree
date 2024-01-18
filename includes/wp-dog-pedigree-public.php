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
        if($dog_data->fur_type == 0){ $furtype = '<p class="dog-pedigree-furtype">' . __('wp_dog_pedigree_lang_shorthair','wp-dog-pedigree') . '</p>';}
        if($dog_data->champion == 1){ $champion = __('wp_dog_pedigree_table_champion_short','wp-dog-pedigree');}
        if($dog_data->multi == 1){ $champion = __('wp_dog_pedigree_table_mchamp_short','wp-dog-pedigree');} //TODO: Solve with a if-else statement
        $output = '<p class="dog-pedigree-champ">'. $champion . '</p><p class="dog-pedigree-dogname">' . $dog_name . '</p><p class="dog-pedigree-color">' . $color . '</p>' . $furtype; //TODO: Gender needs to be added
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

        $output = '<div class="dog-pedigree">';
        $output .= '<table class="dog-pedigree-table">';
        $output .= '<tr>';
        $output .= '<td rowspan="4" class="dog-pedigree-name">' . wp_dog_pedigree_build_parent($pedigree['father']) . '</td>';
        $output .= '<td rowspan="2" class="dog-pedigree-name">' . wp_dog_pedigree_build_parent($pedigree['father_father']) . '</td>';
        $output .= '<td class="dog-pedigree-name">' . wp_dog_pedigree_build_parent($pedigree['father_father_father']) . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td class="dog-pedigree-name">' . wp_dog_pedigree_build_parent($pedigree['father_father_mother']) . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td rowspan="2" class="dog-pedigree-name">' . wp_dog_pedigree_build_parent($pedigree['father_mother']) . '</td>';
        $output .= '<td class="dog-pedigree-name">' . wp_dog_pedigree_build_parent($pedigree['father_mother_father']) . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td class="dog-pedigree-name">' . wp_dog_pedigree_build_parent($pedigree['father_mother_mother']) . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td rowspan="4" class="dog-pedigree-name">' . wp_dog_pedigree_build_parent($pedigree['mother']) . '</td>';
        $output .= '<td rowspan="2" class="dog-pedigree-name">' . wp_dog_pedigree_build_parent($pedigree['mother_father']) . '</td>';
        $output .= '<td class="dog-pedigree-name">' . wp_dog_pedigree_build_parent($pedigree['mother_father_father']) . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td class="dog-pedigree-name">' . wp_dog_pedigree_build_parent($pedigree['mother_father_mother']) . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td rowspan="2" class="dog-pedigree-name">' . wp_dog_pedigree_build_parent($pedigree['mother_mother']) . '</td>';
        $output .= '<td class="dog-pedigree-name">' . wp_dog_pedigree_build_parent($pedigree['mother_mother_father']) . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td class="dog-pedigree-name">' . wp_dog_pedigree_build_parent($pedigree['mother_mother_mother']) . '</td>';
        $output .= '</tr>';
        $output .= '</table>';
        $output .= '</div>';


        return $output;
    }



