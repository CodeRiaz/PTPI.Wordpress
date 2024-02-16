<?php
/***
 * Template Name: Chapters Single
 */

get_header();

?>
<section class="banner chapter">
    <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/chapter-single-banner.png" alt="">
    <div class="find-chapter">
        <select>
            <option>--COUNTRY--</option>
        </select>
        <select>
            <option>--CHAPTER--</option>
        </select>
    </div>
</section>

<section class="chapter--single-content">
    <div class="row">
        <div class="chapter-description">
            <h1 class="title">CERET, FRANCE CHAPTER</h1>
            <h2 class="subtitle">Ceret, France</h2>
            <ul class="social-icon">
                <li><a href="#">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/social/icon-facebook.png"
                            alt="">
                    </a>
                </li>
                <li><a href="#">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/social/icon-instagram.png"
                            alt="">
                    </a>
                </li>
                <li><a href="#">
                        <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/social/icon-twitter.png"
                            alt="">
                    </a>
                </li>
            </ul>
            <p class="copy">Ceret is a delightful surprise, a righteously
                gorgeous Catalan village in the Eastern
                Pyrenees with a history of famous artists!
                Gris, Braque, Chagall, Dali, Matisse, and
                Picasso all lived in Ceret and their works hang
                in the Modern Art Museum here.</p>
        </div>
        <div class="chapter-thumbnail">
            <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/chapter-single-thumbnail.png" alt="">
        </div>
    </div>
</section>
    <?php
am_render_flexible_rows();

get_footer();