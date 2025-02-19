<?php
include_once("../models/User.php");

$newUser = new User();

if (isset($_POST['submit'])) {
    if (!empty($_POST['pseudo']) && !empty($_POST['password'])) {
        $userLogin = htmlentities($_POST['pseudo']);
        $userPass = $_POST['password'];
        $newUser->userConnexion($userLogin, $userPass);
    } else {
        $_SESSION['message'] = "Veuillez remplir tous les champs.";
    }
}

?>

<?php include '../components/header.php' ?>


<main class="main">
    <section>
        <!-- si connecté, renvoie vers l'accueil -->
        <?php if (isset($_SESSION['userId'])) : ?>
            <?php header("location: ../index.php");
            exit(); ?>

            <!-- sinon, formulaire connexion -->
        <?php else : ?>
            <h1 class="title">Connexion</h1>
            <section class="login-bloc">
                <form method="post" action="" class="form">
                    <label for="" class="label-form">Pseudo :</label><br />
                    <input class="input" type="text" name="pseudo" id="pseudo" value="" placeholder="Entrez votre pseudo" required><br /><br />
                    <label for="" class="label-form">Mot de Passe :</label><br />
                    <input class="input" type="password" name="password" id="password" value="" placeholder="Entrez votre mot de passe" required><br /><br />
                    <button type="submit" name="submit" class="bouton">Valider</button>
                    <?php if (isset($_SESSION['message'])): ?>
                        <p class="alert"><?= $_SESSION['message'] ?></p>
                    <?php endif; ?>
                </form>
            </section>
            <div class="txt">
                <span>Pas encore de compte? </span>
                <a href="./inscription.php" class="link-bold">S’inscrire</a>
            </div>
        <?php endif ?>

    </section>
</main>

<?php include '../components/footer.php'; ?>