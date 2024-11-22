<?php
require_once 'usuario.php';
$usuario = new Usuario();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Login</h2>
    <form method="post" class="form-login">
        <label>Usuário:</label>
        <input type="email" name="email" placeholder="Digite seu e-mail" required><br>
        
        <label>Senha:</label>
        <input type="password" name="senha" placeholder="********" required><br>

        <input type="submit" value="Logar" class="btn editar">
        <a href="cadastro.php" class="btn">Inscreva-se</a>
    </form>

    <?php
        if(isset($_POST['email']))
        {
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);

            if(!empty($email) && !empty($senha))
            {
                $usuario->conectar("cadastrousuarioturma33","localhost","root","");
                if($usuario->msgErro =="")
                {
                    if($usuario->logar($email,$senha))
                    {
                        header("location: areaRestrita.php");
                    }
                    else
                    {
                        ?>
                            <div class="msg-erro">
                                <p>E-mail e/ou Senha incorretos.</p>
                            </div>
                        <?php
                    }
                }
                else
                {
                    ?>
                        <div class="msg-erro"> 
                            <?php echo "Erro: ".$usuario->msgErro; ?>
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
