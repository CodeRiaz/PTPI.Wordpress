<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the section.content div and all content after.
 *
 * @since 1.0
 */
?>
    <!-- Footer -->
    <footer class="footer">
        <div class="container flex">

            <?php if ( have_rows( 'footer_columns', 'option' ) ) : while ( have_rows( 'footer_columns', 'option' ) ) : the_row(); ?>
                <div class="footer__detail col-3 flex">
                    <?php if ( get_sub_field( 'address' ) || have_rows( 'social_links' ) ) : ?>
                    <div class="footer__address col-1">
                        <?php
                            the_sub_field( 'address' );

                            if ( have_rows( 'social_links' ) ) :
                                am_the_field( 'social_links_title', '<p>', '</p>', true );
                            ?>
                                <ul class="social-icon">
                                    <?php while ( have_rows ( 'social_links' ) ) : the_row(); ?>
                                        <li>
                                            <a href="<?php the_sub_field( 'url' ); ?>" alt="<?php echo get_sub_field( 'network' )['label']; ?>">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/social/icon-<?php echo get_sub_field( 'network' )['value']; ?>.png" alt="<?php echo get_sub_field( 'network' )['label']; ?>">
                                            </a>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <?php if ( get_sub_field( 'contact_form' ) ) : ?>
                    <div class="footer__form col-3">
                        <?php
                            am_the_field( 'contact_form_heading', '<p>', '</p>', true );

                            if ( $form = get_sub_field( 'contact_form' ) ) {
                                echo do_shortcode( "[contact-form-7 id=\"{$form}\"]" );
                            }
                        ?>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if ( get_sub_field( 'map' ) ) : ?>
                <div class="footer__map col-1">
                    <?php the_sub_field( 'map' ); ?>
                    <div class="overlay"></div>
                </div>
                <?php endif; ?>
            <?php endwhile; endif; ?>

        </div>
    </footer>

    <?php wp_footer(); ?>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkEk-cL74u1FvvcwMAXEbERx7rZjYKQQ8&callback=initMap" async defer></script>
</body>
</html>