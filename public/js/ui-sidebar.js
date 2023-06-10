const sidebar = document.getElementById('sidebar');
const sidebarContainer = document.getElementById('sidebar-container');
const openButton = document.getElementById('open-nav-btn');
const closeButton = document.getElementById('close-nav-btn');

class UISidebarView {
  constructor() {
    openButton.addEventListener('click', this._openSidebar);
    closeButton.addEventListener('click', this._closeSidebar);
  }

  _openSidebar() {
    closeButton.classList.add('navigation__button--acticve');
    openButton.classList.remove('navigation__button--acticve');
    sidebar.classList.add('sidenav--active');
  }

  _closeSidebar() {
    openButton.classList.add('navigation__button--acticve');
    closeButton.classList.remove('navigation__button--acticve');
    sidebar.classList.remove('sidenav--active');
  }
}

const sidebarNav = new UISidebarView();
