<?php
    if ( isset($_GET['story']) && !empty($_GET['story']) && is_numeric($_GET['story']) ) {
        global $wpdb;
        $id = $_GET['story'];

        $story = $wpdb->get_results("SELECT * FROM `PTPI-stories` WHERE recid = $id", OBJECT);

        if ($story) {
            $story = $story[0];
        } else {
            exit;
        }
    } else {
        exit;
    }
?>
    <div class="ceo-employees">
    <div class="flex layout-forward">
        <div class="col-1">
            <img src="<?php echo $story->storyPromoImage; ?>" alt="<?php echo $story->storyPeople; ?>">
        </div>
        <div class="col-3">
            <div class="description">
                <div class="name">
                    <div class="bold"><?php echo $story->storyPeople; ?></div>
                    <?php echo $story->storyCountry; ?>
                </div>
                <p><?php echo $story->storyText; ?></p>
            </div>
        </div>
    </div>
</div>