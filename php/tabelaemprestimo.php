<!DOCTYPE html>
<?php   
   include_once "../conf/default.inc.php";
   require_once "../conf/Conexao.php";
   $title = "EMPRESTIMO";
   $busca = isset($_POST["busca"]) ? $_POST["busca"] : "EMP_ID";
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
    <form method="post" style="background-color: rgb(33, 37, 41); color: #FFF;">
    <input type="radio" id="EMP_ID" name="busca" value="EMP_ID" <?php if($busca == "EMP_ID"){echo "checked";}?>>
        <label for="huey"><h3>#ID</h3></label>
        <br>
        <input type="radio" id="EMP_ENTRADA" name="busca" value="EMP_ENTRADA" <?php if($busca == "EMP_ENTRADA"){echo "checked";}?>>
        <label for="huey"><h3>NOME</h3></label>
        <br>
        <input type="radio" id="EMP_SAIDA" name="busca" value="EMP_SAIDA" <?php if($busca == "EMP_SAIDA"){echo "checked";}?>>
        <label for="huey"><h3>NOME</h3></label>
        <br>
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
                    <th scope="col">Entrada</th>
                    <th scope="col">Sa??da</th>
                    <th scope="col">Nome do cliente</th>
                    <th scope="col">Nome do exemplar</th>
                    <th scope="row">ALTERAR</th>
                    <th scope="row">EXCLUIR</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $type = "LIKE";
                $procurar = "'%". trim($procurar) ."%'";
                if($busca != "EMP_ID" && $busca != "EMP_ENTRADA" && $busca != "EMP_SAIDA"){
                    $type = "<=";
                    $procurar = ($_POST["procurar"]);
                    if(is_numeric($procurar) == false){
                        $procurar = 0;
                    }
                }
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query("SELECT * FROM emprestimo, cliente, exemplar, titulo
                                        WHERE $busca $type $procurar
                                        AND emprestimo.CLI_ID = cliente.CLI_ID
                                        AND emprestimo.EXE_ID = exemplar.EXE_ID
                                        AND exemplar.TIT_ID = titulo.TIT_ID
                                        ORDER BY $busca");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                <th scope="row"><?php echo $linha['EMP_ID'];?></th>
                <td><?php echo date("d/m/Y", strtotime($linha['EMP_ENTRADA']));?></td>
                <td><?php echo date("d/m/Y", strtotime($linha['EMP_SAIDA']));?></td>
                    <td scope="row"><?php echo $linha['CLI_NOME'];?></td>
                    <td scope="row"><?php echo $linha['TIT_NOME'];?></td>
                    <td scope="row"><a href="cademprestimo.php?id=<?php echo $linha['EMP_ID'];?>&comando=update"><img src="../img/history-solid.svg" style="width: 2rem;"></a></td>
                    <td><a onclick="return confirm('Deseja mesmo excluir?')" href="acao.php?id=<?php echo $linha['EMP_ID'];?>&tabela=emprestimo&comando=deletar"><img src="../img/trash.svg" style="width: 2rem;"></a></td>
                </tr>
            <?php } ?> 
            </tbody>
        </table>
    </div>
</body>
</html>