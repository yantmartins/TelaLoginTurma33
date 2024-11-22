<?php
require_once 'usuario.php';
$usuario = new Usuario();
$usuario->conectar("cadastrousuarioturma33", "localhost", "root", "");

if (!empty($usuario->msgErro)) {
    die("Erro ao conectar ao banco de dados: " . $usuario->msgErro);
}

// Puxar pelo ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $dados = $usuario->listarUsuarios();
    $usuarioSelecionado = null;

    foreach ($dados as $pessoa) {
        if ($pessoa['id_usuario'] == $id) {
            $usuarioSelecionado = $pessoa;
            break;
        }
    }

    if (!$usuarioSelecionado) {
        die("Usuário não encontrado.");
    }
} else {
    die("ID do usuário não informado.");
}

// Editar o usuário
if (isset($_POST['editar']) && !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['telefone'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    if ($usuario->editarUsuario($id, $nome, $email, $telefone)) {
        $msgSucesso = "Usuário editado com sucesso.";
    } else {
        $msgErro = "Erro ao editar o usuário.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Editar Usuário</h1>
    <form method="post" class="form-editar">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($usuarioSelecionado['nome']); ?>" required><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($usuarioSelecionado['email']); ?>" required><br>

        <label>Telefone:</label>
        <input type="text" name="telefone" value="<?php echo htmlspecialchars($usuarioSelecionado['telefone']); ?>" required><br>

        <button type="submit" name="editar" class="btn">Confirmar Edição</button>
    </form>

    <?php if (isset($msgSucesso)): ?>
        <div class="msg-sucesso">
            <p><?php echo $msgSucesso; ?></p>
            <a href="areaRestrita.php">Voltar </a>
        </div>
    <?php endif; ?>

    <?php if (isset($msgErro)): ?>
        <div class="msg-erro">
            <p><?php echo $msgErro; ?></p>
        </div>
    <?php endif; ?>
</body>
</html>
