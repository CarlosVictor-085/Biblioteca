document.addEventListener('DOMContentLoaded', function() {
    // Seleciona todos os campos com a classe 'form-control'
    const formControls = document.querySelectorAll('.form-control');

    // Adiciona o atributo 'required' a cada campo
    formControls.forEach(function(input) {
        input.setAttribute('required', 'required');
    });
});
