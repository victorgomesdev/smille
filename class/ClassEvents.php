<?php
namespace Classes;
session_start();
use Models\ModelConect;

class ClassEvents extends ModelConect
{
    #Trazer os dados de eventos do banco
    public function getEvents()
    {
        $id = $_SESSION['profissional']['id'];
        $b=$this->conectDB()->prepare("SELECT * FROM consultas where profissional = $id");
        $b->execute();
        $f=$b->fetchAll(\PDO::FETCH_ASSOC);
        return json_encode($f);
    }

    public function creatEvent($id=0, $title, $description, $color='blue', $start ,$end,$profissional){
        $b=$this->conectDB()->prepare("INSERT INTO consultas VALUES(?,?,?,?,?,?,?)");
        $b->bindParam(1, $id, \PDO::PARAM_INT);
        $b->bindParam(2, $title, \PDO::PARAM_STR);
        $b->bindParam(3, $description, \PDO::PARAM_STR);
        $b->bindParam(4, $color, \PDO::PARAM_STR);
        $b->bindParam(5, $start, \PDO::PARAM_STR);
        $b->bindParam(6, $end, \PDO::PARAM_STR);
        $b->bindParam(7, $profissional, \PDO::PARAM_STR);
        $b->execute();
        header("Location: ../calendar.php");
    }

    #Buscar eventos pelo id

    public function getEventsById($id){
        $b=$this->conectDB()->prepare("SELECT * FROM consultas where id=?");
        $b->bindParam(1, $id, \PDO::PARAM_INT);
        $b->execute();
        return $f = $b->fetch(\PDO::FETCH_ASSOC);
    }

    #Update do evento

    public function updateEvent($id,$title, $description, $color, $start ,$end){
        $b=$this->conectDB()->prepare("update consultas set title=?, description=?, color=?, start=?, end=? where id=?");
        $b->bindParam(1, $title, \PDO::PARAM_STR);
        $b->bindParam(2, $description, \PDO::PARAM_STR);
        $b->bindParam(3, $color, \PDO::PARAM_STR);
        $b->bindParam(4, $start, \PDO::PARAM_STR);
        $b->bindParam(5, $end, \PDO::PARAM_STR);
        $b->bindParam(6, $id, \PDO::PARAM_INT);
        $b->execute();
        header("Location: ../calendar.php");
    }
}

?>