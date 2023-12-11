<?php
namespace Classes;
include("config/init.php");
include("config/sessionVerify.php");
include("config/config.php"); 
include("model/ModelConect.php");
?>
<?php include(DIRREQ . "smille/lib/html/header.php"); ?>
<?php

use Models\ModelConect;
class ClassProfssionais extends ModelConect
{
    public function getProfissionais()
    {
        $b = $this->conectDB()->prepare("SELECT id, nome FROM profissional");
        $b->execute();
        $f = $b->fetchAll(\PDO::FETCH_ASSOC);
        return json_encode($f);
    }

    
}

$objProfissionais = new \Classes\ClassProfssionais();
$profissionais = $objProfissionais->getProfissionais();
$profissionaisArray = json_decode($profissionais, true);

$objEvents = new \Classes\ClassEvents();
$events = ($objEvents->getEventsById($_GET['id']));

?>
<link rel="stylesheet" href="<?php echo DIRPAGE.'smille/lib/css/form-consultas.css';?>">
<div class="corpo1">
    <div id="container">
        <h2 class="h2con">Gerenciar Dados do Agendamento:</h2>
        <?php
            if (isset($_SESSION['erro'])) {
                echo $_SESSION['erro'];
                unset($_SESSION['erro']);
            }
        ?>
        <form method="POST" action="<?php echo DIRPAGE . 'smille/controllers/ControllerEdit.php' ?>">
            <input value="<?php echo $_GET['id']; ?>" type="hidden" id="id" name="id" >
            <label for="title">Paciente:</label>
            <input value="<?php echo $events['title']; ?>" type="text" id="title" name="title" >

            <label for="description">Descrição:</label>
            <textarea  id="description" name="description" rows="4" ><?php echo $events['description']; ?></textarea>

            <label for="start">Data e Hora de Início:</label>
            <input value="<?php echo $events['start']; ?>" type="datetime-local" id="start" name="start" >

            <label for="end">Data e Hora de Fim:</label>
            <input value="<?php echo $events['end'] ?>" type="datetime-local" id="end" name="end" >

            <label for="color">Status da consulta:</label><br>
            <select name="color" id="color">
                <option value="blue">Agendada</option>
                <option value="green">Confirmada</option>
                <option value="yellow">Cancelada</option>
                <option value="red">Falta</option>
            </select>
            <br><br>
            <input type="submit" value="Atualizar Dados">
        </form>
    </div>
</div>



<?php include(DIRREQ . "smille/lib/html/footer.php"); ?>