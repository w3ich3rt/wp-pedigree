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
        $output .= '<div class="dog-pedigree__father">';
        $output .= '<div class="dog-pedigree__father__name">';
        $output .= $pedigree['father'];
        $output .= '</div>';
        $output .= '<div class="dog-pedigree__father__father">';
        $output .= $pedigree['father_father'];
        $output .= '</div>';
        $output .= '<div class="dog-pedigree__father__mother">';
        $output .= $pedigree['father_mother'];
        $output .= '</div>';
        $output .= '</div>';
        $output .= '<div class="dog-pedigree__mother">';
        $output .= '<div class="dog-pedigree__mother__name">';
        $output .= $pedigree['mother'];
        $output .= '</div>';
        $output .= '<div class="dog-pedigree__mother__father">';
        $output .= $pedigree['mother_father'];
        $output .= '</div>';
        $output .= '<div class="dog-pedigree__mother__mother">';
        $output .= $pedigree['mother_mother'];
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</div>';
        

        return $output;
    }
