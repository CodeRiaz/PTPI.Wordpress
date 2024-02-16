<section class="mission-vision layout-<?php the_sub_field( 'layout' ); ?>">
    <?php if ( get_sub_field( 'images' ) ) : ?>
    <div class="mission-vision__thumbnail col-2 slick-int">
        <?php foreach( get_sub_field( 'images' ) as $image ) : ?>
            <div class="item"><?php am_get_attachment( $image['id'], 'full', true ); ?></div>
        <?php endforeach; ?>
    </div>
    <?php else : ?>
    <div class="mission-vision__thumbnail col-2">
        <?php am_the_video( get_sub_field( 'video' ) ); ?>
    </div>
    <?php endif; ?>

    <?php if ( get_sub_field( 'single_heading' ) || have_rows( 'values' ) ) : ?>
    <div class="mission-vision__description col-2">
        <div class="mission-vision__inner<?php echo get_sub_field( 'single_heading' ) ? ' history__text' : ''; ?>">
            <?php
                if ( get_sub_field( 'single_heading' ) ) {
                    am_the_field( 'single_heading', '<h2 class="title">', '</h2>', true );
                } else {
                    while ( have_rows( 'values' ) ) : the_row();
                        am_the_field( 'heading', '<h2 class="title">', '</h2>', true );
                        am_the_field( 'description', '<p class="copy">', '</p>', true );
                    endwhile;
                }
            ?>
        </div>
    </div>
    <?php endif; ?>
</section>