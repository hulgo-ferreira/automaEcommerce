<!DOCTYPE html>

<?php 

  if(session_status() == 1)
    session_start();

//isset determina se a variável no caso array($_session) está declarado
//se estiver será chamado a localização ou seja a página index.php
  if(!isset($_SESSION['user_id']))
    header('location:/e-commerce/index.php');

  if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "logout") {

    $_SESSION["user_id"] = null;
    $_SESSION["class"] = null;

    header('location:/e-commerce/index.php');
    
  }

?>

<html>
  <?php include('./components/Head.php') ?> 
  <body>
    <?php include('./components/Navbar.php') ?> 
    <main class="container py">
      <form action="?act=logout" method="POST" enctype="multipart/form-data" class="form" size="sm" align-text="center">
        <h1 class="title" color="primary" align="center">
          Sair
        </h1>
        <small class="message" color="primary" size="md" text-align="center">
          Você tem certeza que deseja sair? 
        </small>

        <button type="submit" class="button" color="primary" size="auto" icon="margin-right">
          <i class="fas fa-sign-out"></i>Sair
        </button>
      </form>
    </main>

    <?php include('./components/Footer.php') ?>

  </body>
</html>