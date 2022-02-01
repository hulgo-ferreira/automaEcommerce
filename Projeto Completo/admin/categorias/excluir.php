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

  try {
    $id = (isset($_GET["id"]) && $_GET["id"] != null) ? $_GET["id"] : "";
  
    $query = "SELECT * FROM categorias WHERE id=?";    
  
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $id);
  
    if ($stmt->execute()) {            
      $result = $stmt->fetch(PDO::FETCH_OBJ);

      if (!isset($categoria)) 
        $categoria = new stdClass();
      $categoria->nome = $result->nome;

    } else {
      throw new PDOException("Erro: Não foi possível executar a declaração sql");
    }
  } catch (PDOException $error) {
    echo "Erro: ".$error->getMessage();
  }

  if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "delete") {

    try {
      $query = "SELECT * FROM produtos WHERE id_categoria=?";
      $stmt = $pdo->prepare($query);
      $stmt->bindParam(1, $id);
      
    if ($stmt->execute()) {    
      $folder ='../../../imagens/'.$id.'/';
      while ($produto = $stmt->fetch(PDO::FETCH_OBJ)) {
        unlink($folder.$produto->imagem); 
        rmdir($folder);
      }
    } else {          
      throw new PDOException("Erro: Não foi possível executar a declaração sql");
    }

      $query = "DELETE FROM produtos WHERE id_categoria=?";

      $stmt = $pdo->prepare($query);
      $stmt->bindParam(1, $id);
      
      $stmt->execute();

    } catch (PDOException $error) {
      echo "Erro: ".$error->getMessage();
    }

    try {
      $query = "DELETE FROM categorias WHERE id=?";

      $stmt = $pdo->prepare($query);
      $stmt->bindParam(1, $id);

      if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
          
          header('location:/e-commerce/admin/categorias.php');

        } else {

          header('location:/e-commerce/admin/categorias/excluir.php/?id='.$id);
        
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
      <form action="?id=<?php echo $id ?>&act=delete" method="POST" enctype="multipart/form-data" class="form" size="sm" align-text="center">
        <h1 class="title" color="danger" align="center">
          Excluir
          <span>Categoria</span>
        </h1>
        <small class="message" color="primary" size="md" text-align="center">
          Você tem certeza que deseja excluir a categoria <span><?php echo $categoria->nome ?></span>? 
          <small class="message" color="danger" size="sm">
            Esta operação irá excluir todos os produtos desta categoria.
          </small>
        </small>

        <button type="submit" class="button" color="danger" size="auto" icon="margin-right">
          <i class="fas fa-trash"></i>Excluir
        </button>
        <a href="/e-commerce/admin/categorias.php" type="button" class="button" color="secondary" size="auto" icon="margin-right" style="margin-top: .5rem">
          <i class="fas fa-chevron-left"></i>Voltar
        </a>
      </form>
    </main>

    <?php include('../../components/Footer.php') ?>

  </body>
</html>