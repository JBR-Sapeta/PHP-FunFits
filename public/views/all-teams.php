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
  <link rel="stylesheet" type="text/css" href="public/css/index.css" />
  <link rel="stylesheet" type="text/css" href="public/css/layout/navigation.css" />
  <link rel="stylesheet" type="text/css" href="public/css/layout/main.css" />
  <link rel="stylesheet" type="text/css" href="public/css/layout/sidebar.css" />
  <link rel="stylesheet" type="text/css" href="public/css/layout/footer.css" />
  <link rel="stylesheet" type="text/css" href="public/css/search.css" />
  <script src="https://kit.fontawesome.com/46d253cbeb.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="public/js/ui-sidebar.js"defer></script>
  <script type="text/javascript" src="public/js/search.js"defer></script>

</head>

<body>

  <?php include('public/views/layout/navigation.php') ?>

  <main class="main">
    <div class="main__sidebar">
      <nav id="sidebar" class="sidenav">
        <div class="sidenav__container">
          <div class="sidenav__profile">
            <h3 class="sidenav__name">John Smith</h3>
            <picture class="sidenav__avatar">
              <img
                class="sidenav__img"
                src="https://images.unsplash.com/photo-1531891437562-4301cf35b7e4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=764&q=80"
                alt="User avatar"
              />
            </picture>
          </div>

          <ul class="sidenav__menu">
            <li class="menu__button ">
              <a class="menu__link" href="">
                <i class="fa-solid fa-user"></i>
                Profile
              </a>
            </li>
            <li class="menu__button active" >
              <a class="menu__link" href="/allTeams">
                <i class="fa-solid fa-magnifying-glass"></i>
                Search</a
              >
            </li>

            <li class="menu__button">
              <a class="menu__link" href="">
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
              <a class="menu__link" href="">
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
          <button class="search__button" type="button">
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
                  15
                </p>
                <p class="search-result__info">
                  <i class="fa-sharp fa-solid fa-city search-result__icon"></i>  
                  <?= $team->getCity(); ?>
              </div>
              <div class="search-result__actions">
                <button class="search-result__button" >More</button>
              </div>
          </article>
        <?php endforeach; ?>

      </div>

      </section>
    </div>
  </main>

  <?php include('public/views/layout/footer.php') ?>

</body>
