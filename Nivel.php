<?php
require './Conn.php';


$connection = new Conn();
$conn = $connection->conectar();

$user = new User();
$users = $user->listar();


$situacoesUsuarios = new SituacoesUsuarios($conn);
$situacoes = $situacoesUsuarios->listarSituacoesUsuarios();


echo "Lista de Usuários:<br>";
foreach ($users as $usuario) {
    echo "ID: " . $usuario['id'] . "<br>";
    echo "Nome do Usuário: " . $usuario['nome_usuario'] . "<br>";
    echo "Email: " . $usuario['email'] . "<br>";
    echo "Situação: " . $usuario['nome_situacao'] . "<br>";
    echo "Nível de Acesso: " . $usuario['nome_nivel'] . "<br>";
    echo "<hr>";
}

echo "<br>Lista de Situações dos Usuários:<br>";
foreach ($situacoes as $situacao) {
    echo "ID: " . $situacao['id'] . "<br>";
    echo "Nome da Situação: " . $situacao['nome'] . "<br>";
    echo "<hr>";
}
?>
