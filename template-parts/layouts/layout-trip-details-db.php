<?php
    if ( isset($_GET['trip']) && !empty($_GET['trip']) && is_numeric($_GET['trip']) ) {
        global $wpdb;

        $id = $_GET['trip'];

        $trip = $wpdb->get_results("SELECT * FROM `PTPI-travelTrips` WHERE recid = $id", OBJECT);

        if ($trip) {
            setlocale(LC_MONETARY, "en_US");
            $trip = $trip[0];

            $trip_leader = false;
            if (!empty($trip->tripLeader && $trip_leader = $wpdb->get_results("SELECT * FROM `PTPI-tripLeaders` WHERE recid = $trip->tripLeader", OBJECT))) {
                $trip_leader = $trip_leader[0];
            }

            $trip_inclusions = $wpdb->get_results("SELECT * FROM `PTPI-tripInclusions` WHERE included = 1 and tripID = $trip->recid", OBJECT);
            $trip_exclusions = $wpdb->get_results("SELECT * FROM `PTPI-tripInclusions` WHERE included = 0 and tripID = $trip->recid", OBJECT);
            $trip_itineraries = $wpdb->get_results("SELECT * FROM `PTPI-tripInineraries` WHERE tripID = $trip->recid ORDER BY dayNum ASC", OBJECT);
         } else {
            return false;
        }
    } else {
        return false;
    }
?>
<section class="banner">
    <img src="<?php echo $trip->tripBanner; ?>" alt="">
