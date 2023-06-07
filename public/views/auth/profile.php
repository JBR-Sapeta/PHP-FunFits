<?php 
  session_start();
  if(!isset($_SESSION['userId'])){
    $url = "http://$_SERVER[HTTP_HOST]";
    header("Location: {$url}/signin");
  }
?>


<!DOCTYPE html>
<head>
  <script
    src="https://kit.fontawesome.com/46d253cbeb.js"
    crossorigin="anonymous"
  ></script>
  <title>Sign Up</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Iceland&family=Roboto:wght@400;500&display=swap"
    rel="stylesheet"
  />
  <link rel="stylesheet" type="text/css" href="/public/css/index.css" />
  <link rel="stylesheet" type="text/css" href="/public/css/layout/navigation.css" />
  <link rel="stylesheet" type="text/css" href="/public/css/index.css" />
  <link rel="stylesheet" type="text/css" href="/public/css/layout/navigation.css" />
  <link rel="stylesheet" type="text/css" href="/public/css/layout/main.css" />
  <link rel="stylesheet" type="text/css" href="/public/css/layout/sidebar.css" />
  <link rel="stylesheet" type="text/css" href="/public/css/layout/footer.css" />
  <link rel="stylesheet" type="text/css" href="/public/css/auth/profile.css" />
  <script src="https://kit.fontawesome.com/46d253cbeb.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="/public/js/ui-sidebar.js" defer></script>


</head>

<body>

  <?php include('public/views/layout/navigation.php') ?>

  <main class="main">
    <div class="main__sidebar">
      <nav id="sidebar" class="sidenav">
        <div class="sidenav__container">
          
          <div class="sidenav__profile">
            <h3 class="sidenav__name"><?= $_SESSION['username'] ; ?></h3>
            <picture class="sidenav__avatar">
              <img
                class="sidenav__img"
                src="/public/uploads/avatars/<?= $_SESSION['avatar'] ; ?>"
                alt="User avatar"
              />
            </picture>
          </div>

          <ul class="sidenav__menu">
            <li class="menu__button active">
              <a class="menu__link" href="/profile">
                <i class="fa-solid fa-user"></i>

                Profile
              </a>
            </li>
            <li class="menu__button" >
              <a class="menu__link" href="/searchteams">
                <i class="fa-solid fa-magnifying-glass"></i>
                Search</a
              >
            </li>

            <li class="menu__button ">
              <a class="menu__link" href="/myteams">
                <i class="fa-solid fa-users"></i>
                Teams</a
              >
            </li>
            <li class="menu__button">
              <a class="menu__link" href="">
                <i class="fa-solid fa-circle-play"></i>
                Compet</a
              >
            </li>
            <li class="menu__button">
              <a class="menu__link" href="/logout">
                <i class="fa-sharp fa-solid fa-arrow-right-from-bracket"></i>
                Logout</a
              >
            </li>
          </ul>
        </div>
      </nav>
    </div>

    <div class="main__page">

      

        <?php if($user) : ?>
          <section class="profile">

            <div class="profile__container">
              <h3 class="profile__header"><?= $user->getUsername() ?></h3>
              <picture class="profile__avatar">
                <img
                  class="profile__img"
                  src="/public/uploads/avatars/<?= $user->getAvatar() ?>"
                  alt="User avatar"
                />
              </picture>

              <div class="profile__data">
                <p>
                  <i class="fa-solid fa-user profile__icon"></i>
                  Name: <span><?= $user->getName() ?></span>
                </p>
                <p>
                  <i class="fa-solid fa-user profile__icon"></i>
                  Surname: <span><?= $user->getSurname() ?></span>
                </p>
                <p>
                  <i class="fa-solid fa-envelope profile__icon"></i>
                  Email:<span> <?= $user->getEmail() ?></span>
                </p>
                <p>
                  <i class="fa-solid fa-phone profile__icon"></i>
                  Phone: <span><?= $user->getPhone() ?></span>
                </p>
              </div>
            </div>
            <a href="/userform" class="profile__button" >Edit</a>
          </section>
        <?php else : ?>
          <h3 class="profile__header">Oops, something went wrong...</h3>
        <?php endif; ?>


    </div>
  </main>

  <?php include('public/views/layout/footer.php') ?>
</body>
