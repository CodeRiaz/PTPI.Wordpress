<?php
    global $wpdb;

    // Process form
    if (isset($_POST['insert']) && isset($_POST['book_id'])) {
        $id = $_POST['book_id'];

        if ($_POST['book_insert_type'] == 'comment') {
            $wpdb->insert('PTPI-bookComments', array(
                'bookID' => $id,
                'commentName' => trim($_POST['book_author']),
                'bookComment' => trim($_POST['book_comment']),
            ));
        }
    }

    $book = $is_previous = false;
    if ( isset($_GET['book']) && !empty($_GET['book']) && is_numeric($_GET['book']) ) {
        $id = $_GET['book'];

        $book = $wpdb->get_results("SELECT * FROM `PTPI-books` WHERE recid = $id", OBJECT);

        if ($book) {
            $book = $book[0];
        }

        $is_previous = true;
    } else {
        $book = $wpdb->get_results("SELECT * FROM `PTPI-books` WHERE active = 1", OBJECT);

        if ($book) {
            $book = $book[0];
        }
    }

    $questions = $wpdb->get_results("SELECT * FROM `PTPI-discussionQuestions` WHERE bookID = $book->recid AND active = 1", OBJECT);
    $comments = $wpdb->get_results("SELECT * FROM `PTPI-bookComments` WHERE bookID = $book->recid", OBJECT);
?>
<div class="tabs_section global-book">
    <?php am_the_field( 'heading', '<h3 class="main-heading no__bg my-heading">', '</h3>', true ); ?>
    <div class="book-selection">

        <?php if ( $book ) : ?>
        <div class="col-1">
            <div class="current-book"> 
                    <img src="<?php echo $book->bookImage; ?>" alt="<?php echo $book->bookTitle; ?>">
                 <?php if (!$is_previous) : ?>
                    <h3>OUR CURRENT SELECTION</h3>
                <?php endif; ?>

                <span><?php echo $book->bookTitle; ?></span>

                <p>by <?php echo $book->bookAuthor; ?><p>
                <p><?php echo $book->bookSynopsis; ?></p>
            </div>
        </div>
        <?php endif; ?>

        <div class="col-3">
            <div class="current-book-accordion">
                <div id="accordion1" class="accordion">
                    <h3 class="accordion-toggle">SIGN UP FOR THE GLOBAL BOOK CLUB</h3>
                    <div class="accordion-content default accordion-signup"> 
                        <?php echo do_shortcode(get_sub_field('form_shortcode')); ?>
                    </div>

                    <h3 class="accordion-toggle">DISCUSSION QUESTIONS</h3>
                    <div class="accordion-content questions-blocks-wrapper">
                        <div class="questions-block">
                            <?php
                                $question_count = 1;
                                foreach($questions as $question) :
                                    if ($question_count%5 == 0) {
                                        echo '</div><div class="questions-block">';
                                    }
                            ?>
                                <p class="accordion-questions"><?php echo $question_count++ . ". {$question->discussionQuestion}"; ?></p>
                            <?php endforeach; ?>
                        </div>

                        <ul class="accordion-ul questions-pagination">
                            <?php for($i = 1; $i <= ceil($question_count / 5); $i++) : ?>
                                <li><a href="#"<?php echo $i == 1 ? ' class="active"' : ''; ?>><?php echo $i; ?></a></li>
                            <?php endfor; ?>
                        </ul>
                        <h4>What Do You Think?</h4>
                        <form action="" method="post">
                            <input type="hidden" name="book_id" value="<?php echo $book->recid; ?>">
                            <input type="hidden" name="book_insert_type" value="comment">
                            <input type="text" name="book_author" value="" placeholder="Name">
                            <textarea name="book_comment"></textarea>
                            <button type="submit" name="insert">Submit</button>
                        </form>
                    </div>
                    <h3 class="accordion-toggle">RECENT COMMENTS</h3>
                    <div class="accordion-content comments-blocks-wrapper">
                        <div class="comments-block">
                            <?php
                                $comment_count = 1;
                                foreach($comments as $comment) :
                                    if ($comment_count%8 == 0) {
                                        echo '</div><div class="comments-block">';
                                    }
                            ?>
                                <p><strong><?php echo $comment->commentName; ?>:</strong> <?php echo $comment->bookComment; ?></p>
                            <?php endforeach; ?>
                        </div>

                        <ul class="accordion-ul">
                            <?php for($i = 1; $i <= ceil($comment_count / 8); $i++) : ?>
                                <li><a href="#"<?php echo $i == 1 ? ' class="active"' : ''; ?>><?php echo $i; ?></a></li>
                            <?php endfor; ?>
                        </ul>
                        <h4>What Do You Think?</h4>
                        <form action="" method="post">
                            <input type="hidden" name="book_id" value="<?php echo $book->recid; ?>">
                            <input type="hidden" name="book_insert_type" value="comment">
                            <input type="text" name="book_author" value="" placeholder="Name">
                            <textarea name="book_comment"></textarea>
                            <button type="submit" name="insert">Submit</button>
                        </form>
                    </div>


                </div>

            </div>

        </div>
    </div>

    <?php
        $books = $wpdb->get_results("SELECT * FROM `PTPI-books` WHERE active != 1", OBJECT);

        if ($books) :
    ?>
    <div class="previous-books">
        <h3>PREVIOUS BOOK CLUB SELECTION</h3>
        <div class="previous-books-inner">
            <ul class="slider_wrapper">
                <?php foreach($books as $book) : ?>
                <li>
                    <a href="<?php echo get_permalink() . '?book=' . $book->recid; ?>">
                        <img src="<?php echo $book->bookImage; ?>" alt="<?php echo $book->bookTitle; ?>">
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <?php endif; ?>
</div>