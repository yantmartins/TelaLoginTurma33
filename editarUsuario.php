<?php
require_once 'usuario.php';
$usuario = new Usuario();
$usuario->conectar("cadastrousuarioturma33", "localhost", "root", "");




if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = addslashes($_GET['id']);

    $pdo = $usuario->getPdo();
    $sql = $pdo->prepare("SELECT * FROM usuario WHERE id_usuario = :id");
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

$pdo = $usuario->getPdo();
if (isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    if (!empty($nome) && !empty($email) && !empty($telefone)) {
        $sql = $pdo->prepare("UPDATE usuario SET nome = :n, email = :e, telefone = :t WHERE id_usuario = :id");
        $sql->bindValue(":n", $nome);
        $sql->bindValue(":e", $email);
        $sql->bindValue(":t", $telefone);
        $sql->bindValue(":id", $id);
        if ($sql->execute()) {
            echo "<p>Usuário editado com sucesso! <a href='areaRestrita.php'>Voltar</a></p>";
        } else {
            echo "<p>Erro ao editar o usuário.</p>";
        }
    } else {
        echo "<p>Preencha todos os campos!</p>";
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
        <input type="text" name="nome" value="<?php echo $dadosUsuario['nome']; ?>" required><br>

        <label>Telefone:</label>
        <input type="text" name="telefone" value="<?php echo $dadosUsuario['telefone']; ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $dadosUsuario['email']; ?>" required><br>

        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>

