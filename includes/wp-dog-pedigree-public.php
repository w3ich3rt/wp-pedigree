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

        $pedigree = wp_dog_pedigree_get_pedigree($id);

        $output = '<div class="dog-pedigree">';
        $output .= '<table class="dog-pedigree-table">';
        $output .= '<tr>';
        $output .= '<th colspan="2">Pedigree</th>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td colspan="2" class="dog-pedigree-name">' . $pedigree[0]->name . '</td>';
        $output .= '</tr>';
        $output .= '<tr>';
        $output .= '<td class="dog-pedigree-father">' . $pedigree[0]->father . '</td>';
        $output .= '<td class="dog-pedigree-mother">' . $pedigree[0]->mother . '</td>';
        $output .= '</tr>';
        $output .= '</table>';
        $output .= '</div>';

        return $output;
    }
