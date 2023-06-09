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

  <meta name="viewport" content="width=device-width">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />

  <script
    src="https://kit.fontawesome.com/46d253cbeb.js"
    crossorigin="anonymous"
  ></script>
  <title>Logout</title>
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
  <link rel="stylesheet" type="text/css" href="public/css/auth/logout.css" />

  <script src="https://kit.fontawesome.com/46d253cbeb.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="public/js/ui-sidebar.js"defer></script>

</head>

<body>
  <?php include('public/views/layout/navigation.php') ?>  



  <main class="main">
    <div class="main__sidebar">
      <nav id="sidebar" class="sidenav">
          <div class="sidenav__container">
            <ul class="sidenav__menu">
              <li class="menu__button ">
                <a class="menu__link" href="/">
                  <i class="fa-solid fa-house"></i>
                  Home
                </a>
              </li>
              <li class="menu__button">
                <a class="menu__link" href="/signin">
                  <i class="fa-regular fa-solid fa-arrow-right-to-bracket"></i>
                  Sign In
                </a>
              </li>
              <li class="menu__button ">
                <a class="menu__link" href="signup">
                  <i class="fa-solid fa-user-plus"></i>
                  Sign Up
                </a>
              </li>
            </ul>
        </div>
      </nav>
    </div>

    <div class="main__page">
      <div class="logout">
        <picture class="logout__picture">
          <img class="logout__img" src="public/img/logout.png" alt="Good bye!">
        </picture>
        <a class="logout__link" href="/signin"> Sign In</a>
      </div>
    </div>
  
  </main>

  <?php include('public/views/layout/footer.php') ?>
</body>
