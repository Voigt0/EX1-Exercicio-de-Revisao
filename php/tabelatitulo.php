<!DOCTYPE html>
<?php   
   include_once "../conf/default.inc.php";
   require_once "../conf/Conexao.php";
   $title = "TÍTULO";
   $busca = isset($_POST["busca"]) ? $_POST["busca"] : "TIT_ID";
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
        <input type="radio" id="TIT_ID" name="busca" value="TIT_ID" <?php if($busca == "TIT_ID"){echo "checked";}?>>
        <label for="huey"><h3>#ID</h3></label>
        <br>
        <input type="radio" id="TIT_NOME" name="busca" value="TIT_NOME" <?php if($busca == "TIT_NOME"){echo "checked";}?>>
        <label for="huey"><h3>NOME</h3></label>
        <br> 
        <input type="radio" id="TIT_AUTOR" name="busca" value="TIT_AUTOR" <?php if($busca == "TIT_AUTOR"){echo "checked";}?>>
        <label for="huey"><h3>AUTOR</h3></label>
        <br>
        <input type="radio" id="TIT_NUMEROPAG" name="busca" value="TIT_NUMEROPAG" <?php if($busca == "TIT_NUMEROPAG"){echo "checked";}?>>
        <label for="huey"><h3>NÚMERO DE PÁGINA</h3></label>
        <br> 
        <input type="radio" id="TIT_IDIOMA" name="busca" value="TIT_IDIOMA" <?php if($busca == "TIT_IDIOMA"){echo "checked";}?>>
        <label for="huey"><h3>IDIOMA</h3></label>
        <br>
        <input type="radio" id="EDI_NOME" name="busca" value="EDI_NOME" <?php if($busca == "EDI_NOME"){echo "checked";}?>>
        <label for="huey"><h3>EDITORA</h3></label>
        <br><br>
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
                    <th scope="col">Autor</th>
                    <th scope="col">Número de Página</th>
                    <th scope="col">Idioma</th>
                    <th scope="col">Lançamento</th>
                    <th scope="col">Editora</th>
                    <th scope="row">ALTERAR</th>
                    <th scope="row">EXCLUIR</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $type = "LIKE";
                $procurar = "'%". trim($procurar) ."%'";
                if($busca != "TIT_NOME" && $busca != "TIT_AUTOR" && $busca != "TIT_IDIOMA" && $busca != "TIT_ID"){
                    $type = "<=";
                    $procurar = ($_POST["procurar"]);
                    if(is_numeric($procurar) == false){
                        $procurar = 0;
                    }
                }
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query("SELECT * FROM titulo, editora
                                        WHERE $busca $type $procurar
                                        AND titulo.EDI_ID = editora.EDI_ID
                                        ORDER BY $busca");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            ?>
                <tr>
                    <th scope="row"><?php echo $linha['TIT_ID'];?></th>
                    <td scope="row"><?php echo $linha['TIT_NOME'];?></td>
                    <td scope="row"><?php echo $linha['TIT_AUTOR'];?></td>
                    <td scope="row"><?php echo $linha['TIT_NUMEROPAG'];?></td>
                    <td scope="row"><?php echo $linha['TIT_IDIOMA'];?></td>
                    <td><?php echo date("d/m/Y", strtotime($linha['TIT_LANCAMENTO']));?></td>
                    <td scope="row"><?php echo $linha['EDI_NOME'];?></td>
                    <td scope="row"><a href="cadtitulo.php?id=<?php echo $linha['TIT_ID'];?>&comando=update"><img src="../img/history-solid.svg" style="width: 2rem;"></a></td>
                    <td><a onclick="return confirm('Deseja mesmo excluir?')" href="acao.php?id=<?php echo $linha['TIT_ID'];?>&tabela=titulo&comando=deletar"><img src="../img/trash.svg" style="width: 2rem;"></a></td>
                </tr>
            <?php } ?> 
            </tbody>
        </table>
    </div>
</body>
</html>