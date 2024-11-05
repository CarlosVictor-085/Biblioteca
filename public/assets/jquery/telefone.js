document.addEventListener('DOMContentLoaded', function() {
    const telefoneInput = document.getElementById('telefone');

    telefoneInput.addEventListener('input', function(event) {
        let value = event.target.value;

        // Remove tudo que não é número
        value = value.replace(/\D/g, '');

        // Limita o número de dígitos a 11
        if (value.length > 11) {
            value = value.slice(0, 11);
        }

        // Aplica a máscara
        if (value.length > 10) {
            value = value.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
        } else if (value.length > 5) {
            value = value.replace(/^(\d{2})(\d{5})$/, '($1) $2-');
        } else if (value.length > 2) {
            value = value.replace(/^(\d{2})/, '($1) ');
        }

        // Define o valor formatado no campo
        event.target.value = value;
    });

    // Inicializa o campo com a máscara padrão
    telefoneInput.addEventListener('focus', function() {
        if (telefoneInput.value === '') {
            telefoneInput.value = '';
        }
    });
});
