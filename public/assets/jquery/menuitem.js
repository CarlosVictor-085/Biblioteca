document.addEventListener('DOMContentLoaded', function () {
    // Função para lidar com o evento de clique nos links do menu
    function handleMenuItemClick(event) {
        event.preventDefault(); // Prevenir o comportamento padrão do link

        // Obter o link do menu clicado
        const menuLink = event.currentTarget;
        const menuItem = menuLink.closest('.menu-item');

        // Remover a classe 'active' de todos os itens do menu
        document.querySelectorAll('.menu-item').forEach(item => {
            item.classList.remove('active');
        });

        // Adicionar a classe 'active' ao <li> do item de menu clicado
        if (menuItem) {
            menuItem.classList.add('active');
            // Armazenar a URL do item ativo no sessionStorage
            sessionStorage.setItem('activeMenuItem', menuLink.getAttribute('href'));
        }

        // Navegar para o link após definir o estado ativo
        setTimeout(() => {
            window.location.href = menuLink.getAttribute('href');
        }, 100); // Pequeno atraso para garantir a atualização da classe
    }

    // Função para definir o item ativo ao carregar a página
    function setActiveMenuItem() {
        const activeItemUrl = sessionStorage.getItem('activeMenuItem');
        if (activeItemUrl) {
            document.querySelectorAll('.menu-link').forEach(link => {
                if (link.getAttribute('href') === activeItemUrl) {
                    link.closest('.menu-item').classList.add('active');
                }
            });
        }
    }

    // Função para lidar com o evento de clique para um item específico do menu
    function handleSpecialMenuItemClick(event) {
        event.preventDefault(); // Prevenir o comportamento padrão do link

        // Remover a classe 'active' de todos os itens do menu
        document.querySelectorAll('.menu-item').forEach(item => {
            item.classList.remove('active');
        });

        // Limpar o item ativo do sessionStorage
        sessionStorage.removeItem('activeMenuItem');

        // Redirecionar para a URL especificada
        window.location.href = baseUrl + 'Home/index';

        // Adicionar a classe 'active' ao item do menu Home
        const homeMenuItem = document.querySelector('a[href="' + baseUrl + 'Home/index' + '"]').closest('.menu-item');
        if (homeMenuItem) {
            homeMenuItem.classList.add('active');
        }
    }

    // Adicionar listeners de clique a todos os links do menu
    document.querySelectorAll('.menu-link').forEach(link => {
        link.addEventListener('click', handleMenuItemClick);
    });

    // Adicionar listener de clique para o item específico do menu
    const specialMenuItem = document.getElementById('menuitem');
    if (specialMenuItem) {
        specialMenuItem.addEventListener('click', handleSpecialMenuItemClick);
    }

    // Definir o item ativo ao carregar a página
    setActiveMenuItem();

    // Adicionar listener de clique ao link de logout para limpar o sessionStorage
    const logoutLink = document.querySelector('.dropdown-item[href="' + logoutUrl + '"]');
    if (logoutLink) {
        logoutLink.addEventListener('click', function () {
            sessionStorage.clear(); // Limpar todos os dados do sessionStorage
        });
    }

    // Função para verificar a expiração da sessão
    function checkSessionExpiration() {
        fetch(baseUrl + 'Auth/checkSession') // Substituir pela rota que verifica a sessão
            .then(response => response.json())
            .then(data => {
                if (!data.session_active) {
                    sessionStorage.clear(); // Limpar sessionStorage se a sessão expirar
                    window.location.href = logoutUrl; // Redirecionar para o logout
                }
            })
            .catch(error => console.error('Erro ao verificar a sessão:', error));
    }

    // Verificar a expiração da sessão a cada 5 minutos (300000 ms)
    setInterval(checkSessionExpiration, 300000); // 300000 ms = 5 minutos
});
