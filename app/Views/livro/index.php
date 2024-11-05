<div class="container">
    <h2>Livro</h2>
    <!-- Button do Modal -->
    <button type="button" class="btn btn-primary d-grid" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Novo
    </button>
    <br>
    <!-- Tabela de Usuario -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <table id="table" class="table table-responsive display responsive">
                <thead>
                    <tr>
                        <td class="">ID</td>
                        <td class="text-center">DISPONÍVEL</td>
                        <td class="text-center">STATUS</td>
                        <td class="text-center">TOMBAMENTO</td>
                        <td class="text-center">OBRA</td>
                        <td class="text-center">AÇÕES</td> <!-- Coluna de ações -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listaLivro as $li) : ?>
                    <tr>
                        <td class="">
                            <?= $li['id'] ?>
                        </td>
                        <td class="text-center">
                            <?php if ($li['status'] == 3): ?>
                            <span class="text-danger">Livro indisponível</span>
                            <?php else: ?>
                            <?= $statusdisponivel[$li['disponivel']] ?>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <span id="status-<?= $li['id'] ?>"
                                class="badge rounded-pill <?= $li['status'] == 2 ? 'bg-label-warning' : ($li['status'] == 1 ? 'bg-label-success' : 'bg-label-danger') ?> fw-bold">
                                <?= $status[$li['status']] ?>
                            </span>

                        </td>
                        <td class="text-center">
                            <?= $li['tombo'] ?>
                        </td>
                        <td class="text-center">
                            <?= $li['titulo'] ?>
                        <td class="text-center">
                            <div class="dropdown">
                                <a class="text-primary" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded'></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item text-info"
                                            href="<?= base_url('Livro/editar/' . $li['id']) ?>">
                                            <i class="fas fa-pen"></i> Editar
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-danger delete-link" data-id="<?= $li['id'] ?>"
                                            href="#">
                                            <i class="fas fa-trash"></i> Excluir
                                        </a>
                                        <r /li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <?= form_open("Livro/cadastrar") ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Livro</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="tombo">Tombamento:</label>
                        <input type="text" class="form-control" name="tombo" id="tombo" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="telefone">Obra:</label>
                        <select class='form-select' name="id_obra" id="id_obra" required>
                            <option>Selecione uma obra</option>
                            <?php foreach ($listaObra as $obra) : ?>
                            <?php if ($obra['livros_cadastrados'] < $obra['quantidade']) : // Apenas exibe se ainda tiver espaço 
                                ?>
                            <option value="<?= $obra['id'] ?>"><?= $obra['titulo'] ?></option>
                            <?php endif; ?>
                            <?php endforeach ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success">Cadastrar</button>
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>
<script>
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
</script>

<!-- Formulário de exclusão -->
<?php echo form_open('Livro/excluir', ['id' => 'formExcluir']); ?>
<input type="hidden" name="id" id="alunoId">
<?php echo form_close(); ?>

<!-- Modal de confirmação de exclusão -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza de que deseja excluir este livro?
            </div>
            <div class="modal-footer">
                <button type="button" id="confirmDeleteBtn" class="btn btn-outline-danger">Excluir</button>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
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
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Verifica o status e atualiza a classe do span
    document.querySelectorAll('[id^="status-"]').forEach(span => {
        const statusText = span.innerText.trim();
        if (statusText === 'Rasgado') {
            span.className = 'badge rounded-pill bg-label-warning fw-bold';
        } else if (statusText === 'Perdido') {
            span.className = 'badge rounded-pill bg-label-danger fw-bold';
        } else if (statusText === 'Integro') {
            span.className = 'badge rounded-pill bg-label-success fw-bold';
        }
        // Adicione outras condições conforme necessário
    });
});
</script>
<style>
/* Estilos para o Select2 */
.select2-container--bootstrap .select2-selection--single {
    border: 1px solid #ced4da;
    /* Borda padrão do Bootstrap */
    border-radius: .375rem;
    /* Alinha com o border-radius do Bootstrap */
    height: calc(2.25rem + 2px);
    /* Altura do input do Bootstrap */
    min-width: 100%;
    /* Garante que o Select2 ocupe toda a largura disponível */
}

.select2-container--bootstrap .select2-selection--single .select2-selection__rendered {
    line-height: 2.25rem;
    /* Alinha o texto verticalmente */
}

.select2-container--bootstrap .select2-selection--single .select2-selection__arrow {
    height: calc(2.25rem + 2px);
    /* Altura do arrow */
    right: 10px;
    /* Ajusta a posição do ícone da seta */
}

/* Adiciona altura máxima ao dropdown com rolagem */
.select2-results {
    max-height: 200px;
    /* Altura máxima do dropdown */
    overflow-y: auto;
    /* Ativa a rolagem vertical */
}

/* Customização adicional */
.custom-select {
    position: relative;
}

.custom-select select {
    padding-right: 30px;
    /* Espaço para a seta */
    height: calc(2.25rem + 2px);
    /* Garantindo a mesma altura que os inputs do Bootstrap */
    width: 100%;
    /* Garante que o Select2 ocupe toda a largura do container */
}

.custom-select::after {
    content: '▼';
    /* Seta para baixo */
    position: absolute;
    right: 10px;
    /* Espaçamento da borda direita */
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    /* Para não interferir no clique */
    color: #6c757d;
    /* Cor padrão do Bootstrap */
}
</style>