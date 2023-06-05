<?php 
  session_start();
  if(isset($_SESSION['userId'])){
    $url = "http://$_SERVER[HTTP_HOST]";
    header("Location: {$url}/allteams");
  }
?>

<!DOCTYPE html>
<head>
  <title>Home</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Iceland&family=Roboto:wght@400;500&display=swap"
    rel="stylesheet"
  />
  <link rel="stylesheet" type="text/css" href="public/css/index.css" />
  <link rel="stylesheet" type="text/css" href="public/css/home.css" />
  <link rel="stylesheet" type="text/css" href="public/css/layout/navigation.css" />
  <link rel="stylesheet" type="text/css" href="public/css/layout/main.css" />
  <link rel="stylesheet" type="text/css" href="public/css/layout/sidebar.css" />
  <link rel="stylesheet" type="text/css" href="public/css/layout/footer.css" />
  <link rel="stylesheet" type="text/css" href="public/css/home.css" />
  <script src="https://kit.fontawesome.com/46d253cbeb.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="public/js/ui-sidebar.js"defer></script>
  <script type="text/javascript" src="public/js/home.js"defer></script>

</head>

<body>

  <?php include('public/views/layout/navigation.php') ?>

  <main class="main">
    <div class="main__sidebar">
      <nav id="sidebar" class="sidenav">
        <div class="sidenav__container">
          <ul class="sidenav__menu">
            <li class="menu__button active">
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
      <section class="hero">
        <div class="hero__element-1">
          <h2 class="hero__header">
            Let's <span id="actions" class="hero__span--green"> Play </span> Together
          </h2>
        </div>
        <div class="hero__element-2">
          <picture class="hero__picture">
            <img class="hero__img" src="public/img/hero/hero2.jpg" alt="" />
          </picture>
        </div>
        <div class="hero__element-3">
          <picture class="hero__picture">
            <img class="hero__img" src="public/img/hero/hero3.jpg" alt="" />
          </picture>
        </div>
        <div class="hero__element-4">
          <picture class="hero__picture">
            <img class="hero__img" src="public/img/hero/hero4.jpg" alt="" />
          </picture>
        </div>
        <div class="hero__element-5">
          <picture class="hero__picture">
            <img class="hero__img" src="public/img/hero/hero5.jpg" alt="" />
          </picture>
        </div>
        <div class="hero__element-6">
          <picture class="hero__picture">
            <img class="hero__img" src="public/img/hero/hero6.jpg" alt="" />
          </picture>
        </div>
        <div class="hero__element-7">
          <picture class="hero__picture">
            <img class="hero__img" src="public/img/hero/hero7.jpg" alt="" />
          </picture>
        </div>
        <div class="hero__element-8">
          <picture class="hero__picture">
            <img class="hero__img" src="public/img/hero/hero8.jpg" alt="" />
          </picture>
        </div>
        <div class="hero__element-9">
          <picture class="hero__picture">
            <img class="hero__img" src="public/img/hero/hero9.jpg" alt="" />
          </picture>
        </div>
        <div class="hero__element-10">
          <picture class="hero__picture">
            <img class="hero__img" src="public/img/hero/hero10.jpg" alt="" />
          </picture>
        </div>
      </section>

      <section class="numbers">
        <h3 class="numbers__header">Join The Competition</h3>
        <div class="numbers__container">
          <div class="numbers__item">
            <i class="fa-solid fa-user numbers__icon"></i>
            <p class="numbers__count">125 000</p>
            <p class="numbers__title">Users</p>
          </div>
          <div class="numbers__item">
            <i class="fa-solid fa-basketball numbers__icon"></i>
            <p class="numbers__count">54</p>
            <p class="numbers__title">Activities</p>
          </div>
          <div class="numbers__item">
            <i class="fa-sharp fa-solid fa-users numbers__icon"></i>
            <p class="numbers__count">5 000</p>
            <p class="numbers__title">Teams</p>
          </div>
          <div class="numbers__item">
            <i class="fa-solid fa-circle-play numbers__icon"></i>
            <p class="numbers__count">25 000</p>
            <p class="numbers__title">Competitions</p>
          </div>
        </div>
      </section>

      <section class="features">
        <article class="feature">
          <div class="feature__content feature__content--right">
            <h3>
              <i class="fa-sharp fa-solid fa-chart-simple feature__icon"></i>
              Develope Skills
            </h3>
            <p>
              It is a long established fact that a reader will be distracted by
              the readable content of a page when looking at its layout. The
              point of using Lorem Ipsum is that it has a more-or-less normal
              distribution of letters, as opposed to using 'Content here,
              content here', making it look like readable English.
            </p>
          </div>
          <picture class="feature__picture feature__picture--right">
            <img
              class="feature__img"
              src="public/img/feature/feature1.jpg"
              alt=""
            />
          </picture>
        </article>

        <article class="feature">
          <div class="feature__content feature__content--left">
            <h3>
              <i class="fa-sharp fa-solid fa-users feature__icon"></i>
              Find New Friends
            </h3>
            <p>
              It is a long established fact that a reader will be distracted by
              the readable content of a page when looking at its layout. The
              point of using Lorem Ipsum is that it has a more-or-less normal
              distribution of letters, as opposed to using 'Content here,
              content here', making it look like readable English.
            </p>
          </div>
          <picture class="feature__picture feature__picture--left">
            <img
              class="feature__img"
              src="public/img/feature/feature2.jpg"
              alt=""
            />
          </picture>
        </article>

        <article class="feature">
          <div class="feature__content feature__content--right">
            <h3>
              <i class="fa-solid fa-trophy feature__icon"></i>
              Compete With Others
            </h3>
            <p>
              It is a long established fact that a reader will be distracted by
              the readable content of a page when looking at its layout. The
              point of using Lorem Ipsum is that it has a more-or-less normal
              distribution of letters, as opposed to using 'Content here,
              content here', making it look like readable English.
            </p>
          </div>
          <picture class="feature__picture feature__picture--right">
            <img
              class="feature__img"
              src="public/img/feature/feature3.jpg"
              alt=""
            />
          </picture>
        </article>
      </section>
    </div>
  </main>

  <?php include('public/views/layout/footer.php') ?>
 
</body>
