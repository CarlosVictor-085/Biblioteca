<div class="container">

    <h2>Usuario</h2>

    <!-- Button do Modal De cadastro de usuario-->

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

                        <td class="text-center">NOME</td>

                        <td class="text-center">EMAIL</td>

                        <td class="text-center">TELEFONE</td>

                        <td class="text-center">TIPO DE USUARIO</td>

                        <td class="text-center">AÇÕES</td> <!-- Coluna de Ações -->

                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($listaUsuarios as $u) : ?>

                    <tr>

                        <td class="text-center">

                            <?= $u['id'] ?>

                        </td>

                        <td class="text-center">

                            <?= $u['nome'] ?>

                        </td>

                        <td class="text-center">

                            <?= $u['email'] ?>

                        </td>

                        <td class="text-center">

                            <?= $u['telefone'] ?>

                        </td>

                        <td class="text-center">

                            <?= $tipousuario[$u['tipo_usuario']] ?>

                        </td>

                        <td class="text-center">

                            <div class="dropdown">

                                <a class="text-primary" role="button" data-bs-toggle="dropdown" aria-expanded="false">

                                    <i class='bx bx-dots-vertical-rounded'></i>

                                </a>

                                <ul class="dropdown-menu">

                                    <li>

                                        <a class="dropdown-item text-info"
                                            href="<?= base_url('Usuario/editar/' . $u['id']) ?>">

                                            <i class="fas fa-pen"></i> Editar

                                        </a>

                                    </li>

                                    <li>

                                        <a class="dropdown-item text-danger delete-link" data-id="<?= $u['id'] ?>"
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

    <!-- Modal de cadastro de usuario-->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <?= form_open("Usuario/cadastrar") ?>

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">

                    <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Usuario</h1>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body">

                    <div class="form-group">

                        <label class="form-label" for="nome">Nome:</label>

                        <input class='form-control' type="text" id='nome' name='nome'>

                    </div>

                    <div class="form-group">

                        <label class="form-label" for="e-mail">Email:</label>

                        <input class='form-control' type="text" id='email' name='email'>

                    </div>

                    <div class="form-group">

                        <label class="form-label" for="e-mail">Tipo De Usuario:</label>

                        <select class='form-select' name="tipo_usuario" id="tipo_usuario" required>

                            <?php foreach ($tipousuario as $chave => $valor) : ?>

                            <option value="<?= $chave ?>"><?= $valor ?></option>

                            <?php endforeach ?>

                            </option>

                        </select>

                    </div>

                    <div class="form-group">

                        <label class="form-label" for="telefone">Telefone:</label>

                        <input class='form-control' type="text" id='telefone' name='telefone'>

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

<?php echo form_open('Usuario/excluir', ['id' => 'formExcluir']); ?>

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

                Tem certeza de que deseja excluir este usuario?

            </div>

            <div class="modal-footer">

                <button type="button" id="confirmDeleteBtn" class="btn btn-outline-danger">Excluir</button>

                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>

            </div>

        </div>

    </div>

</div>



<script src="<?= base_url('assets/jquery/exclusaodeusuario.js') ?>"></script>