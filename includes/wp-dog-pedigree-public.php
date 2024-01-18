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
    * shortcode to display the dog's pedigree
    **/
    add_shortcode('dog_pedigree_by_dog', 'wp_dog_pedigree_shortcode');
    function wp_dog_pedigree_shortcode($atts) {
        extract(shortcode_atts(array(
            'id' => '',
        ), $atts));

        $pedigree = get_pedigree($id);

        $output = '<div class="dog-pedigree">';
        $output .= '<ul>';
        foreach ($pedigree as $dog) {
            $output .= '<li>';
            $output .= '<span class="dog-name">' . $dog->name . '</span>';
            $output .= '<span class="dog-father">' . $dog->father . '</span>';
            $output .= '<span class="dog-mother">' . $dog->mother . '</span>';
            $output .= '</li>';
        }
        $output .= '</ul>';
        $output .= '</div>';

        return $output;
    }
