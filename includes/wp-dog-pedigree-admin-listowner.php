<div class="wrap">
    <div >
        <div>
            <h2><?php esc_html_e('wp_dog_pedigree_list_pedigree','wp-dog-pedigree'); ?></h2>
            <table class="admin-table">
                <caption><?php esc_html_e('wp_dog_pedigree_table_caption_listdogs','wp-dog-pedigree'); ?></caption>
                <tr class="admin-table">
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_id','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_owner','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_address','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_country','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_phone','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_mobile','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_email','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_website','wp-dog-pedigree'); ?></th>
                    <th class="admin-table"><?php esc_html_e('wp_dog_pedigree_table_actions','wp-dog-pedigree'); ?></th>
                </tr>
            <?php
                global $wpdb;
                $result = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}dogpedigree_owners");
                foreach ( $result as $row ) {
                    echo "<tr class='admin-table'>";
                    echo "<td class='admin-table'>$row->ID</td>";
                    echo "<td class='admin-table'>$row->name</td>";
                    echo "<td class='admin-table'>$row->street, $row->zip $row->city, $row->country</td>";
                    echo "<td class='admin-table'>$row->street, $row->zip $row->city</td>";
                    echo "<td class='admin-table'>$row->phone</td>";
                    echo "<td class='admin-table'>$row->mobile</td>";
                    echo "<td class='admin-table'><a href='mailto:$row->email'>$row->email</a></td>";
                    echo "<td class='admin-table'><a href='$row->website' target='_blank'>$row->website</a></td>";
                    $link = admin_url('admin-post.php?action=delete_owner&id=' . $row->ID);
                    $string = '<td class="admin-table"><center><a href="%s"><i class="trashcans"></i></a></center></td>';
                    echo sprintf($string, $link);
                    echo "</tr>";
                }
            ?>
            </table>
        </div>
    </div>
</div>