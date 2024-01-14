<div class="wrap">
    <div>
        <h1>Dog Pedigree Page</h1>
        <p>On this page you can add dog pedigrees for your dog.</p>
        <p>Then you will have the ID to use them on your page.</p>
    </div>
    <div>
        <h2>List of all pedigrees</h2>
        <?php
            global $wpdb;
            $result = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}dogpedigree");
            foreach ( $result as $row ) { 
                $s_id = $row->ID;
                $s_name = $row->name;
                $s_owner = $row->owner;
                $s_breeder = $row->breeder;
                $s_gender = $row->gender;
                $s_color = $row->color;
                $s_HD_value = $row->HD_value;
                $s_fur_type = $row->fur_type;
                $s_champion = $row->champion;
                $s_multi = $row->multi;
                $s_father = $row->father;
                $s_mother = $row->mother;
            }
        ?>
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
            <tr>
                <td><?php echo $s_id; ?></td>
                <td><?php echo $s_name; ?></td>
                <td><?php echo $s_owner; ?></td>
                <td><?php echo $s_breeder; ?></td>
                <td><?php if($s_gender == 0){echo "Male";} else { echo "Female;"}; ?></td>
                <td><?php echo $s_color; ?></td>
                <td><?php echo $s_HD_value; ?></td>
                <td><?php if($s_fur_type == 0){echo "Long hair";} else { echo "Short hair";}; ?></td>
                <td><?php if($s_champion == 0){echo "No";} else { echo "Yes";} ?></td>
                <td><?php if($s_multi == 0){echo "No";} else { echo "Yes";} ?></td>
                <td><?php echo $s_father; ?></td>
                <td><?php echo $s_mother; ?></td>
            </tr>
    </div>
</div>
