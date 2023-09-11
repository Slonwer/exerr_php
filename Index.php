<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RRSECCO - Listar</title>
</head>
<body>
    <?php
       
       require './User.php'; 
       require './Nivel.php'; 
       require './Acesso.php'; 
      
        $listUser = new User();
        $result_user = $listUser->listar();

        $connection = new Conn(); 
        $conn = $connection->conectar();
        $niveisAcessos = new NiveisAcessos($conn);
        $niveis = $niveisAcessos->listarNiveisAcesso();

        echo "<h1 style='text-align: center;'>Listar</h1>";
        
        foreach ($result_user as $linha) {
           echo "ID do usuário: " . $linha['id'] . "<br>";
           echo "Nome do usuário: " . $linha['nome'] . "<br>";
           echo "E-mail do usuário: " . $linha['email'] . "<br>";

           $nivelAcesso = "Nível de Acesso: Não Encontrado"; 
           foreach ($niveis as $nivel) {
               if ($nivel['id'] === $linha['nome_nivel']) {
                   $nivelAcesso = "Nível de Acesso: " . $nivel['nome'];
                   break; 
               }
           }
           echo $nivelAcesso . "<br>";

           echo "<hr>";
        }
    ?>
</body>
</html>
