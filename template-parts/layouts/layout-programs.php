<section class="programs flex">
    <?php while ( have_rows( 'programs' ) ) : the_row(); ?>
    <div class="col-2">
        <div class="programs__box">
            <?php  if ( $link = get_sub_field ( 'link' ) ) : ?>
                <a href="<?php echo $link['url']; ?>" title="<?php echo $link['title']; ?>" target="<?php echo $link['target']; ?>">
                    <?php
                        am_get_attachment( get_sub_field( 'image' ), 'full', true );
                        am_the_field( 'title', '<h4 class="title">', '</h4>', true );
                    ?>
                </a>
            <?php else : ?>
                <?php
                    am_get_attachment( get_sub_field( 'image' ), 'full', true );
                    am_the_field( 'title', '<h4 class="title">', '</h4>', true );
                ?>
            <?php endif; ?>
        </div>
    </div>
    <?php endwhile; ?>
</section>