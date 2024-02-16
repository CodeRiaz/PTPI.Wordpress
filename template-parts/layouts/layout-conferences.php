<section class="conferences-wrapper">
    <?php am_the_field( 'heading', '<div class="heading"><h4 class="title">', '</h3></div>', true ); ?>

    <?php
        global $wpdb;

        $date = date('Y-m-d');
        $confs = $wpdb->get_results("SELECT * FROM `PTPI-travelTrips` WHERE tripType = 'conf' AND tripStartDate >= '$date' AND tripActive = 1", OBJECT);

        if ($confs) :
    ?>
        <div class="adult-travel">
            <?php foreach( $confs as $conf ) : ?>
                <div class="col-1 travel-thumbnail">
                    <a href="/trip-details?trip=<?php echo $conf->recid; ?>">
                        <img src="<?php echo $conf->tripPromoImage; ?>" alt="">
                    </a>
                    <div class="detail">
                        <a href="/trip-details?trip=<?php echo $conf->recid; ?>">
                            <strong><?php echo $conf->tripName; ?></strong>

                            <?php
                                $start = strtotime($conf->tripStartDate);
                                $end = strtotime($conf->tripEndDate);

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
    <?php endif; ?>

    <?php $heading_previous = get_sub_field( 'heading_previous' ); ?>
    <?php if ( have_rows( 'previous_conferences' ) ) : ?>
    <div class="conferences-detail layout-<?php the_sub_field( 'layout' ); ?>">
        <div class="left-col">
            <div class="previous-conference">
                <div class="bold">
                    <?php echo $heading_previous; ?>
                </div>
                <ul>
                    <?php while ( have_rows( 'previous_conferences' ) ) : the_row(); ?>
                    <li>
                        <a href="#" class="previous-conference-name" data-filter="conference-<?php the_row_index(); ?>">
                            <?php the_sub_field( 'name' ); ?>
                        </a>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>

        <div class="right-col">
            <div class="slider__wrapper">
                <div class="slider conference-slider">
                    <?php
                        while ( have_rows( 'previous_conferences' ) ) : the_row();
                            foreach( get_sub_field( 'images' ) as $image ) :
                    ?>
                        <div class="conference-<?php the_row_index(); ?>">
                            <?php am_get_attachment( $image['ID'], 'full', true ); ?>
                        </div>
                    <?php endforeach; endwhile; ?>
                </div>
                <div class="slider-thumb">
                    <?php
                        while ( have_rows( 'previous_conferences' ) ) : the_row();
                            foreach( get_sub_field( 'images' ) as $image ) :
                    ?>
                        <div class="conference-<?php the_row_index(); ?>">
                            <?php am_get_attachment( $image['ID'], 'full', true ); ?>
                        </div>
                    <?php endforeach; endwhile; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</section>