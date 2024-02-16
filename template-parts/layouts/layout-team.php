<div class="ceo-employees">
    <div class="team-members">
        <?php am_the_field( 'heading', '<div class="heading">', '</div>', true ); ?>

        <ul class="employees">
            <?php while ( have_rows( 'team_members' ) ) : the_row(); ?>
            <li>
                <div class="avatar">
                    <?php am_get_attachment( get_sub_field( 'image' ), 'medium', true ); ?>
                </div>

                <div class="overlay">
                    <p>
                        <?php
                            the_sub_field( 'name' );
                            am_the_field( 'designation', '<br>', '', true );
                        ?>
                    </p>
                    <a href="mailto:<?php the_sub_field( 'email' ); ?>">
                        <?php the_sub_field( 'email' ); ?>
                    </a>
                    <a href="tel:<?php the_sub_field( 'phone' ); ?>">
                        <?php the_sub_field( 'phone' ); ?>
                    </a>
                    <?php /* if ( get_sub_field( 'email' ) || get_sub_field( 'phone' ) ) : ?>
                    <ul class="links flex">
                        <li>
                            <a href="mailto:<?php the_sub_field( 'email' ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/social/icon-email.png" alt="<?php the_sub_field( 'email' ); ?>">
                            </a>
                        </li>
                        <li>
                            <a href="tel:<?php the_sub_field( 'phone' ); ?>">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/social/icon-phone.png" alt="<?php the_sub_field( 'phone' ); ?>">
                            </a>
                        </li>
                    </ul>
                    <?php endif; */ ?>
                </div>
            </li>
            <?php endwhile; ?>
        </ul>
    </div>
</div>