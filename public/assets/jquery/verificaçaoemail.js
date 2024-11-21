document.getElementById('email').addEventListener('blur', function() {
    const email = this.value;
    const emailErrorDiv = document.getElementById('emailError');

    // Verifique se o e-mail está vazio ou tem um formato inválido
    if (email === '' || !validateEmail(email)) {
        emailErrorDiv.textContent = 'E-mail inválido';  // Mensagem de erro personalizada
        emailErrorDiv.style.display = 'block';  // Mostra o erro
    } else {
        emailErrorDiv.style.display = 'none';  // Oculta o erro
    }
});

// Função para validar o formato do e-mail com domínios específicos
function validateEmail(email) {
    const regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    const allowedDomains = ['gmail.com', 'hotmail.com', 'outlook.com', 'yahoo.com'];  // Domínios permitidos
    const emailDomain = email.split('@')[1];  // Extrai o domínio do e-mail

    // Verifica se o formato é válido e se o domínio está na lista permitida
    return regex.test(email) && allowedDomains.includes(emailDomain);
}

// Impede o envio do formulário se o e-mail for inválido
document.getElementById('meuFormulario').addEventListener('submit', function(event) {
    const email = document.getElementById('email').value;
    const emailErrorDiv = document.getElementById('emailError');

    // Se o e-mail for inválido, impede o envio do formulário
    if (email === '' || !validateEmail(email)) {
        emailErrorDiv.textContent = 'E-mail inválido';  // Mensagem de erro personalizada
        emailErrorDiv.style.display = 'block';  // Mostra o erro
        event.preventDefault();  // Impede o envio do formulário
    } else {
        emailErrorDiv.style.display = 'none';  // Oculta o erro se válido
    }
});
