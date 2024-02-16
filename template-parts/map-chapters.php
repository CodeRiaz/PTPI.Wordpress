<?php
    global $wpdb;
    $selected_country = '';
    $chapter_id = -1;
    $chapters = array();
    $zoom = 7;
    $center_lat = 44.359206;
    $center_lng = -2.827666;

    if (isset($_GET['chapter_id']) && !empty($_GET['chapter_id'])) {
        $chapter_id = $_GET['chapter_id'];
        $selected_country = $wpdb->get_var("SELECT chapterMainCountry FROM `PTPI-chapters` WHERE recid = $chapter_id");
    } else if (isset($_GET['country']) && !empty($_GET['country'])) {
        $selected_country = $_GET['country'];
    }

    $countries = $wpdb->get_results("SELECT DISTINCT chapterMainCountry FROM `PTPI-chapters` WHERE chapterActive = 1", ARRAY_N);

    if ($countries) {
        $countries = array_map(function($country) {
            return $country[0];
        }, $countries);
        $countries = array_filter($countries);
        sort($countries);
    }

    if ($selected_country) {
        $chapters_query = $wpdb->get_results("SELECT * FROM `PTPI-chapters` WHERE chapterMainCountry = '$selected_country' AND chapterActive = 1", OBJECT);
    } else {
        $chapters_query = $wpdb->get_results("SELECT * FROM `PTPI-chapters` WHERE chapterActive = 1 Limit 25", OBJECT);
        $zoom = 3;
    }

    foreach ( $chapters_query as $chapter ) {
        $chapters[] = array(
            'id' => $chapter->recid,
            'name' => $chapter->chapterName,
            'lat' => (double) $chapter->chapterLat,
            'lng' => (double) $chapter->chapterLong,
            'content' => $chapter->chapterName
        );
    }

    if ($selected_country) {
        $center_lat = $chapters[0]['lat'];
        $center_lng = $chapters[0]['lng'];
    }
?>
<script>
    window.chapters = <?php echo json_encode($chapters); ?>;
    window.countries = <?php echo json_encode($countries); ?>;
</script>
<section class="banner chapter">
    <div id="map" data-permalink="<?php the_permalink(); ?>" data-lat="<?php echo $center_lat; ?>" data-lng="<?php echo $center_lng; ?>" data-zoom="<?php echo $zoom; ?>" style="width: 100%; height: 100%;"></div>
    <div class="find-chapter">
        <select id="map-country-input" data-permalink="<?php the_permalink(); ?>">
            <option value="-1">-- Country --</option>
            <?php
                foreach($countries as $country) :
                    $selected = $country == $selected_country  ? ' selected' : '';
                    echo "<option$selected>$country</option>";
                endforeach;
            ?>
        </select>
        <select id="map-chapter-input" data-permalink="<?php the_permalink(); ?>">
            <option value="-1">-- Chapter --</option>
            <?php
                if ($selected_country) {
                    foreach($chapters as $chapter) :
                        $selected = $chapter_id && $chapter_id == $chapter['id'] ? ' selected' : '';
                        echo "<option value=\"{$chapter['id']}\"$selected>{$chapter['name']}</option>";
                    endforeach;
                } else {
                    echo '<option value="-1" disabled>-- Select a country first --</option>';
                }
            ?>
        </select>
    </div>
</section>