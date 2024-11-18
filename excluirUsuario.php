<?php
require_once 'usuario.php';
$usuario = new Usuario();
$usuario->conectar("cadastrousuarioturma33", "localhost", "root", "");

// Verificar se o ID foi informado
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = addslashes($_GET['id']);

    // Realizar exclusão
    $pdo = $usuario->getPdo();
    $sql = $pdo->prepare("DELETE FROM usuario WHERE id_usuario = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();

    echo "<p>Usuário excluído com sucesso! <a href='areaRestrita.php'>Voltar</a></p>";
} else {
    echo "ID não informado.";
    exit;
}
?>