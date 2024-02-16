<div class="ceo-employees">
    <div class="flex layout-<?php the_sub_field( 'layout' ); ?>">
        <div class="col-1">
            <?php am_get_attachment( get_sub_field( 'image' ), 'full', true ); ?>
        </div>
        <div class="col-3">
            <div class="description">
                <div class="name">
                    <?php
                        am_the_field( 'name', '<div class="bold">', '</div>', true );
                        the_sub_field( 'organization' );
                    ?>
                </div>
                <?php the_sub_field( 'message' ); ?>
            </div>
        </div>
    </div>
</div>