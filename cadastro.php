<?php
require_once 'usuario.php';
$usuario = new Usuario();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Cadastro de Usuário</h2>
    <form action="" method="post" class="form-cadastro">
        <label>Nome:</label>
        <input type="text" name="nome" placeholder="Nome Completo" required><br>
        
        <label>Email:</label>
        <input type="email" name="email" placeholder="Digite seu E-mail" required><br>
        
        <label>Telefone:</label>
        <input type="tel" name="telefone" placeholder="Digite seu telefone" required><br>
        
        <label>Senha:</label>
        <input type="password" name="senha" placeholder="Digite sua senha" required><br>
        
        <label>Confirmar Senha:</label>
        <input type="password" name="confSenha" placeholder="Confirme sua senha" required><br>

        <input type="submit" value="Cadastrar" class="btn editar">
    </form>

    <?php
        if(isset($_POST['nome']))
        {
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $confSenha = addslashes($_POST['confSenha']);

            if(!empty($nome) && !empty($email) && !empty($telefone) && !empty($senha) && !empty($confSenha))
            {
                $usuario->conectar("cadastrousuarioturma33","localhost","root","");
                if($usuario->msgErro == "")
                {
                    if($senha == $confSenha)
                    {
                        if($usuario->cadastrar($nome, $telefone, $email, $senha))
                        {
                            ?>
                                <div class="msg-sucesso">
                                    <p>Cadastrado com Sucesso</p>
                                    <p>Clique <a href="login.php">aqui</a> para logar.</p>
                                </div>
                            <?php
                        }
                        else
                        {
                            ?>
                            <div class="msg_erro">
                                <p>Email já cadastrado.</p>
                            </div>
                        <?php 
                        }
                    }
                    else
                    {
                        ?>
                            <div class="msg_erro">
                                <p>Senhas não conferem.</p>
                            </div>
                        <?php
                    }
                }
                else
                {
                    ?>
                        <div class="msg-erro">
                            <?php echo "Erro: ".$usuario->msgErro?>
                        </div>
                    <?php
                }
            }
            else
            {
                ?>
                    <div class="msg-erro">
                        <p>Preencha todos os campos.</p>
                    </div>
                <?php
            }
        
        }
    ?>
</body>
</html>
