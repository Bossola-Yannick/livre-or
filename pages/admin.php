<?php

include_once("../models/Comment.php");

// initialisation des variable pour la pagination
$perPage = 10;

$getComments = new Comment();

// comptage du nombre de commentaire
$nbComments = $getComments->countComment();
$nbComment = $nbComments[0]['nbComment'];

// calcule du nombre de pages
$nbPage = ceil($nbComment / $perPage);

// condition pour savoir quelle page est affiché
if ((isset($_GET['p'])) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage) {
    $whichPage = $_GET['p'];
} else {
    $whichPage = 1;
}

// envoie de la requette pour récupérer les commentaires en fonction de la page ou l'on se trouve
$AllComments = $getComments->getAllComments($whichPage, $perPage);
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
    <section class="pagination">
        <?php for ($i = 1; $i <= $nbPage; $i++) : ?>
            <?php if ($i == $whichPage) : ?>
                <span> <?= $i ?> / </span>
            <?php else : ?>
                <a href="livre-or.php?p=<?= $i ?>" ?><?= $i ?> /</a>
            <?php endif ?>
        <?php endfor ?>
    </section>
</main>
<?php include '../components/footer.php'; ?>