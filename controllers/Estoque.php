<?php

namespace Controllers;

use Models\Produto;
use PDOException;
use Providers\Conexao;
use Providers\Resposta;

class Estoque
{

    // public static function cadastrar(string $nome,  int $id_categoria,  int $codigo)
    // {

    //     $novo_produto = new Produto($nome, $id_categoria, $codigo);
    //     $t = $novo_produto->cadastrar_item();

    //     if ($t === true) {
    //         Resposta::enviar(200, ['message' => '<p>Produto cadastrado.</p>']);
    //     } else {
    //         Resposta::enviar(200, ['message' => "<p>Código inválido</p>"]);
    //     }
    // }

    public static function excluir(int $codigo)
    {

        if (($res = Produto::excluir_item($codigo)) === true) {
            Resposta::enviar(200, ['message' => '<p>Produto excluído.</p>']);
        } else {
            Resposta::enviar(200, ['message' => $res]);
        }
    }

    public static function buscar(int $codigo = null): array
    {

        $lista = Produto::buscar_produto($codigo);

        if (count($lista) == 0) {
            return [];
        } else {
            return $lista;
        }
    }

    public static function baixas(string $usuario)
    {

        try {

            $query = "
            select sum(produtos.valor_unitario),
            profissional.nome
        from baixas
        inner join produtos
        on baixas.codigo = produtos.codigo
        inner join profissional
        on baixas.usuario = profissional.nome
        where profissional.nome = :usuario
        group by profissional.nome;";

            $conn = Conexao::conectar();
            $req = $conn->prepare($query);

            $req->execute(['usuario' => $usuario]);
            $res = $req->fetchAll()[0][0];

            $conn = null;
            return $res;
        } catch (PDOException $err) {
        }
    }

    public static function detalhar(string $usuario)
    {

        try {

            $query = "
            select 
            produtos.nome,
            produtos.codigo,
            produtos.valor_unitario
            from produtos
            inner join baixas
            on produtos.codigo = baixas.codigo
            where baixas.usuario = :usuario";

            $conn = Conexao::conectar();
            $req = $conn->prepare($query);

            $req->execute(['usuario' => $usuario]);
            $res = $req->fetchAll();

            $conn = null;
            return $res;
        } catch (PDOException $err) {
        }
    }

    public static function receitas($usuario)
    {
        try {

            $query = "
            select 
            descricao,
            valor,
            (select sum(valor) from receitas) as total
            from
            receitas
            where usuario = :usuario";

            $conn = Conexao::conectar();
            $req = $conn->prepare($query);

            $req->execute(['usuario' => $usuario]);
            $res = $req->fetchAll();

            $conn = null;
            return $res;
        } catch (PDOException $err) {
        }
    }
}
