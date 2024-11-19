<div class="container">
    <h2>Aluno</h2>
    <!-- Button do Modal de Cadastro de Aluno -->
    <button type="button" class="btn btn-primary d-grid" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Novo
    </button>
    <br>
    <!-- Tabela de Aluno -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <table id="table" class="table table-responsive display responsive">
                <thead>
                    <tr>
                        <td class=" text-start">ID</td>
                        <td class="text-center">NOME</td>
                        <td class="text-center">CPF</td>
                        <td class="text-center">EMAIL</td>
                        <td class="text-center">TELEFONE</td>
                        <td class="text-center">TURMA</td>
                        <td class="text-center">AÇÕES</td> <!-- Coluna para ações -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listaAlunos as $au) : ?>
                    <tr>
                        <td class="text-start">
                            <?= $au['id'] ?>
                        </td>
                        <td class="text-center">
                            <?= $au['nome'] ?>
                        </td>
                        <td class="text-center">
                            <?= $au['cpf'] ?>
                        </td>
                        <td class="text-center">
                            <?= $au['email'] ?>
                        </td>
                        <td class="text-center">
                            <?= $au['telefone'] ?>
                        </td>
                        <td class="text-center">
                            <?= $au['turma'] ?>
                        </td>
                        <td class="text-center">
                            <div class="dropdown">
                                <a class="text-primary" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded'></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item text-info"
                                            href="<?= base_url('Aluno/editar/' . $au['id']) ?>">
                                            <i class="fas fa-pen"></i> Editar
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-danger delete-link" data-id="<?= $au['id'] ?>"
                                            href="#">
                                            <i class="fas fa-trash"></i> Excluir
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-warning"
                                            href="<?= base_url('Aluno/gerarRelatorioPDF/' . $au['id']) ?>"
                                            target="_blank">
                                            <i class="fas fa-file-pdf"></i> Gerar Relatório de Empréstimos do Aluno
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

    <!-- Modal de Cadastro de Aluno -->
    <div class="modal fade" id="exampleModal" tabindex="-1D" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <?= form_open("Aluno/cadastrar") ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Aluno</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="cpf">CPF:</label>
                        <input class='form-control' type="text" id='cpf' name='cpf' required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="nome">Nome:</label>
                        <input class='form-control' type="text" id='nome' name='nome'>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="e-mail">Email:</label>
                        <input class='form-control' type="text" id='email' name='email'>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="telefone">Telefone:</label>
                        <input class='form-control' type="text" id='telefone' name='telefone'>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="turma">Turma:</label>
                        <select class='form-select' name="turma" id="turma">
                            <option hidden>Selecione Uma Turma...</option>
                            <option value="1A">1A</option>
                            <option value="1B">1B</option>
                            <option value="1C">1C</option>
                            <option value="1D">1D</option>
                            <option value="2A">2A</option>
                            <option value="2B">2B</option>
                            <option value="2C">2C</option>
                            <option value="2D">2D</option>
                            <option value="3A">3A</option>
                            <option value="3B">3B</option>
                            <option value="3C">3C</option>
                            <option value="3D">3D</option>
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

<!-- Formulário de exclusão de Aluno-->
<?php echo form_open('Aluno/excluir', ['id' => 'formExcluir']); ?>
<input type="hidden" name="id" id="alunoId">
<?php echo form_close(); ?>
<!-- Modal de confirmação de exclusão de Aluno-->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza de que deseja excluir este aluno?
            </div>
            <div class="modal-footer">
                <button type="button" id="confirmDeleteBtn" class="btn btn-outline-danger">Excluir</button>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/jquery/exclusaodealuno.js') ?>"></script>
<script src="<?= base_url('assets/jquery/selectrequest.js') ?>"></script>