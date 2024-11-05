document.addEventListener('DOMContentLoaded', function() {
    // Função para abrir o modal de confirmação e passar o ID do aluno
    function confirmarExclusao(id) {
        // Atribui o ID ao campo oculto do formulário
        document.getElementById('alunoId').value = id;

        // Exibir o modal de confirmação
        var confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'), {});
        confirmDeleteModal.show();

        // Quando o usuário confirmar a exclusão
        document.getElementById('confirmDeleteBtn').onclick = function() {
            // Submete o formulário para excluir
            document.getElementById('formExcluir').submit();
        };
    }

    // Listener para cliques nos links de exclusão
    document.querySelectorAll('.delete-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault(); // Prevenir o comportamento padrão
            const alunoId = this.getAttribute('data-id'); // Pega o ID do aluno
            confirmarExclusao(alunoId); // Chama a função de confirmação
        });
    });
});