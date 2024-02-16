<?php
    global $wpdb;

    if ( isset($_GET['mural_year']) && !empty($_GET['mural_year']) && is_numeric($_GET['mural_year']) ) {
        $mural_year = $_GET['mural_year'];
    } else {
        $mural_year = $wpdb->get_var( 'SELECT * FROM `PTPI-globalYouthMuralYears`', 1, 0);
    }

    $mural_bg_color = $wpdb->get_var( "SELECT * FROM `PTPI-globalYouthMuralYears` WHERE muralYear = $mural_year", 3, 0);

    $yearly_murals = $wpdb->get_results("SELECT * FROM `PTPI-globalYouthMurals` WHERE muralYear = $mural_year", OBJECT);
    $mural_years = $wpdb->get_results("SELECT * FROM `PTPI-globalYouthMuralYears` ORDER BY muralYear ASC", OBJECT);
?>
<div class="maural-gallery">
    <div class="maural-gallery-heading">
        <?php
            $before = "<h1 style=\"background-color: #$mural_bg_color;\">";
            am_the_field( 'heading', $before, '</h1>', true );
        ?>
    </div>

    <div class="maural-slider">
        <div class="container">
            <ul class="maural-slider-wrapper">
                <?php foreach($yearly_murals as $mural) : ?>
                <li class="maural-slider-single">
                    <img src="<?php echo $mural->muralImage; ?>" alt="<?php echo $mural->muralName; ?>">
                    <div class="single-hover">
                        <h2><?php echo $mural->muralCountry; ?></h2>
                        <h3><?php echo $mural->muralName; ?></h3>
                        <p><?php echo $mural->muralArtist; ?></p>
                        <span><?php echo $mural->muralYear; ?></span>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="years-progress">
        <?php foreach($mural_years as $mural_year) : ?>
            <a href="<?php the_permalink(); ?>?mural_year=<?php echo $mural_year->muralYear; ?>">
                <img src="<?php echo $mural_year->muralPromo ?>" alt="Mural <?php echo $mural_year->muralYear; ?>">
            </a>
        <?php endforeach; ?>
    </div>
</div>