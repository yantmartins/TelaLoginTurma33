<?php
    include_once 'conectar.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar</title>
</head>
<body>
    <h1>Listar Usuários</h1>
    <?php
        $result_msg_cont = "SELECT * FROM usuario ORDER BY id_usuario ASC";
        $resultado_msg_cont=$conn->prepare($result_msg_cont);
        $result_msg_cont->execute();

        while($row_msg_cont = $resultado_msg_cont->fetch(PDO::FETCH_ASSOC))
        {
            echo "ID:" .$row_msg_cont['id_usuario']."br>";
            echo "Nome:" .$row_msg_cont['nome']."<br>";
            echo "Email:" .$row_msg_cont['email']."<br>";
            echo "Telefone:" .$row_msg_cont['telefone']."<br>";
        }
    ?>  
</body>
</html>

