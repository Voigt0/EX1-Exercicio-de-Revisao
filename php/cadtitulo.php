<!DOCTYPE html>
<?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    include_once "acao.php";
    $comando = isset($_GET['comando']) ? $_GET['comando'] : "";
    $tabela = "titulo";
    $dados;
    if ($comando == 'update'){
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id, $tabela);
    }
    $tit_nome = isset($_POST['TIT_NOME']) ? $_POST['TIT_NOME'] : "";
    $tit_autor = isset($_POST['TIT_AUTOR']) ? $_POST['TIT_AUTOR'] : "";
    $tit_numeropag = isset($_POST['TIT_NUMEROPAG']) ? $_POST['TIT_NUMEROPAG'] : "";
    $tit_idioma = isset($_POST['TIT_IDIOMA']) ? $_POST['TIT_IDIOMA'] : "";
    $tit_lancamento = isset($_POST['TIT_LANCAMENTO']) ? $_POST['TIT_LANCAMENTO'] : "";
    $edi_id = isset($_POST['EDI_ID']) ? $_POST['EDI_ID'] : "";
    ?>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Biblioteca</title>
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
        <h1>Cadastro Título</h1>
        <br>
            <p class="formItem formText" id="">Nome:</p>
            <input required type="text" class="formItem formInput" name="TIT_NOME" id="TIT_NOME" value="<?php if ($comando == "update"){echo $dados['TIT_NOME'];}?>">
            <br><br>
            <p class="formItem formText" id="">Autor:</p>
            <input required type="text" class="formItem formInput" name="TIT_AUTOR" id="TIT_AUTOR" value="<?php if ($comando == "update"){echo $dados['TIT_AUTOR'];}?>">
            <br><br>
            <p class="formItem formText" id="">Número de páginas:</p>
            <input required type="number" class="formItem formInput" name="TIT_NUMEROPAG" id="TIT_NUMEROPAG" value="<?php if ($comando == "update"){echo $dados['TIT_NUMEROPAG'];}?>">
            <br><br>
            <p required class="formItem formText" id="">Idioma:</p>
            <input required type="text" class="formItem formInput" name="TIT_IDIOMA" id="TIT_IDIOMA" value="<?php if ($comando == "update"){echo $dados['TIT_IDIOMA'];}?>">
            <br><br>
            <p class="formItem formText" id="formEmail">Lançamento:</p>
            <input type="date" class="formItem formInput" name="TIT_LANCAMENTO" id="TIT_LANCAMENTO" value="<?php if ($comando == "update"){echo $dados['TIT_LANCAMENTO'];}?>">
            <br><br>
            <p class="formItem formText" id="">Editora:</p>
            <select class="formItem formText" name="EDI_ID" value="">
            <?php
                $pdo = Conexao::getInstance();
                $consulta = $pdo->query("SELECT * FROM editora");
                while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <option name="" value="<?php echo $linha['EDI_ID']; ?>" <?php if ($comando == "update" && $linha['EDI_ID'] == $dados['EDI_ID']){echo "selected";}?>><?php echo $linha['EDI_NOME'];?></option>
            <?php } ?>
            </select>
            <br><br><br><br><br><br><br><br><br>
            <input type="hidden" name="comando" id="" value="<?php if($comando == "update"){echo "update";}else{echo "insert";}?>">
            <input type="hidden" id="tabela" name="tabela" class="tabela" value="titulo">
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