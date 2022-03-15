<!DOCTYPE html>
<?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    include_once "acao.php";
    $comando = isset($_GET['comando']) ? $_GET['comando'] : "";
    $tabela = "endereco";
    $dados;
    if ($comando == 'update'){
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id, $tabela);
    }
    $end_estado = isset($_POST['END_ESTADO']) ? $_POST['END_ESTADO'] : "";
    $end_cidade = isset($_POST['END_CIDADE']) ? $_POST['END_CIDADE'] : "";
    $end_rua = isset($_POST['END_RUA']) ? $_POST['END_RUA'] : "";
    $end_numero = isset($_POST['END_NUMERO']) ? $_POST['END_NUMERO'] : "";
    $cli_id = isset($_POST['CLI_ID']) ? $_POST['CLI_ID'] : "";
    ?>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title></title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel='stylesheet' type='text/css' media='screen' href='../css/cadastro.css'>
    <script src='../js/main.js'></script>
    <link rel="icon" type="image/x-icon" href="../img/favicon.ico">
    <style>
        #searchImg {
            width: 10rem;
            background-color: black;
        }
    </style>
</head>
<body>
    <header>
        <nav class="" id="nav">
            <a href="../index.php"><p class="navItem" id="navHome"> Home </p></a>
        </nav>
    </header>
    <content>
        <form action="acao.php" method="post" id="form">
            <p class="formItem formText" id="">Estado:</p>
            <input required type="text" class="formItem formInput" name="END_ESTADO" id="END_ESTADO" value="<?php if ($comando == "update"){echo $dados['END_ESTADO'];}?>">
            <br><br>
            <p class="formItem formText" id="">Cidade:</p>
            <input required type="text" class="formItem formInput" name="END_CIDADE" id="END_CIDADE" value="<?php if ($comando == "update"){echo $dados['END_CIDADE'];}?>">
            <br><br>
            <p class="formItem formText" id="">Rua:</p>
            <input required type="text" class="formItem formInput" name="END_RUA" id="END_RUA" value="<?php if ($comando == "update"){echo $dados['END_RUA'];}?>">
            <br><br>
            <p required class="formItem formText" id="">Número:</p>
            <input required type="number" class="formItem formInput" name="END_NUMERO" id="END_NUMERO" value="<?php if ($comando == "update"){echo $dados['END_NUMERO'];}?>">
            <br><br>
            <p class="formItem formText" id="">Cliente:</p>
            <select class="form-select" name="CLI_ID" value="">
            <?php
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query("SELECT * FROM cliente");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <option name="" value="<?php echo $linha['CLI_ID']; ?>" <?php if ($comando == "update" && $linha['CLI_ID'] == $dados['CLI_ID']){echo "selected";}?>><?php echo $linha['CLI_NOME'];?></option>
            <?php } ?>
            </select>
            <br><br>
            <input type="hidden" name="comando" id="" value="<?php if($comando == "update"){echo "update";}else{echo "insert";}?>">
            <input type="hidden" id="tabela" name="tabela" class="tabela" value="endereco">
            <input type="hidden" name="id" id="" value="<?php if($comando == "update"){echo $id;}?>">
            <input type="submit" class="formItem formInput" id="acao" value="ENVIAR">
            <br><br>
        </form>    
    </content>
    <footer class="" id="">
        <br><br><br>
        <p class="footerItem footerText" id="footerInfo">
            Informações ao consumidor: Biblioteca S/A - CNPJ nº xx.xxx.xxx/xxxx-xx<br>
            Sede: Rua Wenceslau Borini, n° xxx - Canta Galo - CEP: xx.xxx-xxx - Rio do Sul - SC<br>
            Central de Reservas 24h: 0800 xxx xxxx | Assistência a Clientes 24h: 0800 xxx xxxx<br>
            Central de Reservas 24 horas: 0800 xxx xxxx | Assistência a Clientes 24 horas: 0800 xxx xxxx<br>
            E-mail: centraldereservas@biblioteca.com<br>
        </p>
        <p class="footerItem footerText" id="footerTbm">
            VEJA TAMBÉM:<br><br>
            <a class="footerHyperlink" href="facebook.com"><img class="footerItem" id="footerFacebook" src="../img/facebookLogo.png">Facebook<br></a>
            <a class="footerHyperlink" href="instagram.com"><img class="footerItem" id="footerInstagram" src="../img/instagramLogo.png">Instagram<br></a>
        </p>
        <br><br><br><br><br><br>
        <p class="footerItem footerText " id="footerRights">
            ©Biblioteca - Todos direitos reservados<br>
        </p>
    </footer>
</body>
</html>