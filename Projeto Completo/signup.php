<!DOCTYPE html>

<?php 

  if(session_status() == 1)
    session_start();

  if(isset($_SESSION['user_id'])) {
    if($_SESSION['acess'] == 'admin')
      header('location:/e-commerce/admin/categorias.php');
    if($_SESSION['acess'] == 'user')
      header('location:/e-commerce/index.php');
  }

  try {
    $pdo = new PDO("mysql:host=localhost; dbname=database", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("set names utf8");
  } catch (PDOException $error) {
    echo "Erro na conexão:".$error->getMessage();
  }

  if(isset($_REQUEST["act"]) && $_REQUEST["act"] == "create") { 

    if (!isset($usuario)) 
      $usuario = new stdClass();
    $usuario->nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $usuario->cpf = (isset($_POST["cpf"]) && $_POST["cpf"] != null) ? $_POST["cpf"] : "";
    $usuario->email = (isset($_POST["email"]) && $_POST["email"] != null) ? $_POST["email"] : "";
    $usuario->senha = (isset($_POST["senha"]) && $_POST["senha"] != null) ? $_POST["senha"] : "";
    $usuario->sexo = (isset($_POST["sexo"]) && $_POST["sexo"] != null) ? $_POST["sexo"] : "";
    $usuario->nascimento = (isset($_POST["nascimento"]) && $_POST["nascimento"] != null) ? $_POST["nascimento"] : "";
    $usuario->celular = (isset($_POST["celular"]) && $_POST["celular"] != null) ? $_POST["celular"] : "";
    $usuario->cep = (isset($_POST["cep"]) && $_POST["cep"] != null) ? $_POST["cep"] : "";
    $usuario->endereco = (isset($_POST["endereco"]) && $_POST["endereco"] != null) ? $_POST["endereco"] : "";
    $usuario->cidade = (isset($_POST["cidade"]) && $_POST["cidade"] != null) ? $_POST["cidade"] : "";
    $usuario->uf = (isset($_POST["uf"]) && $_POST["uf"] != null) ? $_POST["uf"] : "";
    $usuario->bairro = (isset($_POST["bairro"]) && $_POST["bairro"] != null) ? $_POST["bairro"] : "";
    $usuario->numero = (isset($_POST["numero"]) && $_POST["numero"] != null) ? $_POST["numero"] : "";
    $usuario->complemento = (isset($_POST["complemento"]) && $_POST["complemento"] != null) ? $_POST["complemento"] : "";

    try {

      $stmt = $pdo->prepare("INSERT INTO usuarios (nome, cpf, email, senha, sexo, nascimento, celular, cep, endereco, cidade, uf, bairro, numero, complemento) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"); 
      $stmt->bindParam(1, $usuario->nome); 
      $stmt->bindParam(2, $usuario->cpf); 
      $stmt->bindParam(3, $usuario->email); 
      $stmt->bindParam(4, $usuario->senha); 
      $stmt->bindParam(5, $usuario->sexo); 
      $stmt->bindParam(6, $usuario->nascimento); 
      $stmt->bindParam(7, $usuario->celular); 
      $stmt->bindParam(8, $usuario->cep); 
      $stmt->bindParam(9, $usuario->endereco); 
      $stmt->bindParam(10, $usuario->cidade); 
      $stmt->bindParam(11, $usuario->uf); 
      $stmt->bindParam(12, $usuario->bairro); 
      $stmt->bindParam(13, $usuario->numero); 
      $stmt->bindParam(14, $usuario->complemento); 
      
      if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
          
          header('location:/e-commerce/index.php');
          
        } else {
          
          header('location:/e-commerce/signup.php');
        
        }
      } else {
        throw new PDOException("Erro: Não foi possível executar a declaração sql");
      }

    } catch (PDOException $error) {
      echo "Erro: ".$error->getMessage();
    }
  }

?>

<html>
  
  <?php include('./components/Head.php') ?> 
  
  <body>

    <?php include('./components/Navbar.php') ?>

    <main class="container py">
      <form action="?act=create" method="POST" enctype="multipart/form-data" class="form" size="xl">
        <h1 class="title" color="success" align="center">
          Cadastrar-se
        </h1>
        <div class="row" columns="4">
          <div class="input col" span="2" color="primary">
            <label>Nome *</label>
            <input name="nome" type="text" required>
          </div>
          <div class="input col" color="primary">
            <label>CPF *</label>
            <input name="cpf" type="text" required>
          </div>
          <div class="col"></div>
        </div>
        <div class="row" columns="4">
          <div class="input col" span="2" color="primary">
            <label>E-mail *</label>
            <input name="email" type="email" required>
          </div>
          <div class="input col" color="primary">
            <label>Senha *</label>
            <input name="senha" type="password" required>
          </div>
          <div class="col"></div>
        </div>
        <div class="row" columns="4">
          <div class="input col" color="primary">
            <label>Sexo *</label>
            <input name="sexo" type="text" required>
          </div>
          <div class="input col" color="primary">
            <label>Nascimento *</label>
            <input name="nascimento" type="text" required>
          </div>     
          <div class="col" span="2"></div>  
        </div>
        <div class="row" columns="4">
          <div class="input" color="primary">
            <label>Celular *</label>
            <input name="celular" type="text" required>
          </div>
          <div class="col" span="3"></div>  
        </div>
        
        <div style="background: var(--grey4); margin: 1rem 0; height: 1px; width: 100%;"></div>

        <div class="row" columns="4">
          <div class="row" columns="2">
            <div class="input col" color="primary">
              <label>cep *</label>
              <input name="cep" type="text" required>
            </div>
            <div class="col"></div>
          </div>
          <div class="col" span="3"></div>
        </div>

        <div class="row" columns="4">
          <div class="input col" span="2" color="primary">
            <label>endereço *</label>
            <input name="endereco" type="text" required>
          </div>
          <div class="input col" color="primary">
            <label>cidade *</label>
            <input name="cidade" type="text" required>
          </div>
          <div class="input col" color="primary">
            <label>uf *</label>
            <input name="uf" type="text" required>
          </div>
        </div>
        <div class="row" columns="4">
          <div class="input col" span="2" color="primary">
            <label>bairro *</label>
            <input name="bairro" type="text" required>
          </div>
          <div class="input col" color="primary">
            <label>nº *</label>
            <input name="numero" type="text" required>
          </div>
          <div class="input col" color="primary">
            <label>complemento</label>
            <input name="complemento" type="text">
          </div>
        </div>

        <button type="submit" class="button" color="success" size="auto" icon="margin-right">
          <i class="fas fa-user-plus"></i>Cadastrar-se
        </button>
      </form>
    </main>

    <?php include('./components/Footer.php') ?>

  </body>
  <script>
    
    document
    .querySelectorAll('.file-input')
    .forEach(fileInput => {
      fileInput
        .querySelector('input:first-of-type')
        .addEventListener('change', e => {
          fileInput
            .querySelector('input:last-of-type')
            .value = e.target.files[0].name
      })
    });

  </script>
</html>