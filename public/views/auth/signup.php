<?php 
  session_start();
  // if(isset($_SESSION['userId'])){
  //   $url = "http://$_SERVER[HTTP_HOST]";
  //   header("Location: {$url}/searchteams");
  // }
?>

<!DOCTYPE html>
<head>
  <meta name="viewport" content="width=device-width">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
  
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
  <link rel="stylesheet" type="text/css" href="public/css/auth/signup.css" />

  <script src="https://kit.fontawesome.com/46d253cbeb.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="public/js/ui-sidebar.js"defer></script>
  <script type="text/javascript" src="public/js/signup.js"defer></script>
  
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
            <li class="menu__button ">
              <a class="menu__link" href="/signin">
                <i class="fa-regular fa-solid fa-arrow-right-to-bracket"></i>
                Sign In
              </a>
            </li>
            <li class="menu__button active">
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
      <section class="auth-form auth-form--signin">
        <div class="auth-form__container auth-form__container--signin">
          
          <div class="auth-header__block">
            <h2 class="auth-header__header">WaveUp</h2>
            <hr class="auth-header__hr" />
            <p class="auth-header__slogan">Login in to Your Account</p>
          </div>

          <form class="auth-form__form auth-form__form--center" action="register" method="POST">
            <div class="base-input__container">
              <div id="username-div" class="base-input__field">
                <i class="fa-solid fa-user fa-xl base-input__icon"></i>
                <input
                  name="username"
                  class="base-input__input"
                  type="text"
                  placeholder="Username"
                />
              </div>
              <p id="username-p" class="validation-error"></p>
            </div>

            <div class="base-input__container">
              <div id="email-div" class="base-input__field">
                <i class="fa-solid fa-envelope base-input__icon"></i>
                <input
                  name="email"
                  class="base-input__input"
                  type="text"
                  placeholder="E-mail"
                />
              </div>
              <p id="email-p" class="validation-error"></p>
            </div>

            <div class="base-input__container">
              <div id="password-div" class="base-input__field">
                <i class="fa-solid fa-lock base-input__icon"></i>
                <input
                  name="password"
                  class="base-input__input"
                  type="password"
                  placeholder="Password"
                />
              </div>
              <p id="password-p"  class="validation-error"></p>
            </div>

            <div class="base-input__container">
              <div id="confirm-div" class="base-input__field">
                <i class="fa-solid fa-lock base-input__icon"></i>
                <input
                  name="confirm" 
                  class="base-input__input"
                  type="password"
                  placeholder="Repeat Password"
                />
              </div>
              <p id="confirm-p" class="validation-error"></p>
            </div>

            <div class="auth-form__messages">
              <p>
                <span class="auth-form__message--error"> 
                <?php if(isset($errors)){
                  foreach($errors as $error){
                    echo $error;
                  }
                }
                ?>
              </span>
              </p>
            </div>


            <div class="auth-form__actions">
              <button class="auth-form__button" type="submit">Sign Up</button>
            </div>
          </form>
        </div>
      </section>
    </div>
  </main>

  <?php include('public/views/layout/footer.php') ?>
</body>
