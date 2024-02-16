<?php
/***
 * Template Name: Chapter Single
 */


if (isset($_GET['chapter_id']) && !empty($_GET['chapter_id'])) {
    $chapter_id = $_GET['chapter_id'];
    $chapter = $wpdb->get_results("SELECT * FROM `PTPI-chapters` WHERE recid = $chapter_id");

    if ($chapter) {
        $chapter = $chapter[0];
    } else {
        wp_redirect('/chapters');
    }
} else {
    wp_redirect('/chapters');
}

get_header();

?>
<?php get_template_part('template-parts/map-chapters'); ?>

<section class="chapter--single-content">
    <div class="row">
        <div class="chapter-description">
            <h1 class="title"><?php echo trim(str_replace(['chapter', 'Chapter', 'chapters', 'Chapters'], '', $chapter->chapterName)); ?></h1>
            <h2 class="subtitle"><?php echo $chapter->chapterMainCity; ?>, <?php echo $chapter->chapterMainCountry; ?></h2>
            <ul class="social-icon">
                <?php if (!empty($chapter->chapterFacebook)) : ?>
                <li>
                    <a href="<?php echo $chapter->chapterFacebook; ?>" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/social/icon-facebook.png" alt="">
                    </a>
                </li>
                <?php endif; ?>

                <?php if (!empty($chapter->chapterTwitter)) : ?>
                <li>
                    <a href="<?php echo $chapter->chapterTwitter; ?>" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/social/icon-twitter.png" alt="">
                    </a>
                </li>
                <?php endif; ?>

                <?php if (!empty($chapter->chapterInstagram)) : ?>
                <li>
                    <a href="<?php echo $chapter->chapterInstagram; ?>" target="_blank">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/social/icon-instagram.png" alt="">
                    </a>
                </li>
                <?php endif; ?>
            </ul>

            <?php if (!empty($chapter->chapterStory)) : ?>
            <p class="copy"><?php echo $chapter->chapterStory; ?></p>
            <?php endif; ?>
        </div>

        <?php if (!empty($chapter->chapterPromoImage)) : ?>
            <div class="chapter-thumbnail">
                <img src="<?php echo $chapter->chapterPromoImage; ?>" alt="<?php echo $chapter->chapterName; ?>">
            </div>
        <?php endif; ?>
    </div>
</section>
    <?php
am_render_flexible_rows();

get_footer();