<!DOCTYPE html>
<?php
    $comando = "";
    if(isset($_POST['comando'])){$comando = $_POST['comando'];}else if(isset($_GET['comando'])){$comando = $_GET['comando'];}
    $tabela = "";
    if(isset($_POST['tabela'])){$tabela = $_POST['tabela'];}else if(isset($_GET['tabela'])){$tabela = $_GET['tabela'];}
    $title = "";
?>
<html>
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <style>
       body {
            right: 200px;
       } 
    </style>
</head>
<body class="">
<?php
    include_once "../conf/default.inc.php";
    require_once "../conf/Conexao.php";
    acao($comando, $tabela);


    function acao($acao, $tabela){
        if($acao == "insert"){inserir($tabela);}
        else if($acao == "deletar"){deletar($tabela);}
        else if($acao == "update"){atualizar($tabela);}
    }


    function inserir($tabela){
    $pdo = Conexao::getInstance();
    if($tabela == 'cliente'){
        $dados = dados();
        $nome = $dados["CLI_NOME"];
        $sobrenome = $dados["CLI_SOBRENOME"];
        $nascimento = $dados["CLI_NASCIMENTO"];
        $telefone = $dados["CLI_TELEFONE"];
        $email = $dados["CLI_EMAIL"];
        $cpf = $dados["CLI_CPF"];
        $senha = $dados["CLI_SENHA"];
        $stmt = $pdo->prepare("INSERT INTO `biblioteca`.`cliente` (`CLI_NOME`, `CLI_SOBRENOME`, `CLI_NASCIMENTO`, `CLI_TELEFONE`, `CLI_CPF`, `CLI_EMAIL`, `CLI_SENHA`) VALUES ('$nome', '$sobrenome', '$nascimento', '$telefone', '$cpf', '$email', '$senha');");
        $stmt->execute();
        header('location:tabelacliente.php');
    } else if($tabela == 'genero'){
        $dados = dados();
        $nome = $dados['GEN_NOME'];
        $stmt = $pdo->prepare("INSERT INTO `biblioteca`.`genero` (`GEN_NOME`) VALUES ('$nome')");
        $stmt->execute();
        header('location:tabelagenero.php');
    } else if($tabela == 'editora'){
        $dados = dados();
        $nome = $dados["EDI_NOME"];
        $fundacao = $dados["EDI_FUNDACAO"];
        $fundador = $dados["EDI_FUNDADOR"];
        $sede = $dados["EDI_SEDE"];
        $stmt = $pdo->prepare("INSERT INTO `biblioteca`.`editora` (`EDI_NOME`, `EDI_FUNDACAO`, `EDI_FUNDADOR`, `EDI_SEDE`) VALUES ('$nome', '$fundacao', '$fundador', '$sede')");
        $stmt->execute();
        header('location:tabelaeditora.php');
    } else if($tabela == 'titulo'){
        $dados = dados();
        $nome = $dados['TIT_NOME'];
        $autor = $dados['TIT_AUTOR'];
        $numeropag = $dados['TIT_NUMEROPAG'];
        $idioma = $dados['TIT_IDIOMA'];
        $lancamento = $dados['TIT_LANCAMENTO'];
        $ediid = $dados['EDI_ID'];
        $stmt = $pdo->prepare("INSERT INTO `biblioteca`.`titulo` (`TIT_NOME`, `TIT_AUTOR`, `TIT_NUMEROPAG`, `TIT_IDIOMA`, `TIT_LANCAMENTO`, `EDI_ID`) VALUES ('$nome', '$autor', '$numeropag', '$idioma', '$lancamento', '$ediid');");
        $stmt->execute();
        header('location:tabelatitulo.php');
    } else if($tabela == 'endereco'){
        $dados = dados();
        $estado = $dados['END_ESTADO'];
        $cidade = $dados['END_CIDADE'];
        $rua = $dados['END_RUA'];
        $numero = $dados['END_NUMERO'];
        $cliid = $dados['CLI_ID'];
        $stmt = $pdo->prepare("INSERT INTO `biblioteca`.`endereco` (`END_ESTADO`, `END_CIDADE`, `END_RUA`, `END_NUMERO`, `CLI_ID`) VALUES ('$estado', '$cidade', '$rua', '$numero', '$cliid');");
        $stmt->execute();
        header('location:tabelaendereco.php');
    }
    }


    function deletar($tabela){
    $id = $_GET['id'];
    $pdo = Conexao::getInstance();
    if($tabela == 'editora'){
        $stmt = $pdo->query("DELETE FROM `biblioteca`.`editora` WHERE EDI_ID = $id");
        $stmt->execute();
        header('location:tabelaeditora.php');
    } else if($tabela == 'cliente'){
        $stmt = $pdo->query("DELETE FROM `biblioteca`.`cliente` WHERE CLI_ID = $id");
        $stmt->execute();
        header('location:tabelacliente.php');
    } else if($tabela == 'genero'){
        $stmt = $pdo->query("DELETE FROM `biblioteca`.`genero` WHERE GEN_ID = $id");
        $stmt->execute();
        header('location:tabelagenero.php');
    } else if($tabela == 'titulo'){
        $stmt = $pdo->query("DELETE FROM `biblioteca`.`titulo` WHERE TIT_ID = $id");
        $stmt->execute();
        header('location:tabelatitulo.php');
    } else if($tabela == 'endereco'){
        $stmt = $pdo->query("DELETE FROM `biblioteca`.`endereco` WHERE END_ID = $id");
        $stmt->execute();
        header('location:tabelaendereco.php');
    } else if($tabela == 'exemplar'){
        $stmt = $pdo->query("DELETE FROM `biblioteca`.`exemplar` WHERE EXE_ID = $id");
        $stmt->execute();
        header('location:tabelaexemplar.php');
    }
    }


    function atualizar($tabela){
    if(isset($_POST['id'])){$id = $_POST['id'];}
        $pdo = Conexao::getInstance();
    if($tabela == 'genero'){
        $dados = dados();
        $nome = $dados['GEN_NOME'];
        $stmt = $pdo->query("UPDATE `biblioteca`.`genero` SET `GEN_NOME` = '$nome' WHERE (`GEN_ID` = '$id');");
        $stmt->execute();
        header('location:tabelagenero.php');
    } else if($tabela == 'editora'){
        $dados = dados();
        $nome = $dados["EDI_NOME"];
        $fundacao = $dados["EDI_FUNDACAO"];
        $fundador = $dados["EDI_FUNDADOR"];
        $sede = $dados["EDI_SEDE"];
        $stmt = $pdo->prepare("UPDATE `biblioteca`.`editora` SET `EDI_NOME` = '$nome', `EDI_FUNDACAO` = '$fundacao', `EDI_FUNDADOR` = '$fundador', `EDI_SEDE` = '$sede' WHERE (`EDI_ID` = '$id');");
        $stmt->execute();
        header('location:tabelaeditora.php');
    } else if($tabela == 'cliente'){
        $dados = dados();
        $nome = $dados["CLI_NOME"];
        $sobrenome = $dados["CLI_SOBRENOME"];
        $nascimento = $dados["CLI_NASCIMENTO"];
        $telefone = $dados["CLI_TELEFONE"];
        $email = $dados["CLI_EMAIL"];
        $cpf = $dados["CLI_CPF"];
        $senha = $dados["CLI_SENHA"];
        $stmt = $pdo->prepare("UPDATE `biblioteca`.`cliente` SET `CLI_NOME` = '$nome', `CLI_SOBRENOME` = '$sobrenome', `CLI_NASCIMENTO` = '$nascimento', `CLI_TELEFONE` = '$telefone', `CLI_CPF` = '$cpf', `CLI_EMAIL` = '$email', `CLI_SENHA` = '$senha' WHERE (`CLI_ID` = '$id');");
        $stmt->execute();
        header('location:tabelacliente.php');
    } else if($tabela == 'titulo'){
        $dados = dados();
        $nome = $dados['TIT_NOME'];
        $autor = $dados['TIT_AUTOR'];
        $numeropag = $dados['TIT_NUMEROPAG'];
        $idioma = $dados['TIT_IDIOMA'];
        $lancamento = $dados['TIT_LANCAMENTO'];
        $ediid = $dados['EDI_ID'];
        $stmt = $pdo->prepare("UPDATE `biblioteca`.`titulo` SET `TIT_NOME` = '$nome', `TIT_AUTOR` = '$autor', `TIT_NUMEROPAG` = '$numeropag', `TIT_IDIOMA` = '$idioma', `TIT_LANCAMENTO` = '$lancamento', `EDI_ID` = '$ediid' WHERE (`TIT_ID` = '$id');");
        $stmt->execute();
        header('location:tabelatitulo.php');
    } else if($tabela == 'endereco'){
        $dados = dados();
        $estado = $dados['END_ESTADO'];
        $cidade = $dados['END_CIDADE'];
        $rua = $dados['END_RUA'];
        $numero = $dados['END_NUMERO'];
        $cliid = $dados['CLI_ID'];
        $stmt = $pdo->prepare("UPDATE `biblioteca`.`endereco` SET `END_ESTADO` = '$estado', `END_CIDADE` = '$cidade', `END_RUA` = '$rua', `END_NUMERO` = '$numero', `CLI_ID` = '$cliid' WHERE (`END_ID` = '$id');");
        $stmt->execute();
        header('location:tabelaendereco.php');
    }
    }


    function dados(){
        $dados = array();
        $dados['CLI_NOME'] = $_POST["CLI_NOME"];
        $dados['CLI_SOBRENOME'] = $_POST["CLI_SOBRENOME"];
        $dados['CLI_NASCIMENTO'] = $_POST["CLI_NASCIMENTO"];
        $dados['CLI_TELEFONE'] = $_POST["CLI_TELEFONE"];
        $dados['CLI_EMAIL'] = $_POST["CLI_EMAIL"];
        $dados['CLI_CPF'] = $_POST["CLI_CPF"];
        $dados['CLI_SENHA'] = $_POST["CLI_SENHA"];
        $dados['GEN_NOME'] = $_POST['GEN_NOME'];
        $dados['EDI_NOME'] = $_POST["EDI_NOME"];
        $dados['EDI_FUNDACAO'] = $_POST["EDI_FUNDACAO"];
        $dados['EDI_FUNDADOR'] = $_POST["EDI_FUNDADOR"];
        $dados['EDI_SEDE'] = $_POST["EDI_SEDE"];
        $dados['TIT_NOME'] = $_POST["TIT_NOME"];
        $dados['TIT_AUTOR'] = $_POST["TIT_AUTOR"];
        $dados['TIT_NUMEROPAG'] = $_POST["TIT_NUMEROPAG"];
        $dados['TIT_IDIOMA'] = $_POST["TIT_IDIOMA"];
        $dados['TIT_LANCAMENTO'] = $_POST["TIT_LANCAMENTO"];
        $dados['EDI_ID'] = $_POST["EDI_ID"];
        $dados['END_ESTADO'] = $_POST["END_ESTADO"];
        $dados['END_CIDADE'] = $_POST["END_CIDADE"];
        $dados['END_RUA'] = $_POST["END_RUA"];
        $dados['END_NUMERO'] = $_POST["END_NUMERO"];
        $dados['CLI_ID'] = $_POST["CLI_ID"];        
        return $dados;
    }


    function buscarDados($id,$tabela){
        $pdo = Conexao::getInstance();
        $dados = array();
    if($tabela == 'genero'){
        $consulta = $pdo->query("SELECT * FROM genero WHERE GEN_ID = $id");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['GEN_NOME'] = $linha['GEN_NOME'];
        }
    } else if($tabela == 'cliente'){
        $consulta = $pdo->query("SELECT * FROM cliente WHERE CLI_ID = $id");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['CLI_NOME'] = $linha["CLI_NOME"];
            $dados['CLI_SOBRENOME'] = $linha["CLI_SOBRENOME"];
            $dados['CLI_NASCIMENTO'] = $linha["CLI_NASCIMENTO"];
            $dados['CLI_TELEFONE'] = $linha["CLI_TELEFONE"];
            $dados['CLI_EMAIL'] = $linha["CLI_EMAIL"];
            $dados['CLI_CPF'] = $linha["CLI_CPF"];
            $dados['CLI_SENHA'] = $linha["CLI_SENHA"];
        }
    } else if($tabela == 'editora'){
        $consulta = $pdo->query("SELECT * FROM editora WHERE EDI_ID = $id");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['EDI_NOME'] = $linha["EDI_NOME"];
            $dados['EDI_FUNDACAO'] = $linha["EDI_FUNDACAO"];
            $dados['EDI_FUNDADOR'] = $linha["EDI_FUNDADOR"];
            $dados['EDI_SEDE'] = $linha["EDI_SEDE"];
        }
    } else if($tabela == 'titulo'){
        $consulta = $pdo->query("SELECT * FROM titulo, editora WHERE TIT_ID = $id");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['TIT_NOME'] = $linha["TIT_NOME"];
            $dados['TIT_AUTOR'] = $linha["TIT_AUTOR"];
            $dados['TIT_NUMEROPAG'] = $linha["TIT_NUMEROPAG"];
            $dados['TIT_IDIOMA'] = $linha["TIT_IDIOMA"];
            $dados['TIT_LANCAMENTO'] = $linha["TIT_LANCAMENTO"];
            $dados['EDI_ID'] = $linha["EDI_ID"];
        }
    } else if($tabela == 'endereco'){
        $consulta = $pdo->query("SELECT * FROM endereco, cliente WHERE END_ID = $id");
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['END_ESTADO'] = $linha["END_ESTADO"];
            $dados['END_CIDADE'] = $linha["END_CIDADE"];
            $dados['END_RUA'] = $linha["END_RUA"];
            $dados['END_NUMERO'] = $linha["END_NUMERO"];
            $dados['CLI_ID'] = $linha["CLI_ID"];
        }
    }
        return $dados;
    }
?>
</body>
</html>