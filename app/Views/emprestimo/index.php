<div class="container">
    <h2>Emprestimo</h2>
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
                        <td class="text-center">ID</td>
                        <td class="text-center">DATA DE INÍCIO</td>
                        <td class="text-center">DATA DO FIM</td>
                        <td class="text-center">DATA DO PRAZO</td>
                        <td class="text-center">LIVRO</td>
                        <td class="text-center">ALUNO</td>
                        <td class="text-center">USUÁRIO</td>
                        <td class="text-center">DEVOLUÇÃO</td>
                        <td class="text-center">AÇÕES</td> <!-- Coluna de Ações -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listaEmprestimo as $em) : ?>
                        <tr>
                            <td class="text-center"><?= $em['emprestimo_id'] ?></td>
                            <td class="text-center"><?= $em['data_inicio_formatada'] ?></td>
                            <td class="text-center">
                                <?= !empty($em['data_fim_formatada']) ? $em['data_fim_formatada'] : 'Não definida'; ?></td>
                            <td class="text-center"><?= $em['data_prazo_formatada'] ?></td>
                            <td class="text-center"><?= $em['tombo'] ?> - <?= $em['nome_obra'] ?></td>
                            <td class="text-center"><?= $em['nome_aluno'] ?></td>
                            <td class="text-center"><?= $em['nome_usuario'] ?></td>
                            <td class="text-center">
                                <?php if ($em['status_devolucao'] === 'Livro perdido'): ?>
                                    <span class="text-danger"><?= $em['status_devolucao']; ?></span>
                                <?php elseif (empty($em['data_fim'])): ?>
                                    <?= anchor("Emprestimo/devolucao/" . $em['emprestimo_id'], "Devolução", ['class' => 'btn btn-dark']) ?>
                                <?php else: ?>
                                    <?= $em['status_devolucao'] ? $em['status_devolucao'] : 'Aguardando devolução'; ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <a class="text-primary" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class='bx bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item text-info"
                                                href="<?= base_url('Emprestimo/editar/' . $em['emprestimo_id']) ?>">
                                                <i class="fas fa-pen"></i> Editar
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-danger delete-link" href="#"
                                                data-id="<?= $em['emprestimo_id'] ?>" data-id-livro="<?= $em['id_livro'] ?>"
                                                data-bs-toggle="modal" data-bs-target="#confirmDeleteModal1"
                                                onclick="setModalData(this, '#confirmDeleteModal1')">
                                                <i class="fas fa-trash"></i> Excluir
                                            </a>
                                        </li>
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
        <?= form_open("Emprestimo/cadastrar") ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Emprestimo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                    foreach ($listaObra as $obra) {
                        $obras[$obra['id']] = $obra['titulo'];
                    }
                    ?>
                    <div class="form-group">
                        <label for="data_inicio">Data de Inicio:</label>
                        <input class='form-control' type="date" id='data_inicio' name='data_inicio'>
                    </div>
                    <div class="form-group">
                        <label for="data_prazo">Prazo:</label>
                        <input class='form-control' type="text" id='data_prazo' name='data_prazo'>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Livro:</label>
                        <select class='form-select' name="id_livro" id="id_livro" required>
                            <option>Selecione um Livro</option>
                            <?php foreach ($listaLivro as $livro) : ?>
                                <?php if ($livro['disponivel'] >= 1 && $livro['status'] != 3): ?>
                                    <option value="<?= $livro['id'] ?>">
                                        <?= $livro['tombo'] ?> -
                                        <?= isset($obras[$livro['id_obra']]) ? $obras[$livro['id_obra']] : 'Obra não encontrada' ?>
                                    </option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Aluno:</label>
                        <select class='form-select' name="id_aluno" id="id_aluno" required>
                            <option hidden>Selecione um Aluno</option>
                            <?php foreach ($listaAluno as $aluno) : ?>
                                <option value="<?= $aluno['id'] ?>"><?= $aluno['nome'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Usuario:</label>
                        <!-- Exibe o nome do usuário, mas o campo é somente leitura -->
                        <input type="text" class="form-control" name="nome_usuario" id="nome_usuario"
                            value="<?= session()->get('nome') ?>" readonly>
                        <!-- Campo oculto para enviar o ID do usuário -->
                        <input type="hidden" name="id_usuario" value="<?= session()->get('id') ?>">
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


<!-- Modal de Confirmação -->
<div class="modal fade" id="confirmDeleteModal1" tabindex="-1" aria-labelledby="confirmDeleteModalLabel1"
aria-hidden="true">
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel1">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Você tem certeza que deseja excluir este empréstimo?
            </div>

            <div class="modal-footer">
                <?= form_open('Emprestimo/excluir', ['id' => 'formExcluir']); ?>
                <input type="hidden" name="id" class="emprestimoId">
                <input type="hidden" name="id_livro" class="id_livro">
                <button type="submit" class="btn btn-outline-danger">Excluir</button>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>

<script>
    function setModalData(link, modalSelector) {
        // Obtém os valores do link de exclusão
        const emprestimoId = link.getAttribute('data-id');
        const idLivro = link.getAttribute('data-id-livro');
        // Define os valores no modal específico usando o seletor fornecido
        document.querySelector(`${modalSelector} .emprestimoId`).value = emprestimoId;
        document.querySelector(`${modalSelector} .id_livro`).value = idLivro;
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Adiciona o required a todos os inputs e selects da classe 'form-control'
        var inputsAndSelects = document.querySelectorAll('.form-control, .form-select');
        inputsAndSelects.forEach(function(element) {
            element.setAttribute('required', 'required');
        });
    });
</script>