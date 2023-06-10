<?php 
  session_start();
  if(!isset($_SESSION['userId'])){
    $url = "http://$_SERVER[HTTP_HOST]";
    header("Location: {$url}/signin");
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
  <title>Chellenge</title>
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
  <link rel="stylesheet" type="text/css" href="/public/css/team/chellenge.css" />
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
              <a class="menu__link" href="/usergames">
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

        <?php if($opponent) : ?>
            <article class="team__item">
                <div class="team__name">
                  <h3><?= $opponent->getTitle() ?></h3>
                </div>

                <div class="team__info">
                  <p class="team__data">
                    <i class="fa-solid fa-basketball team__icon"></i>  
                    <?= $opponent->getGame() ?>
                  </p>
                  <p class="team__data">
                    <i class="fa-sharp fa-solid fa-city team__icon"></i>
                    <?= $opponent->getCity() ?>
                  </p>
                  <p class="team__data"> 
                    <i class="fa-solid fa-users team__icon"></i>
                    <?= $opponent->getMembers() ?>
                  </p>
                </div>

                <picture class="team__picture"> 
                  <img class="team__img" src="/public/uploads/<?= $opponent->getImage() ?>" alt="Team">
                </picture>
                
                <div class="team__description">
                  <p class="team__about">
                  <i class="fa-solid fa-circle-info team__icon"></i>
                    About us:
                  </p>
                  <p class="team__text">
                  <?= $opponent->getDescription() ?>
                  </p>
                </div>

                <hr class="team__hr"/>

                <?php if($teams) : ?>
                <form class="team__form" method="POST" action="/creategame">
                 
                    <input
                        name="opponentId"
                        type="hidden"
                        value="<?= $opponent->getId() ?>"
                    />

                    <div class="input__container">
                        <label for="game">
                        <i class="fa-sharp fa-solid fa-city input__icon"></i>
                            Enter a place:
                        </label>
                        <input
                            name="place"
                            class="input__field"
                            type="text"
                            placeholder="Place"
                            require
                        />
                    </div>

                    <div class="input__container">
                        <label for="team">
                        <i class="fa-solid fa-users input__icon"></i>
                        Choose a team:
                        </label>
                        <select name="hostId" id="team" class="input__select" require>
                           
                                <?php foreach($teams as $team):?>
                                <option value="<?= $team->getId() ?>"><?= $team->getTitle() ?></option>
                                <?php endforeach; ?>
                            
                        </select> 
                    </div>

                    <div class="input__container">
                        <label for="date">
                        <i class="fa-solid fa-calendar-days input__icon"></i>
                        Choose a date:
                        </label>
                        <input id="gdate" name="game_date" class="input__field"  type="datetime-local" require>
                    </div>

                    <div class="form__button">
                        <button type="submit" class="team__button team__button--green">Compete</button>
                    </div>
                </form>

                <?php else : ?>                     
                        <div class="message">
                            <h3 class="message__header">You don't have any team that plays <?= strtolower($opponent->getGame()) ?>. </h3>
                        </div>
                <?php endif; ?>

            </article>
        <?php endif; ?>        
      </section>
    </div>
  </main>

  <?php include('public/views/layout/footer.php') ?>
</body>
