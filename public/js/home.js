const heroAction = document.getElementById('actions');

class HeroView {
  action = ['Play', 'Meet', 'Win'];
  color = ['hero__span--green', 'hero__span--blue', 'hero__span--red'];

  constructor() {
    this.interval = this._changeAction.bind(this)();
  }

  _changeAction() {
    let counter = 0;
    return setInterval(() => {
      counter += 1;
      heroAction.innerHTML = this.action[counter % 3];
      heroAction.classList = this.color[counter % 3];
    }, 2500);
  }
}

const hero = new HeroView();
