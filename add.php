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

    public function getClientes()
    {
        $b = $this->conectDB()->prepare("SELECT nome FROM clientes");
        $b->execute();
        $f = $b->fetchAll(\PDO::FETCH_ASSOC);
        return json_encode($f);
    }
}

$objEvents = new \Classes\ClassProfssionais();
$profissionais = $objEvents->getProfissionais();
$profissionaisArray = json_decode($profissionais, true);
$clientes = $objEvents->getClientes();
$clientesArray = json_decode($clientes, true);

?>



<link rel="stylesheet" href="<?php echo DIRPAGE . 'smille/lib/css/form-consultas.css'; ?>">
<div class="corpo1">
    <div id="container">
        <h2 class="h2con">Agendamento de Consulta:</h2>
        <?php
        if (isset($_SESSION['erro'])) {
            echo $_SESSION['erro'];
            unset($_SESSION['erro']);
        }
        ?>
        <form method="POST" action="<?php echo DIRPAGE . 'smille/controllers/ControllerAdd.php' ?>">
            <!-- <label for="title">Paciente:</label>
            <input type="text" id="title" name="title" > -->
            <label for="title">Paciente:</label><br>
            <select name="title" id="title">
                <option value="">Selecione</option>
                <?php
                // Verifica se há clientes
                if ($clientesArray) {
                    foreach ($clientesArray as $clientes) {
                        echo '<option value="' . $clientes['nome'] . '">' . $clientes['nome'] . '</option>';
                    }
                }
                ?>
            </select>
            <label for="description">Descrição:</label><br>
            <textarea id="description" name="description" rows="4"></textarea>

            <label for="start">Data e Hora de Início:</label><br>
            <input type="datetime-local" id="start" name="start">

            <label for="end">Data e Hora de Fim:</label><br>
            <input type="datetime-local" id="end" name="end">

            <label for="select-profissional">Profissional:</label> <br>
            <select name="profissional" id="select-profissional">
                <option value="">Selecione</option>
                <?php
                // Verifica se há profissionais
                if ($profissionaisArray) {
                    foreach ($profissionaisArray as $profissional) {
                        echo '<option value="' . $profissional['id'] . '">' . $profissional['nome'] . '</option>';
                    }
                }
                ?>
            </select>

            <br><br>
            <input type="submit" value="Agendar Consulta">
        </form>
    </div>
</div>



<?php include(DIRREQ . "smille/lib/html/footer.php"); ?>