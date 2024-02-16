<?php

/**
 * Shortcode for printing today's date
 */
function am_date_today_shortcode( $args ) {
    return '<div class="date">' . date('Y.m.d') . '</div>';
}
add_shortcode( 'date_today', 'am_date_today_shortcode' );