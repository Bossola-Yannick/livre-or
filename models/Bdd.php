<?php

class Bdd
{
    protected $bdd;
    public function __construct()
    {
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbName = "livreor";
        // $host = "localhost:3306";
        // $username = "userlivreor";
        // $password = "livreor13";
        // $dbName = "yannick-bossola_livreor";
        try {
            $this->bdd  = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
}
