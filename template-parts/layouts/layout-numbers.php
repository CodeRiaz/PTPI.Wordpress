<?php $section_overlap = get_sub_field( 'section_overlap' ) ? ' pull-up' : ''; ?>
<?php if ( have_rows( 'number_boxes' ) ) : ?>
<section class="boxes<?php echo $section_overlap; ?>">
    <div class="container">
        <ul>
            <?php while ( have_rows( 'number_boxes' ) ) : the_row(); ?>
            <li>
                <?php $field = get_sub_field_object('number'); ?>
                <span id="<?php echo $field['name']; ?>" class="number countup" data-number="<?php the_sub_field( 'number' ); ?>" data-prefix="<?php the_sub_field( 'number_prefix' ); ?>" data-suffix="<?php the_sub_field( 'number_suffix' ); ?>"><?php the_sub_field( 'number_prefix' ); the_sub_field( 'number' ); the_sub_field( 'number_suffix' ); ?></span>
                <?php am_the_field( 'label', '<p>', '</p>', true ); ?>
            </li>
            <?php endwhile; ?>
        </ul>

        <?php am_the_field( 'description', '<div class="boxes__description">', '</div>', true ); ?>
    </div>
</section>
<?php endif; ?>