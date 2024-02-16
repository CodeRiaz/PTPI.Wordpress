<?php if ( get_field( 'faq_questions', 'option' ) ) : ?>
<section class="testimonial">
    <?php am_the_field( 'faq_heading', '<div class="main--heading">', '</div>', false, true ); ?>

    <div id="accordion">
        <?php while ( have_rows( 'faq_questions', 'option' ) ) : the_row(); ?>
            <h4 class="accordion-toggle">
                <div class="container"><?php the_row_index(); ?>. <?php the_sub_field( 'question' ); ?></div>
            </h4>
            <div class="accordion-content<?php echo get_row_index() == 1 ? ' default' : ''; ?>">
                <div class="container">
                    <p><?php the_sub_field( 'answer' ); ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>
<?php endif; ?>