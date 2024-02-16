<section class="chapter-detail">
    <div class="chapter-row">
        <?php if ( get_field( 'chapters_start_chapter', 'option' ) ) : ?>
            <div class="col-3 chapter-column">
                <?php $link = get_field( 'chapters_start_chapter_link', 'option' ) ?>
                <a href="<?php echo $link['url']; ?>" title="<?php echo $link['title']; ?>" target="<?php echo $link['target']; ?>">
                    <?php am_get_attachment( get_field( 'chapters_start_chapter_image', 'option' ), 'full', true ); ?>

                    <div class="text-overlay">
                        <h4 class="text"><?php the_field( 'chapters_start_chapter_title', 'option' ); ?></h4>
                    </div>

                    <div class="overlay-detail">
                        <p><?php the_field( 'chapters_start_chapter_description', 'option' ); ?></p>
                    </div>
                </a>
            </div>
        <?php endif; ?>

        <?php while( have_rows( 'chapters_chapters', 'option' ) ) : the_row(); ?>
            <div class="col-<?php echo in_array((get_row_index() + 1) % 4, [0, 1]) ? 3 : 1; ?> chapter-column">
                <?php $link = get_sub_field( 'link' ); ?>
                <a href="<?php echo $link['url']; ?>" title="<?php echo $link['title']; ?>" target="<?php echo $link['target']; ?>">
                    <?php am_get_attachment( get_sub_field( 'image' ), 'full', true ); ?>
                    <div class="text-overlay">
                        <h4 class="text"><?php the_sub_field( 'title' ); ?></h4>
                    </div>
                    <div class="overlay-detail">
                        <p><?php the_sub_field( 'description' ); ?></p>
                    </div>
                </a>
            </div>
        <?php endwhile; ?>

    </div>
</section>

<?php /* ?>
<section class="awards flex layout-<?php the_sub_field( 'layout' ); ?>">
    <div class="col-1">
        <div class="awards__copy">
            <?php
                am_the_field( 'subheading', '<div class="link">', '</div>', true );
                am_the_field( 'heading', '<h3 class="title">', '</h3>', true );
                the_sub_field( 'description' );
            ?>
        </div>
    </div>

    <div class="col-3">
        <div class="awards__photos flex">
            <?php foreach( $chapters as $index => $chapter ) : ?>
                <div class="col-2">
                    <div class="thumbnail">
                        <a href="#">
                            <?php am_get_attachment( get_post_thumbnail_id( $chapter ), 'full', true); ?>
                            <div class="overlay flex">
                                <h4 class="title"><?php echo get_the_title( $chapter ); ?></h4>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php */ ?>