<?php

namespace Classes;

session_start();

use Models\ModelConect;

class ClassRelatorios extends ModelConect
{
    public function agendados()
    {
        $id = $_SESSION['profissional']['id'];
        $b = $this->conectDB()->prepare("SELECT * FROM consultas WHERE profissional = ?");
        $b->execute([$id]);

        $f = $b->fetchAll(\PDO::FETCH_ASSOC);
        $rowCount = $b->rowCount(); // Obtém o número de linhas encontradas

        $result = [
            'data' => $f,
            'rowCount' => $rowCount
        ];

        return json_encode($result);
    }

    public function confirmados(){
        $id = $_SESSION['profissional']['id'];
        $b = $this->conectDB()->prepare("SELECT * FROM consultas WHERE profissional = ? and color = 'green'");
        $b->execute([$id]);

        $f = $b->fetchAll(\PDO::FETCH_ASSOC);
        $rowCount = $b->rowCount(); // Obtém o número de linhas encontradas

        $result_confirmados = [
            'data' => $f,
            'rowCount' => $rowCount
        ];

        return json_encode($result_confirmados);
    }

    public function cancelados(){
        $id = $_SESSION['profissional']['id'];
        $b = $this->conectDB()->prepare("SELECT * FROM consultas WHERE profissional = ? and color = 'yellow'");
        $b->execute([$id]);

        $f = $b->fetchAll(\PDO::FETCH_ASSOC);
        $rowCount = $b->rowCount(); // Obtém o número de linhas encontradas

        $result_cancelados = [
            'data' => $f,
            'rowCount' => $rowCount
        ];

        return json_encode($result_cancelados);
    }

    public function faltas(){
        $id = $_SESSION['profissional']['id'];
        $b = $this->conectDB()->prepare("SELECT * FROM consultas WHERE profissional = ? and color = 'red'");
        $b->execute([$id]);

        $f = $b->fetchAll(\PDO::FETCH_ASSOC);
        $rowCount = $b->rowCount(); // Obtém o número de linhas encontradas

        $result_faltas = [
            'data' => $f,
            'rowCount' => $rowCount
        ];

        return json_encode($result_faltas);
    }
}


?>