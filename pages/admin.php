<?php
include_once("../models/Comment.php");
session_start();
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
if (isset($_POST['search'])) {
    $allComments = $getComments->getAllCommentsSearch($_POST['search'], $whichPage, $perPage);
} else {
    // envoie de la requette pour récupérer les commentaires en fonction de la page ou l'on se trouve
    $allComments = $getComments->getAllComments($whichPage, $perPage);
}
if (isset($_POST['delete'])) {
    $getComments->delete($_POST['delete']);
    header("location: ./admin.php");
}

?>

<?php include '../components/header.php'; ?>

<main class="livre-dor">
    <section>

        <section class="searchBar">
            <form action="" method="post">
                <input type="text" name="search" placeholder="Rechercher" class="inputSearch">
            </form>
        </section>
        <h1 class="livre-dor-titre">Vos réaction</h1>
        <?php foreach ($allComments as $comment) : ?>
            <article class="box-comment">
                <div class="box-comment-top">
                    <p class="comment"><?= $comment['comment'] ?></p>
                </div>
                <div class="box-comment-bottom">
                    <p class="box-comment-info">Posté le : <?= $comment['date'] ?></p>
                    <p class="box-comment-info"> Par : <?= $comment['login'] ?></p>
                    <form action="" method="post">
                        <button type="submit" name="delete" class="delete" value="<?= $comment['id'] ?>">Supprimer</button>
                    </form>
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