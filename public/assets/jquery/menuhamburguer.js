document.addEventListener('DOMContentLoaded', () => {
  const menuToggle = document.getElementById('menuToggle');
  const layoutMenuToggle = document.querySelector('.layout-menu-toggle.menu-link');
  const htmlElement = document.documentElement;

  // Função para alternar a classe
  function toggleMenu() {
    htmlElement.classList.toggle('layout-menu-expanded');
    console.log('Class toggled:', htmlElement.classList.contains('layout-menu-expanded'));
  }

  // Adicionar o evento de clique ao botão de alternância de menu
  if (menuToggle) {
    console.log('Menu toggle button found.');
    menuToggle.addEventListener('click', toggleMenu);
  } else {
    console.log('Menu toggle button not found.');
  }

  // Adicionar o evento de clique ao novo link
  if (layoutMenuToggle) {
    console.log('Layout menu toggle link found.');
    layoutMenuToggle.addEventListener('click', () => {
      // Verifica se a classe está presente e remove se estiver
      if (htmlElement.classList.contains('layout-menu-expanded')) {
        htmlElement.classList.remove('layout-menu-expanded');
        console.log('Class removed.');
      } else {
        console.log('Class not present.');
      }
    });
  } else {
    console.log('Layout menu toggle link not found.');
  }
});