$(document).ready(function () {
    // Função para inicializar o Select2
    function initializeSelect2() {
        // Inicializa o Select2 em todos os selects com a classe form-select
        $('.form-select').select2({
            theme: 'bootstrap',
            dropdownAutoWidth: true, // Permite que a largura do dropdown seja automática
            width: '100%', // Garante que o Select2 tenha largura total
            placeholder: "Selecione uma opção", // Placeholder padrão
            language: "pt-BR"
        });
    }
    // Inicializa o Select2 quando o documento está pronto
    initializeSelect2();
    // Inicializa o Select2 quando o modal é exibido
    $('#exampleModal').on('shown.bs.modal', function () {
        // Garante que o Select2 funcione dentro do modal
        $('#exampleModal .form-select').select2({
            dropdownParent: $('#exampleModal'), // Garante que o dropdown apareça dentro do modal
            width: '100%', // Garante que o Select2 tenha largura total
            dropdownAutoWidth: true, // Permite que a largura do dropdown seja automática
            placeholder: "Selecione uma opção",
            theme: 'bootstrap',
            language: "pt-BR",
            dropdownPosition: 'above'
            // Permite que o usuário limpe a seleção
        });
    });
    // Garante que o dropdown não mude de posição ao ser clicado
    $('.form-select').on('select2:open', function () {
        $.fn.modal.Constructor.prototype._enforceFocus = function() {}; // Desativa o foco forçado do modal
    });
});
