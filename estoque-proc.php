<?php
session_start();
use Controllers\Estoque;
use Models\Produto;
use Providers\Resposta;

include 'autoload.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        if (isset($_POST['opt'])) {
            switch($_POST['opt']){
                case 'sum':
                    Produto::adicionar($_POST['codigo']);
                    Resposta::enviar(200, ['status'=> true]);
                    break;
                case 'sub':
                    Produto::baixar($_POST['codigo'], $_POST['usuario']);
                    Resposta::enviar(200, ['status'=> true]);
                break;
                case 'edit':
                    echo json_encode(Produto::editar_item($_POST['nomeProduto'], $_POST['valorUnitario'], $_POST['codigo'], $_POST['quantidadeProduto']));
                    break;
                case 'cadastrar':
                    $produto = new Produto($_POST['nomeProduto'], $_POST['valorUnitario'], $_POST['quantidadeProduto'], $_POST['usuario']);
                    $produto->cadastrar_item();
                    Resposta::enviar(200, ['message'=> 'Produto cadastrado']);
                    break;
            }
        }
        break;

    case 'GET':

        if(isset($_GET['edit'])){
            echo $_GET['edit'];
            exit;
        }
        
        $lista = Estoque::buscar();
        Resposta::enviar(200, $lista);
        break;
}
