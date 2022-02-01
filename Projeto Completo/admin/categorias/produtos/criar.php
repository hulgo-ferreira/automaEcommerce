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

  $id_categoria = (isset($_GET['id_categoria']) && $_GET['id_categoria'] != null) ? $_GET['id_categoria'] : '';

  if(isset($_REQUEST['act']) && $_REQUEST['act'] == 'create') { 

    if(!isset($produto)) 
      $produto = new stdClass();
    $imagem              = $_FILES['imagem']; 
    $produto->titulo     = (isset($_POST['titulo'])     && $_POST['titulo'] != null)     ? $_POST['titulo']     : '';
    $produto->quantidade = (isset($_POST['quantidade']) && $_POST['quantidade'] != null) ? $_POST['quantidade'] : '';
    $produto->valor      = (isset($_POST['valor'])      && $_POST['valor'] != null)      ? $_POST['valor']      : '';
    $produto->desconto   = (isset($_POST['desconto'])   && $_POST['desconto'] != null)   ? $_POST['desconto']   : '';

    try {

      $create_query = 'INSERT INTO produtos (id_categoria, imagem, titulo, quantidade, valor, desconto) values (?, ?, ?, ?, ?, ?)';

      $stmt_create = $pdo->prepare($create_query); 
      $stmt_create->bindParam(1, $id_categoria); 
      $stmt_create->bindParam(2, $imagem['name']); 
      $stmt_create->bindParam(3, $produto->titulo); 
      $stmt_create->bindParam(4, $produto->quantidade); 
      $stmt_create->bindParam(5, $produto->valor); 
      $stmt_create->bindParam(6, $produto->desconto); 
      
      if($stmt_create->execute()) {
        if($stmt_create->rowCount() > 0) {

          $read_query = 'SELECT id FROM produtos ORDER BY id DESC LIMIT 1';
          $stmt_read = $pdo->prepare($read_query); 
          
          if($stmt_read->execute()) {
           
            $last_insert = $stmt_read->fetch(PDO::FETCH_OBJ);
            $id_last_insert = $last_insert->id;
  
            $folder = '../../../imagens/'.$id_last_insert.'/';
            mkdir($folder);
  
            $path = $folder.$imagem['name'];        
            move_uploaded_file($imagem['tmp_name'], $path); 
            
            header('location:/e-commerce/admin/categorias.php');

          } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
          }
        
        } else {

          header('location:/e-commerce/admin/categorias/produtos/criar.php/?id_categoria='.$id_categoria);
        
        }
      } else {
        throw new PDOException('Erro: Não foi possível executar a declaração sql');
      }

    } catch(PDOException $error) {
      echo 'Erro: '.$error->getMessage();
    }
  }

?>

<html>
  
  <?php include('../../../components/Head.php') ?> 
  
  <body>

    <?php include('../../../components/Navbar.php') ?>

    <main class="container py">
      <form action="?id_categoria=<?php echo $id_categoria ?>&act=create" method="POST" enctype="multipart/form-data" class="form" size="md">
        <h1 class="title" color="success" align="center">
          Adicionar
          <span>Produtos</span>
        </h1>
        <div class="file-input" color="primary">
          <label>Imagem *</label>
          <label>
            <input name="imagem" type="file" accept="image/png, image/jpeg, image/jpg" >
            <input type="text" placeholder="Escolha uma imagem..." disabled>
            <div><i class="fas fa-upload"></i></div>          
          </label>
        </div>
        <div class="input" color="primary">
          <label>Título *</label>
          <input name="titulo" type="text"z>
        </div>
        <div class="row" columns="2">
          <div class="input col" color="primary">
            <label>Quantidade *</label>
            <input name="quantidade" type="text">
          </div>
          <div class="col"></div>
        </div>
        <div class="row" columns="2">
          <div class="input col" color="primary">
            <label>Valor *</label>
            <input name="valor" type="text">
          </div>
          <div class="input col" color="primary">
            <label>Desconto</label>
            <input name="desconto" type="text">
          </div>
        </div>
        <button type="submit" class="button" color="success" size="auto" icon="margin-right">
          <i class="fas fa-plus-square"></i>Adicionar
        </button>
        <a href="/e-commerce/admin/categorias.php" type="button" class="button" color="secondary" size="auto" icon="margin-right" style="margin-top: .5rem">
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
          } else {
            fileInput
              .querySelector('input:last-of-type')
              .value = ''
          }
      })
    });

  </script>
</html>