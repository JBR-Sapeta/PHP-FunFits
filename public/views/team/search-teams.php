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
  <title>Search</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Iceland&family=Roboto:wght@400;500&display=swap"
    rel="stylesheet"
  />
  <link rel="stylesheet" type="text/css" href="/public/css/index.css" />
  <link rel="stylesheet" type="text/css" href="/public/css/layout/navigation.css" />
  <link rel="stylesheet" type="text/css" href="/public/css/layout/main.css" />
  <link rel="stylesheet" type="text/css" href="/public/css/layout/sidebar.css" />
  <link rel="stylesheet" type="text/css" href="/public/css/layout/footer.css" />
  <link rel="stylesheet" type="text/css" href="/public/css/team/search-teams.css" />
  <script src="https://kit.fontawesome.com/46d253cbeb.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="/public/js/ui-sidebar.js" defer></script>
  <script type="text/javascript" src="/public/js/search.js" defer></script>

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
                src="public/uploads/avatars/<?= $_SESSION['avatar'] ; ?>"
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
            <li class="menu__button active" >
              <a class="menu__link" href="/searchteams">
                <i class="fa-solid fa-magnifying-glass"></i>
                Search</a
              >
            </li>

            <li class="menu__button">
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
      <section class="search">
      
      <div class="search__field">
        <input id="title" class="search__input" type="text" placeholder="Serach by team name" />
        <div class="search__action">
          <button id="search__button" class="search__button" type="button">
            <i class="fa-sharp fa-solid fa-magnifying-glass search__icon-20"></i>
            Search
          </button>
        </div>
      </div>

      <div class="search__params">
        <div class="search__city">
          <label for="city" class="search__label">
            <i class="fa-sharp fa-solid fa-city search__icon-16"></i>  
            City
          </label>
          <input id="city" type="text" placeholder="City"  />
        </div>
        <div class="search__game">
          <label for="game" class="search__label">
            <i class="fa-solid fa-basketball base-select__icon search__icon-16"></i>
            Category:
          </label>
          <select  id="game" class="search__select">
            <option value="Football">Football</option>
            <option value="Voleyball">Voleyball</option>
            <option value="Basketball">Basketball</option>
            <option value="Tenis">Tenis</option>
          </select> 
        </div>
      </div>

      <div id="no-results" class="no-results">
          <picture class="no-results__picture">
            <img class="no-results__img" src="/public/img/not_found.png" alt="Good bye!">
          </picture>
      </div>

      <div id="teamsContainer" class="search-results">

        <?php foreach($teams as $team):?>

            <article class="search-result">
              <picture class="search-result__picture">
                <img class="search-result__img" src="public/uploads/<?= $team->getImage(); ?>" alt="Team" >
              </picture>
              <h3 class="search-result__headre">
                <?= $team->getTitle(); ?>
              </h3>
              <div class="search-result__team-info">
                <p class="search-result__info">
                  <i class="fa-solid fa-basketball base-select__icon search-result__icon"></i>
                  <?= $team->getGame(); ?>
                </p>
                <p class="search-result__info">
                  <i class="fa-solid fa-users search-result__icon"></i>
                  <?= $team->getMembers(); ?>
                </p>
                <p class="search-result__info">
                  <i class="fa-sharp fa-solid fa-city search-result__icon"></i>  
                  <?= $team->getCity(); ?>
              </div>
              <div class="search-result__actions">
                <a class="search-result__button" href="/team/<?= $team->getId(); ?>" >More</a>
              </div>
          </article>
        <?php endforeach; ?>

      </div>

      </section>
    </div>
  </main>

  <?php include('public/views/layout/footer.php') ?>

</body>
