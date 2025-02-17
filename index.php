<?php
session_start();
$_SESSION['userId'] = 2;
$_SESSION['userRole'] = "admin";
if (!empty($_SESSION)) {

    // deconnexion
    if (isset($_POST['logout'])) {
        $_SESSION = array();
        session_destroy();
        header("Location: index.php");
    }
    if (isset($_POST['user-profil'])) {
        if (isset($_SESSION['userId'])) {
            header("Location: ./pages/profil.php");
        }
    };
};


?>

<!DOCTYPE html>
<html lang="fr">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./assets/css/style_header-footer.css">
<link rel="stylesheet" href="./assets/css/style_index.css">

<title>Livre d'or | S-Quiz Game </title>
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
                <a href="./page/connexion.php">
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
                    <!-- penser a refair une session=>userNumber -->
                    <p class="login "><?= "{ " . $_SESSION['userId'] . " }" ?></p>
                </button>
                <button class="icon-account" type="submit" name="logout">
                    <img src="./assets/img/deconnexion.png" alt="deconnexion" />
                </button>
            </form>
        <?php endif; ?>


    </header>

    <main class="main-index">


        <h1 class="index-title">Livre d'or</h1>
        <section class="index-sub-box">
            <h2>Vos retours d'experience</h2>
            <article>
                <p>Partagez avec nous votre experience S-quiz game!</p>
            </article>
            <!-- lien vers livre d'or -->
            <div class="button-index">
                <a href="./pages/livre-or.php"> <span class="bold">→</span> Voir les commentaires <span class="bold">←</span> </a>
            </div>
            <!-- lien vers s-quiz game -->
            <div class="button-index">
                <a href="#"> <span class="bold">→</span> Toi aussi, découvre l'experience ! <span class="bold">←</span> </a>
            </div>
        </section>



        <section class="index-box-comments">
            <!-- affichage des 5 dernieres commentaires -->
            <p>---affichage des 5 dernieres commentaires---</p>
        </section>


    </main>


    <?php include './components/footer.php'; ?>