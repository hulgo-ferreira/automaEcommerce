<?php
  $servername = "localhost";
   $database = "database";
   $username = "root";
   $password = "";
   
   $conexao = mysqli_connect($servername, $username, $password, $database);

//sintaxe para deletar algum item do carrinho 
   $sql = "DELETE FROM `itens_carrinho`";
    $deletar = mysqli_query($conexao, $sql);

?>

    <html>
  <!--chamando o arquivo head.php-->
  <?php include('./components/Head.php') ?> 
  <body>
  <!--chamando o arquivo navbar.php-->
    <?php include('./components/Navbar.php') ?>

    <div class="container py">
      <div style="grid-column: 2 / span 12; display: flex;">
        <h1 class="title" color="primary" align="left">CARRINHO</h1>
      </div>
      
      <div class="collapsible-table">
        <div class="table-wrapper show">
        
        <!--campo de informação-->
          <table>
            <thead>
              <tr>
                <th style="width: 50%;">Produto</th>
                <th style="width: 15%;">Quantidade</th>
                <th style="width: 15%;">Valor</th>
                <th style="width: 15%;">Subtotal</th>
                <th style="width: 5%;"></th>
              </tr>
            </thead>
            <tbody>
            <?php
              try {
                $query = "SELECT * FROM itens_carrinho WHERE usuario_id=?";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(1, $_SESSION['user_id']);
                $total = 0;
                if ($stmt->execute()) {    
                  if ($stmt->rowCount() > 0) {
                    
                    while ($item_carrinho = $stmt->fetch(PDO::FETCH_OBJ)) {
                      try {
                        $query2 = "SELECT * FROM produtos WHERE id=?";
                        $stmt2 = $pdo->prepare($query2);
                        $stmt2->bindParam(1, $item_carrinho->produto_id);
                        
                        if ($stmt2->execute()) {    
                          $produto = $stmt2->fetch(PDO::FETCH_OBJ);
                        } else {
                  
                          throw new PDOException("Erro: Não foi possível executar a declaração sql");
                        }
                      } catch (PDOException $error) {
                        echo "Erro: ".$error->getMessage();
                      }
                      
                      $paymentRequest->addItem($item_carrinho->id, $produto->titulo, $item_carrinho->quantidade, $produto->valor);  
                      echo
                      '
                        <tr>
                          <th>'.$produto->titulo.'</th>
                          <th>'.$item_carrinho->quantidade.' un.</th>
                          <th>R$ '.number_format($produto->valor, 2, ',', '.').'</th>
                          <th>R$ '.number_format($produto->valor*$item_carrinho->quantidade, 2, ',', '.').'</th>
                          <th>
                            <a href="/e-commerce/carrinho.php/?id='.$item_carrinho->id.'&act=cancel"><i class="fas fa-times" title="Cancelar"></i></a>
                          </th>
                        </tr>
                      ';
                      $total += $produto->valor*$item_carrinho->quantidade;
                    } 
                    echo '
                        </tbody>
                      </table>
                    ';
                  } else {
                    echo '
                        </tbody>
                      </table>
                      <p class="message" color="secondary" size="md" text-align="center" style="border: 2px solid white; background: var(--grey1); padding: .5rem;">
                        Nenhum produto foi adicionado ao carrinho.
                      </p>
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
      </div>
      <div style="grid-column: 2 / span 12; display: flex; align-items: center; justify-content: space-between">
        <p class="message" color="primary" align="left" size="lg" style="margin-top: .5rem;">
          <?php
            if(isset($total)){
              echo 'TOTAL: <span>R$ '.number_format($total, 2, ',', '.').'</span>';
            } else {
              echo 'TOTAL: <span>R$ '.number_format(0, 2, ',', '.').'</span>';
            }
          ?>
        </p>
        <a href="finalizarcompra.php" type="submit" class="button" color="success" size="auto" icon="margin-right">
          <i class="fas fa-check"></i>Finalizar COMPRA
        </a>
      </div>
    </div>
    


  
    <?php include('./components/Footer.php') ?>
  </body>

</html>
