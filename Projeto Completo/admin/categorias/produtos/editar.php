<!DOCTYPE html>

<?php 

  if(session_status() == 1)
    session_start();
  
  if(!isset($_SESSION['user_id']) || $_SESSION['acess'] != 'admin')
    header('location:/e-commerce/index.php');

  try {
    $pdo = new PDO('mysql:host=localhost; dbname=database', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('set names utf8');
  } catch (PDOException $error) {
    echo 'Erro na conexão: '.$error->getMessage();
  }

  try {
    $id = (isset($_GET['id']) && $_GET['id'] != null) ? $_GET['id'] : '';
  
    $query = 'SELECT * FROM produtos WHERE id=?';    
  
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $id);
  
    if ($stmt->execute()) {            

      $result = $stmt->fetch(PDO::FETCH_OBJ);

    } else {
      throw new PDOException('Erro: Não foi possível executar a declaração sql');
    }
  } catch (PDOException $error) {
    echo 'Erro: '.$error->getMessage();
  }

  if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'edit') { 
    
    if (!isset($produto)) 
      $produto = new stdClass();
    $produto->imagem = $_FILES['imagem']; 
    $produto->titulo = (isset($_POST['titulo']) && $_POST['titulo'] != null) ? $_POST['titulo'] : '';
    $produto->quantidade = (isset($_POST['quantidade']) && $_POST['quantidade'] != null) ? $_POST['quantidade'] : '';
    $produto->valor = (isset($_POST['valor']) && $_POST['valor'] != null) ? $_POST['valor'] : '';
    $produto->desconto = (isset($_POST['desconto']) && $_POST['desconto'] != null) ? $_POST['desconto'] : '';
    
    if ($produto->imagem['name']) {
      $folder ='../../../imagens/'.$result->id.'/';
      
      unlink($folder.$result->imagem);

      $path = $folder . $produto->imagem['name']; 
      $target_file = $folder . basename($produto->imagem['name']);
      $mFileType = pathinfo($target_file, PATHINFO_EXTENSION);
      $filename = $produto->imagem['name'];
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
  
      move_uploaded_file($produto->imagem['tmp_name'], $path); 
    }


    try {

      $stmt = $pdo->prepare('UPDATE produtos SET imagem=?, titulo=?, quantidade=?, valor=?, desconto=? WHERE id=?'); 
      if ($produto->imagem['name']) {
        $stmt->bindParam(1, $produto->imagem['name']); 
      } else {
        $stmt->bindParam(1, $result->imagem); 
      }
      $stmt->bindParam(2, $produto->titulo); 
      $stmt->bindParam(3, $produto->quantidade); 
      $stmt->bindParam(4, $produto->valor); 
      $stmt->bindParam(5, $produto->desconto); 
      $stmt->bindParam(6, $id); 
      
      if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
          
          header('location:../../../categorias.php');

        } else {
          header('location:../editar.php/?id='.$id);
        }
      } else {
        throw new PDOException('Erro: Não foi possível executar a declaração sql');
      }

    } catch (PDOException $error) {
      echo 'Erro: '.$error->getMessage();
    }
  }

?>

<html>
  
  <?php include('../../../components/Head.php') ?> 
  
  <body>

    <?php include('../../../components/Navbar.php') ?>

    <main class="container py">
      <form action="?id=<?php echo $id ?>&act=edit" method="POST" enctype="multipart/form-data" class="form" size="md">
        <h1 class="title" color="warning" align="center">
          Editar
          <span>Produtos</span>
        </h1>
        <div class="file-input" color="primary">
          <label>Imagem *</label>
          <label>
            <input name="imagem" type="file" accept="image/png, image/jpeg, image/jpg">
            <input type="text" placeholder="Escolha uma imagem..." disabled value=<?php echo "'$result->imagem'" ?>>
            <div><i class="fas fa-upload"></i></div>          
          </label>
        </div>
        <div class="input" color="primary">
          <label>Título *</label>
          <input name="titulo" type="text" value=<?php echo "'$result->titulo'" ?> required>
        </div>
        <div class="row" columns="2">
          <div class="input col" color="primary">
            <label>Quantidade *</label>
            <input name="quantidade" type="text" value=<?php echo "'$result->quantidade'" ?> required>
          </div>
          <div class="col"></div>
        </div>
        <div class="row" columns="2">
          <div class="input col" color="primary">
            <label>Valor *</label>
            <input name="valor" type="text" value=<?php echo "'$result->valor'" ?> required>
          </div>
          <div class="input col" color="primary">
            <label>Desconto</label>
            <input name="desconto" type="text" value=<?php echo "'$result->desconto'" ?>>
          </div>
        </div>
        <button type="submit" class="button" color="warning" size="auto" icon="margin-right">
          <i class="fas fa-edit"></i>Editar
        </button>
        <a href="../../../categorias.php" type="button" class="button" color="secondary" size="auto" icon="margin-right" style="margin-top: .5rem">
          <i class="fas fa-chevron-left"></i>Voltar
        </a>
      </form>
    </main>

    <?php include('../../../components/Footer.php') ?>

  </body>
  <script>
    
    document
    .querySelectorAll('.file-input')
    .forEach(fileInput => {
      fileInput
        .querySelector('input:first-of-type')
        .addEventListener('change', e => {
          if (e.target.files[0]) {
            fileInput
              .querySelector('input:last-of-type')
              .value = e.target.files[0].name
          }
      })
    });

  </script>
</html>