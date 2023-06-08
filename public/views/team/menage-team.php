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
  <link rel="stylesheet" type="text/css" href="/public/css/team/menage-team.css" />
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
            <li class="menu__button ">
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

            <li class="menu__button active">
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
              <a class="menu__link" href="/userinvitations">
              <i class="fa-solid fa-envelope"></i>
                Invitations</a
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
      <section class="team">
       <?php if($team) : ?>
          
            <article class="team__item">
                <div class="team__name">
                  <h3><?= $team->getTitle() ?></h3>
                </div>

                <div class="team__info">
                  <p class="team__data">
                    <i class="fa-solid fa-basketball team__icon"></i>  
                    <?= $team->getGame() ?>
                  </p>
                  <p class="team__data">
                    <i class="fa-sharp fa-solid fa-city team__icon"></i>
                    <?= $team->getCity() ?>
                  </p>
                  <p class="team__data"> 
                    <i class="fa-solid fa-users team__icon"></i>
                    <?= $team->getMembers() ?>
                  </p>
                </div>

                <picture class="team__picture"> 
                  <img class="team__img" src="/public/uploads/<?= $team->getImage() ?>" alt="Team">
                </picture>
                
                <div class="team__description">
                  <p class="team__about">
                  <i class="fa-solid fa-circle-info team__icon"></i>
                    About us:
                  </p>
                  <p class="team__text">
                  <?= $team->getDescription() ?>
                  </p>
                </div>

                <div class="team__actions">
                    <a href="/teaminvitations/<?= $team->getId() ?>" class="team__button">Members</a>
                  <form method="POST" action ="/deleteteam/<?= $team->getId() ?>">
                    <button type="submit" class="team__button team__button--red">Delete</button>
                  </form>
                </div>

            </article>
    

        <?php else : ?>
            <div class="not-found">
              <h3 class="not-found__header">Team with given ID does not exist.</h3>
              <div class="not-found__mmesage ">
                <picture class="not-found__picture">
                    <img class="not-found__img" src="/public/img/not_found.png" alt="Good bye!">
                </picture>
              </div>
             <a class="not-found__link" href="/searchteams"> Search</a>
            </div>
        <?php endif; ?>
      </section>



    </div>
  </main>

  <?php include('public/views/layout/footer.php') ?>
</body>
