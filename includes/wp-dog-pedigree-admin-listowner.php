<div class="wrap">
    <div >
        <div>
            <h2><?php esc_html_e('wp_dog_pedigree_list_pedigree','wp-dog-pedigree'); ?></h2>
            <table class="admin-table">
                <caption><?php esc_html_e('wp_dog_pedigree_table_caption_listdogs','wp-dog-pedigree'); ?></caption>
                <tr class="admin-table">
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_id','wp-dog-pedigree'); ?></th>
                    
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_actions','wp-dog-pedigree'); ?></th>
                </tr>
            <?php
                global $wpdb;
                $result = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}dogpedigree_owners");
                foreach ( $result as $row ) {
                    if($row->fur_type == 1){ $furtypehtml = __('wp_dog_pedigree_lang_longhair','wp-dog-pedigree');} else { $furtypehtml = __('wp_dog_pedigree_lang_shorthair','wp-dog-pedigree');}
                    if($row->gender == 0){ $genderhtml =  __('wp_dog_pedigree_table_male','wp-dog-pedigree');} else { $genderhtml = __('wp_dog_pedigree_table_female','wp-dog-pedigree');}
                    if($row->champion == 0){ $championhtml =  __('wp_dog_pedigree_lang_no','wp-dog-pedigree');} else { $championhtml = __('wp_dog_pedigree_lang_yes','wp-dog-pedigree');}
                    if($row->multi == 0){ $multihtml =  __('wp_dog_pedigree_lang_no','wp-dog-pedigree');} else { $multihtml = __('wp_dog_pedigree_lang_yes','wp-dog-pedigree');}
                    switch ($row->color) {
                        case "Red":
                            $colorhtml = __('wp_dog_pedigree_lang_furcolor_red','wp-dog-pedigree');
                            break;
                        case "Black":
                            $colorhtml = __('wp_dog_pedigree_lang_furcolor_black','wp-dog-pedigree');
                            break;
                        case "Blue":
                            $colorhtml = __('wp_dog_pedigree_lang_furcolor_blue','wp-dog-pedigree');
                            break;
                        case "Cream":
                            $colorhtml = __('wp_dog_pedigree_lang_furcolor_cream','wp-dog-pedigree');
                            break;
                        case "Fawn":
                            $colorhtml = __('wp_dog_pedigree_lang_furcolor_fawn','wp-dog-pedigree');
                            break;
                        default:
                            $colorhtml = __('wp_dog_pedigree_lang_furcolor_no','wp-dog-pedigree');
                    }
                    echo "<tr class='admin-table'>";
                    echo "<td class='admin-table'>$row->ID</td>";
                    echo "<td class='admin-table'>$row->mother</td>";
                    $link = admin_url('admin-post.php?action=delete_pedigree&id=' . $row->ID);
                    $string = '<td class="admin-table"><center><a href="%s"><i class="trashcans"></i></a></center></td>';
                    echo sprintf($string, $link);
                    echo "</tr>";
                }
            ?>
            </table>
        </div>
    </div>
</div>
