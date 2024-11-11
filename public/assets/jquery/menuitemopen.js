document.addEventListener("DOMContentLoaded", function() {
    // Seleciona o elemento <li> com o ID específico
    const menuItem = document.getElementById("meuMenuItem");

    if (menuItem) {
        menuItem.addEventListener("click", function(event) {
            // Alterna entre "menu-item" e "menu-item open" ao clicar
            if (menuItem.classList.contains("open")) {
                menuItem.classList.remove("open");
            } else {
                menuItem.classList.add("open");
            }

            // Se o link dentro do item for clicado, ele abrirá em nova aba (target="_blank")
            const link = menuItem.querySelector("a");
            if (link) {
                // Garantir que o link será aberto em uma nova aba
                link.target = "_blank";
            }
        });
    }
});
