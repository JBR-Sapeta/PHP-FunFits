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
  <link rel="stylesheet" type="text/css" href="/public/css/auth/userform.css" />
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

        <section >

            <form class="userform" action="userupdate" method="POST" ENCTYPE="multipart/form-data">

                <h2 class="userform__header">Update Account</h2>

                <div class="base-input__container">
                    <i class="fa-solid fa-user base-input__icon"></i>
                    <input
                    name="name"
                    class="base-input__input"
                    type="text"
                    placeholder="Name"
                    maxlength="32"
                    />
                </div>

                <div class="base-input__container">
                    <i class="fa-solid fa-user base-input__icon"></i>
                    <input
                    name="surname"
                    class="base-input__input"
                    type="text"
                    placeholder="Surname"
                    maxlength="32"
                    />
                </div>

                <div class="base-input__container">
                    <i class="fa-solid fa-phone base-input__icon"></i>
                    <input
                    name="phone"
                    class="base-input__input"
                    type="text"
                    placeholder="Phone"
                    pattern="[0-9]+"
                    maxlength="12"
                    />
                </div>

                <div class="base-file__container">
                <label> 
                    <i class="fa-regular fa-image base-file__icon "></i>
                    Add your avatar.
                </label>
                <input type="file" name="file" class="base-file__input" /><br/>
                </div>

                <div class="userform__actions">
                <div class="userform__messages">
                  <p>
                  <?php if(isset($messages)){
                    foreach($messages as $message){
                      echo $message;
                    }
                  }
                  ?>
                  </p>
                </div>
                <button class="userform__button" type="submit">Update</button>
              </div>
                    
            </form>
        </section>

    </div>
  </main>

  <?php include('public/views/layout/footer.php') ?>
</body>
