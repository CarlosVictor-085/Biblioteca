<div class="container">
    <h2>Autor</h2>
    <!-- Button do Modal de cadastro de autor-->
    <button type="button" class="btn btn-primary d-grid" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Novo
    </button>
    <br>
    <!-- Tabela de Autor -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <table id="table" class="table table-responsive display responsive">
                <thead>
                    <tr>
                        <td class="text-center">ID</td> 
                        <td class="text-center">NOME</td> 
                        <td class="text-center">AÇÕES</td> 
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listaAutor as $a) : ?>
                        <tr>
                            <td class="text-center">
                                <?= $a['id'] ?>
                            </td>
                            <td class="text-center">
                                <?= $a['nome'] ?>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <a class="text-primary" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class='bx bx-dots-vertical-rounded'></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item text-info"
                                                href="<?= base_url('Autor/editar/' . $a['id']) ?>">
                                                <i class="fas fa-pen"></i> Editar
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-danger delete-link" data-id="<?= $a['id'] ?>"
                                                href="#">
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

    <!-- Modal de cadastro de autor -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <?= form_open("Autor/cadastrar") ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Autor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="nome">Nome:</label>
                        <input class='form-control' type="text" id='nome' name='nome'>
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

<!-- Formulário de exclusão -->
<?php echo form_open('Autor/excluir', ['id' => 'formExcluir']); ?>
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
                Tem certeza de que deseja excluir este autor?
            </div>
            <div class="modal-footer">
                <button type="button" id="confirmDeleteBtn" class="btn btn-outline-danger">Excluir</button>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/jquery/exclusaodeautor.js') ?>"></script>