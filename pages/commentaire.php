<?php
session_start();
include_once("../models/Comment.php");

if (isset($_POST['postNewComment'])) {
    if ($_POST['newComment'] == "") {
        $_SESSION['emptyComment'] = "Veuillez remplir le champ commentaire avant de validé !";
    } else {
        unset($_SESSION['emptyComment']);
        $newComment = new Comment();
        $date = new DateTime("now");
        $_SESSION['date'] = $date;
        $newDate = $_SESSION['date']->format('Y-m-d H:i:s');
        $myComment = $_POST['newComment'];
        $userid = $_SESSION['userId'];
        $newComment->create($myComment, $newDate, $userid);
        header("location: ./livre-or.php");
    }
}



?>
<?php include '../components/header.php'; ?>

<main class="main-comment">

    <section class="new-comment">

        <h1 class="new-comment-title">Merci de donner votre avis</h1>
        <?php if (isset($_SESSION['emptyComment'])) : ?>
            <p class="empty-comment"><?= $_SESSION['emptyComment'] ?></p>
        <?php endif ?>
        <form action="" method="post" class="new-comment-form">
            <textarea name="newComment" id="" cols="70" rows="10" placeholder="entrez votre commentaire ici"></textarea>
            <button type="submit" name="postNewComment" class="button-new-comment">Validé</button>
        </form>
    </section>



</main>




<?php include '../components/footer.php'; ?>