<!DOCTYPE html>

<?php 

  if(session_status() == 1)
    session_start();

  if(!isset($_SESSION['user_id']) || $_SESSION['acess'] != 'admin')
    header('location:/e-commerce/index.php');

  try {
    $pdo = new PDO("mysql:host=localhost; dbname=database", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("set names utf8");
  } catch (PDOException $error) {
    echo "Erro na conexão:".$error->getMessage();
  }

  if(isset($_REQUEST["act"]) && $_REQUEST["act"] == "create") { 

    if (!isset($categoria)) 
      $categoria = new stdClass();
    $categoria->nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";

    try {

      $stmt = $pdo->prepare("INSERT INTO categorias (nome) values (?)"); 
      $stmt->bindParam(1, $categoria->nome); 
      
      if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
          
          header('location:/e-commerce/admin/categorias.php');
          
        } else {
          
          header('location:/e-commerce/admin/categorias/criar.php');
        
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
  
  <?php include('../../components/Head.php') ?> 
  
  <body>

    <?php include('../../components/Navbar.php') ?>

    <main class="container py">
      <form action="?act=create" method="POST" enctype="multipart/form-data" class="form" size="sm">
        <h1 class="title" color="success" align="center">
          Criar
          <span>Categoria</span>
        </h1>
        <div class="input col" color="primary">
          <label>Nome *</label>
          <input name="nome" type="text" required>
        </div>
        <button type="submit" class="button" color="success" size="auto" icon="margin-right">
          <i class="fas fa-plus-square"></i>Adicionar
        </button>
        <a href="/e-commerce/admin/categorias.php" type="button" class="button" color="secondary" size="auto" icon="margin-right" style="margin-top: .5rem">
          <i class="fas fa-chevron-left"></i>Voltar
        </a>
      </form>
    </main>

    <?php include('../../components/Footer.php') ?>

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