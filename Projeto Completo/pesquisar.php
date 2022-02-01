<!DOCTYPE html>

<?php 

  $servername = "localhost";
  $database = "database";
  $username = "root";
  $password = "";

  $conexao = mysqli_connect($servername, $username, $password, $database);

  $pesquisar = $_POST['ppesquisar'];
  $result_prod = "SELECT * FROM produtos WHERE titulo LIKE '%$pesquisar%' LIMIT 5";
  $resultado_prods = mysqli_query($conexao, $result_prod);

?>

<html>
  <?php include('./components/Head.php') ?> 
  <body>
    <?php include('./components/Navbar.php') ?>

    <main>
      <h1 class="section-title title" color="primary" align="center">Pesquisa Resultado</h1>
      <div class="card-list">
        <?php
          try {          
            
//trazendo da tabela produtos do campo titulo informações que o usuário irá pesquisar limitando um número de linhas(5) que devem ser retornados
            $query = "SELECT * FROM produtos WHERE titulo LIKE '%$pesquisar%' LIMIT 5";
                
            $stmt = $pdo->prepare($query);

            if ($stmt->execute()) {    
              if ($stmt->rowCount() > 0) {
                while ($produto = $stmt->fetch(PDO::FETCH_OBJ)) {
                  $valor = number_format($produto->valor, 2, ',', '.');
                  if($produto->desconto) {

                    $valor_descontado = (100 - $produto->desconto)/100 * $produto->valor;
                    $valor_descontado = number_format($valor_descontado, 2, ',', '.');
                  } else {
                    $valor_descontado = number_format($produto->valor, 2, ',', '.');
                  }
                  echo '
                    <div class="card">
                      <div class="image-container">
                      ';
                          if($produto->imagem) {
                            echo '<img src="/e-commerce/imagens/'.$produto->id.'/'.$produto->imagem.'">';
                          }
                          if($produto->desconto) {
                            echo '<div class="discount-percent">'.$produto->desconto.'% OFF</div>';
                          }
                          //Card com a imagem do produto.
                        echo '
                      </div>
                      <div class="card-text">
                        <h3 class="card-title">'.$produto->titulo.'</h3>
                        <p class="message" size="sm" color="primary" text-align="right">QUANTIDADE: <span>'.$produto->quantidade.'</span> un.</p>
                        <div>
                          ';
                          if($produto->desconto) {
                            echo '<small class="card-prev-price">DE <span>R$ '.$valor.' </span></small>';
                          }
                          echo '
                          <p class="card-price">POR <span>R$ '.$valor_descontado.'</span> À VISTA</p>
                        </div>       
                      </div>
                      ';
                      //Sessao usario
                      if(!isset($_SESSION["user_id"])) {
                        echo '<a href="/e-commerce/signin.php" class="button" color="success" size="auto">Comprar</a>';
                      } else {
                        echo '
                          <form action="?act=add&id='.$produto->id.'" method="POST" enctype="multipart/form-data" style="width: 100%">
                            <button type="submit" class="button" color="success" size="full">Comprar</button>
                          </form>
                        ';
                      }
                      echo '
                    </div>                
                  ';
                }
              } else {
                echo '
                  <small class="message" color="secondary" size="md" text-align="center" style="grid-column: span 12">
                    Não há nenhum produto cadastrado nesta categoria.
                  </small>
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
    </main>

    <?php include('./components/Footer.php') ?>
  </body>

  <style>

    main {
      display: grid;
      grid-template-columns: 1fr repeat(12, minmax(auto, 60px)) 1fr;
      grid-gap: 20px;
      padding: 5rem 0;
    }

      @media (min-width: 640px) {
        main {
          grid-gap: 40px;
        }
      }

      .section-title {
        grid-column: 2 / span 12;
        font-weight: 600;
        font-size: 1.5rem;
        text-transform: uppercase;
        color: var(--grey8);
        position: relative;
        margin-bottom: 1.5rem;
        user-select: none;
      }

        .section-title::after {
          content: "";
          width: 72px;
          height: 5px;
          position: absolute;
          left: 0;
          bottom: -5px;
          background: var(--green4);
        }

      .card-list {
        grid-column: 2 / span 12;
        display: grid;
        grid-template-columns: repeat(12, minmax(auto, 60px));
        grid-gap: 20px;
      }

      @media (min-width: 640px) {
        .card-list {
          grid-gap: 40px;
        }
      }

        .card {
          grid-column-end: span 12;
          display: flex;
          flex-direction: column;
          user-select: none;
          background: var(--grey1);
          position: relative;
        }

          .card:hover {
            transform: translateY(-1.25%);
            transform: scale(1.025);
          }

          @media (min-width: 640px) {
            .card {
              grid-column-end: span 6;
            }
          }

          @media (min-width: 768px) {
            .card {
              grid-column-end: span 4;
            }
          }

          @media (min-width: 1024px) {
            .card {
              grid-column-end: span 3;
            }
          }

          .image-container {
            width: 100%;
            background: var(--grey4);
            padding-top: 125%;
            overflow: hidden;
            position: relative;
          }

            .image-container img {
              height: 100%;
              position: absolute;
              top: 50%;
              left: 50%;
              transform: translate(-50%, -50%);
            }

              .image-container::before {
                content: '3 x 4';
                color: var(--grey5);
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);

              }

            .discount-percent {
              position: absolute;
              background: black;
              top: 5px;
              right: 0;
              font-size: .675rem;
              padding: .25rem .5rem;
              color: white;
            }
      
          .card-text {
            padding: .5rem;
            margin-bottom: 1rem;
            text-align: center;
            height: 100%;
          }

            .card-title {
              font-size: .875rem;
              font-weight: 500;
              color: var(--grey8);				
              text-transform: uppercase;
              margin-bottom: .5rem;
            }
            
            .card-text small {
				      font-size: .75rem;
            }

            .card-text p {
              color: var(--grey8);
              font-size: .875rem;
            }

            .card-text .card-prev-price {
              margin-right: .5rem;
            }

              .card-prev-price span {
                color: var(--blue4);
                text-decoration: line-through;
              }

            .card-text .card-price {
              display: inline-block;
            }
              
              .card-price span {
                color: var(--blue4);
              }

            .card-text .card-installment {
              color: var(--grey5);
            }

              .card-installment span {
                color: var(--grey8);
              }

  </style>
</html>