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
    }
        return $dados;
    }














    if($comando == "verificar"){
        $pdo = Conexao::getInstance();
        $cpf = $_POST["CLI_CPF"];
        $senha = $_POST["CLI_SENHA"];     
        $stmt = $pdo->query("SELECT * FROM biblioteca.cliente;");
        $confirmado = 0;
            while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($cpf == $linha['CLI_CPF'] && $senha == $linha['CLI_SENHA']){
                    $confirmado = 1;
                    $usuario = $linha['CLI_NOME'];
                }
            }
            if($confirmado == 0){
                header('location:login.php');
            } else {
                header('location:logou.php');
            }
    }
    ?>
</body>
</html>