<!DOCTYPE html>
<head>
  <script
    src="https://kit.fontawesome.com/46d253cbeb.js"
    crossorigin="anonymous"
  ></script>
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
  <script
    src="https://kit.fontawesome.com/46d253cbeb.js"
    crossorigin="anonymous"
  ></script>
</head>

<body>
  <header class="navigation">
    <div class="naviagtion__menu">
      <button class="navigation__button" type="button">
        <img src="public/img/menu.svg" alt="Menu button" class="navigation__icon" />
      </button>
    </div>

    <div class="navigation__logo">
      <img class="navigation__header" src="public/img/FunFits.svg" />
    </div>

    <div class="navigation__actions">
      <button class="navigation__link hover-animation">
        <a href="#">Sign In</a>
      </button>
      <button class="navigation__link hover-animation">
        <a href="#"></a>Sign Up
      </button>
    </div>
  </header>

  <main class="main">
    <div class="main__sidebar">
      <nav class="sidenav">
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
            <li class="menu__button active">
              <a class="menu__link" href="">
                <i class="fa-solid fa-user"></i>
                Profile
              </a>
            </li>
            <li class="menu__button">
              <a class="menu__link" href="">
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
      <section class="hero">
        <div class="hero__element-1">
          <h2 class="hero__header">
            Let's <span class="hero__span"> Play </span> Together
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

  <footer class="footer">
    <div class="footer__container">
      <div class="footer__baner">
        <div class="footer__logo">
          <h2 class="footer__header">FunFits</h2>
          <p class="footer__slogan">Explore, Talk, Meet</p>
        </div>
        <div class="footer__navigation">
          <a class="footer__link hover-animation"> Home </a>
          <a class="footer__link hover-animation"> About </a>
          <a class="footer__link hover-animation"> Contact </a>
          <a class="footer__link hover-animation"> Join Us </a>
        </div>
      </div>
      <hr class="footer__hr" />
      <div class="footer__media">
        <ul class="footer__list">
          <li class="footer__li hover-animation">
            <a
              target="_blank"
              rel="noreferrer"
              href="https://www.facebook.com"
              class="footer__a"
            >
              <i class="fa-brands fa-facebook"></i>
              Facebook
            </a>
          </li>
          <li class="footer__li hover-animation">
            <a
              target="_blank"
              rel="noreferrer"
              href="https://www.facebook.com"
              class="footer__a"
            >
              <i class="fa-brands fa-instagram"></i>
              Instagram
            </a>
          </li>
          <li class="footer__li hover-animation">
            <a
              target="_blank"
              rel="noreferrer"
              href="https://www.facebook.com"
              class="footer__a"
            >
              <i class="fa-brands fa-twitter"></i>
              Twitter
            </a>
          </li>
          <li class="footer__li hover-animation">
            <a
              target="_blank"
              rel="noreferrer"
              href="https://www.facebook.com"
              class="footer__a"
            >
              <i class="fa-brands fa-youtube"></i>
              YouTube
            </a>
          </li>
        </ul>
      </div>
      <div class="footer__rights">
        <p>Copyright © 2023 by FunFits Inc. All rights reserved.</p>
      </div>
    </div>
  </footer>
</body>