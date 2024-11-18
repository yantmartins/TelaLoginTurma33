<?php
require_once 'usuario.php';
$usuario = new Usuario();
$usuario->conectar("cadastrousuarioturma33", "localhost", "root", "");




if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = addslashes($_GET['id']);

    $sql = $usuario->pdo->prepare("SELECT * FROM usuario WHERE id_usuario = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $dadosUsuario = $sql->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Usuário não está no sistema.";
        exit;
    }
} else {
    echo "ID inválido.";
    exit;
}

if (isset($_POST['nome'])) 
{    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    

    if (!empty($nome) && !empty($email) && !empty($telefone)) 
    {
        $sql = $usuario->pdo->prepare("UPDATE usuario SET nome = :n, email = :e, telefone = :t WHERE id_usuario = :id");
        $sql->bindValue(":n", $nome);
        $sql->bindValue(":e", $email);
        $sql->bindValue(":t", $telefone);
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        echo "Usuário editado com sucesso.";
    } 
    else 
    {
        echo "Erro ao editar usuário.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
</head>
<body>
    <h1>Editar Usuário</h1>
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

</body>
</html>
