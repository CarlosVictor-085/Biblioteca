document.addEventListener('DOMContentLoaded', function() {
    // Seletor para todos os campos de select com a classe 'form-select'
    var selects = document.querySelectorAll('.form-select');

    selects.forEach(function(select) {
        // Cria a opção de texto padrão
        var defaultOption = document.createElement('option');
        defaultOption.value = ''; // Valor vazio
        defaultOption.disabled = true; // Desabilitado
        defaultOption.selected = true; // Selecionado por padrão
        defaultOption.textContent = 'Selecione uma opção'; // Texto a ser exibido

        // Adiciona a opção padrão ao select
        select.prepend(defaultOption);
    });

    // Adiciona o required a todos os inputs e selects da classe 'form-control'
    var inputsAndSelects = document.querySelectorAll('.form-control, .form-select');
    inputsAndSelects.forEach(function(element) {
        element.setAttribute('required', 'required');
    });
});