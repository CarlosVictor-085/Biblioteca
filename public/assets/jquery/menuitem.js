document.addEventListener('DOMContentLoaded', function () {

    // Função para lidar com o evento de clique nos links do menu
    function handleMenuItemClick(event) {
        event.preventDefault(); // Prevenir o comportamento padrão do link

        // Obter o link do menu clicado
        const menuLink = event.currentTarget;

        // Verificar se o item clicado é o menu com id "meuMenuItem"
        const menuItem = menuLink.closest('.menu-item');
        if (menuItem && menuItem.id === "meuMenuItem") {
            // Não fazer nada, pois este item não deve ser ativado
            return;
        }

        // Remover a classe 'active' de todos os itens do menu
        const allMenuItems = document.querySelectorAll('.menu-item');
        allMenuItems.forEach(item => {
            item.classList.remove('active');
        });

        // Adicionar a classe 'active' ao item de menu clicado
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
            const link = document.querySelector('.menu-link[href="' + activeItemUrl + '"]');
            if (link) {
                const menuItem = link.closest('.menu-item');
                if (menuItem) {
                    menuItem.classList.add('active');
                }
            }
        }
    }

    // Adicionar listeners de clique a todos os links do menu
    document.querySelectorAll('.menu-link').forEach(link => {
        link.addEventListener('click', handleMenuItemClick);
    });

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
