<?php
include_once("./Bdd.php");


class Comment extends Bdd
{

    public $bdd;

    public function __construct()
    {
        $this->bdd = $this->connexion();
    }

    // creation commentaire
    public function create($comment, $date, $userId)
    {

        $sql = "INSERT INTO comment (comment, date, id_user) VALUES (:comment, :date, :id_user)";
        $create = $this->bdd->prepare($sql);
        $create->execute([
            ':comment' => $comment,
            ':date' => $date,
            ':id_user' => $userId
        ]);
    }

    // suppression commentaire
    public function delete($id)
    {

        $sql = "DELETE FROM comment WHERE id = $id";
        $delete = $this->bdd->prepare($sql);
        $delete->execute();
    }

    // récupération de tout les commentaire
    public function getAllComments()
    {
        $sql = "SELECT comment.id, comment.comment, comment.date, user.login
                FROM comment
                JOIN user ON comment.id_user = user.id
                ORDER BY date DESC";
        $getAll = $this->bdd->prepare($sql);
        $getAll->execute();
        return $getAll->fetchAll(PDO::FETCH_ASSOC);
    }
    // récupération des 5 dernier commentaires
    public function getfiveLastComment()
    {
        $sql = "SELECT comment.id, comment.comment, comment.date, user.login
                FROM comment
                JOIN user ON comment.id_user = user.id
                ORDER BY date DESC
                LIMIT 5";
        $getAll = $this->bdd->prepare($sql);
        $getAll->execute();
        return $getAll->fetchAll(PDO::FETCH_ASSOC);
    }
    // récupération des 5 dernier commentaires
    public function getAllCommentByUser($userId)
    {
        $sql = "SELECT comment.id, comment.comment, comment.date, user.login
                FROM comment
                JOIN user ON comment.id_user = user.id
                WHERE user.id = $userId
                ORDER BY date DESC";
        $getAll = $this->bdd->prepare($sql);
        $getAll->execute();
        return $getAll->fetchAll(PDO::FETCH_ASSOC);
    }
}

$test = new Comment();
$result = $test->getAllComments();
var_dump($result);
