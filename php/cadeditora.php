<!DOCTYPE html>
<?php
    //<img class="footerItem" id="footerLogo" src="../img/carGoLogo.png">
    //<a href="../index.php"><img class="navItem" id="navTitle" src="../img/carGoLogo.png"></a>
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    include_once "acao.php";
    $comando = isset($_GET['comando']) ? $_GET['comando'] : "";
    $tabela = "editora";
    $dados;
    if ($comando == 'update'){
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id, $tabela);
    }
    $edi_nome = isset($_POST['EDI_NOME']) ? $_POST['EDI_NOME'] : "";
    $edi_fundacao = isset($_POST['EDI_FUNDACAO']) ? $_POST['EDI_FUNDACAO'] : "";
    $edi_fundador = isset($_POST['EDI_FUNDADOR']) ? $_POST['EDI_FUNDADOR'] : "";
    $edi_sede = isset($_POST['EDI_SEDE']) ? $_POST['EDI_SEDE'] : "";
    ?>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Biblioteca</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/editora.css'>
    <script src='../js/main.js'></script>
    <style>
        #searchImg {
            width: 10rem;
            background-color: black;
        }
    </style>
</head>
<body>
    <?php 
    
    
    ?>
    <header>
        <nav class="" id="nav">
            <a href="../index.php"><p class="navItem" id="navHome"> Home </p></a>
        </nav>
    </header>
    <content>
        <form action="acao.php" method="post" id="form">
            <p class="formItem formText" id="formCadastrarEditora">Cadastrar editora</p><br><br><br>
            <p class="formItem formText" id="formNomedaEditora">Nome da editora:</p>
            <input required type="text" class="formItem formInput" name="EDI_NOME" id="EDI_NOME" value="<?php if ($comando == "update"){echo $dados['EDI_NOME'];}?>">
            <br><br>
            <p class="formItem formText" id="formFundação">Fundação:</p>
            <input required type="date" class="formItem formInput" name="EDI_FUNDACAO" id="EDI_FUNDACAO" value="<?php if ($comando == "update"){echo $dados['EDI_FUNDACAO'];}?>">
            <br><br>
            <p class="formItem formText" id="formFundador">Fundador:</p>
            <input required type="text" class="formItem formInput" name="EDI_FUNDADOR" id="EDI_FUNDADOR" value="<?php if ($comando == "update"){echo $dados['EDI_FUNDADOR'];}?>">
            <br><br>
            <p class="formItem formText" id="formSede">Sede:</p>
            <input required type="text" class="formItem formInput" name="EDI_SEDE" id="EDI_SEDE" value="<?php if ($comando == "update"){echo $dados['EDI_SEDE'];}?>">
            <br><br><br><br>
            <input type="hidden" name="comando" id="" value="<?php if($comando == "update"){echo "update";}else{echo "insert";}?>">
            <input type="hidden" id="tabela" name="tabela" class="tabela" value="editora">
            <input type="hidden" name="id" id="" value="<?php if($comando == "update"){echo $id;}?>">
            <input type="submit" class="formItem formInput" id="acao" value="ENVIAR">
            <br><br><br><br>
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
