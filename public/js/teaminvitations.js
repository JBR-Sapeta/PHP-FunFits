const spinnerContainer = document.getElementById('spinner');
const notFoundContainer = document.getElementById('not-found');
const invitationsContainer = document.getElementById('invitations');

function getInvitations() {

  const teamId = window.location.href.split('teaminvitations/')[1];
  
  fetch(`/getteaminvitations/${teamId}`, {
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
      console.log(invitations);
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
  const html = `
    <article class="invitation">
        <picture class="invitation__picture">
            <img class="invitation__img" src="/public/uploads/avatars/${invitation.avatar}" alt="User">
        </picture>
        <div class="invitation__data">
            <div class="invitation__title">
                <h3>${invitation.username}</h3>
            </div>
            <div class="invitation__info">
                <p>
                <i class="fa-solid fa-user invitation__icon"></i>  
                    Name: <span class="invitation__span">${invitation.name}</span> 
                </p>
                <p>
                    <i class="fa-solid fa-user invitation__icon"></i>
                    Surname: <span class="invitation__span">${invitation.surname}</span> 
                </p>
                <p>
                    <i class="fa-solid fa-envelope invitation__icon"></i>
                    Email: <span class="invitation__span">${invitation.email}</span> 
                </p>
            </div>
        </div>

        <div class="invitation__status">
            <p>Status:</p>
            <span class="invitation__status--blue">"${invitation.status}"</span>
        </div>

        <div>   
            <form class="invitation__action" action="/acceptinvitation/${invitation.id}">
                <button type="submit" class="invitation__button invitation__button--green">Accept</button>
            </form>

            <form class="invitation__action" action="/rejectinvitation/${invitation.id}">
                <button type="submit" class="invitation__button">Reject</button>
            </form>
        </div>

    </article>
    `;
  invitationsContainer.insertAdjacentHTML('beforeend', html);
}

getInvitations();
