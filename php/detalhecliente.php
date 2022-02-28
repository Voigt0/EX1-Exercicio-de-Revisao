<!DOCTYPE html>
<?php   
   include_once "../conf/default.inc.php";
   require_once "../conf/Conexao.php";
   $title = "CLIENTE";
   $id = isset($_GET["id"]) ? $_GET["id"] : "CLI_ID";
?>
<html>
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
</head>
<body class="">
    <?php include_once "menu.php"; ?>
    <div class="">
        <table class="table table-striped" style="background-color: #FFF;">
            <thead>
                <tr class="table-dark">
                    <th scope="col">#ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Sobrenome</th>
                    <th scope="col">Nascimento</th>
                    <th scope="col">Idade</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Email</th>
                    <th scope="col">Senha</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query("SELECT * FROM cliente 
                                        WHERE CLI_ID LIKE $id");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                    $hoje = date("Y");
                    $nascimento = date("Y", strtotime($linha['CLI_NASCIMENTO']));
                    $idade = $hoje - $nascimento;
            ?>
                <tr>
                    <th scope="row"><?php echo $linha['CLI_ID'];?></th>
                    <td scope="row"><?php echo $linha['CLI_NOME'];?></td>
                    <td scope="row"><?php echo $linha['CLI_SOBRENOME'];?></td>
                    <td><?php echo date("d/m/Y", strtotime($linha['CLI_NASCIMENTO']));?></td>
                    <td style="color: <?php if($idade >=18){echo "blue";}else{echo "red";}?>;"><?php echo $idade;?></td>
                    <td scope="row"><?php echo $linha['CLI_TELEFONE'];?></td>
                    <td scope="row"><?php echo $linha['CLI_CPF'];?></td>
                    <td scope="row"><?php echo $linha['CLI_EMAIL'];?></td>
                    <td scope="row"><?php echo $linha['CLI_SENHA'];?></td>
                </tr>
            <?php } ?> 
            </tbody>
        </table>
    </div>
</body>
</html>