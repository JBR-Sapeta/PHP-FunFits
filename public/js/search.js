const titleInput = document.getElementById('title');
const cityInput = document.getElementById('city');
const gameInput = document.getElementById('game');

const searchButton = document.getElementById('search__button');

const teamsContainer = document.getElementById('teamsContainer');
const notFoundContainer = document.getElementById('no-results');

titleInput.addEventListener('keyup', function (event) {
  if (event.key === 'Enter') {
    event.preventDefault();

    const data = {
      title: this.value,
      city: cityInput.value,
      game: gameInput.value,
    };

    
    
    
  }
});

searchButton.addEventListener('click', function (_event) {
  const data = {
    title: titleInput.value,
    city: cityInput.value,
    game: gameInput.value,
  };

  fetch('/search', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(data),
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (teams) {
      if (!teams.length) {
        notFoundContainer.classList.add('no-results--show');
      } else {
        notFoundContainer.classList.remove('no-results--show');
      }

      teamsContainer.innerHTML = '';
      renderTeams(teams);
    })
    .catch((err) => {
      console.log(err);
    });
});

function renderTeams(teams) {
  teams.forEach((team) => {
    renderTeam(team);
  });
}

function renderTeam(team) {
  const id = Number(team.id);
  const html = `
    <article class="search-result">
        <picture class="search-result__picture">
            <img class="search-result__img" src="public/uploads/${team.image}" alt="Team" >
        </picture>
        <h3 class="search-result__headre">
            ${team.title}
        </h3>
        <div class="search-result__team-info">
        <p class="search-result__info">
            <i class="fa-solid fa-basketball base-select__icon search-result__icon"></i>
            ${team.game}
        </p>
        <p class="search-result__info">
            <i class="fa-solid fa-users search-result__icon"></i>
            ${team.members}
        </p>
        <p class="search-result__info">
            <i class="fa-sharp fa-solid fa-city search-result__icon"></i>  
            ${team.city}
        </div>
        <div class="search-result__actions">
            <a class="search-result__button" href="/team/${id}">More</a>
        </div>
    </article>
    `;
  teamsContainer.insertAdjacentHTML('beforeend', html);
}
