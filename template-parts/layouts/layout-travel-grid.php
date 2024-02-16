<div class="travel-detail">
    <div class="flex">
        <?php while ( have_rows( 'boxes' ) ) : the_row(); ?>
        <?php $video_atts = 'muted'; ?>
        <div class="col-2 box-title">

            <div class="thumbnail">
                <?php
                    if ( get_sub_field( 'type1' ) == 'image' ) :
                        $link = get_sub_field( 'link1' );
                        echo '<div class="object-container"><a href="' . $link['url'] . '" target="' . $link['target'] . '">';
                        am_get_attachment( get_sub_field( 'image1' ), 'full', true );
                        echo '</a></div>';
                    else :
                        if ( get_sub_field( 'autoplay1' ) )
                            $video_atts .= ' autoplay';
                        am_the_video( get_sub_field( 'video1' ), $video_atts );
                    endif;
                ?>
            </div>


            <div class="thumbnail">
                <?php
                    if ( get_sub_field( 'type2' ) == 'image' ) :
                        $link = get_sub_field( 'link2' );
                        echo '<div class="object-container"><a href="' . $link['url'] . '" target="' . $link['target'] . '">';
                        am_get_attachment( get_sub_field( 'image2' ), 'full', true );
                        echo '</a></div>';
                    else :
                        if ( get_sub_field( 'autoplay2' ) )
                            $video_atts .= ' autoplay';
                        am_the_video( get_sub_field( 'video2' ), $video_atts );
                    endif;
                ?>
            </div>

            <?php am_the_field( 'title', '<div class="thumbnail-desc">', '</div>', true ); ?>
        </div>
        <?php endwhile; ?>
    </div>
</div>