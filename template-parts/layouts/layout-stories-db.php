<?php
    global $wpdb;
    $stories = $wpdb->get_results("SELECT * FROM `PTPI-stories` WHERE active = 1");

    if ($stories) :
?>
<div class="stories flex">
    <div class="col-1">
        <div class="stories__copy">
            <?php
                am_the_field( 'heading', '<h4 class="title">', '</h4>', true );
                the_sub_field( 'description' );
            ?>
        </div>
    </div>

    <div class="col-3 stories__thumbnails">
        <ul>
        <?php foreach ( $stories as $story ) : ?>
            <li>
                <div class="thumbnail">
                    <img src="<?php echo $story->storyPromoImage; ?>" alt="<?php echo $story->storyPeople; ?>">
                </div>
                <div class="location-overlay">
                    <a href="/about/ptpi-story-details/?story=<?php echo $story->recid; ?>">
                        <strong><?php echo $story->storyPeople; ?></strong>
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/ptpi-globe.png" alt="" title="" >
                        <p><?php echo $story->storyCountry; ?></p>
                    </a>
                </div>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php endif; ?>