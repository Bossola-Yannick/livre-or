<?php
include_once(__DIR__ . "/Bdd.php");


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
    // comptage du nombre de commentaire
    public function countComment()
    {
        $sql = "SELECT COUNT(id) as nbComment FROM comment";
        $getCount = $this->bdd->prepare($sql);
        $getCount->execute();
        return $getCount->fetchAll(PDO::FETCH_ASSOC);;
    }
    // récupération de tout les commentaire et pagination
    public function getAllComments($whichPage, $perPage)
    {
        $sql = "SELECT comment.id, comment.comment, DATE_FORMAT(comment.date,\"%d/%m/%Y %H:%i:%s\") as date, user.id as userId, user.login
                FROM comment
                JOIN user ON comment.id_user = user.id
                ORDER BY date DESC
                LIMIT " . (($whichPage - 1) * $perPage) . ",$perPage";
        $getAll = $this->bdd->prepare($sql);
        $getAll->execute();
        return $getAll->fetchAll(PDO::FETCH_ASSOC);
    }
    // récupération des 5 dernier commentaires
    public function getfiveLastComment()
    {
        $sql = "SELECT comment.id, comment.comment, DATE_FORMAT(comment.date,\"%d/%m/%Y\") as date, user.login
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
        $sql = "SELECT comment.id, comment.comment, DATE_FORMAT(comment.date,\"%d/%m/%Y\") as date, user.login
                FROM comment
                JOIN user ON comment.id_user = user.id
                WHERE user.id = $userId
                ORDER BY date DESC";
        $getAll = $this->bdd->prepare($sql);
        $getAll->execute();
        return $getAll->fetchAll(PDO::FETCH_ASSOC);
    }

    // récupération de tout les commentaires avec un mot de recherche
    public function getAllCommentsSearch($word, $whichPage, $perPage)
    {
        $sql = "SELECT comment.id, comment.comment, DATE_FORMAT(comment.date,\"%d/%m/%Y\") as date, user.login
                FROM comment
                JOIN user ON comment.id_user = user.id
                WHERE comment LIKE '%$word%'
                ORDER BY date DESC
                LIMIT " . (($whichPage - 1) * $perPage) . ",$perPage";
        $getAll = $this->bdd->prepare($sql);
        $getAll->execute();
        return $getAll->fetchAll(PDO::FETCH_ASSOC);
    }
}
