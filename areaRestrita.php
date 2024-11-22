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

// //Edita
// if (isset($_POST['editar']) && !empty($_POST['id']) && !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['telefone'])) {
//     $id = $_POST['id'];
//     $nome = $_POST['nome'];
//     $email = $_POST['email'];
//     $telefone = $_POST['telefone'];
//     if ($usuario->editarUsuario($id, $nome, $email, $telefone)) {
//         echo "Usuário editado com sucesso.";
//     } else {
//         echo "Erro ao editar usuário.";
//     }
// }

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
                 
                 <td><?php echo $pessoa['nome']; ?></td>
                    <td><?php echo $pessoa['email']; ?></td>
                    <td><?php echo $pessoa['telefone']; ?></td>
                    <td>
                        <!--Ir para edição -->
                        <a href="editarUsuario.php?id=<?php echo $pessoa['id_usuario']; ?>" class="btn">Editar</a>

                        <!-- Excluir o usuário -->
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $pessoa['id_usuario']; ?>">
                            <button type="submit" name="excluir" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</button>
                        </form>
                    </td>
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

