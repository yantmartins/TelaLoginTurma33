<?php
require_once 'usuario.php';

$usuario = new Usuario();
$usuario->conectar("cadastrousuarioturma33", "localhost", "root", "");




if ($email) 
{
    $sql = $pdo->prepare("SELECT * FROM usuario WHERE email = :e");
    $sql->bindValue(":e", $email);
    $sql->execute();
    $dadosUsuario = $sql->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{    
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confSenha = addslashes($_POST['confSenha']);

    if ($usuario->editar($id_usuario, $nome, $telefone, $email, $senha, $confSenha)) 
    {
        echo "Usuário editado com sucesso.";
    } 
    else 
    {
        echo "Erro ao editar usuário.";
    }
}
?>

<form method="POST">
    <label>Nome:</label>
    <input type="text" name="nome" value="" required><br>

    <label>Telefone:</label>
    <input type="text" name="telefone" value="" required><br>

    <label>Email:</label>
    <input type="email" name="email" value="" required><br>

    <label>Senha:</label>
    <input type="password" name="senha" required><br>

    <button type="submit">Salvar Alterações</button>
</form>
