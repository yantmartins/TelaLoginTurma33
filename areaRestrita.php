<?php
require_once 'usuario.php';
$usuario = new Usuario();
$usuario->conectar("cadastrousuarioturma33", "localhost", "root", "");

if (!empty($usuario->msgErro)) 
{
    die("Erro ao conectar ao banco de dados: " . $usuario->msgErro);
}

//Excluir usuario
if (isset($_POST['excluir']) && !empty($_POST['id'])) 
{
    $usuario->excluirUsuario($_POST['id']);
}

//Edita
if (isset($_POST['editar']) && !empty($_POST['id']) && !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['telefone'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $usuario->editarUsuario($id, $nome, $email, $telefone);
}

//Lista
$dados = $usuario->listarUsuarios();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Dados</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>LISTAR USUÁRIO</h1>
    <table border="1" class="tabela">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(!empty($dados))
                {
                    foreach ($dados as $pessoa): 
            ?>
                <tr>
                <form method="post">
                        <td>
                            <input type="text" name="nome" value="<?php echo $pessoa['nome']; ?>" required>
                        </td>
                        <td>
                            <input type="email" name="email" value="<?php echo $pessoa['email']; ?>" required>
                        </td>
                        <td>
                            <input type="text" name="telefone" value="<?php echo $pessoa['telefone']; ?>" required>
                        </td>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $pessoa['id_usuario']; ?>">
                            <button type="submit" name="editar">Editar</button>
                            <button type="submit" name="excluir" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</button>
                        </td>
                    </form>
                </tr>    
            <?php
                endforeach;
                }
                else
                {
                    echo "<tr><td colspan='4'>Nenhum usuário cadastrado.</td></tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>

