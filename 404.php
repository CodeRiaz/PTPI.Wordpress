<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @since 1.0
 */

    get_header();
?>
<div class="container">
    <div class="page-not-found">
        <h1>404</h1>
        <p>We couldn't find the page you are looking for.</p>
        <a href="<?php echo home_url(); ?>" class="black-btn">Back to Home</a>
    </div>
</div>
<?php get_footer(); ?>