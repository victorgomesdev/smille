<?php

namespace Models;
use Providers\Conexao;
use PDOException;
use PDO;
class Produto
{

    public function __construct(private string $nome, private float $valor_unitario, public int $quantidade, private string $usuario)
    {
        $this->nome = $nome;
        $this->valor_unitario = $valor_unitario;
        $this->quantidade = $quantidade;
        $this->usuario = $usuario;
    }

    public function cadastrar_item()
    {
        try {
            $query = 'INSERT INTO produtos( nome, valor_unitario, quantidade, usuario) VALUES (:nome, :valor_unitario, :quantidade, :usuario);';

            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $req->execute(['nome'=> $this->nome, 'valor_unitario'=> $this->valor_unitario, 'quantidade'=>$this->quantidade, 'usuario'=> $this->usuario]);

            $conn = null;
            return true;
        } catch (PDOException $err) {

            $conn = null;
            return $err->getCode();
        }
    }

    public static function excluir_item(int $codigo)
    {
        try {
            $query = 'DELETE FROM produtos WHERE codigo = :codigo;';
            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $req->execute(['codigo' => $codigo]);

            $conn = null;
            return true;
        } catch (PDOException $err) {
            $conn = null;
            return $err->getCode();
        }
    }

    public static function editar_item(string $nome, float $valor, int $codigo, int $quantidade)
{
    try {
        $query = 'UPDATE produtos SET nome = :nome, valor_unitario = :valor, quantidade = :quantidade WHERE codigo = :codigo;';
        $conn = Conexao::conectar();

        $req = $conn->prepare($query);
        $req->bindParam(':nome', $nome, PDO::PARAM_STR);
        $req->bindParam(':valor', $valor, PDO::PARAM_STR);
        $req->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
        $req->bindParam(':codigo', $codigo, PDO::PARAM_INT);

        $req->execute();

        $conn = null;
        return 'Alterações salvas com sucesso!';
    } catch (PDOException $err) {
        $conn = null;
        return $err->errorInfo;
    }
}


    public static function buscar_produto(int $codigo = null)
    {

        if ($codigo == null) {

            try {

                $query = 'SELECT * FROM produtos;';
                $conn = Conexao::conectar();

                $req = $conn->prepare($query);
                $req->execute();

                $res = $req->fetchAll();
                $conn = null;

                return $res;
            } catch (PDOException $err) {

                $conn = null;
                return $err->getCode();
            }
        } else {

            try {

                $query = 'SELECT * FROM produtos WHERE codigo = :codigo;';
                $conn = Conexao::conectar();

                $req = $conn->prepare($query);
                $req->execute(['codigo' => $codigo]);

                $res = $req->fetchAll();
                $conn = null;

                return $res;
            } catch (PDOException $err) {

                $conn = null;
                return $err->getCode();
            }
        }
    }


    public static function baixar(int $codigo, string $usuario){
        try {
            $conn = Conexao::conectar();
        
            // Iniciar a transação
            $conn->beginTransaction();
        
            $query1 = 'UPDATE produtos SET quantidade = quantidade - 1 WHERE codigo = :codigo;';
            $query2 = 'INSERT INTO baixas(codigo, usuario) VALUES (:codigo, :usuario)';
        
            $req1 = $conn->prepare($query1);
            $req1->execute(['codigo' => $codigo]);
        
            $req2 = $conn->prepare($query2);
            $req2->execute(['codigo' => $codigo, 'usuario'=> $usuario]);
        
            // Commitar a transação apenas se ambas as consultas foram bem-sucedidas
            $conn->commit();
        
            
        } catch (PDOException $err) {
            // Desfazer a transação em caso de erro
            $conn->rollBack();
        
            // Tratar a exceção de alguma forma (imprimir, logar, etc.)
            echo "Erro: " . $err->getMessage();
        
            $conn = null;
        }
        
    }

    public static function adicionar($codigo){
        try{

            $query = 'UPDATE produtos SET quantidade = quantidade + 1 WHERE codigo = :codigo;';
            $conn = Conexao::conectar();

            $req = $conn->prepare($query);
            $req->execute(['codigo'=> $codigo]);

            $conn = null;
        }catch(PDOException $err){

            $conn = null;
            return $err->errorInfo;
        }
    }
}
