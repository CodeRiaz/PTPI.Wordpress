<?php

/***
 * Template Name: Composer
 */

get_header();

if ( get_field( 'use_map' ) ) {
    get_template_part('template-parts/map', 'chapters');
} else {
    get_template_part('template-parts/hero-banner');
}

am_render_flexible_rows();

get_footer();