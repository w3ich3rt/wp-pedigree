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
                $result = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}dogpedigree_titles");
                foreach ( $result as $row ) {
                    
                    echo "<tr class='admin-table'>";
                    echo "<td class='admin-table'>$row->ID</td>";
                    echo "<td class='admin-table'>" + wp_dog_pedigree_get_dogname($row->dogid) + "</td>";
                    echo "<td class='admin-table'>$row->title</td>";
                    $link = admin_url('admin-post.php?action=delete_title&id=' . $row->ID);
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
function wp_dog_pedigree_get_dogname($id) {
    global $wpdb;
    $result = $wpdb->get_results( "SELECT name FROM {$wpdb->prefix}dogpedigree_dogs WHERE ID = $id");
    return $result;
}
?>