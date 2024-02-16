<?php if ( get_field( 'banner_image' )  || get_field( 'banner_video' ) ) : ?>
<section class="banner <?php the_field( 'banner_css_classes' ); ?>">
    <?php
       if ( get_field( 'banner_type' ) == 'image' ) :
            am_get_attachment( get_field( 'banner_image' ), 'full', true );
        else :
            $video_atts = 'muted';
            if ( get_field( 'autoplay' ) )
                $video_atts .= ' autoplay';
            am_the_video( get_field( 'banner_video' ) , $video_atts );
        endif;
    ?>
</section>
<?php endif; ?>