<!DOCTYPE html>
<?php
   include_once "conf/default.inc.php";
   require_once "conf/Conexao.php";
   $title = "Biblioteca";
?>
<html>
<head>
  <meta charset="UTF-8">
  <title> <?php echo $title; ?> </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="img/favicon.ico">
  <style>
    body {
      background-image: url("img/biblioteca.jpg");
      font-weight: bolder;
    }
  </style>
</head>
<body class="">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php"><img src="img/booklogo.png" style="width: 6vw;"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <a class="navbar-brand" href="php/tabelacliente.php">CLIENTE</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <a class="navbar-brand" href="php/tabelaeditora.php">EDITORA</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <a class="navbar-brand" href="php/tabelagenero.php">GÊNERO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <a class="navbar-brand" href="php/cadcliente.php">INSERIR CLIENTE</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <a class="navbar-brand" href="php/cadeditora.php">INSERIR EDITORA</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <a class="navbar-brand" href="php/cadgenero.php">INSERIR GÊNERO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
<br><br>
<h1 style="font-family: 'Fredoka One', cursive; text-align: center; font-size: 15vh; padding-bottom: 15vh; color:#FFF;">Biblioteca</h1>
<br><br>
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
        </tr>
      </thead>
      <tbody>
      <?php
        $pdo = Conexao::getInstance();
        $consulta1 = $pdo->query("SELECT * FROM cliente 
                                  ORDER BY CLI_ID");
          while ($linha = $consulta1->fetch(PDO::FETCH_ASSOC)) {
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
        </tr>
      <?php } ?> 
      </tbody>
    </table>
  </div>
  <br><br>
  <div class="">
    <table class="table table-striped" style="background-color: #FFF;">
      <thead>
        <tr class="table-dark">
          <th scope="col">#ID</th>
          <th scope="col">Nome</th>
          <th scope="col">Fundação</th>
          <th scope="col">Fundador</th>
          <th scope="col">Sede</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $pdo = Conexao::getInstance();
        $consulta1 = $pdo->query("SELECT * FROM editora 
                                  ORDER BY EDI_ID");
          while ($linha = $consulta1->fetch(PDO::FETCH_ASSOC)) {
      ?>
        <tr>
          <th scope="row"><?php echo $linha['EDI_ID'];?></th>
          <td scope="row"><?php echo $linha['EDI_NOME'];?></td>
          <td><?php echo date("d/m/Y", strtotime($linha['EDI_FUNDACAO']));?></td>
          <td scope="row"><?php echo $linha['EDI_FUNDADOR'];?></td>
          <td scope="row"><?php echo $linha['EDI_SEDE'];?></td>
        </tr>
      <?php } ?> 
      </tbody>
    </table>
  </div>
  <br><br>
  <div class="">
    <table class="table table-striped" style="background-color: #FFF;">
      <thead>
        <tr class="table-dark">
          <th scope="col">#ID</th>
          <th scope="col">Nome</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $pdo = Conexao::getInstance();
        $consulta1 = $pdo->query("SELECT * FROM genero 
                                  ORDER BY GEN_ID");
          while ($linha = $consulta1->fetch(PDO::FETCH_ASSOC)) {
      ?>
        <tr>
          <th scope="row"><?php echo $linha['GEN_ID'];?></th>
          <td scope="row"><?php echo $linha['GEN_NOME'];?></td>
        </tr>
      <?php } ?> 
      </tbody>
    </table>
  </div>
<br><br><br>
</body>
</html>