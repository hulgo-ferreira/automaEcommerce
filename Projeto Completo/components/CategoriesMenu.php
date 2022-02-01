<?php

  try {
    $pdo = new PDO("mysql:host=localhost; dbname=database", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("set names utf8");
  } catch (PDOException $error) {
    echo "Erro na conexão:".$error->getMessage();
  }

?>
<div class="categories-menu">
  <div class="scroll-button left">
    <i class="fa fa-chevron-left"></i>
  </div>
  <div class="scrollable-menu">
    <?php 
      try {
        $query = "SELECT * FROM categorias";
        $stmt = $pdo->prepare($query);
        if ($stmt->execute()) {            
          while ($categoria = $stmt->fetch(PDO::FETCH_OBJ)) {
            echo '
    <a class="category-link" href="/e-commerce/produtos.php/?id_categoria='.$categoria->id.'">'.$categoria->nome.'</a>
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
  <div class="scroll-button right">
    <i class="fa fa-chevron-right"></i>
  </div>
</div>

<!--estilizando a página com CSS-->
<style>
  .subnav {
    position: fixed;
    top: 4rem;
    z-index: 999;
    background: white;
    box-shadow: 0 5px 5px rgba(0,0,0,0.05);    
  }

    .categories-menu {
      position: relative;
      width: 100%;
      grid-column: 2 / span 12;
      display: flex;
      user-select: none;
      border-top: 1px solid var(--grey4);
    }

      .scrollable-menu { 
        margin: 0 3rem;
        display: flex;
        overflow-x: hidden;
      }

        .category-link {
          text-decoration: none;
          padding: .5rem 1rem;
          color: var(--grey8);
          cursor: pointer;
          font-size: .875rem;
        }

          .category-link:hover {
            color: var(--blue4);
          }

      .scroll-button {

        position: absolute;
        padding: .3rem 1rem;
        margin: .2rem;
        color: white;
        cursor: pointer;
        background: var(--blue4);
        font-size: .875rem;
      }

        .scroll-button:hover {
          color: var(--blue1);
          background: var(--blue5);
        }

        .left {
          left: 0;
        }

        .right {
          right: 0;
        }

		  .disable {
        background: var(--grey3);
        color: car(--grey4);
        cursor: default;
      }

        .disable:hover {
          background: var(--grey3);
          color: car(--grey4);
        }

</style>

<script>
  let scrollableMenu = document.querySelector('.scrollable-menu')

  let timeout = null

  function scrollToLeft() {
    timeout = setTimeout(() => {
      if (scrollableMenu.scrollLeft == 0) 
        clearTimeout(timeout)
      scrollableMenu.scrollLeft -= 1
      scrollToLeft()
    }, 1)
  }

  function scrollToRight() {
    timeout = setTimeout(() => {
      if (scrollableMenu.scrollLeft == (scrollableMenu.scrollWidth - scrollableMenu.clientWidth))
        clearTimeout(timeout)
      scrollableMenu.scrollLeft += 1
      scrollToRight()
    }, 1)
  }

  function stopScrolling() {
    if (timeout)
      clearTimeout(timeout)
  }
  
  document.querySelectorAll('.scroll-button').forEach(scrollButton => {
    if (scrollableMenu.scrollWidth <= scrollableMenu.offsetWidth)
      scrollButton.style.display = "none"
    scrollButton.addEventListener('mousedown', () => {
      if (scrollButton.classList.contains('left'))
        scrollToLeft()
      if (scrollButton.classList.contains('right'))
        scrollToRight()
    })
    scrollButton.addEventListener('mouseup', () => {
      stopScrolling();
    })
    scrollButton.addEventListener('mouseout', () => {
      stopScrolling();
    })
  });
  
</script>
