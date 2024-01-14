<div class="wrap">
    <div>
        <h1>Dog Pedigree Page</h1>
        <p>On this page you can add dog pedigrees for your dog.</p>
        <p>Then you will have the ID to use them on your page.</p>
    </div>
    <div >
        <div>
            <h2>List of all pedigrees</h2>
            <table>
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
                    if($row->fur_type == 1){echo "Long hair";} else { echo "<td>Short hair</td>";}
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
