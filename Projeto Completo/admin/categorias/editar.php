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

  if(isset($_REQUEST["act"]) && $_REQUEST["act"] == "create") { 

    if (!isset($categoria)) 
      $categoria = new stdClass();
    $categoria->nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";

    try {

      $stmt = $pdo->prepare("UPDATE categorias SET nome=? WHERE id=?"); 
      $stmt->bindParam(1, $categoria->nome); 
      $stmt->bindParam(2, $id); 
      
      if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
          
          header('location:/e-commerce/admin/categorias.php');

        } else {

          header('location:/e-commerce/admin/categorias/editar.php/?id='.$id);
        
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
      <form action="?id=<?php echo $id ?>&act=create" method="POST" enctype="multipart/form-data" class="form" size="sm">
        <h1 class="title" color="warning" align="center">
          Editar
          <span>Categoria</span>
        </h1>
        <div class="input col" color="primary">
          <label>Nome *</label>
          <input name="nome" type="text" value=<?php echo "'$categoria->nome'" ?> required>
        </div>
        <button type="submit" class="button" color="warning" size="auto" icon="margin-right">
          <i class="fas fa-edit"></i>Editar
        </button>
        <a href="../../categorias.php" type="button" class="button" color="secondary" size="auto" icon="margin-right" style="margin-top: .5rem">
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