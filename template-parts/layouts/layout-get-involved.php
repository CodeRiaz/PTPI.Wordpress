<section class="tabs_section">
    <?php am_the_field( 'heading', '<h3 class="main-heading">', '</h3>', true ); ?>

    <div class="flex layout-<?php the_sub_field( 'layout' ); ?>">
        <div class="tabs_section__column col-3 half-background">
            <?php am_get_attachment( get_sub_field( 'image' ), 'full', true ); ?>
        </div>

        <div class="tabs_section__column col-1">
            <ul class="tabs_section__list no-js">
                <?php while ( have_rows( 'links' ) ) : the_row(); ?>
                <li<?php echo get_row_index() == 1 ? ' class="active"' : ''; ?>>
                    <?php am_the_link( get_sub_field( 'link' ) ); ?>
                </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
</section>