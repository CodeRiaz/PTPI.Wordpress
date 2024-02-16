<?php
/**
 * The header for our theme
 *
 * @since 1.0
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="ie6 ie" lang="en"><![endif]-->
<!--[if IE 7]><html class="ie7 ie" lang="en"><![endif]-->
<!--[if IE 8]><html class="ie8 ie" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 ie" lang="en"><![endif]-->
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

    <?php do_action( 'am_body_start' ); ?>

    <!-- Header -->
    <header class="header">
        <div class="container flex">
            <div class="header__logo">
                <a href="<?php bloginfo( 'url' ); ?>">
                    <?php am_get_logo( 'header', true ); ?>
                </a>
            </div>
            <div class="header__nav flex">
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'header',
                        'container' => 'div',
                        'container_class' => 'menu__wrapper',
                        'menu_class' => 'header__nav__list'
                    ) );
                ?>

                <div class="header__user">
                    <a href="#">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/people-icon.png" alt="">
                    </a>
                </div>

                <div id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </header>