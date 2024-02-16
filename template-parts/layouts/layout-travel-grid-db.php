<?php
    $trips = $wpdb->get_results("SELECT * FROM `PTPI-travelTrips` WHERE tripEndDate > CURDATE() AND tripType != 'conf' and tripActive=1 ORDER BY tripStartDate", OBJECT);

    if (!$trips) {
        exit;
    }
?>
<?php am_the_field( 'heading', '<div class="travel--heading"><h4 class="title">', '</h4></div>', true ); ?>

<div class="adult-travel">
    <?php foreach( $trips as $trip ) : ?>
        <div class="col-1 travel-thumbnail">
            <a href="/trip-details?trip=<?php echo $trip->recid; ?>">
                <img src="<?php echo $trip->tripPromoImage; ?>" alt="">
            </a>
            <div class="detail">
                <a href="/trip-details?trip=<?php echo $trip->recid; ?>">
                    <strong><?php echo $trip->tripName; ?></strong>

                    <?php
                        $start = strtotime($trip->tripStartDate);
                        $end = strtotime($trip->tripEndDate);

                        if (date('F', $start) == date('F', $end)) {
                        ?>
                            <span><?php echo date('F', $start); ?> <?php echo date('d', $start); ?>-<?php echo date('d', $end); ?>, <?php echo date('Y', $start); ?></span>
                        <?php
                        } else if (date('Y', $start) == date('Y', $end)) {
                        ?>
                            <span><?php echo date('M d', $start); ?> - <?php echo date('M d', $end); ?>, <?php echo date('Y', $start); ?></span>
                        <?php
                        } else {
                        ?>
                            <span><?php echo date('F d, Y', $start); ?> - <?php echo date('F d, Y', $end); ?></span>
                        <?php
                        }
                    ?>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>