</section>
<section class="content">
    <div class="spot-detail">
        <div class="col-3">
            <div class="spot-name"><?php echo $trip->tripName; ?></div>
            <div class="spot-date"><?php echo date('F d Y', strtotime($trip->tripStartDate)); ?> - <?php echo date('F d Y', strtotime($trip->tripEndDate)); ?></div>
            <div class="spot-address"><?php echo $trip->tripByline; ?></div>
            <p class="spot-content"><?php echo $trip->tripAbout; ?></p>
        </div>
        <div class="col-1">
            <div class="reserve-spot">
                <strong>CALL<br>
                    816.531.4701<br>
                    TO BOOK</strong>
                <ul>
                    <li>RSVP: <?php echo date('l, F d, Y', strtotime($trip->tripRSVPdate)); ?></li>
                    <li>Member Fees: <?php echo money_format('$%!n', $trip->tripMemberFee); ?></li>
                    <li>Non-Member Fees: <?php echo money_format('$%!n', $trip->tripNonMemberFee); ?></li>

					 <li>Deposit Amount: <?php echo money_format('$%!n', $trip->tripDepositAmount); ?></li>
					 <li>Single Room Supplement (optional): <?php echo money_format('$%!n', $trip->tripRoomSupplementAmount); ?></li>

                </ul>
            </div>

        </div>
    </div>

    <div class="itinerary-content">
        <div class="col-3">
            <?php if ($trip_itineraries) : ?>
                <strong class="title">ITINERARY</strong>
                <ul class="days">
                    <?php foreach( $trip_itineraries as $index => $itinerary) : ?>
                        <li <?php echo $index == 0 ? 'class="active"' : ''; ?>><a href="#"><?php echo $itinerary->dayNum; ?></a></li>
                    <?php endforeach; ?>
                </ul>

                <?php foreach( $trip_itineraries as $index => $itinerary) : ?>
                <div class="day-details day-<?php echo $index + 1; ?><?php echo $index == 0 ? ' active' : ''; ?>">
                    <div class="subheading">DAY 01, <?php echo date('F d, Y', strtotime($itinerary->dayDate)); ?> | <?php echo $itinerary->dayLocation; ?></div>
                    <div class="thumbnail">
                        <img src="<?php echo $itinerary->dayImage; ?>" alt="<?php echo $itinerary->dayLocation; ?>">
                    </div>

                    <p><?php echo $itinerary->dayDetails; ?></p>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?php if ($trip->tripPDF) : ?>
            <div class="col-1">
                <div class="download-pdf">
                    <img src="<?php echo $trip->tripPDFimage; ?>" alt="Download PDF">
                    <a href="<?php echo $trip->tripPDF; ?>">DOWNLOAD PDF</a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="hotel-detail">
                <div class="col-3">
                    <?php foreach( $trip_itineraries as $index => $itinerary ) : ?>
                        <?php
                            if ($itinerary->hotelStart || $itinerary->hotelEnd) :
                                $hotel_start = $itinerary->hotelStart;
                                $hotel_end = $itinerary->hotelEnd;

                                if ($hotel_start) {
                                    $hotel_start = $wpdb->get_results("SELECT * FROM `PTPI-travelTripHotels` WHERE recid = $hotel_start", OBJECT);

                                    if ($hotel_start) {
                                        $hotel_start = $hotel_start[0];
                                    }
                                }

                                if ($hotel_end) {
                                    $hotel_end = $wpdb->get_results("SELECT * FROM `PTPI-travelTripHotels` WHERE recid = $hotel_end", OBJECT);

                                    if ($hotel_end) {
                                        $hotel_end = $hotel_end[0];
                                    }
                                }
                        ?>
                        <div class="day-hotel-details day-<?php echo $index + 1; ?><?php echo $index == 0 ? ' active' : ''; ?>">
                            <?php if ($hotel_start) : ?>
                                <div class="row">
                                    <div class="col-2">
                                        <div class="title">HOTEL INFORMATION</div>
                                        <p><?php echo $hotel_start->hotelName; ?><br>
                                            <?php echo $hotel_start->hotelAddress1; ?>
                                            <?php echo $hotel_start->hotelCity; ?></p>

                                        <p> Telephone<br>
                                            <?php echo $hotel_start->hotelPhone; ?></p>

                                        <p>
                                            Website<br>
                                            <a href="<?php echo $hotel_start->hotelURL; ?>"><?php echo $hotel_start->hotelURL; ?></a>
                                        </p>
                                    </div>
                                    <div class="col-2">
                                        <img src="<?php echo $hotel_start->hotelImage; ?>" alt="<?php echo $hotel_start->hotelName; ?>">
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if ($hotel_end && $hotel_start != $hotel_end) : ?>
                                <div class="row">
                                    <div class="col-2">
                                        <div class="title">HOTEL INFORMATION</div>
                                        <p><?php echo $hotel_end->hotelName; ?><br>
                                            <?php echo $hotel_end->hotelAddress1; ?>
                                            <?php echo $hotel_end->hotelCity; ?></p>

                                        <p> Telephone<br>
                                            <?php echo $hotel_end->hotelPhone; ?></p>

                                        <p>
                                            Website<br>
                                            <a href="<?php echo $hotel_end->hotelURL; ?>"><?php echo $hotel_end->hotelURL; ?></a>
                                        </p>
                                    </div>
                                    <div class="col-2">
                                        <img src="<?php echo $hotel_end->hotelImage; ?>" alt="<?php echo $hotel_end->hotelName; ?>">
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <div class="col-1">
                    <div class="other-detail">
                        <ul>
                            <li>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/static/icon-language.png" alt="">
                                <span><?php echo $trip->tripLanguages; ?></span>
                            </li>
                            <li>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/static/icon-currency.png" alt="">
                                <span><?php echo $trip->tripCurrencies; ?></span>
                            </li>
                            <li>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/static/icon-food.png" alt="">
                                <span><?php echo $trip->tripFamousFood; ?></span>
                            </li>
                            <li>
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/static/icon-landmark.png" alt="">
                                <span><?php echo $trip->tripFamousLandmarks; ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
    </div>

    <div class="trip-detail">
        <div class="main-heading">
            TRIP DETAILS
        </div>

        <?php if ($trip_leader) : ?>
            <div class="subheading">TRIP LEADER(S)</div>
            <div class="trip-leader">
                <div class="leader-avatar">
                    <img src="<?php echo $trip_leader->leaderPic; ?>" alt="">
                    <strong><?php echo $trip_leader->leaderName; ?></strong>
                </div>
                <div class="leader-detail">
                    <p><?php echo $trip_leader->leaderBio; ?></p>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($trip->tripAirfare) : ?>
            <div class="airfare-detail">
                <div class="subheading">AIRFARE</div>
                <div class="content">
                    <?php echo $trip->tripAirfare; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ( count($trip_inclusions ) || count( $trip_exclusions ) ) : ?>
            <div class="inclusions">
                <div class="subheading">INCLUSIONS</div>
                <div class="inclusions-content">

                    <?php if ( count($trip_inclusions ) ) : ?>
                        <div class="col-2">
                            <p>The following is included with your registration fee:</p>
                            <ul>
                                <?php foreach ($trip_inclusions as $trip_inclusion) : ?>
                                    <li><?php echo $trip_inclusion->inclusion; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if ( count( $trip_exclusions ) ) : ?>
                        <div class="col-2">
                            <p>The following is NOT included with your registration fee:</p>
                            <ul>
                                <?php foreach ($trip_exclusions as $trip_exclusion) : ?>
                                    <li><?php echo $trip_exclusion->inclusion; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php  if ( $trip->tripTermsAndConditions ) : ?>
            <div class="airfare-detail term-conditions">
                <div class="subheading">TERMS &amp; CONDITIONS</div>
                <div class="content">
                    <p><?php echo $trip->tripTermsAndConditions; ?></p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>