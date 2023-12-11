<?php

namespace Classes;
session_start();

use Models\ModelConect;

class ClassCadastrar extends ModelConect
{

    public function cadastro()
    {

        //Recebendo os dados do fomulário
        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($formulario)) {
            $dados = [
                'nome' => trim($formulario['nomeFuncionario']),
                'cpf' => trim($formulario['cpf']),
                'telefoneFuncionario' => trim($formulario['telefoneFuncionario']),
                'cargoFuncionario' => trim($formulario['cargoFuncionario']),
                'email' => trim($formulario['email']),
                'senha' => trim($formulario['senha']),
                'confirmarSenha' => trim($formulario['confirmarSenha']),
            ];

            // Verificando se o e-mail já está cadastrado
            $b = $this->conectDB()->prepare("SELECT email from profissional where email = :e");
            $b->bindParam(":e", $dados['email']);
            $b->execute();

            if ($b->rowCount() > 0) {
                $_SESSION['erro'] = " <p style='color: red;'>Email já cadastrado!</p>";
                header("Location: ../cadastros.php");
                return; // Encerra a execução do método, pois não é possível prosseguir com o cadastro.
            }

            //Validando se a campos vazios
            if (in_array("", $dados)) {

                if (empty($dados['nome'])) {
                    $_SESSION['erro'] = " <p style='color: red;'> <p style='color: red;'>Preencha todos os campos!</p></p>";
                    header("Location: ../cadastros.php");
                    exit();
                }
                if (empty($dados['cpf'])) {
                    $_SESSION['erro'] = "<p style='color: red;'> <p style='color: red;'>Preencha todos os campos!</p></p>";
                    header("Location: ../cadastros.php");
                    exit();
                }
                if (empty($dados['telefoneFuncionario'])) {
                    $_SESSION['erro'] = " <p style='color: red;'> <p style='color: red;'>Preencha todos os campos!</p></p>";
                    header("Location: ../cadastros.php");
                    exit();
                }
                if (empty($dados['cargoFuncionario']) || $dados['cargoFuncionario'] = 'selecione') {
                    $_SESSION['erro'] = " <p style='color: red;'>Preencha todos os campos!</p>";
                    header("Location: ../cadastros.php");
                    exit();
                }
                if (empty($dados['email'])) {
                    $_SESSION['erro'] = " <p style='color: red;'>Preencha todos os campos!</p>";
                    header("Location: ../cadastros.php");
                    exit();
                }
                if (empty($dados['senha'])) {
                    $_SESSION['erro'] = " <p style='color: red;'>Preencha todos os campos!</p>";
                    header("Location: ../cadastros.php");
                    exit();
                }
                if (empty($dados['confirmarSenha'])) {
                    $_SESSION['erro'] = " <p style='color: red;'>Preencha todos os campos!</p>";
                    header("Location: ../cadastros.php");
                    exit();
                }
            } else {
                //Validando se não a números no campo nome
                if (!preg_match('/[a-zA-Z]+/m', $dados['nome'])) {
                    $_SESSION['erro'] = " <p style='color: red;'>O nome informado é inválido!</p>";
                    header("Location: ../cadastros.php");
                    exit();
                } else
                    //Validando se o campo email está preenchido corretamente
                    if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
                        $_SESSION['erro'] = " <p style='color: red;'>O email informado é inválido!</p>";
                        header("Location: ../cadastros.php");
                        exit();
                    } else
                        //Validando se a senha possui pelo menos 6 caracteres
                        if (strlen($formulario['senha']) < 6) {
                            $_SESSION['erro'] = " <p style='color: red;'>A senha deve possuir pelo menos 6 caracteres!</p>";
                            header("Location: ../cadastros.php");
                            exit();
                        } else
                            //Validando se as senhas são iguais
                            if ($dados['senha'] != $dados['confirmarSenha']) {
                                $_SESSION['erro'] = " <p style='color: red;'>As senhas informadas não são iguais!</p>";
                                header("Location: ../cadastros.php");
                                exit();
                            } else {
                                //Encriptando a senha
                                $dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);

                                $b = $this->conectDB()->prepare("INSERT INTO profissional (nome, cpf, telefone, cargo, email, senha) VALUES (?, ?, ?, ?, ?, ?)");

                                $b->bindParam(1, $dados['nome'], \PDO::PARAM_STR);
                                $b->bindParam(2, $dados['cpf'], \PDO::PARAM_INT);
                                $b->bindParam(3, $dados['telefoneFuncionario'], \PDO::PARAM_INT);
                                $b->bindParam(4, $dados['cargoFuncionario'], \PDO::PARAM_INT);
                                $b->bindParam(5, $dados['email'], \PDO::PARAM_STR);
                                $b->bindParam(6, $dados['senha'], \PDO::PARAM_STR);

                                $b->execute();
                                $_SESSION['Sucesso'] = "<p style='color: green;'>Cadastro realizado com sucesso</p>";
                                header("Location: ../cadastros.php");
                            }
            }
        } else {
            $dados = [
                'nome' => '',
                'cpf' => '',
                'telefoneFuncionario' => '',
                'cargoFuncionario' => '',
                'email' => '',
                'senha' => '',
                'confirmarSenha' => '',
            ];
        }
    }

    public function cadastroFornecedor()
    {
        $formulario = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($formulario)) {
            $dados = [
                'nome' => trim($formulario['nomeFornecedor']),
                'cnpj' => trim($formulario['cnpj']),
                'enderecoFornecedor' => trim($formulario['enderecoFornecedor']),
                'Numero' => trim($formulario['Numero']),
                'Cidade' => trim($formulario['Cidade']),
                'telefoneFornecedor' => trim($formulario['telefoneFornecedor']),
            ];
        
            if (empty($dados['nome']) || empty($dados['cnpj']) || empty($dados['enderecoFornecedor']) || empty($dados['Numero']) || empty($dados['Cidade']) || empty($dados['telefoneFornecedor'])) {
                $_SESSION['erro'] = " <p style='color: red;'>Preencha todos os campos!</p>";
                header("Location: ../cadastros.php");
                exit();
            }
            $b = $this->conectDB()->prepare("INSERT INTO fornecedores (nome, cnpj, endereco, numero, cidade, telefone) VALUES (?, ?, ?, ?, ?, ?)");

            $b->bindParam(1, $dados['nome'], \PDO::PARAM_STR);
            $b->bindParam(2, $dados['cnpj'], \PDO::PARAM_INT);
            $b->bindParam(3, $dados['enderecoFornecedor'], \PDO::PARAM_STR);
            $b->bindParam(4, $dados['Numero'], \PDO::PARAM_STR);
            $b->bindParam(5, $dados['Cidade'], \PDO::PARAM_STR);
            $b->bindParam(6, $dados['telefoneFornecedor'], \PDO::PARAM_STR);

            $b->execute();
            $_SESSION['Sucesso'] = "<p style='color: green;'>Cadastro realizado com sucesso!</p>";
            header("Location: ../cadastros.php");
        
            
        }else{
            $dados = [
                'nome' => '',
                'cnpj' => '',
                'enderecoFornecedor' => '',
                'Numero' => '',
                'Cidade' => '',
                'telefoneFornecedor' => '',
            ];
        }
        
    }

    public function cadastroClientes(){
        $formulario = filter_input_array(INPUT_POST,FILTER_DEFAULT);
        if(isset($formulario)){
            $dados = [
                'nome' => trim($formulario['nomeCliente']),
                'email' => trim($formulario['email']),
                'telefone' => trim($formulario['telefoneCliente']),
                'dataNascimento' => trim($formulario['dataNascimento']),
    
            ];

            if(empty($dados['nome']) || empty($dados['email']) || empty($dados['telefone']) || empty($dados['dataNascimento'])){
                $_SESSION['erro'] = " <p style='color: red;'>Preencha todos os campos!</p>";
                header("Location: ../cadastros.php");
                exit();
            }

            $b = $this->conectDB()->prepare("INSERT INTO clientes (nome, email, telefone, dataNascimento) VALUES (?, ?, ?, ?)");

            $b->bindParam(1, $dados['nome'], \PDO::PARAM_STR);
            $b->bindParam(2, $dados['email'], \PDO::PARAM_STR);
            $b->bindParam(3, $dados['telefone'], \PDO::PARAM_INT);
            $b->bindParam(4, $dados['dataNascimento'], \PDO::PARAM_STR);
            $b->execute();
            $_SESSION['Sucesso'] = "<p style='color: green;'>Cadastro realizado com sucesso!</p>";
            header("Location: ../cadastros.php");

        }else{
            $dados = [
                'nome' => '',
                'email' => '',
                'telefone' => '',
                'dataNascimento' => '',
            ];
        }
    }
}
