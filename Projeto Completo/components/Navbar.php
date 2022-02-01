<?php 

//fazendo tratamento de exceção para acessar a conta
  try {
    $pdo = new PDO("mysql:host=localhost; dbname=database", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("set names utf8");
  } catch (PDOException $error) {
    echo "Erro na conexão:".$error->getMessage();
  }

  $quantidade = 0;

//acesso do usuário com tratamento de exceção
  if(isset($_SESSION["user_id"])) {

    try {
      $query = "SELECT * FROM itens_carrinho WHERE usuario_id=?";

      
      $stmt = $pdo->prepare($query); 
      $stmt->bindParam(1, $_SESSION["user_id"]); 
      
      if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
          while ($item_carrinho = $stmt->fetch(PDO::FETCH_OBJ)) {

            $quantidade += $item_carrinho->quantidade;
            
          }
        }
      } else {
        throw new PDOException("Erro: Não foi possível executar a declaração sql");
      }
      
    } catch (PDOException $error) {
      echo "Erro: ".$error->getMessage();
    }
  }

  $quantidade = str_pad($quantidade, 2, '0', STR_PAD_LEFT);

?>

<div class="nav-wrapper">
  <div class="navbar">
    <a href="/e-commerce/index.php" style="text-decoration: none;"><h1 class="brand">E-commerce</h1></a>
    <div class="nav-menu">
      <div class="nav-item">
        <div class="dropdown-toggler">
          <i class="fas fa-user"></i>
          <div class="text">
            <a data-testId="menuconta">minha Conta</a>
          </div>
        </div>
        <div class="dropdown">
          <?php
            if(isset($_SESSION["user_id"])) {
              echo '
                <a href="/e-commerce/signout.php">Sair</a>
              ';
            } else {
              echo '
                <a href="/e-commerce/signin.php">Entrar</a>
                <a href="/e-commerce/signup.php">Cadastrar-se</a>
                <a href="/e-commerce/admin.php">Admin</a>
              ';
            }
          ?>
        </div>
      </div>
      <div class="nav-item">
        <a href="/e-commerce/carrinho.php" style="text-decoration:none">
          <div class="dropdown-toggler">
            <i class="fas fa-shopping-basket"></i>
            <div class="text">
              <small>carrinho</small>
              <p><?php echo $quantidade ?> itens</p>
            </div>
          </div>
        </a>
      </div>

      <div class="nav-item">
          <div class="dropdown-toggler">
            <form method="POST" action="pesquisar.php">
              <input type="text" name="ppesquisar" placeholder="PESQUISA DE PRODUTO">
              <input type="submit" value="Pesquisar">
            </form>
          </div>
      </div>

    </div>
  </div>
  <?php
    if(!(isset($_SESSION["user_id"]) && $_SESSION["acess"] == 'admin'))
      include('./components/CategoriesMenu.php')
  ?>
</div>
<div style="width: 100%; height: 6rem;"></div>

<style>

  .nav-wrapper {
    width: 100%;
		display: grid;
		grid-template-columns: 1fr repeat(12, minmax(auto, 60px)) 1fr;
		grid-column-gap: 20px;
		position: fixed;
		z-index: 999;
		background: white;
		box-shadow: 0 5px 5px rgba(0,0,0,0.05);    
  }

    @media (min-width: 640px) {
      main {
        grid-column-gap: 40px;
      }
    }

    .navbar {
			grid-column: 2 / span 12;
			display: flex;
			align-items: center;
			justify-content: space-between;
			user-select: none;
			height: 4rem;
    }

      .brand {				
				font-weight: 600;
				font-size: 1.5rem;
				color: var(--blue4);
				white-space: nowrap;
      }

      @media (min-width: 640px) {
        .brand {
          font-size: 2rem;
        }
      }

      .search {
        width: 100%;
        display: flex;
        border: 1px solid var(--grey4);
      }

        .search input {
					width: 100%;
					text-transform: uppercase;
          border: none;
					outline: none;
					font-size: .75rem;
					padding: .5rem .75rem;
					color: var(--grey8);
					user-select: auto;
        }

					.search input::placeholder {
						text-transform: uppercase;
						color: var(--grey7);
          }	
        
        .search button {
          outline: none;
					padding: .3rem 1rem;
					margin: .2rem;
					background: var(--grey4);
					cursor: pointer;
					color: var(--grey8);
          border: none;
        }

          .search button:hover {
            background: var(--grey5);
            color: var(--grey9);
          }

          .search button i {
            height: .75rem;
          }

      .nav-menu {
        display: flex;
      }

        .nav-item {
          display: flex;
          margin-left: 2rem;
        }

          .dropdown-toggler {
            cursor: pointer;
            display: flex;
            color: var(--grey8);
          }

            .dropdown-toggler:hover p {
              color: var(--blue4);
            }

            .dropdown-toggler i {
              display: flex;
              align-items: flex-end;
              font-size: 2rem;
            }

            .text {
              margin-left: .5rem;
              text-transform: uppercase;
            }

              .text small {
                font-size: .75rem;
              }

              .text p {
                font-size: .875rem;
                line-height: 1;
                font-weight: 600;
              }

            .dropdown {
              position: absolute;
              flex-direction: column;
              top: calc(100%);
              box-shadow: var(--lg);
              background: white;
              display: none;
              overflow: auto;
              padding: .5rem 0;
              min-width: 200px;
              max-height: 9.5rem;
              transform: translateX(-25%);
              cursor: default;
            }    

              .dropdown a {
                text-decoration: none;
                display: block;
                color: var(--grey8);
                cursor: pointer;
                padding: .5rem .75rem;
                font-size: .875rem;
              }

                .dropdown a:hover {
                  background: var(--blue4);
                }

            .show {
              display: flex;
            }

</style>
<!--realizando acesso ao menu nas categorias-->
<script> 
  let nav_items = document.querySelectorAll('.nav-item'); 

  window.addEventListener('click', (e) => {
    nav_items.forEach(nav_item => {
        if(nav_item != e.target.closest('.nav-item') && nav_item.querySelector('.dropdown')) 
          nav_item.querySelector('.dropdown').classList.remove('show');
      });
  });

  nav_items.forEach(nav_item => {
    if(nav_item.querySelector('.dropdown')) {

      nav_item.querySelector('.dropdown-toggler').addEventListener('click', () => {
        nav_item.querySelector('.dropdown').classList.toggle('show');
      });
      nav_item.querySelectorAll('.dropdown a').forEach(a => {
        a.addEventListener('click', () => {
          nav_item.querySelector('.dropdown').classList.toggle('show');
        });
      });
    }
  });

</script>