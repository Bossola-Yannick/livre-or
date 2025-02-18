<?php
session_start();

include_once("../models/User.php");
include_once("../models/Comment.php");

var_dump($_SESSION);
var_dump($_POST);

$newUser = new User();
$newComment = new Comment();
$userComment = $newComment->getAllCommentByUser($_SESSION['userId']);
var_dump($userComment);

if (isset($_SESSION['message'])) {
    $_SESSION['message'] = "";
}

if (isset($_POST['submitLogin'])) {
    if (!empty($_POST['newLogin'])) {
        $userLogin = $_SESSION['userLogin'];
        $newLogin = htmlentities($_POST['newLogin']);
        $newUser->updateUserLogin($userLogin, $newLogin);
        header('refresh: 1 ; url=profil.php');
    }
}

if (isset($_POST['submitPass'])) {
    if (!empty($_POST['newPass']) and (!empty($_POST['currentPass']))) {
        $userId = $_SESSION['userId'];
        $currentPass = htmlentities($_POST['currentPass']);
        $newPass = htmlentities($_POST['newPass']);

        $newUser->updateUserPassword($userId, $currentPass, $newPass);
        header('refresh: 1 ; url=profil.php');
    }
}

?>



<?php include '../components/header.php'; ?>

<main>
    <div class="profil-box">

        <section class="error-profil">
            <?php if (!isset($_SESSION['userId'])): ?>
                <article>
                    <p>Vous n'êtes pas connecté</p>
                </article>
                <div class="button-box">
                    <form action="" method="post">
                        <input type="submit" name="connexion" id="connexion" class="button-index" value="Connexion">
                    </form>
                </div>
        </section>

    <?php else: ?>

        <section class="profil-infos">
            <div class=" profil-title">
                <h2>Mon profil</h2>
            </div>
            <!--  -->
            <article class="infos-box">
                <form action="" method="post">
                    <!-- pseudo -->
                    <div class="editLogin">
                        <p>Pseudo:
                            <?php if (isset($_POST['editLogin'])): ?>
                                <input type="text" name="newLogin" id="pseudo" class="" placeholder="nouveau pseudo" minlength="3" />
                                <button type="submit" name="cancelLogin" id="cancel" class="" value="">Annuler pseudo modif</button>
                                <input type="submit" name="submitLogin" id="submitLogin" class="" value="Valider">
                            <?php else: ?>

                                <span><?= $_SESSION['userLogin'] ?></span>
                        </p>
                        <button type="submit" name="editLogin" id="modifier" class="" value="">Modifier pseudo</button>
                    <?php endif; ?>
                    </div>

                    <!-- mot de passe -->
                    <div class="editPass">
                        <p>Mot de passe:
                            <?php if (isset($_POST['editPass'])): ?>
                                <input type="password" name="currentPass" id="currentPass" class="" placeholder="mot de passe actuel" minlength="3" />
                                <input type="password" name="newPass" id="newPass" class="" placeholder="nouveau mot de passe" minlength="3" />
                                <button type="submit" name="cancelPass" id="cancel" class="" value="">Annuler mdp</button>
                                <input type="submit" name="submitPass" id="submitPass" class="" value="Valider">
                            <?php else: ?>
                                <span>**********</span>
                        </p>
                        <button type="submit" name="editPass" id="modifier" class="" value="">Modifier mot de passe</button>

                    <?php endif; ?>

                    </div>

                    <?php if (isset($_SESSION['message'])): ?>
                        <p><?= $_SESSION['message']; ?></p>
                    <?php endif; ?>
                </form>
            </article>
        </section>
        <!-- commentaires de l'user -->
        <section class="commentUser">

            <?php foreach ($userComment as $comment): ?>
                <article class="index-box-comment">
                    <div class="box-comment-top">
                        <p class="comment"><?= $comment['comment'] ?></p>
                    </div>
                    <div class="box-comment-bottom">
                        <p class="box-comment-info">Posté le : <?= $comment['date'] ?></p>

                    </div>
                </article>
            <?php endforeach; ?>
        </section>
    </div>
<?php endif; ?>
</main>

<?php include '../components/footer.php'; ?>