<?php
require './Conn.php';

class User {
    public $connect;

    public function listar() {
        $conn = new Conn();
        $this->connect = $conn->conectar();

        try {
            $query_user = "SELECT usuarios.id, usuarios.nome AS nome_usuario, usuarios.email, 
                           sits_usuarios.nome AS nome_situacao, niveis_acessos.nome AS nome_nivel
                           FROM usuarios
                           INNER JOIN sits_usuarios ON usuarios.sits_usuario_id = sits_usuarios.id
                           INNER JOIN niveis_acessos ON usuarios.niveis_acesso_id = niveis_acessos.id
                           ORDER BY usuarios.nome";
            
            $result_user = $this->connect->prepare($query_user);
            
            if ($result_user->execute()) {
                return $result_user->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $errorInfo = $result_user->errorInfo();
                return [];
            }
        } catch (PDOException $e) {
            echo 'Ocorreu um erro: ' . $e->getMessage();
            return [];
        }
    }
}

class NiveisAcessos {
    public $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function listarNiveisAcesso() {
        try {
            $query = "SELECT * FROM niveis_acessos";
            $result = $this->connection->prepare($query);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erro ao listar níveis de acesso: ' . $e->getMessage();
            return [];
        }
    }
}


$connection = new Conn(); 
$conn = $connection->conectar(); 
$niveisAcessos = new NiveisAcessos($conn);
$niveis = $niveisAcessos->listarNiveisAcesso();

$user = new User();
$users = $user->listar();

echo "Lista de Usuários:<br>";
foreach ($users as $usuario) {
    echo "ID: " . $usuario['id'] . "<br>";
    echo "Nome do Usuário: " . $usuario['nome_usuario'] . "<br>";
    echo "E-mail do Usuário: " . $usuario['email'] . "<br>";
    echo "Situação: " . $usuario['nome_situacao'] . "<br>";
    echo "Nível de Acesso: " . $usuario['nome_nivel'] . "<br>";
    
   
    $informacoesAdicionais = new InformacoesAdicionais("Administrador", "2023-08-29 00:00:00", "2023-09-30 00:00:00");
    echo "Nível de Acesso: " . $informacoesAdicionais->getNivelAcesso() . "<br>";
    echo "Data: " . $informacoesAdicionais->getDataInicio() . "<br>";
    echo "Data: " . $informacoesAdicionais->getDataTermino() . "<br>";

    echo "<hr>";
}

echo "<br>Lista de Níveis de Acesso:<br>";
foreach ($niveis as $nivel) {
    echo "ID do nível: " . $nivel['id'] . "<br>";
    echo "Nome do nível: " . $nivel['nome'] . "<br>";
    echo "<hr>";
}


?>

