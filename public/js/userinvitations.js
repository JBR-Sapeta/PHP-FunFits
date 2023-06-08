const spinnerContainer = document.getElementById('spinner');
const notFoundContainer = document.getElementById('not-found');
const invitationsContainer = document.getElementById('invitations');

function getInvitations() {
  fetch('/getuserinvitations', {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
    },
  })
    .then(function (response) {
      return response.json();
    })
    .then(function (invitations) {
      hideSpinner();
      if (!invitations.length) {
        showNotFound();
      }
      renderInvitations(invitations);
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

function renderInvitations(invitations) {
  invitations.forEach((invitation) => {
    renderInvitation(invitation);
  });
}

function renderInvitation(invitation) {
  let claas = 'invitation__status--blue';

  if (invitation.status === 'Rejected') {
    claas = 'invitation__status--red';
  }

  if (invitation.status === 'Accepted') {
    claas = 'invitation__status--green';
  }

  const html = `
    <article class="invitation">
        <picture class="invitation__picture">
            <img class="invitation__img" src="/public/uploads/${invitation.image}" alt="Team">
        </picture>
        <div class="invitation__data">
            <div class="invitation__title">
            <h3>${invitation.title}</h3>
            </div>
            <div class="invitation__info">
            <p>
            <i class="fa-solid fa-basketball invitation__icon"></i>  
                Game: <span class="invitation__span">${invitation.game}</span> 
            </p>
            <p>
                <i class="fa-solid fa-users invitation__icon"></i>
                Members: <span class="invitation__span">${invitation.members}</span> 
            </p>
            <p>
                <i class="fa-sharp fa-solid fa-city invitation__icon"></i>
                City: <span class="invitation__span">${invitation.city}</span> 
            </p>
            </div>
        </div>

        <div class="invitation__status">
            <p>Status:</p>
            <span class="${claas}">"${invitation.status}"</span>
        </div>

        <form class="invitation__action" action="/deleteinvitation/${invitation.id}">
            <button type="submit" class="invitation__button">Delete</button>
        </form>

    </article>
    `;
  invitationsContainer.insertAdjacentHTML('beforeend', html);
}

getInvitations();
