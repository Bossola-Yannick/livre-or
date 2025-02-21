<?php
require 'config.php';
session_start();
include_once("./models/Comment.php");
include_once("./models/User.php");
if (!empty($_SESSION)) {
    // deconnexion
    if (isset($_POST['logout'])) {
        $_SESSION = array();
        session_destroy();
        header("Location: index.php");
        exit();
    }
    if (isset($_POST['user-profil'])) {
        if (isset($_SESSION['userId'])) {
            header("Location: ./pages/profil.php");
            exit();
        }
    };
};

$getLastComment = new Comment();
$lastComment = $getLastComment->getfiveLastComment();

?>

<!DOCTYPE html>
<html lang="fr">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./assets/css/style_header-footer.css">
<link rel="stylesheet" href="./assets/css/style_livre-dor.css">
<link rel=" stylesheet" href="./assets/css/style_index.css">
<link rel="icon" type="image/x-icon" href="./assets/img/logo-icon.ico">
<title>Livre d'or S-Quiz Game </title>
</head>

<body>

    <header class="header">
        <?php if (!isset($_SESSION['userId'])): ?>

            <!-- pas connecté  -->
            <div class="logo-box">
                <a href="index.php">
                    <img src="./assets/img/accueil-logo.png" class="logo-header" alt="connexion" />
                </a>
            </div>

            <img class="quiz-logo" src="./assets/img/titre-logo.png" />

            <div class="logo-login">
                <a href="./pages/connexion.php">
                    <img src="./assets/img/utilisateur.png">
                </a>
            </div>
        <?php elseif ($_SESSION['userRole'] == "admin") : ?>
            <!-- connecté ADMIN-->
            <div class="logo-box">
                <a href="index.php">
                    <img src="./assets/img/accueil-logo.png" class="logo-header" alt="connexion" />
                </a>
            </div>
            <img class="quiz-logo" src="./assets/img/titre-logo.png" />
            <form method="post" action="" class="box-login-disconnect">
                <a href="./pages/admin.php" class="icon-account header-user-logo" type="submit" name="user-profil">
                    <div class="box-account">
                        <img src="./assets/img/redSuit.png" class="logo-admin" />
                    </div>
                </a>
                <button class="icon-account" type="submit" name="logout">
                    <img src="./assets/img/deconnexion.png" alt="deconnexion" />
                </button>
            </form>
        <?php else : ?>
            <!-- connecté USER -->
            <div class="logo-box">
                <a href="index.php">
                    <img src="./assets/img/accueil-logo.png" class="logo-header" alt="connexion" />
                </a>
            </div>
            <img class="quiz-logo" src="./assets/img/titre-logo.png" />
            <form method="post" action="" class="box-login-disconnect">
                <button class="icon-account header-user-logo" type="submit" name="user-profil">
                    <div class="box-account">
                        <img src="./assets/img/utilisateur.png" />
                    </div>
                    <p class="login "><?= "{ " . $_SESSION['userNumber'] . " }" ?></p>
                </button>
                <button class="icon-account" type="submit" name="logout">
                    <img src="./assets/img/deconnexion.png" alt="deconnexion" />
                </button>
            </form>
        <?php endif; ?>


    </header>

    <main class="main-index">


        <h1 class="index-title pink">Livre d'or</h1>
        <section class="index-sub-box">
            <h2>Vos retours d'experience</h2>
            <article>
                <p>Partagez avec nous votre experience S-quiz game!</p>
            </article>
            <!-- lien vers livre d'or -->
            <div class="button-index button-index-green">
                <a href="./pages/livre-or.php"> <span class="pink">→</span> Voir les commentaires <span class="pink">←</span> </a>
            </div>
            <!-- lien vers s-quiz game -->
            <p>Toi aussi, fait l'experience : </p>
            <div class="button-index button-index-green">
                <a href="https://yannick-bossola.students-laplateforme.io/squizgame/"> <span class="pink">→</span> S-quiz Game ! <span class="pink">←</span> </a>
            </div>
        </section>



        <section class="section-box-comments">
            <!-- affichage des 5 dernieres commentaires -->
            <p class="display-comment">↓↓ affichage des 5 derniers commentaires ↓↓</p>
            <?php foreach ($lastComment as $comment) : ?>
                <?php
                $userId = $comment['userId'];
                $user = new User();
                $userNumber = $user->changeNumber(intval($userId));
                ?>
                <article class="index-box-comment">
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


    </main>


    <?php include './components/footer.php'; ?>