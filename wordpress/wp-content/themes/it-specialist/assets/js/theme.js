(() => {
  const toggle = document.querySelector('.menu-toggle');
  const nav = document.querySelector('.site-navigation');

  if (!toggle || !nav) {
    return;
  }

  toggle.addEventListener('click', () => {
    const isOpen = nav.classList.toggle('is-open');
    toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
  });
})();
