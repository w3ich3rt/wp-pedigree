<div class="wrap">
    <div >
        <div>
            <h2><?php esc_html_e('wp_dog_pedigree_list_pedigree','wp-dog-pedigree'); ?></h2>
            <table class="admin-table">
                <caption><?php esc_html_e('wp_dog_pedigree_table_caption_listdogs','wp-dog-pedigree'); ?></caption>
                <tr class="admin-table">
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_image','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_id','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_name','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_owner','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_breeder','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_gender','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_color','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_hdvalue','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_furtype','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_champion','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_mchamp','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_studdog','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_dog_miss_tooth','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_dog_breed_conditions','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_birthday','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_deathday','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_studbook_nr','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_shoulderheight','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_father','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_mother','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_actions','wp-dog-pedigree'); ?></th>
                </tr>
            <?php
                global $wpdb;
                $result = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}dogpedigree_dogs");
                foreach ( $result as $row ) {
                    if($row->fur_type == 1){ $furtypehtml = __('wp_dog_pedigree_lang_longhair','wp-dog-pedigree');} else { $furtypehtml = __('wp_dog_pedigree_lang_shorthair','wp-dog-pedigree');}
                    if($row->gender == 0){ $genderhtml =  __('wp_dog_pedigree_table_male','wp-dog-pedigree');} else { $genderhtml = __('wp_dog_pedigree_table_female','wp-dog-pedigree');}
                    if($row->champion == 0){ $championhtml =  __('wp_dog_pedigree_lang_no','wp-dog-pedigree');} else { $championhtml = __('wp_dog_pedigree_lang_yes','wp-dog-pedigree');}
                    if($row->multi == 0){ $multihtml =  __('wp_dog_pedigree_lang_no','wp-dog-pedigree');} else { $multihtml = __('wp_dog_pedigree_lang_yes','wp-dog-pedigree');}
                    if($row->stud_dog == 0){ $studdog =  __('wp_dog_pedigree_lang_no','wp-dog-pedigree');} else { $studdog = __('wp_dog_pedigree_lang_yes','wp-dog-pedigree');}
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
                    echo "<td class='admin-table'><img src='$row->dog_image' width='64px'/></td>";
                    echo "<td class='admin-table'>$row->ID</td>";
                    echo "<td class='admin-table'>$row->name</td>";
                    echo "<td class='admin-table'>" . wp_dog_pedigree_get_dogowner_by_ownerId($row->owner) . "</td>";
                    echo "<td class='admin-table'>$row->breeder</td>";
                    echo "<td class='admin-table'>$genderhtml</td>";
                    echo "<td class='admin-table'>$colorhtml</td>";
                    echo "<td class='admin-table'>$row->HD_value</td>";
                    echo "<td class='admin-table'>$furtypehtml</td>";
                    echo "<td class='admin-table'>$championhtml</td>";
                    echo "<td class='admin-table'>$multihtml</td>";
                    echo "<td class='admin-table'>$studdog</td>";
                    echo "<td class='admin-table'>$row->dog_miss_tooth</td>";
                    echo "<td class='admin-table'>$row->dog_breed_conditions</td>";
                    echo "<td class='admin-table'>$row->birthday</td>";
                    echo "<td class='admin-table'>$row->deathday</td>";
                    echo "<td class='admin-table'>$row->studbook_nr</td>";
                    echo "<td class='admin-table'>$row->shoulder_height</td>";
                    echo "<td class='admin-table'>$row->father</td>";
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

<?php
    function wp_dog_pedigree_get_dogowner_by_ownerId($owner_id) {
        global $wpdb;
        $result = $wpdb->get_results( "SELECT name FROM {$wpdb->prefix}dogpedigree_owners WHERE ID = '$owner_id'" );
        return $result;
    }

?>
