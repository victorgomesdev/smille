<?php 
include("config/init.php"); 
include("config/sessionVerify.php");
include("config/config.php"); ?>
<?php include(DIRREQ."smille/lib/html/header.php"); ?>

<link rel="stylesheet" href="<?php echo DIRPAGE.'smille/lib/css/cadastro.css';?>">

    <div id="cadastro-container">
            <h1 class="tituloTipo">Escolha o tipo de cadastro:</h1>

            <ul class="tipoCadastro">
                <li><a href="#" id="fornecedorLink">Fornecedor</a></li>
                <li><a href="#" id="funcionarioLink">Funcionário</a></li>
                <li><a href="#" id="clienteLink">Cliente</a></li>
                <li><a href="#" id="estoqueLink">Estoque</a></li>
            </ul>

            
            <?php

                        if (isset($_SESSION['erro'])) {
                            echo $_SESSION['erro'];
                            unset($_SESSION['erro']);
                        }

                        if(isset($_SESSION['Sucesso'])){
                            echo $_SESSION['Sucesso'];
                            unset($_SESSION['Sucesso']);
                        }

            ?>
            
                       <br>
            
            <!-- Tela de Cadastro de Fornecedor -->
            <div id="fornecedor" class="cadastro">
                <h2>Cadastro de Fornecedor</h2>
                <form class="formulario" method="post" action="<?php echo DIRPAGE.'smille/controllers/ControllerFornecedores.php'?>">
                    <label for="nomeFornecedor">Nome:</label>
                    <input type="text" id="nomeFornecedor" name="nomeFornecedor" ><br>

                    <label for="cnpj">CNPJ:</label>
                    <input type="text" id="cnpj" name="cnpj" ><br>

                    <label for="enderecoFornecedor">Endereço:</label>
                    <input type="text" id="enderecoFornecedor" name="enderecoFornecedor" ><br>

                    <label for="Numero">Número</label>
                    <input type="number" id="Numero" name="Numero" ></input><br>

                    <label for="Cidade">Cidade:</label>
                    <input type="text" id="Cidade" name="Cidade" ><br>

                    <label for="telefoneFornecedor">Telefone:</label>
                    <input type="text" id="telefoneFornecedor" name="telefoneFornecedor" ><br>

                    

                    <!-- futuras alteraçoes -->

                    <input type="submit" value="Cadastrar">
                </form>
            </div>

            <!-- Tela de Cadastro de Funcionário -->
            <div id="funcionario" class="cadastro">
                <h2>Cadastro de Funcionário</h2>
                <form class="formulario" method="post" action="<?php echo DIRPAGE.'smille/controllers/ControllerUsuarios.php'?>">
                    <label for="nomeFuncionario">Nome:</label>
                    <input type="text" id="nomeFuncionario" name="nomeFuncionario" autocomplete="off"><br>

                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" ><br>

                    <label for="telefoneFuncionario">Telefone:</label>
                    <input type="text" id="telefoneFuncionario" name="telefoneFuncionario" ><br>

                    <label for="cargoFuncionario">Cargo:</label>
                    <select name="cargoFuncionario" id="cargoFuncionario">
                    <option value="">Selecione</option>
                    <option value="1">Dentista</option>
                    <option value="2">Secretaria</option>
                    </select><br><br>
                    
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" ><br>
                    

                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" ><br>

                    <label for="confirmarSenha">Confirme a Senha:</label>
                    <input type="password" id="confirmarSenha" name="confirmarSenha" ><br>

                    <!-- futuras alteraçoes -->

                    <input type="submit" value="Cadastrar">
                </form>
            </div>

            <!-- Tela de Cadastro de Cliente -->
            <div id="cliente" class="cadastro">
                <h2>Cadastro de Cliente</h2>
                <form class="formulario" method="post" action="<?php echo DIRPAGE.'smille/controllers/ControllerClientes.php'?>">
                    <label for="nomeCliente">Nome:</label>
                    <input type="text" id="nomeCliente" name="nomeCliente"><br>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" ><br>


                    <label for="telefoneCliente">Telefone:</label>
                    <input type="text" id="telefoneCliente" name="telefoneCliente"><br>

                    <label for="dataNascimento">Data de Nascimento:</label>
                    <input type="date" id="dataNascimento" name="dataNascimento"><br><br>

                    <!-- futuras alteraçoes -->

                    <input type="submit" value="Cadastrar">
                </form>
            </div>

            <!-- Tela de Cadastro de Estoque -->
            <div id="estoque" class="cadastro">
                <h2>Cadastro de Estoque</h2>
                <form class="formulario" id="form">
                    <input type="hidden" name="opt" value="cadastrar">
                    <input type="hidden" name="usuario" value="<?php echo $_SESSION['profissional']['nome']?>">
                    <label for="nomeProduto">Nome do Produto:</label>
                    <input type="text" id="nomeProduto" name="nomeProduto" required><br>

                    <label for="quantidadeProduto">Quantidade:</label>
                    <input type="number" id="quantidadeProduto" name="quantidadeProduto" required><br>

                    <label for="valorUnitario">Valor Unitário:</label>
                    <input type="text" id="valorUnitario" name="valorUnitario" required><br>

                    <input type="submit" value="Cadastrar">
                </form>
            </div>
        </div>

        <script>
            // Função para alternar entre as telas de cadastro
            function mostrarCadastro(cadastroSelecionado) {
                const cadastros = document.querySelectorAll('.cadastro');

                // Esconde todas as telas de cadastro
                cadastros.forEach(cadastro => {
                    cadastro.style.display = 'none';
                });

                // Mostra apenas a tela de cadastro selecionada
                document.getElementById(cadastroSelecionado).style.display = 'block';
            }

            // Event Listeners para cada tipo de cadastro
            document.getElementById('fornecedorLink').addEventListener('click', function() {
                mostrarCadastro('fornecedor');
            });

            document.getElementById('funcionarioLink').addEventListener('click', function() {
                mostrarCadastro('funcionario');
            });

            document.getElementById('clienteLink').addEventListener('click', function() {
                mostrarCadastro('cliente');
            });

            document.getElementById('estoqueLink').addEventListener('click', function() {
            mostrarCadastro('estoque');
            });

            // Mostrar a tela de fornecedor por padrão (outra opção pode ser escolhida)
            mostrarCadastro('cliente');


            const form = document.getElementById('form')

            form.addEventListener('submit',async  (e)=>{
                e.preventDefault()

                let fd = new FormData(form)

                await fetch('http://localhost/smille/estoque-proc.php',{
                    method: 'post',
                    body: fd
                })
                .then(resposta=>{
                    resposta.json()
                    .then(r=>{
                        alert(r.message)
                    })
                })
            })
        </script>

<?php include(DIRREQ."smille/lib/html/footer.php"); ?>
