document.addEventListener('DOMContentLoaded', function () {
    const dropdownLink = document.querySelector('.nav-link.dropdown-toggle.hide-arrow');
    const dropdownMenu = document.querySelector('.dropdown-menu.dropdown-menu-end');

    if (dropdownLink && dropdownMenu) {
        dropdownLink.addEventListener('click', function (event) {
            event.preventDefault();

            const isExpanded = dropdownLink.classList.contains('show');

            if (isExpanded) {
                dropdownLink.setAttribute('aria-expanded', 'false');
                dropdownLink.classList.remove('show');
                dropdownMenu.classList.remove('show');
            } else {
                dropdownLink.setAttribute('aria-expanded', 'true');
                dropdownLink.classList.add('show');
                dropdownMenu.classList.add('show');
            }
        });

        // Função para ajustar a margem do dropdown
        function adjustDropdownMargin() {
            const windowWidth = window.innerWidth;

            // Ajusta a margem dependendo da largura da tela
            if (windowWidth < 768) { // Para telas menores que 768px
                dropdownMenu.style.marginRight = '250px'; // Ajuste conforme necessário
            } else {
                dropdownMenu.style.marginRight = '-150px'; // Ajuste conforme necessário
            }
        }

        // Adiciona o listener para o evento de redimensionamento
        window.addEventListener('resize', adjustDropdownMargin);
        
        // Chama a função no carregamento para garantir que a margem esteja correta
        adjustDropdownMargin();
    } else {
        console.error('O link ou o menu dropdown não foi encontrado no DOM.');
    }
});
