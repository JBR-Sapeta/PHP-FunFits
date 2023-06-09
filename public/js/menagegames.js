const spinnerContainer = document.getElementById('spinner');
const notFoundContainer = document.getElementById('not-found');
const gamesContainer = document.getElementById('games');
const userId = gamesContainer.parentElement.id;

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
  const teamId = window.location.href.split('menagegames/')[1];

  console.log(userId);

  fetch(`/getgames/${teamId}`, {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
    },
  })
    .then(function (response) {
      console.log(response.body);
      return response.json();
    })
    .then(function (games) {
      console.log(games);
      hideSpinner();
      if (!games.length) {
        showNotFound();
      }
      renderGames(games);
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

function renderGames(games) {
  games.forEach((game) => {
    renderGame(game);
  });
}

function renderGame(game) {
  const date = formattedDate(game.date);
  console.log(date);
  console.log(new Date(game.date));

  let html = `
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
                    Status: <span>"${game.status}"</span></p>
                <p class="game__info">
                    <i class="fa-sharp fa-solid fa-city game__icon "></i>
                    Place: <span>${game.place}</span></p>
            </div>
        </div>
        <div class="game__actions">
            <form method="POST" action="/acceptgame/${game.id}">
                <button type="submit" class="game__button game__button--green " >Accept</button>
            </form>
            <form method="POST" action="/rejectgame/${game.id}">
                <button  type="submit" class="game__button">Reject</button>
            </form>
        </div>
    </article>
  `;

  if (game.host_owner === parseInt(userId)) {
    html = `
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
                    Status: <span>"${game.status}"</span></p>
                <p class="game__info">
                    <i class="fa-sharp fa-solid fa-city game__icon "></i>
                    Place: <span>${game.place}</span></p>
            </div>
        </div>
        <div class="game__actions">
            <form method="POST" action="/deletegame/${game.id}">
                <button type="submit" class="game__button">Delete</button>
            </form>
        </div>
    </article>
    `;
  }
  gamesContainer.insertAdjacentHTML('beforeend', html);
}

getGames();
