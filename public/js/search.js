const titleInput = document.getElementById('title');
const cityInput = document.getElementById('city');
const gameInput = document.getElementById('game');

const searchButton = document.getElementById('search__button');

console.log(searchButton);

const teamsContainer = document.getElementById('teamsContainer');

titleInput.addEventListener('keyup', function (event) {
  if (event.key === 'Enter') {
    event.preventDefault();

    const data = {
      title: this.value,
      city: cityInput.value,
      game: gameInput.value,
    };

    console.log(data);

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
        teamsContainer.innerHTML = '';
        renderTeams(teams);
      });
  }
});

searchButton.addEventListener('click', function (_event) {
  const data = {
    title: titleInput.value,
    city: cityInput.value,
    game: gameInput.value,
  };

  console.log(data);

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
      console.log(teams);
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
            <button class="search-result__button" >More</button>
        </div>
    </article>
    `;
  teamsContainer.insertAdjacentHTML('beforeend', html);
}
