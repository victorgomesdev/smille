<?php
include("config/init.php");
include("config/sessionVerify.php");
include("config/config.php");
include 'autoload.php';

use Controllers\Estoque;
?>
<?php include(DIRREQ . "smille/lib/html/header.php"); ?>

<link rel="stylesheet" href="<?php echo DIRPAGE . 'smille/lib/css/cadastro.css'; ?>">

<div id="cadastro-container">

    <?php
    if (isset($_SESSION['erro'])) {
        echo $_SESSION['erro'];
        unset($_SESSION['erro']);
    }

    if (isset($_SESSION['Sucesso'])) {
        echo $_SESSION['Sucesso'];
        unset($_SESSION['Sucesso']);
    }

    if(isset($_GET['edit'])){
        $item = Estoque::buscar($_GET['edit']);
    }
    ?>

    <br>
    <div>
        <!-- Tela de Cadastro de Estoque -->
        <div id="estoque" class="cadastro">
            <h2>Editar Produto</h2>
            <form class="formulario" id="form">
                <input id="codigo" type="hidden" name="codigo" value="<?php echo $item[0]['codigo']?>">
                <input type="hidden" name="opt" value="edit">
                <label for="nomeProduto">Nome do Produto:</label>
                <input type="text" id="nomeProduto" name="nomeProduto" required value="<?php echo $item[0]['nome']?>"><br>

                <label for="quantidadeProduto">Quantidade:</label>
                <input type="number" id="quantidadeProduto" name="quantidadeProduto" required value="<?php echo $item[0]['quantidade']?>"><br>

                <label for="valorUnitario">Valor Unitário:</label>
                <input type="text" id="valorUnitario" name="valorUnitario" required value="<?php echo $item[0]['valor_unitario']?>"><br>

                <input type="submit" value="Salvar">
            </form>
        </div>
    </div>

    <script>
        // Função para alternar entre as telas de cadastro
        function mostrarCadastro(cadastroSelecionado) {
            const cadastros = document.querySelectorAll('.cadastro');

            document.getElementById(cadastroSelecionado).style.display = 'block';
        }
        mostrarCadastro('estoque')

        const form = document.querySelector('form')

        form.addEventListener('submit', async (e)=>{
            e.preventDefault()

            const form = document.getElementById('form')

            const fd = new FormData(form)

            await fetch('http://localhost/smille/estoque-proc.php',{
                method: 'post',
                body: fd
            }).then(r => {
                r.json().then(res => alert(res))
                window.location.href = 'http://localhost/smille/estoque.php'
            })
        })
    </script>

    <?php include(DIRREQ . "smille/lib/html/footer.php"); ?>