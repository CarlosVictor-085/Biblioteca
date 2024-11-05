document.addEventListener('DOMContentLoaded', function () {
    const emailInput = document.getElementById('email');
    const domain = 'gmail.com';

    emailInput.addEventListener('input', function () {
        let userInput = emailInput.value;
        
        // Verifica se o usuário digitou "@" e se o domínio ainda não foi adicionado
        if (userInput.includes('@') && !userInput.includes('@' + domain)) {
            const atIndex = userInput.indexOf('@');
            // Limita o nome de usuário a 27 caracteres antes do "@"
            const username = userInput.slice(0, atIndex).slice(0, 27);
            emailInput.value = username + '@' + domain;
        }

        // Limita o nome de usuário a 27 caracteres, se já houver o "@gmail.com"
        if (userInput.includes('@' + domain)) {
            const atIndex = userInput.indexOf('@');
            const username = userInput.slice(0, atIndex).slice(0, 27);
            emailInput.value = username + '@' + domain;
        }
    });

    // Bloqueia a edição do domínio
    emailInput.addEventListener('keydown', function (event) {
        const userInput = emailInput.value;
        if (userInput.includes('@' + domain) && emailInput.selectionStart >= userInput.indexOf('@')) {
            event.preventDefault();
        }
    });
});

