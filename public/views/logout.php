<?php 
  session_start();
  if(isset($_SESSION['userId'])){
    unset($_SESSION['userId']);
    unset($_SESSION['username']);
    unset($_SESSION['avatar']);
  }
?>


<!DOCTYPE html>
<head>
  <script
    src="https://kit.fontawesome.com/46d253cbeb.js"
    crossorigin="anonymous"
  ></script>
  <title>logout</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Iceland&family=Roboto:wght@400;500&display=swap"
    rel="stylesheet"
  />
  <link rel="stylesheet" type="text/css" href="public/css/index.css" />
  <link rel="stylesheet" type="text/css" href="public/css/layout/navigation.css" />
  <link rel="stylesheet" type="text/css" href="public/css/layout/main.css" />
  <link rel="stylesheet" type="text/css" href="public/css/layout/sidebar.css" />
  <link rel="stylesheet" type="text/css" href="public/css/layout/footer.css" />
  <link rel="stylesheet" type="text/css" href="public/css/logout.css" />

  <script src="https://kit.fontawesome.com/46d253cbeb.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="public/js/ui-sidebar.js"defer></script>

</head>

<body>
  <?php include('public/views/layout/navigation.php') ?>

  <main class="main">
    <div class="logout">
      <picture class="logout__picture">
        <img class="logout__img" src="public/img/logout.png" alt="Good bye!">
      </picture>

      <a class="logout__link" href="/signin"> Sign In</a>
    </div>
  
  </main>

  <?php include('public/views/layout/footer.php') ?>
</body>
