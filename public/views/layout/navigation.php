<header class="navigation">
    <div class="naviagtion__menu">
      <button id="open-nav-btn" class="navigation__button  navigation__button--acticve" type="button">
        <i class="fa-sharp fa-solid fa-bars navigation__icon "></i>
      </button>
      <button id="close-nav-btn" class="navigation__button" type="button">
        <i class="fa-regular fa-x navigation__icon"></i>
      </button>
    </div>

    <div class="navigation__logo">
      <img class="navigation__header" src="/public/img/FunFits.svg" />
    </div>

    <div class="navigation__actions">

    <?php if(!isset($_SESSION['userId'])) : ?>
      <button class="navigation__link hover-animation">
        <a href="/signin">Sign In</a>
      </button>
      <button class="navigation__link hover-animation">
        <a href="/signup">Sign Up</a>
      </button>
    <?php else : ?>
      <button class="navigation__link hover-animation">
        <a href="/logout">Logout</a>
      </button>
    <?php endif; ?>

    
     
    </div>
  </header>