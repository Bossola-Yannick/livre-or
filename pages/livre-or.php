<?php
include_once("../models/Comment.php");
include_once("../models/User.php");
session_start();
// initialisation des variable pour la pagination
$perPage = 5;

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
    unset($_SESSION['noSearchResult']);
    $allComments = $getComments->getAllCommentsSearch($_POST['search'], $whichPage, $perPage);
    if (count($allComments) == 0) {
        $_SESSION['noSearchResult'] = "Pas de résultat pour votre recherche";
        $allComments = $getComments->getAllComments($whichPage, $perPage);
    }
} else {
    // envoie de la requette pour récupérer les commentaires en fonction de la page ou l'on se trouve
    $allComments = $getComments->getAllComments($whichPage, $perPage);
}
if (isset($_POST['new-comment'])) {
    header("location: ./commentaire.php");
}

?>

<?php include '../components/header.php'; ?>

<main class="livre-dor">
    <section>

        <section class="searchBar">
            <form action="" method="post">
                <input type="text" name="search" placeholder="Rechercher" class="inputSearch">
                <?php if (isset($_SESSION['noSearchResult'])): ?>
                    <p class="errorSearch"><?= $_SESSION['noSearchResult'] ?></p>
                <?php endif ?>
            </form>
        </section>
        <h1 class="livre-dor-titre">Vos réaction</h1>
        <?php if (isset($_SESSION['userId'])) : ?>
            <form action="" method="post">
                <button type="submit" name="new-comment" class="button-new-comment"><span class="bold">→</span> Poster un Commentaire <span class="bold">←</span></button>
            </form>
        <?php endif ?>
        <?php foreach ($allComments as $comment) : ?>
            <?php
            $userId = $comment['userId'];
            $user = new User();
            $userNumber = $user->changeNumber(intval($userId));
            ?>
            <article class="box-comment">
                <div class="box-comment-top">
                    <p class="comment"><?= $comment['comment'] ?></p>
                </div>
                <div class="box-comment-bottom">
                    <p class="box-comment-info">Posté le : <?= $comment['date'] ?></p>
                    <p class="box-comment-info"> Par : <?= $comment['login'] . " { " . $userNumber . " }" ?></p>
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