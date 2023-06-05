<footer class="footer">
    <div class="footer__container">
      <div class="footer__baner">
        <div class="footer__logo">
          <h2 class="footer__header">FunFits</h2>
          <p class="footer__slogan">Compete, Play, Win</p>
        </div>

        <?php if(!isset($_SESSION['userId'])) : ?>
          <div class="footer__navigation">
          <a href="/" class="footer__link hover-animation"> Home </a>
          <a href="/signup" class="footer__link hover-animation"> Join Us </a>
          <a href="/signin" class="footer__link hover-animation"> Sign In </a>
        </div>
        <?php else : ?>
          <div class="footer__navigation">
          <a href="/allteams" class="footer__link hover-animation"> Profile </a>
          <a href="/allteams" class="footer__link hover-animation"> Search </a>
          <a href="/addteam" class="footer__link hover-animation"> Teams </a>

        </div>
        <?php endif; ?>

       
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