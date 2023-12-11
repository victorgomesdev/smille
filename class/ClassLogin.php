<?php

namespace Classes;
session_start();
use Models\ModelConect;
use \PDO;
use \PDOException;

class ClassLogin extends ModelConect
{
    public function login()
    {
        //Recebendo os dados do formulário
        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //Verificando se os dados foram enviados
        if (isset($formulario)) {
            //Obtendo o email e senha
            $email = trim($formulario['email']);
            $senha = trim($formulario['senha']);
            //Verificando se nenhum dos campos está vazio
            if (empty($email) || empty($senha)) {
                $_SESSION['erro'] = "<p style='color: red;'>Preencha todos os campos!</p>";
                header("Location: ../login.php");
            } else {

                $b = $this->conectDB()->prepare("SELECT id, email, nome, cargo, senha FROM profissional WHERE email = :e");
                $b->bindParam(":e", $email);
                $b->execute();

                if ($b->rowCount() != 0) {
                    //Obtendo a senha
                    $resultado = $b->fetch(PDO::FETCH_ASSOC);
                    //Verificando a senha
                    if (password_verify($senha, $resultado['senha'])) {
                        session_start();
                        $this->sessao($resultado);
                        header("Location: ../calendar.php");
                        exit();
                    } else {
                        $_SESSION['erro'] = "<p style='color: red;'>Email ou senha não encontrado!</p>";
                        header("Location: ../login.php");
                    }
                } else {
                    $_SESSION['erro'] = "<p style='color: red;'>Email ou senha não encontrado!</p>";
                    header("Location: ../login.php");
                }
            }
        } else {
            return [
                'email' => '',
                'senha' => '',
            ];
        }
    }

    private function sessao($resultado){
        $_SESSION['profissional'] = [
            "id" => $resultado["id"],
            "nome" => $resultado["nome"],
            "email" => $resultado["email"],
            "cargo" => $resultado["cargo"]
        ];
    }
}
