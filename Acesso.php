<?php
class InformacoesAdicionais
{
    private $nivelAcesso;
    private $dataInicio;
    private $dataTermino;

    public function __construct($nivelAcesso, $dataInicio, $dataTermino)
    {
        $this->nivelAcesso = $nivelAcesso;
        $this->dataInicio = $dataInicio;
        $this->dataTermino = $dataTermino;
    }

    public function getNivelAcesso()
    {
        return $this->nivelAcesso;
    }

    public function getDataInicio()
    {
        return $this->dataInicio;
    }

    public function getDataTermino()
    {
        return $this->dataTermino;
    }
}
// ... código anterior ...

// Uso da classe InformacoesAdicionais
$informacoesUsuario1 = new InformacoesAdicionais("Administrador", "2023-08-29 00:00:00", "2023-09-30 00:00:00");
$informacoesUsuario2 = new InformacoesAdicionais("Usuário Comum", "2023-09-01 00:00:00", "2023-09-30 00:00:00");

$user = new User();
$users = $user->listar();

// Exibição dos resultados (você pode ajustar isso conforme necessário)
echo "Lista de Usuários:<br>";
foreach ($users as $usuario) {
    echo "ID: " . $usuario['id'] . "<br>";
    echo "Nome do Usuário: " . $usuario['nome_usuario'] . "<br>";
    echo "E-mail do Usuário: " . $usuario['email'] . "<br>";
    echo "Situação: " . $usuario['nome_situacao'] . "<br>";
    echo "Nível de Acesso: " . $usuario['nome_nivel'] . "<br>";
    echo "Nível de Acesso: " . $informacoesUsuario1->getNivelAcesso() . "<br>";
    echo "Data de Início: " . $informacoesUsuario1->getDataInicio() . "<br>";
    echo "Data de Término: " . $informacoesUsuario1->getDataTermino() . "<br>";
    echo "<hr>";
}

// ... código posterior ...
?>
