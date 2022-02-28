<!DOCTYPE html>
<?php   
   include_once "../conf/default.inc.php";
   require_once "../conf/Conexao.php";
   $title = "CLIENTE";
   $busca = isset($_POST["busca"]) ? $_POST["busca"] : "CLI_ID";
   $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : "";
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
    <form method="post">
        <input type="radio" id="CLI_ID" name="busca" value="CLI_ID" <?php if($busca == "CLI_ID"){echo "checked";}?>>
        <label for="huey"><h3>#ID</h3></label>
        <br>
        <input type="radio" id="CLI_NOME" name="busca" value="CLI_NOME" <?php if($busca == "CLI_NOME"){echo "checked";}?>>
        <label for="huey"><h3>NOME</h3></label>
        <br> 
        <input type="radio" id="CLI_EMAIL" name="busca" value="CLI_EMAIL" <?php if($busca == "CLI_EMAIL"){echo "checked";}?>>
        <label for="huey"><h3>EMAIL</h3></label>
        <br>
        <input type="radio" id="CLI_NASCIMENTO" name="busca" value="CLI_NASCIMENTO" <?php if($busca == "CLI_NASCIMENTO"){echo "checked";}?>>
        <label for="huey"><h3>NASCIMENTO</h3></label>
        <br><br><br>
        <div class="" style="padding-left: 10%;">
            <legend>Procurar: </legend>
            <input type="text"   name="procurar" id="procurar" size="37" value="<?php echo $procurar;?>">
            <button type="submit" class="btn btn-dark" name="acao" id="acao">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
            </button>
            <br><br>
        </div>
    </form>
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
                    <th scope="row">DETALHE</th>
                    <th scope="row">ALTERAR</th>
                    <th scope="row">EXCLUIR</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $type = "LIKE";
                $procurar = "'%". trim($procurar) ."%'";
                if($busca != "CLI_ID" && $busca != "CLI_NOME" && $busca != "CLI_EMAIL" && $busca != "CLI_NASCIMENTO"){
                    $type = "<=";
                    $procurar = ($_POST["procurar"]);
                    if(is_numeric($procurar) == false){
                        $procurar = 9999;
                    }
                }
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query("SELECT * FROM cliente 
                                        WHERE $busca $type $procurar
                                        ORDER BY $busca");
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
                    <td scope="row"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"><path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/></svg></td>
                    <td scope="row"><a href="cadcliente.php?id=<?php echo $linha['CLI_ID'];?>&comando=update"><img src="../img/history-solid.svg" style="width: 2rem;"></a></td>
                    <td><a onclick="return confirm('Deseja mesmo excluir?')" href="acao.php?id=<?php echo $linha['CLI_ID'];?>&tabela=cliente&comando=deletar"><img src="../img/trash.svg" style="width: 2rem;"></a></td>
                </tr>
            <?php } ?> 
            </tbody>
        </table>
    </div>
</body>
</html>