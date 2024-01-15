<div class="wrap">
    <div>
        <h1>Dog Pedigree Page</h1>
        <p>On this page you can add dog pedigrees for your dog.</p>
        <p>Then you will have the ID to use them on your page.</p>
    </div>
    <div class="wp-dog-pedigree-form">
        <h1>Add Episodes</h1>
        <form method="post" action="?page=wp_dog_pedigree_Admin">
            <label for="name">Dogname:</label>
            <input type="text" name="name" id="name" />
            <label for="owner">Owner:</label>
            <input type="text" name="owner" id="owner" />
            <label for="breeder">Breeder:</label>
            <input type="text" name="breeder" id="breeder" />
            <label for="hdvalue">HD-Value:</label>
            <input type="text" name="hdvalue" id="hdvalue" />
            <p>Gender</p>
            <label for="gender">Male</label>
            <input type="radio" name="gender" id="gender" />
            <label for="gender">Female</label>
            <input type="radio" name="gender" id="gender" />
            <label for="champion">Champion</label>
            <input type="checkbox" name="champion" id="champion" />
            <label for="mchamp">Multichampion</label>
            <input type="checkbox" name="mchamp" id="mchamp" />
            <label for="furtype">Furtype</label>
            <select name="furtype" id="furtype">
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
                    <th>HD Value</th>
                    <th>Fur Type</th>
                    <th>Champion</th>
                    <th>Multi</th>
                    <th>Father</th>
                    <th>Mother</th>
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
                    echo "</tr>";
                }
            ?>
            </table>
        </div>
    </div>
</div>
