<?php
require '../config.php';
session_start();

include_once("../models/User.php");
include_once("../models/Comment.php");

if (!isset($_SESSION['userId'])) {
    header("location: ../index.php");
    exit();
}

$newUser = new User();
$newComment = new Comment();
$userComment = $newComment->getAllCommentByUser($_SESSION['userId']);

if (isset($_SESSION['message'])) {
    $_SESSION['message'] = "";
}

if (isset($_POST['submitLogin'])) {
    if (!empty($_POST['newLogin'])) {
        $userLogin = $_SESSION['userLogin'];
        $newLogin = htmlentities($_POST['newLogin']);
        $newUser->updateUserLogin($userLogin, $newLogin);
        header('refresh: 2 ; url=profil.php');
        exit();
    }
}

if (isset($_POST['submitPass'])) {
    if (!empty($_POST['newPass']) and (!empty($_POST['currentPass']))) {
        $userId = $_SESSION['userId'];
        $currentPass = htmlentities($_POST['currentPass']);
        $newPass = htmlentities($_POST['newPass']);

        $newUser->updateUserPassword($userId, $currentPass, $newPass);
        header('refresh: 2 ; url=profil.php');
        exit();
    }
}

?>


<?php include '../components/header.php'; ?>

<main>
    <div class="profil-box">

        <?php if (!isset($_SESSION['userId'])): ?>
            <section class="error-profil">

                <article>
                    <p>Vous n'êtes pas connecté</p>
                </article>
                <div class="button-box">
                    <form action="" method="post">
                        <input type="submit" name="connexion" id="connexion" class="button-index button-index-green" value="Connexion">
                    </form>
                </div>
            </section>

        <?php else: ?>

            <section class="profil-infos">
                <div class=" profil-title pink">
                    <h2>Mon profil</h2>
                    <hr class="separator">
                </div>
                <!--  -->

                <form action="" method="post" class="infos-box">
                    <!-- pseudo -->
                    <div class="edit-box">
                        <?php if (isset($_POST['editLogin'])): ?>

                            <p class="profil-text">Pseudo:</p>
                            <input type="text" name="newLogin" id="pseudo" class="edit-input" placeholder="nouveau pseudo" minlength="3" />

                            <div class="info-duo">
                                <button type="submit" name="cancelLogin" id="cancel" class="button-index button-index-red" value="">Annuler</button>
                                <input type="submit" name="submitLogin" id="submitLogin" class="button-index button-index-green" value="Valider">
                            </div>


                        <?php else: ?>

                            <p class="profil-text">Pseudo:
                                <span class="pink"><?= $_SESSION['userLogin'] ?></span>
                            </p>
                            <button type="submit" name="editLogin" id="modifier" class="button-index button-index-blue" value="">Modifier pseudo</button>

                        <?php endif; ?>

                    </div>

                    <!-- mot de passe -->
                    <div class="edit-box">

                        <?php if (isset($_POST['editPass'])): ?>

                            <p class="profil-text">Mot de passe: </p>
                            <input type="password" name="currentPass" id="currentPass" class="edit-input" placeholder="mot de passe actuel" minlength="3" />
                            <input type="password" name="newPass" id="newPass" class="edit-input" placeholder="nouveau mot de passe" minlength="3" />
                            <div class="info-duo">
                                <button type="submit" name="cancelPass" id="cancel" class="button-index button-index-red">Annuler</button>
                                <input type="submit" name="submitPass" id="submitPass" class="button-index button-index-green" value="Valider">
                            </div>
                        <?php else: ?>
                            <p class="profil-text">Mot de passe:
                                <span class="pink">*****</span>
                            </p>
                            <button type="submit" name="editPass" id="modifier" class="button-index button-index-blue" value="">Modifier mot de passe</button>

                        <?php endif; ?>

                    </div>

                    <?php if (isset($_SESSION['message'])): ?>
                        <p class="msg-show"><?= $_SESSION['message']; ?></p>
                    <?php endif; ?>
                </form>

            </section>
            <!-- commentaires de l'user -->
            <section class="commentUser">

                <?php foreach ($userComment as $comment): ?>
                    <article class="profil-box-comment">
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