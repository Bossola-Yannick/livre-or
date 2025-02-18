<?php
include_once(__DIR__ . "/Bdd.php");


class User extends Bdd
{

    public $bdd;

    public function __construct()
    {
        $this->bdd = $this->connexion();
    }

    // Methode inscription

    public function userSignUp($userLogin, $userPass)
    {
        $checkStmt = "SELECT id 
        FROM user
        WHERE login = :userLogin";
        $checkStmt = $this->bdd->prepare($checkStmt);
        $checkStmt->execute([
            ':userLogin' => $userLogin
        ]);

        if ($checkStmt->fetch()) {
            $_SESSION['message']  = "Ce pseudo est déjà utilisé !";
        } else {

            $signUpStmt = "INSERT INTO user (login, password, role) VALUES (:login, :password, :role)";
            $signUpStmt = $this->bdd->prepare($signUpStmt);
            $signUpStmt->execute([
                ':login' => $userLogin,
                ':password' => $userPass,
                ':role' => 'user'
            ]);

            $signUpStmt = $signUpStmt->fetch(PDO::FETCH_ASSOC);

            $_SESSION['message']  = "Inscription réussie !";

            header("location:connexion.php");
        }
    }

    // Methode connexion
    public function userConnexion($userLogin, $userPass): void
    {
        $loginStmt = "SELECT user.id, user.login, user.password, user.role 
        FROM user
        WHERE login = :userLogin";
        $loginStmt = $this->bdd->prepare($loginStmt);
        $loginStmt->execute([
            ':userLogin' => $userLogin
        ]);
        $userLogin = $loginStmt->fetch(PDO::FETCH_ASSOC);

        if ($userLogin && (password_verify($userPass, $userLogin['password'])) || ($userLogin && $userPass == $userLogin['password'])) {
            session_start();
            $_SESSION['userId'] = $userLogin['id'];
            $_SESSION['userLogin'] = $userLogin['login'];
            $_SESSION['userRole'] = $userLogin['role'];
            $userNum = new User();
            $_SESSION['userNumber'] = $userNum->changeNumber($userLogin['id']);
            header("location: ../index.php");
            exit();
        } else {
            $_SESSION['message']  = "Pseudo ou mot de passe incorrect!";
        }
    }

    // Methode pour récuperer toutes les infos d'un utilisateur par ID
    public function get_allById($userId): array
    {
        $getAllStmt = "SELECT user.id, user.login, user.password, user.role
        FROM user
        WHERE user.id = :userId";
        $getAllStmt = $this->bdd->prepare($getAllStmt);
        $getAllStmt->execute([
            ':userId' => $userId
        ]);

        return $getAllStmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour update user login
    public function updateUserLogin($userLogin, $newLogin): void
    {
        $checkStmt = "SELECT user.login 
        FROM user
        WHERE login = :newLogin";
        $checkStmt = $this->bdd->prepare($checkStmt);
        $checkStmt->execute([
            ':newLogin' => $newLogin
        ]);

        if ($checkStmt->fetch()) {
            $_SESSION['message']  = "Ce pseudo est déjà utilisé !";
        } else {

            $newLoginStmt = "UPDATE user SET login = :newLogin
            WHERE login = :userLogin";
            $newLoginStmt = $this->bdd->prepare($newLoginStmt);
            $newLoginStmt->execute([
                ':userLogin' => $userLogin,
                ':newLogin' => $newLogin
            ]);

            $_SESSION['message'] = "Pseudo modifié";
            $_SESSION['userLogin'] = $newLogin;
        }
    }

    // Méthode pour vérifier et update le mot de passe
    public function updateUserPassword($userId, $currentPass, $newPass)
    {
        // récup mdp actuel
        $passStmt = "SELECT user.password
        FROM user
        WHERE user.id = :userId";
        $passStmt = $this->bdd->prepare($passStmt);
        $passStmt->execute([
            ':userId' => $userId
        ]);
        $userPass = $passStmt->fetch(PDO::FETCH_ASSOC);

        // vérifie s'il est correct
        if (password_verify($currentPass, $userPass['password']) ||  $currentPass == $userPass['password']) {
            $newHashPass = password_hash($newPass, PASSWORD_BCRYPT);

            // met a jour le mot de passe
            $updatePassStmt = "UPDATE user 
            SET password = :newPass 
            WHERE user.id = :userId";
            $updatePassStmt = $this->bdd->prepare($updatePassStmt);
            $updatePassStmt->execute([
                ':newPass' => $newHashPass,
                ':userId' => $userId
            ]);

            $_SESSION['message'] = "Succès - Mot de passe changé !";
        } else {
            $_SESSION['message'] = "Erreur - Mot de passe incorrect !";
        }
    }

    // Méthode pour un affichage du numéro "001"
    public function changeNumber($int): string
    {
        if ($int < 10) {
            return "00" . $int;
        } elseif ($int < 100) {
            return "0" . $int;
        } else {
            return $int;
        }
    }
}


// $test = new User();

// $test->updateUserPassword(2, '123', 'test');
// $test->userSignUp('mike', 'test');
