<div class="ceo-employees">
    <div class="flex layout-<?php the_field( 'ceo_layout', 'option' ); ?>">
        <div class="col-1">
            <?php am_get_attachment( get_field( 'ceo_photo', 'option' ), 'full', true ); ?>
        </div>
        <div class="col-3">
            <div class="description">
                <div class="name">
                    <?php
                        am_the_field( 'ceo_name', '<div class="bold">', '</div>', false, true );
                        the_field( 'ceo_organization', 'option' );
                    ?>
                </div>
                <?php the_field( 'ceo_message', 'option' ); ?>
            </div>
        </div>
    </div>
</div>