<div class="stories flex">
    <div class="col-1">
        <div class="stories__copy">
            <?php
                am_the_field( 'heading', '<h4 class="title">', '</h4>', true );
                the_sub_field( 'description' );
            ?>
        </div>
    </div>

    <div class="col-3 stories__thumbnails">
        <ul>
        <?php while ( have_rows ( 'stories' ) ) : the_row(); ?>
            <li>
                <div class="thumbnail">
                    <?php am_get_attachment( get_sub_field( 'image' ), 'thumbnail-story-small', true ); ?>
                </div>
                <div class="location-overlay">
                    <?php $link = get_sub_field( 'link' ); ?>
                    <a href="<?php echo $link['url'] ?? '#'; ?>" target="<?php echo $link['target'] ?? ''; ?>">
                        <?php am_the_field( 'name', '<strong>', '</strong>', true ); ?>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ptpi-globe.png" alt="" title="" >
                        <?php am_the_field( 'location', '<p>', '</p>', true ); ?>
                    </a>
                </div>
            </li>
        <?php endwhile; ?>
        </ul>
    </div>
</div>