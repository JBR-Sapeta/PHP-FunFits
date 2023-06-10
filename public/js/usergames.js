const spinnerContainer = document.getElementById('spinner');
const notFoundContainer = document.getElementById('not-found');
const gamesContainer = document.getElementById('games');
const headerContainer = document.getElementById('header');

const formattedDate = (dateString) => {
  const language = navigator.language;
  const date = new Date(dateString);
  const formatedDate = new Intl.DateTimeFormat(language, {
    minute: 'numeric',
    hour: 'numeric',
    day: 'numeric',
    month: 'numeric',
    year: 'numeric',
  }).format(date.getTime());

  return formatedDate;
};

function getGames() {
  fetch(`/getusergames`, {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
    },
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (games) {
      hideSpinner();
      if (!games.length) {
        showNotFound();
      } else {
        showHeader();
        renderGames(games);
      }
    })
    .catch((err) => {
      console.log(err);
    });
}

function hideSpinner() {
  spinnerContainer.classList.add('spinner--hiden');
}

function showNotFound() {
  notFoundContainer.classList.add('not-found--show');
}

function showHeader() {
  headerContainer.classList.add('show');
}

function renderGames(games) {
  games.forEach((game) => {
    renderGame(game);
  });
}

function renderGame(game) {
  let classes = 'status--blue';
  if (game.status === 'Rejected') {
    classes = 'status--red';
  }
  if (game.status === 'Accepted') {
    classes = 'status--green';
  }
  const date = formattedDate(game.date);

  const html = `
    <article class="game">
        <div class="game__data">
            <div class="game__header">
                <h3>${game.host_title}</h3>
                <span>vs</span>
                <h3>${game.opponent_title}</h3>
            </div>
            <div class="game__informations">
                <p class="game__info">
                    <i class="fa-solid fa-calendar-days game__icon "></i>
                    Date: <span>${date}</span></p>
                <p class="game__info">
                    <i class="fa-solid fa-square-check game__icon "></i> 
                    Status: <span class="${classes}" >"${game.status}"</span></p>
                <p class="game__info">
                    <i class="fa-sharp fa-solid fa-city game__icon "></i>
                    Place: <span>${game.place}</span></p>
            </div>
        </div>
    </article>
  `;

  gamesContainer.insertAdjacentHTML('beforeend', html);
}

getGames();
