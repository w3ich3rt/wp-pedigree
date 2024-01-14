<div class="wrap">
    <div>
        <h1>Dog Pedigree Page</h1>
        <p>On this page you can add dog pedigrees for your dog.</p>
        <p>Then you will have the ID to use them on your page.</p>
    </div>
    <div>
        <?php
            $dogs = $wpdb->get_col("SELECT * FROM $wpdb->prefix . 'dogpedigree' ORDER BY comment_count DESC")
            echo $dogs;
        ?>
    </div>
</div>
