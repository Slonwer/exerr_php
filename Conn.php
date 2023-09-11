<?php

class Conn
{
    public $host = "localhost";
    public $user = "root";
    public $pass = "";
    public $dbname = "prova_php";
    public $port = 3306;
    public $conn = null;

    public function conectar() {
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->user, $this->pass);
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Erro: Conexão não realizada com sucesso! Erro gerado: " . $e->getMessage();
            return null;
        }
    }
}

class NiveAcesso
{
    private $connection;

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

class SituacaoUsuario
{
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function listarSituacoesUsuarios() {
        try {
            $query = "SELECT * FROM sits_usuarios";
            $result = $this->connection->prepare($query);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erro ao listar situações dos usuários: ' . $e->getMessage();
            return [];
        }
    }
}

// Uso das classes
$connection = new Conn(); 
$conn = $connection->conectar(); 
$niveAcesso = new NiveAcesso($conn); 
$niveis = $niveAcesso->listarNiveisAcesso();

$situacaoUsuario = new SituacaoUsuario($conn);
$situacoes = $situacaoUsuario->listarSituacoesUsuarios();

// Exibição dos resultados
echo "Níveis de Acesso:<br>";
foreach ($niveis as $nivel) {
    echo "ID: " . $nivel['id'] . ", Nome: " . $nivel['nome'] . "<br>";
}

echo "<br>Situações dos Usuários:<br>";
foreach ($situacoes as $situacao) {
    echo "ID: " . $situacao['id'] . ", Nome: " . $situacao['nome'] . "<br>";
}

class AcessosAulas {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function listarAcessosAulas() {
        try {
            $query = "SELECT * FROM acessos_aulas";
            $result = $this->connection->prepare($query);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erro ao listar acessos das aulas: ' . $e->getMessage();
            return [];
        }
    }
}

$acessosAulas = new AcessosAulas($conn); // Use $conn, not $dbConnection

echo "Acessos Aulas:<br>";
$acessos = $acessosAulas->listarAcessosAulas();
foreach ($acessos as $acesso) {
    echo "ID: " . $acesso['id'] . ", Nome: " . $acesso['nome'] . "<br>";
}

?>
