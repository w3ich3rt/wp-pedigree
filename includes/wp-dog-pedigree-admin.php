<div class="wrap">
    <div>
        <h1><?php esc_html_e('wp_dog_pedigree_lang_main_title','wp-dog-pedigree'); ?></h1>
        <p><?php esc_html_e('wp_dog_pedigree_lang_description','wp-dog-pedigree'); ?></p>
        <p><?php esc_html_e('wp_dog_pedigree_lang_copyright','wp-dog-pedigree'); ?></p>
    </div>
    <div class="wp-dog-pedigree-form">
        <h2><?php esc_html_e('wp_dog_pedigree_lang_add-pedigree','wp-dog-pedigree'); ?></h2>
        <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
            <label for="name"><?php esc_html_e('wp_dog_pedigree_lang_dogname','wp-dog-pedigree'); ?>:</label>
            <input type="text" name="name" id="name" />
            <label for="owner"><?php esc_html_e('wp_dog_pedigree_lang_owner','wp-dog-pedigree'); ?>:</label>
            <select name="owner" id="owner">
                <?php
                    $results = wp_dog_pedigree_get_all_dog_owners();
                    foreach ($results as $result) {
                        echo '<option value="' . $result->ID . '">' . $result->name . '</option>';
                    }
                ?>
            </select>
            <label for="breeder"><?php esc_html_e('wp_dog_pedigree_lang_breeder','wp-dog-pedigree'); ?>:</label>
            <input type="text" name="breeder" id="breeder" />
            <select name="gender" id="gender">
                <option value="0"><?php esc_html_e('wp_dog_pedigree_lang_male','wp-dog-pedigree'); ?></option>
                <option value="1"><?php esc_html_e('wp_dog_pedigree_lang_female','wp-dog-pedigree'); ?></option>
            </select>
            <label for="fur_type"><?php esc_html_e('wp_dog_pedigree_lang_furtype','wp-dog-pedigree'); ?></label>
            <select name="fur_type" id="fur_type">
                <option value="1"><?php esc_html_e('wp_dog_pedigree_lang_longhair','wp-dog-pedigree'); ?></option>
                <option value="0"><?php esc_html_e('wp_dog_pedigree_lang_shorthair','wp-dog-pedigree'); ?></option>
            </select>
            <label for="champion"><?php esc_html_e('wp_dog_pedigree_lang_champion','wp-dog-pedigree'); ?>:</label>
            <select name="champion" id="champion">
                <option value="0"><?php esc_html_e('wp_dog_pedigree_lang_no','wp-dog-pedigree') ?></option>
                <option value="1"><?php esc_html_e('wp_dog_pedigree_lang_yes','wp-dog-pedigree'); ?></option>
            </select>
            <label for="mchampion"><?php esc_html_e('wp_dog_pedigree_lang_mchamp','wp-dog-pedigree'); ?>:</label>
            <select name="mchampion" id="mchampion">
                <option value="0"><?php esc_html_e('wp_dog_pedigree_lang_no','wp-dog-pedigree') ?></option>
                <option value="1"><?php esc_html_e('wp_dog_pedigree_lang_yes','wp-dog-pedigree'); ?></option>
            </select>
            <label for="color"><?php esc_html_e('wp_dog_pedigree_lang_furcolor','wp-dog-pedigree'); ?>:</label>
            <select name="color" id="color">
                <option value="Red"><?php esc_html_e('wp_dog_pedigree_lang_furcolor_red','wp-dog-pedigree'); ?></option>
                <option value="Black"><?php esc_html_e('wp_dog_pedigree_lang_furcolor_black','wp-dog-pedigree'); ?></option>
                <option value="Blue"><?php esc_html_e('wp_dog_pedigree_lang_furcolor_blue','wp-dog-pedigree'); ?></option>
                <option value="Cream"><?php esc_html_e('wp_dog_pedigree_lang_furcolor_cream','wp-dog-pedigree'); ?></option>
                <option value="Fawn"><?php esc_html_e('wp_dog_pedigree_lang_furcolor_fawn','wp-dog-pedigree'); ?></option>
            </select>
            <label for="color"><?php esc_html_e('wp_dog_pedigree_lang_studdog','wp-dog-pedigree'); ?>:</label>
            <select name="stud_dog" id="stud_dog">
                <option value="0"><?php esc_html_e('wp_dog_pedigree_lang_no','wp-dog-pedigree') ?></option>
                <option value="1"><?php esc_html_e('wp_dog_pedigree_lang_yes','wp-dog-pedigree'); ?></option>
            </select>
            <label for="HD_value"><?php esc_html_e('wp_dog_pedigree_lang_hd','wp-dog-pedigree'); ?>:</label>
            <input type="text" name="HD_value" id="HD_value" />
            <label for="father"><?php esc_html_e('wp_dog_pedigree_lang_father','wp-dog-pedigree'); ?>:</label>
            <input type="text" name="father" id="father" />
            <label for="mother"><?php esc_html_e('wp_dog_pedigree_lang_mother','wp-dog-pedigree'); ?>:</label>
            <input type="text" name="mother" id="mother" />
            <label for="birthday_date"><?php esc_html_e('wp_dog_pedigree_lang_birthday','wp-dog-pedigree'); ?>:</label>
            <input type="date" name="birthday_date" id="birthday_date" value=<?php echo '"' . date("Y-m-d") . '"' ?> />
            <label for="deathday_date"><?php esc_html_e('wp_dog_pedigree_lang_deathday','wp-dog-pedigree'); ?>:</label>
            <input type="date" name="deathday_date" id="deathday_date" value=<?php echo '"' . date("Y-m-d") . '"' ?> />
            <label for="studbook_nr"><?php esc_html_e('wp_dog_pedigree_lang_studbook','wp-dog-pedigree'); ?>:</label>
            <input type="text" name="studbook_nr" id="studbook_nr" />
            <label for="shoulder_height"><?php esc_html_e('wp_dog_pedigree_lang_shoulderheight','wp-dog-pedigree'); ?>:</label>
            <input type="text" name="shoulder_height" id="shoulder_height" />
            <input type="hidden" name="action" value="submit_add_pedigree">
            <input type="submit" value="Submit" />
        </form>
    </div>
    <div class="wp-dog-pedigree-form">
        <h2><?php esc_html_e('wp_dog_pedigree_lang_add-pedigree_owner','wp-dog-pedigree'); ?></h2>
        <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
            <label for="name"><?php esc_html_e('wp_dog_pedigree_lang_dogname','wp-dog-pedigree'); ?>:</label>
            <input type="text" name="name" id="name" />
            <label for="street"><?php esc_html_e('wp_dog_pedigree_lang_street','wp-dog-pedigree'); ?>:</label>
            <input type="text" name="street" id="street" />
            <label for="zip"><?php esc_html_e('wp_dog_pedigree_lang_zip','wp-dog-pedigree'); ?>:</label>
            <input type="text" name="zip" id="zip" />
            <label for="city"><?php esc_html_e('wp_dog_pedigree_lang_city','wp-dog-pedigree'); ?>:</label>
            <input type="text" name="city" id="city" />
            <label for="country"><?php esc_html_e('wp_dog_pedigree_lang_country','wp-dog-pedigree'); ?>:</label>
            <select name="country" id="country">
                <option value="Germany"><?php esc_html_e('wp_dog_pedigree_lang_country_germany','wp-dog-pedigree'); ?></option>
                <option value="Austria"><?php esc_html_e('wp_dog_pedigree_lang_country_austria','wp-dog-pedigree'); ?></option>
                <option value="Switzerland"><?php esc_html_e('wp_dog_pedigree_lang_country_switzerland','wp-dog-pedigree'); ?></option>
                <option value="Netherlands"><?php esc_html_e('wp_dog_pedigree_lang_country_netherlands','wp-dog-pedigree'); ?></option>
                <option value="France"><?php esc_html_e('wp_dog_pedigree_lang_country_france','wp-dog-pedigree'); ?></option>
            </select>
            <label for="phone"><?php esc_html_e('wp_dog_pedigree_lang_phone','wp-dog-pedigree'); ?>:</label>
            <input type="text" name="phone" id="phone" />
            <label for="mobile"><?php esc_html_e('wp_dog_pedigree_lang_mobile','wp-dog-pedigree'); ?>:</label>
            <input type="text" name="mobile" id="mobile" />
            <label for="email"><?php esc_html_e('wp_dog_pedigree_lang_email','wp-dog-pedigree'); ?>:</label>
            <input type="text" name="email" id="email" />
            <label for="website"><?php esc_html_e('wp_dog_pedigree_lang_website','wp-dog-pedigree'); ?>:</label>
            <input type="text" name="website" id="website" />
            <input type="hidden" name="action" value="submit_add_pedigree_dog_owner">
            <input type="submit" value="Submit" />
        </form>
    </div>
</div>

<?php
    /**
    * Function to get all dog owners
    **/
    function wp_dog_pedigree_get_all_dog_owners() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'wp_dog_pedigree_dog_owner';
        $results = $wpdb->get_results( "SELECT ID, name FROM $table_name" );
        return $results;
    }
?>
