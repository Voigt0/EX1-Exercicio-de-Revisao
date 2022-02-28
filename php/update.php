<!DOCTYPE html>
<?php
    $tabela = isset($_GET['tabela']) ? $_GET['tabela'] : "";
    $id = isset($_GET['id']) ? $_GET['id'] : "";
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
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    



    function buscarDados($id,$tabela){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM locacao WHERE LOC_ID = $id");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['LOC_LOCAL'] = $linha['LOC_LOCAL'];
            $dados['LOC_ENTRADA'] = $linha['LOC_ENTRADA'];
            $dados['LOC_SAIDA'] = $linha['LOC_SAIDA'];
        }
        return $dados;
    }





    function dados(){
        $dados = array();
        $dados['CLI_NOME'] = $_POST["CLI_NOME"];
        $dados['CLI_SOBRENOME'] = $_POST["CLI_SOBRENOME"];
        $dados['CLI_NASCIMENTO'] = $_POST["CLI_NASCIMENTO"];
        $dados['CLI_TELEFONE'] = $_POST["CLI_TELEFONE"];
        $dados['CLI_EMAIL'] = $_POST["CLI_EMAIL"];
        $dados['CLI_TELEFONERES'] = $_POST["CLI_TELEFONERES"];
        $dados['CLI_CNH'] = $_POST["CLI_CNH"];
        $dados['CLI_CNHVALIDADE'] = $_POST["CLI_CNHVALIDADE"];
        $dados['CLI_CNHTIPO'] = $_POST["CLI_CNHTIPO"];
        $dados['CLI_CPF'] = $_POST["CLI_CPF"];
        $dados['CLI_SENHA'] = $_POST["CLI_SENHA"];
        $dados['LOC_LOCAL'] = $_POST['LOC_LOCAL'];
        $dados['LOC_ENTRADA'] = $_POST['LOC_ENTRADA'];
        $dados['LOC_SAIDA'] = $_POST['LOC_SAIDA'];
        $dados['LOJ_NOME'] = $_POST["LOJ_NOME"];
        $dados['LOJ_ESTADO'] = $_POST["LOJ_ESTADO"];
        $dados['LOJ_CIDADE'] = $_POST["LOJ_CIDADE"];
        $dados['LOJ_RUA'] = $_POST["LOJ_RUA"];
        $dados['LOJ_NUMERO'] = $_POST["LOJ_NUMERO"];
        $dados['LOJ_TELEFONE'] = $_POST["LOJ_TELEFONE"];
        return $dados;
    }





?>
</body>
</html>