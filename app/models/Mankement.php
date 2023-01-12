<?php

/**
 * Dit is de model voor de controller Lessen
 */

class Mankement
{
    //properties
    private $db;

    // Dit is de constructor van de Country model class
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getMankementen()
    {
        $this->db->query("SELECT Instructeur.Naam as INNA
                                ,Mankement.Mankement as MANK
                                ,Mankement.Id AS MAID
                                ,Instructeur.Email as INEM
                                ,Auto.Kenteken as AUKE
                                ,Mankement.Datum
                          FROM Mankement
                          INNER JOIN auto
                          ON Auto.Id = Mankement.AutoId
                          INNER JOIN Instructeur
                          ON Instructeur.Id = Auto.InstructeurId
                          WHERE Auto.InstructeurId = :Id");

        $this->db->bind(':Id', 2, PDO::PARAM_INT);

        return $this->db->resultSet();
    }

    public function getTopics($mankementId)
    {
        // Maak je query
        $sql = "SELECT Mankement.Datum
                      ,Mankement.Id
                      ,Mankement.Mankement
                FROM Mankement
                INNER JOIN Auto
                ON Auto.Id = Mankement.AutoId
                WHERE Mankement.Id = :mankementId";

        // Prepareer je query
        $this->db->query($sql);

        // Bind de echte waarde aan de placeholder
        $this->db->bind(':mankementId', $mankementId, PDO::PARAM_INT);

        // Haal je resultaat op en return deze.
        return $this->db->resultSet();
    }

    public function addMankement($post)
    {
        $sql = "INSERT INTO Mankement (MankementId
                                      ,Mankement)
                VALUES                (:mankementId,
                                       :mankement);";

        $this->db->query($sql);

        $this->db->bind(':mankementId', $post['id'], PDO::PARAM_INT);
        $this->db->bind(':mankement', $post['mankement'], PDO::PARAM_STR);

        return $this->db->execute();
    }
}
