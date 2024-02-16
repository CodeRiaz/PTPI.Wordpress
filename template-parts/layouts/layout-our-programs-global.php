<section class="tabs_section global-book">
    <?php am_the_field( 'our_programs_heading', '<h3 class="main-heading no__bg">', '</h3>', false, true ); ?>

    <div class="flex layout-<?php the_field( 'our_programs_layout', 'option' ); ?>">
        <div class="tabs_section__column tabs_section__column--slider col-3 flex">
            <?php while ( have_rows( 'our_programs_programs', 'option' ) ) : the_row(); ?>
                <div class="tabs_section__column-content">
                    <div class="flex">
                        <?php if ( $image = get_sub_field( 'image' ) ) : ?>
                        <div class="col-1">
                            <?php if ( $link = get_sub_field( 'image_link' ) ) : ?>
                                <a href="<?php echo $link; ?>">
                                    <?php am_get_attachment( $image, 'full', true );; ?>
                                </a>
                            <?php
                                else :
                                    am_get_attachment( $image, 'full', true );
                                endif;
                            ?>
                        </div>
                        <?php endif; ?>

                        <div class="col-3">
                            <div class="book-description">
                                <?php
                                    am_the_field( 'heading', '<h4 class="title">', '</h4>', true );
                                    the_sub_field( 'description' );
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="tabs_section__column col-1">
            <ul class="tabs_section__list">
                <?php while ( have_rows( 'our_programs_programs', 'option' ) ) : the_row(); ?>
                <li class="tab-<?php the_row_index(); echo get_row_index() == 1 ? ' active' : ''; ?>" data-index="<?php the_row_index(); ?>">
                    <a href="#"><?php the_sub_field( 'title' ); ?></a>
                </li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>
</section>