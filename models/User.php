<?php
include_once("./Bdd.php");


class User extends Bdd
{




    // Méthode pour un affichage du numéro "001"
    public function changeNumber($int)
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
