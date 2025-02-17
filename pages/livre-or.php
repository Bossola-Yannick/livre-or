<?php

include_once("../models/Comment.php");

$getComments = new Comment();
$AllComments = $getComments->getAllComments();

?>

<?php include '../components/header.php'; ?>

<main class="livre-dor">
    <section>

        <h1 class="livre-dor-titre">Vos réaction</h1>
        <button type="submit" name="new-comment" class="button-new-comment"><span class="bold">→</span> Poster un Commentaire <span class="bold">←</span></button>

        <?php foreach ($AllComments as $comment) : ?>
            <article class="box-comment">
                <div class="box-comment-top">
                    <p class="comment"><?= $comment['comment'] ?></p>
                </div>
                <div class="box-comment-bottom">
                    <p class="box-comment-info"><?= $comment['date'] ?></p>
                    <p class="box-comment-info"><?= $comment['login'] ?></p>
                </div>
            </article>
        <?php endforeach ?>








    </section>
</main>
<?php include '../components/footer.php'; ?>