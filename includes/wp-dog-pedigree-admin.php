<div class="wrap">
    <div>
        <h1><?php __('Dog Pedigree Page','wp-dog-pedigree')?></h1>
        <p><?php __('On this page you can add dog pedigrees for your dog.','wp-dog-pedigree') ?></p>
        <p><?php __('Then you will have the ID to use them on your page.','wp-dog-pedigree') ?></p>
    </div>
    <div class="wp-dog-pedigree-form">
        <h1>Add pedigree</h1>
        <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
            <label for="name">Dogname:</label>
            <input type="text" name="name" id="name" />
            <label for="owner">Owner:</label>
            <input type="text" name="owner" id="owner" />
            <label for="breeder">Breeder:</label>
            <input type="text" name="breeder" id="breeder" />
            <label for="hdvalue">HD-Value:</label>
            <input type="text" name="hdvalue" id="hdvalue" />
            <label for="gender">Gender:</label>
            <select name="gender" id="gender">
                <option value="0">Male</option>
                <option value="1">Female</option>
            </select>
            <label for="fur_type">Fur Type</label>
            <select name="fur_type" id="fur_type">
                <option value="1">Long hair</option>
                <option value="0">Short hair</option>
            </select>
            <label for="champion">Champion</label>
            <select name="champion" id="champion">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
            <label for="mchamp">Multi-Champion</label>
            <select name="mchamp" id="mchamp">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
            <label for="color">Fur Color</label>
            <select name="color" id="color">
                <option value="Red">Red</option>
                <option value="Black">Black</option>
                <option value="Blue">Blue</option>
                <option value="Cream">Cream</option>
                <option value="Fawn">Fawn</option>
            </select>
            <label for="father">Father:</label>
            <input type="text" name="father" id="father" />
            <label for="mother">Mother:</label>
            <input type="text" name="mother" id="mother" />
            <input type="hidden" name="action" value="submit_add_pedigree">
            <input type="submit" value="Submit" />
        </form>
    </div>
    <div >
        <div>
            <h2>List of all pedigrees</h2>
            <table>
                <caption>List of all currently dog pedigrees.</caption>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Owner</th>
                    <th>Breeder</th>
                    <th>Gender</th>
                    <th>Color</th>
                    <th>HD value</th>
                    <th>Fur type</th>
                    <th>Champion</th>
                    <th>Multi</th>
                    <th>Father</th>
                    <th>Mother</th>
                    <th>Actions</th>
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
                    if($row->gender == 0){echo "<td>Male</td>";} else { echo "<td>Female</td>";}
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
