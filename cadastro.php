<?php
    require_once 'usuario.php';
    $usuario = new Usuario();
    $usuario->conectar("cadastroturma33", "localhost", "root", "");
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Cadastro</title>
</head>
<body>
    <h2>Cadastro de Usuário</h2><br>
    <form action="" method="post">
        <label>Nome:</label><br>
        <input type="text" name="nome" id="" placeholder="Nome Completo"><br>
        <label>Email:</label><br>
        <input type="email" name="email" id="" placeholder="Digite seu E-mail"><br>
        <label>Telefone:</label><br>
        <input type="tel" name="telefone" id="" placeholder="Digite seu telefone"><br>
        <label>Senha:</label><br>
        <input type="password" name="senha" id="" placeholder="Digite sua senha"><br>
        <label>Confirmar Senha:</label><br>
        <input type="password" name="confSenha" id="" placeholder="Confirme sua senha"><br><br>

        <input type="submit" value="CADASTRAR">
    </form>

    <?php

if (isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confSenha = $_POST['confSenha'];

    if (!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confSenha)) {
        if ($senha === $confSenha) {
            // Verificar se o e-mail já está cadastrado
            if ($usuario->cadastrar($nome, $telefone, $email, $senha)) {
                echo "<p>Cadastrado com sucesso! <a href='login.php'>Clique aqui</a> para logar.</p>";
            } else {
                echo "<p>E-mail já cadastrado.</p>";
            }
        } else {
            echo "<p>As senhas não conferem.</p>";
        }
    } else {
        echo "<p>Preencha todos os campos.</p>";
    }
}
    ?>
</body>
</html>


