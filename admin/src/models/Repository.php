<?php

namespace App\models;

class Repository
{
    private $connect;

    public function __construct()
    {
        $this->connect = new Connect();
    }
    public function getAllMessages()
    {
        $tabArt = array();
        $sql = "SELECT * FROM livror ORDER BY id";
        $stmp = $this->getConnect()::connect()->prepare($sql);
        $stmp->execute();
        while ($row = $stmp->fetchObject()) {
            array_push($tabArt, $row);
        }
        return $tabArt;
    }

    public function getMessage($id)
    {
        $tabArt = array();
        $sql = "SELECT * FROM livror WHERE id = $id";
        $stmp = $this->getConnect()::connect()->prepare($sql);
        $stmp->execute();
        while ($row = $stmp->fetchObject()) {
            array_push($tabArt, $row);
        }
        return $tabArt;
    }

    public function validMessage($id)
    {
        $sql = "UPDATE livror SET date_valid = NOW() WHERE id = $id";
        $stmp = $this->getConnect()::connect()->prepare($sql);
        $stmp->execute();
        header('location: ../admin.php');
    }

    public function deleteMessage($id)
    {
        $tabArt = array();
        $sql = "DELETE FROM livror WHERE id = $id";
        $stmp = $this->getConnect()::connect()->prepare($sql);
        $stmp->execute();
        $row = $stmp->fetchObject();
        array_push($tabArt, $row);
        return $tabArt;
    }

    public function modifyMessage($id, $message)
    {
        $sql = "UPDATE livror SET message = '$message' WHERE id = $id";
        $stmp = $this->getConnect()::connect()->prepare($sql);
        $stmp->execute();
        header('location: ../admin.php');
    }

    /**
     * Get the value of connect
     */
    public function getConnect()
    {
        return $this->connect;
    }

    /**
     * Set the value of connect
     *
     * @return  self
     */
    public function setConnect($connect)
    {
        $this->connect = $connect;

        return $this;
    }
}
