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
  <link rel="stylesheet" type="text/css" href="public/css/index.css" />
  <link rel="stylesheet" type="text/css" href="public/css/layout/navigation.css" />
  <link rel="stylesheet" type="text/css" href="public/css/layout/main.css" />
  <link rel="stylesheet" type="text/css" href="public/css/layout/sidebar.css" />
  <link rel="stylesheet" type="text/css" href="public/css/layout/footer.css" />
  <link rel="stylesheet" type="text/css" href="public/css/newteam.css" />
  <script src="https://kit.fontawesome.com/46d253cbeb.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="public/js/ui-sidebar.js"defer></script>
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
              <a class="menu__link" href="">
                <i class="fa-solid fa-user"></i>
                Profile
              </a>
            </li>
            <li class="menu__button " >
              <a class="menu__link" href="/allteams">
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
      <section class="teams">

        <nav class="teams__actions">
          <ul class="teams__ul">
            <li>
              <a  class="teams__link teams__link--border " href="/myteams">
                <i class="fa-solid fa-user-shield teams__icon--nav"></i>
                Owner
              </a>
            </li>
            <li>
              <a  class="teams__link teams__link--border" href="/">
              <i class="fa-solid fa-user teams__icon--nav"></i>
                Member
              </a>
            </li>
            <li>
              <a class="teams__link teams__link--active" href="/addteam">
                <i class="fa-solid fa-plus teams__icon--nav"></i>
                Create team
              </a>
            </li>
          </ul>
        </nav>

        <article class="newteam">
          <form class="newteam__form" action="addteam" method="POST" ENCTYPE="multipart/form-data">

              <h2 class="newteam__header">Create New Team</h2>
            
              <div class="base-input__container">
                  <i class="fa-sharp fa-solid fa-people-group base-input__icon"></i>
                  <input
                    name="title"
                    class="base-input__input"
                    type="text"
                    placeholder="Team name"
                  />
              </div>

              <div class="base-input__container">
                  <i class="fa-sharp fa-solid fa-city base-input__icon"></i>
                  <input
                    name="city"
                    class="base-input__input"
                    type="text"
                    placeholder="City"
                  />
              </div>

              <div class="base-textarea__container">
                <label for="description">
                  <i class="fa-solid fa-pen base-textarea__icon"></i>
                  Description
                </label>
                <textarea
                  id="description"
                  name="description"
                  class="base-textarea__input"
                  type="text"
                  placeholder="Team description..."
                  rows="8"
                  maxlength="400"
                > </textarea>
              </div>

              <div class="base-select__container">
                <label for="game">
                <i class="fa-solid fa-basketball base-select__icon"></i>
                Choose a game:
                </label>
                <select name="game" id="game" class="base-select__input">
                  <option value="Football">Football</option>
                  <option value="Voleyball">Voleyball</option>
                  <option value="Basketball">Basketball</option>
                  <option value="Tenis">Tenis</option>
                </select> 
              </div>

              <div class="base-file__container">
                <label> 
                  <i class="fa-regular fa-image base-file__icon "></i>
                  Image
                </label>
                <input type="file" name="file" class="base-file__input" /><br/>
              </div>

              

              <div class="newteam__actions">
                <div class="newteam__messages">
                  <p>
                  <?php if(isset($messages)){
                    foreach($messages as $message){
                      echo $message;
                    }
                  }
                  ?>
                  </p>
                </div>
                <button class="newteam__button" type="submit">Create</button>
              </div>
          </form>
        </article>
      </section>
    </div>
  </main>

  <?php include('public/views/layout/footer.php') ?>
</body>
