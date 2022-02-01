<!DOCTYPE html>

<?php 

//testando se status for = 1
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

//realizando uma requisição das credenciais utilizando o método POST
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($credenciais)) 
      $credenciais = new stdClass();
    $credenciais->email = $_REQUEST['email'];
    $credenciais->senha = $_REQUEST['senha'];
  }

  if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "auth") {

    $errorMessage = null;
  
    try {  //consegue recuperar erros que possam ocorrer no código
      $query = "SELECT * FROM admins WHERE email=? AND senha=?";

      $stmt = $pdo->prepare($query);
      $stmt->bindParam(1, $credenciais->email);
      $stmt->bindParam(2, $credenciais->senha);

      if ($stmt->execute()) {
        
        if($stmt->rowCount() > 0) {

          $result = $stmt->fetch(PDO::FETCH_OBJ);
          $id = $result->id; 

          $_SESSION['user_id'] = $id;
          $_SESSION['acess'] = 'admin';

          header('location:/e-commerce/admin/categorias.php');

        } else {

          $errorMessage = "E-mail e/ou senha incorretos.";
          
        }

      } else {      
        throw new PDOException("Erro: Não foi possível executar a declaração sql");
      }

      // catch por sua vez, faz o tratamento dos erros que aconteceram
    } catch (PDOException $error) {
      echo "Erro: ".$error->getMessage();
    }
  }

?>

<html>
  <?php include('./components/Head.php') ?> <!--inserindo o head -->
  <body>
    <?php include('./components/Navbar.php') ?>  <!--inserindo o navbar dentro do body -->

    <main class="container py">
      <form action="?act=auth" method="POST" enctype="multipart/form-data" class="form" size="sm">
        <h1 class="title" color="primary" align="center">
          Entrar
          <span>Admin</span>
        </h1>
        <div class="input" color="primary">
          <label>E-mail</label>
          <input name="email" type="text" required>
        </div>
        <div class="input" color="primary">
          <label>Senha</label>
          <input name="senha" type="password" required>
        </div>
        <button class="button" color="primary" size="full" icon="margin-right"><i class="fas fa-sign-in-alt"></i>Entrar</button>
        <small class="message" size="sm" color="danger" style="margin-top: .25rem"><?php if(isset($errorMessage)){ echo $errorMessage; } ?></small>
      </form>
    </main>

    <!--inserindo o arquivo do rodapé -->
    <?php include('./components/Footer.php') ?>
  </body>
  
</html>