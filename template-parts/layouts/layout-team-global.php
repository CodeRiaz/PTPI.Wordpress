<div class="ceo-employees">
    <div class="team-members">
        <?php am_the_field( 'team_heading', '<div class="heading">', '</div>', false, true ); ?>

        <ul class="employees">
            <?php while ( have_rows( 'team_team_members', 'option' ) ) : the_row(); ?>
            <li>
                <div class="avatar">
                    <?php am_get_attachment( get_sub_field( 'photo' ), 'medium', true ); ?>
                </div>

                <div class="overlay">
                    <p>
                        <?php
                            the_sub_field( 'name' );
                            am_the_field( 'designation', '<br>', '', true );
                        ?>
                    </p>
                    <a href="mailto:<?php the_sub_field( 'email' ); ?>"><?php the_sub_field( 'email' ); ?></a>
                    <a href="tel:<?php the_sub_field( 'phone' ); ?>"><?php the_sub_field( 'phone' ); ?></a>
                </div>
            </li>
            <?php endwhile; ?>
        </ul>
    </div>
</div>