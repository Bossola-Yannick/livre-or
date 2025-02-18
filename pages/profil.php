<?php



?>



<?php include '../components/header.php'; ?>

<main>

    <section class="profil-box">
        <!--  -->
        <div class="profil-title">
            <h2>Mon profil</h2>
        </div>
        <!--  -->
        <article>
            <form action="" method="post">
                <!-- pseudo -->
                <div>
                    <p>Pseudo:</p>
                    <?= $newUser->get_login(); ?>
                    <input type="text" id="pseudo" class="" placeholder="Entrez votre pseudo" />
                    <input type="submit" name="stillAlive" id="next" class="button-next button-next-green" value="Afficher les prochaines Victimes">
                </div>
                <!-- mot de passe -->
                <div>
                    <p>Mot de passe:</p>
                    <p>**********</p>

                </div>
                <!--  -->
            </form>
        </article>
        <!--  -->
    </section>

</main>

<?php include '../components/footer.php'; ?>