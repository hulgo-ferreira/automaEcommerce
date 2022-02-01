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
    echo "Erro na conexão:" . $error->getMessage();
  }

?>

<html>
  <?php include('../components/Head.php') ?> 
  <body>
    <?php include('../components/Navbar.php') ?>
    
    <div class="container py">
      <div style="grid-column: 2 / span 12; display: flex; justify-content: space-between; align-items: flex-start;">
        <h1 class="title" color="primary" align="left">Categorias</h1>
        <a href="./categorias/criar.php" class="button" color="success" icon="margin-right" size="auto"><i class="fas fa-plus-square"></i>Criar categoria</a> 
      </div>
      <?php
        try {
          $query = "SELECT * FROM categorias";
          $stmt = $pdo->prepare($query);
          if ($stmt->execute()) {            
            while ($categoria = $stmt->fetch(PDO::FETCH_OBJ)) {
              echo '
                <div class="collapsible-table">
                  <div class="table-header">
                    <h3>'.$categoria->nome.'</h3>
                    <div style="display: flex">
                      <a href="/e-commerce/admin/categorias/produtos/criar.php/?id_categoria='.$categoria->id.'" class="button" color="success" icon="no-margin" text="adicionar"><i class="fas fa-plus-square"></i></a>
                      <a href="/e-commerce/admin/categorias/editar.php/?id='.$categoria->id.'" class="button" color="warning" icon="no-margin" text="editar"><i class="fas fa-edit"></i></a>
                      <a href="/e-commerce/admin/categorias/excluir.php/?id='.$categoria->id.'" class="button" color="danger" icon="no-margin" text="excluir"><i class="fas fa-trash"></i></a>
                      <button class="button" color="secondary"><i class="fas fa-plus"></i></button>
                    </div>
                  </div>
                  <div class="table-wrapper">
              ';
              
              $query2 = "SELECT * FROM produtos WHERE id_categoria=?";
              
              $stmt2 = $pdo->prepare($query2);
              $stmt2->bindParam(1, $categoria->id);

              if ($stmt2->execute()) {    
                if ($stmt2->rowCount() > 0) {
                  echo '
                    <table>
                      <thead>
                        <tr>
                          <th style="width: 12%;">Imagem</th>
                          <th style="width: 40%;">Título</th>
                          <th style="width: 12%;">Quantidade</th>
                          <th style="width: 12%;">Valor</th>
                          <th style="width: 12%;">Desconto</th>
                          <th style="width: 12%;">Ações</th>
                        </tr>
                      </thead>
                      <tbody>
                  ';
                  while ($produto = $stmt2->fetch(PDO::FETCH_OBJ)) {
                    echo '
                        <tr>
                          <th>
                            <div style="display:flex; align-items: center; justify-content: center">
                              <img src="../imagens/'.$produto->id.'/'.$produto->imagem.'" style="height: 1.75rem">
                            </div>
                          </th>
                          <th>'.$produto->titulo.'</th>
                          <th>'.$produto->quantidade.' un.</th>
                          <th>R$ '.number_format($produto->valor, 2, ',', '.').'</th>
                          <th>';
                            if($produto->desconto) {
                              echo "$produto->desconto%";
                            } else {
                              echo "-";
                            }

                          echo '
                          </th>
                          <th>
                            <a href="/e-commerce/admin/categorias/produtos/editar.php/?id='.$produto->id.'"><i class="fas fa-edit" title="Editar"></i></a>
                            <a href="/e-commerce/admin/categorias/produtos/excluir.php/?id='.$produto->id.'"><i class="fas fa-trash" title="Excluir"></i></a>
                          </th>
                        </tr>
                    ';
                  }
                  echo '
                      </tbody>
                    </table>
                  ';
                } else {
                  echo '
                    <p class="message" color="secondary" size="md" text-align="center" style="border: 2px solid white; background: var(--grey1); padding: .5rem;">
                      Nenhum produto foi adicionado a esta categoria.
                    </p>
                  ';
                }
              } else {          
                throw new PDOException("Erro: Não foi possível executar a declaração sql");
              }
              echo '
                  </div>
                </div>
              ';
            }
          } else {
          
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
          }
        } catch (PDOException $error) {
          echo "Erro: ".$error->getMessage();
        }
      ?>

    </div>

    <?php include('../components/Footer.php') ?>
  </body>
  
  <script>
    document.querySelectorAll('.collapsible-table').forEach(collapsibleTable => {
      collapsibleTable.querySelector('button').addEventListener('click', e => {
        if(collapsibleTable.querySelector('.table-wrapper').classList.toggle('show')) {
          collapsibleTable.querySelector('button i').classList.add('fa-minus')
          collapsibleTable.querySelector('button i').classList.remove('fa-plus')
        } else {
          collapsibleTable.querySelector('button i').classList.add('fa-plus')
          collapsibleTable.querySelector('button i').classList.remove('fa-minus')
        }

      })
    });
  </script>
</html>
