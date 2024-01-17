<div class="wrap">
    <div>
        <h1><?php _e('wp_dog_pedigree_lang_main_title','wp-dog-pedigree'); ?></h1>
        <p><?php _e('wp_dog_pedigree_lang_description','wp-dog-pedigree'); ?></p>
        <p><?php _e('wp_dog_pedigree_lang_copyright','wp-dog-pedigree'); ?></p>
    </div>
    <div class="wp-dog-pedigree-form">
        <h2>Add pedigree</h2>
        <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
            <label for="name"><?php _e('wp_dog_pedigree_lang_dogname','wp-dog-pedigree'); ?>:</label>
            <input type="text" name="name" id="name" />
            <label for="owner"><?php _e('wp_dog_pedigree_lang_owner','wp-dog-pedigree'); ?>:</label>
            <input type="text" name="owner" id="owner" />
            <label for="breeder"><?php _e('wp_dog_pedigree_lang_breeder','wp-dog-pedigree'); ?>:</label>
            <input type="text" name="breeder" id="breeder" />
            <label for="hdvalue"><?php _e('wp_dog_pedigree_lang_hdvalue','wp-dog-pedigree'); ?>:</label>
            <input type="text" name="hdvalue" id="hdvalue" />
            <label for="gender"><?php _e('wp_dog_pedigree_lang_gender','wp-dog-pedigree'); ?>:</label>
            <select name="gender" id="gender">
                <option value="0"><?php _e('wp_dog_pedigree_lang_male','wp-dog-pedigree'); ?></option>
                <option value="1"><?php _e('wp_dog_pedigree_lang_female','wp-dog-pedigree'); ?></option>
            </select>
            <label for="fur_type"><?php _e('wp_dog_pedigree_lang_furtype','wp-dog-pedigree'); ?></label>
            <select name="fur_type" id="fur_type">
                <option value="1"><?php _e('wp_dog_pedigree_lang_furtype','wp-dog-pedigree'); ?></option>
                <option value="0"><?php _e('wp_dog_pedigree_lang_furtype','wp-dog-pedigree'); ?></option>
            </select>
            <?php $YES = _e('wp_dog_pedigree_lang_yes','wp-dog-pedigree'); ?>
            <?php $NO = _e('wp_dog_pedigree_lang_no','wp-dog-pedigree'); ?>
            <label for="champion"><?php _e('wp_dog_pedigree_lang_champion','wp-dog-pedigree'); ?>:</label>
            <select name="champion" id="champion">
                <option value="0"><?php echo $NO ?></option>
                <option value="1"><?php echo $YES ?></option>
            </select>
            <label for="mchamp"><?php _e('wp_dog_pedigree_lang_mchamp','wp-dog-pedigree'); ?>:</label>
            <select name="mchamp" id="mchamp">
                <option value="0"><?php echo $NO ?></option>
                <option value="1"><?php echo $YES ?></option>
            </select>
            <label for="color"><?php _e('wp_dog_pedigree_lang_furcolor','wp-dog-pedigree'); ?>:</label>
            <select name="color" id="color">
                <option value="Red"><?php _e('wp_dog_pedigree_lang_furcolor','wp-dog-pedigree'); ?></option>
                <option value="Black"><?php _e('wp_dog_pedigree_lang_furcolor_red','wp-dog-pedigree'); ?></option>
                <option value="Blue"><?php _e('wp_dog_pedigree_lang_furcolor_black','wp-dog-pedigree'); ?></option>
                <option value="Cream"><?php _e('wp_dog_pedigree_lang_furcolor_cream','wp-dog-pedigree'); ?></option>
                <option value="Fawn"><?php _e('wp_dog_pedigree_lang_furcolor_fawn','wp-dog-pedigree'); ?></option>
            </select>
            <label for="father"><?php _e('wp_dog_pedigree_lang_father','wp-dog-pedigree'); ?>:</label>
            <input type="text" name="father" id="father" />
            <label for="mother"><?php _e('wp_dog_pedigree_lang_mother','wp-dog-pedigree'); ?>:</label>
            <input type="text" name="mother" id="mother" />
            <input type="hidden" name="action" value="submit_add_pedigree">
            <input type="submit" value="Submit" />
        </form>
    </div>
    <div >
        <div>
            <h2><?php _e('wp_dog_pedigree_list_pedigree','wp-dog-pedigree'); ?></h2>
            <table>
                <caption><?php _e('wp_dog_pedigree_table_caption','wp-dog-pedigree'); ?></caption>
                <tr>
                    <th><?php _e('wp_dog_pedigree_table_id','wp-dog-pedigree'); ?></th>
                    <th><?php _e('wp_dog_pedigree_table_name','wp-dog-pedigree'); ?></th>
                    <th><?php _e('wp_dog_pedigree_table_owner','wp-dog-pedigree'); ?></th>
                    <th><?php _e('wp_dog_pedigree_table_breeder','wp-dog-pedigree'); ?></th>
                    <th><?php _e('wp_dog_pedigree_table_gender','wp-dog-pedigree'); ?></th>
                    <th><?php _e('wp_dog_pedigree_table_color','wp-dog-pedigree'); ?></th>
                    <th><?php _e('wp_dog_pedigree_table_hdvalue','wp-dog-pedigree'); ?></th>
                    <th><?php _e('wp_dog_pedigree_table_furtype','wp-dog-pedigree'); ?></th>
                    <th><?php _e('wp_dog_pedigree_table_champion','wp-dog-pedigree'); ?></th>
                    <th><?php _e('wp_dog_pedigree_table_mchamp','wp-dog-pedigree'); ?></th>
                    <th><?php _e('wp_dog_pedigree_table_father','wp-dog-pedigree'); ?></th>
                    <th><?php _e('wp_dog_pedigree_table_mother','wp-dog-pedigree'); ?></th>
                    <th><?php _e('wp_dog_pedigree_table_actions','wp-dog-pedigree'); ?></th>
                </tr>
            <?php
                global $wpdb;
                $result = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}dogpedigree");
                foreach ( $result as $row ) {
                    echo "<tr>";
                    echo "<td>$row->ID</td>";
                    echo "<td>$row->name</td>";
                    echo "<td>$row->owner</td>";
                    echo "<td>$row->breeder</td>";
                    if($row->gender == 0){echo '<td>' . _e('wp_dog_pedigree_lang_male','wp-dog-pedigree') . '</td>';} else { echo '<td>' . _e('wp_dog_pedigree_lang_female','wp-dog-pedigree') . '</td>';}
                    echo "<td>$row->color</td>";
                    echo "<td>$row->HD_value</td>";
                    if($row->fur_type == 1){echo "<td>Long hair</td>";} else { echo "<td>Short hair</td>";}
                    if($row->champion == 0){echo "<td>No</td>";} else { echo "<td>Yes</td>";}
                    if($row->multi == 0){echo "<td>No</td>";} else { echo "<td>Yes</td>";}
                    echo "<td>$row->father</td>";
                    echo "<td>$row->mother</td>";
                    $link = admin_url('admin-post.php?action=delete_pedigree&id=' . $row->ID);
                    $string = '<td><center><a href="%s"><i class="trashcans"></i></a></center></td>';
                    echo sprintf($string, $link);
                    echo "</tr>";
                }
            ?>
            </table>
        </div>
    </div>
</div>
