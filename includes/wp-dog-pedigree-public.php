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
        $result = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}dogpedigree WHERE name = '$name'" );
        $dictionary = array();
        $dictionary['name'] = $result[0]->name;
        $dictionary['owner'] = $result[0]->owner;
        $dictionary['breeder'] = $result[0]->breeder;
        $dictionary['gender'] = $result[0]->gender;
        $dictionary['color'] = $result[0]->color;
        $dictionary['HD_value'] = $result[0]->HD_value;
        $dictionary['fur_type'] = $result[0]->fur_type;
        $dictionary['champion'] = $result[0]->champion;
        $dictionary['multi'] = $result[0]->multi;
        $dictionary['father'] = $result[0]->father;
        $dictionary['mother'] = $result[0]->mother;
        return $result;
    }

    /**
    * Get parents by name
    **/
    function wp_dog_pedigree_get_parents_by_name($name) {
        global $wpdb;
        $result = $wpdb->get_results( "SELECT father,mother FROM {$wpdb->prefix}dogpedigree WHERE name = '$name'" );
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
    * shortcode to display the dog's pedigree
    **/
    add_shortcode('dog_pedigree_by_dog', 'wp_dog_pedigree_shortcode');
    function wp_dog_pedigree_shortcode($atts) {
        extract(shortcode_atts(array(
            'id' => '',
        ), $atts));

        $pedigree = wp_dog_pedigree_generate_pedigree_dictionary($id);
        
        $output = '<div class="dog-pedigree">';
        $output .= '<table>';
        $output .= '<tr>';
        $output .= '<td rowspan="4" class="dog-pedigree-name"><p>' . $pedigree['father'] . '</p><p>' . wp_dog_pedigree_get_dog($pedigree['father'])[0]->color . '</p></td>';
        $output .= '<td rowspan="2" class="dog-pedigree-name">' . $pedigree['father_father'] . '</td>';
        $output .= '<td class="dog-pedigree-name">' . $pedigree['father_father_father'] . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td class="dog-pedigree-name">' . $pedigree['father_father_mother'] . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td rowspan="2" class="dog-pedigree-name">' . $pedigree['father_mother'] . '</td>';
        $output .= '<td class="dog-pedigree-name">' . $pedigree['father_mother_father'] . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td class="dog-pedigree-name">' . $pedigree['father_mother_mother'] . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td rowspan="4" class="dog-pedigree-name">' . $pedigree['mother'] . '</td>';
        $output .= '<td rowspan="2" class="dog-pedigree-name">' . $pedigree['mother_father'] . '</td>';
        $output .= '<td class="dog-pedigree-name">' . $pedigree['mother_father_father'] . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td class="dog-pedigree-name">' . $pedigree['mother_father_mother'] . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td rowspan="2" class="dog-pedigree-name">' . $pedigree['mother_mother'] . '</td>';
        $output .= '<td class="dog-pedigree-name">' . $pedigree['mother_mother_father'] . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td class="dog-pedigree-name">' . $pedigree['mother_mother_mother'] . '</td>';
        $output .= '</tr>';
        $output .= '</table>';
        $output .= '</div>';


        return $output;
    }



