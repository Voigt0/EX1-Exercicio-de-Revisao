<!DOCTYPE html>
<?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    include_once "acao.php";
    $comando = isset($_GET['comando']) ? $_GET['comando'] : "";
    $tabela = "cliente";
    $dados;
    if ($comando == 'update'){
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    if ($id > 0)
        $dados = buscarDados($id, $tabela);
    }
    $cli_nome = isset($_POST['CLI_NOME']) ? $_POST['CLI_NOME'] : "";
    $cli_sobrenome = isset($_POST['CLI_SOBRENOME']) ? $_POST['CLI_SOBRENOME'] : "";
    $cli_nascimento = isset($_POST['CLI_NASCIMENTO']) ? $_POST['CLI_NASCIMENTO'] : "";
    $cli_telefone = isset($_POST['CLI_TELEFONE']) ? $_POST['CLI_TELEFONE'] : "";
    $cli_email = isset($_POST['CLI_EMAIL']) ? $_POST['CLI_EMAIL'] : "";
    $cli_cpf = isset($_POST['CLI_CPF']) ? $_POST['CLI_CPF'] : "";
    $cli_senha = isset($_POST['CLI_SENHA']) ? $_POST['CLI_SENHA'] : "";
    ?>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Biblioteca</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/cadastro.css'>
    <script src='../js/main.js'></script>
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
            <p class="formItem formText" id="formNome">Nome:</p>
            <input required type="text" class="formItem formInput" name="CLI_NOME" id="CLI_NOME" value="<?php if ($comando == "update"){echo $dados['CLI_NOME'];}?>">
            <br><br>
            <p class="formItem formText" id="formSobrenome">Sobrenome:</p>
            <input required type="text" class="formItem formInput" name="CLI_SOBRENOME" id="CLI_SOBRENOME" value="<?php if ($comando == "update"){echo $dados['CLI_SOBRENOME'];}?>">
            <br><br>
            <p class="formItem formText" id="formNascimento">Nascimento:</p>
            <input required type="date" class="formItem formInput" name="CLI_NASCIMENTO" id="CLI_NASCIMENTO" value="<?php if ($comando == "update"){echo $dados['CLI_NASCIMENTO'];}?>">
            <br><br>
            <p required class="formItem formText" id="formTelefone">Telefone:</p>
            <input required type="tel" class="formItem formInput" name="CLI_TELEFONE" id="CLI_TELEFONE" value="<?php if ($comando == "update"){echo $dados['CLI_TELEFONE'];}?>">
            <br><br>
            <p class="formItem formText" id="formEmail">Email:</p>
            <input type="email" class="formItem formInput" name="CLI_EMAIL" id="CLI_EMAIL" value="<?php if ($comando == "update"){echo $dados['CLI_EMAIL'];}?>">
            <br><br> 
            <p class="formItem formText" id="formCPF">CPF:</p>
            <input required type="text" class="formItem formInput" name="CLI_CPF" id="CLI_CPF" value="<?php if ($comando == "update"){echo $dados['CLI_CPF'];}?>">
            <br><br>
            <p class="formItem formText" id="formSenha">Senha:</p>
            <input required type="password" class="formItem formInput" name="CLI_SENHA" id="CLI_SENHA" value="<?php if ($comando == "update"){echo $dados['CLI_SENHA'];}?>">
            <br><br>
            <br><br><br><br>
            <input type="hidden" name="comando" id="" value="<?php if($comando == "update"){echo "update";}else{echo "insert";}?>">
            <input type="hidden" id="tabela" name="tabela" class="tabela" value="cliente">
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