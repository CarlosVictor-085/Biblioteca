<div class="container p-5">
    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_open('Emprestimo/salvar') ?>
            <input value='<?= $emprestimo['id'] ?>' class='form-control' type="hidden" id='id' name='id'>
            <input value='<?= $emprestimo['id_livro'] ?>' type="hidden" name='id_livro_antigo' id='id_livro_antigo'>
            <div class="row p-2">
                <div class="col-2">
                    <label for="data_inicio">Data de Inicio:</label>
                </div>
                <div class="col-10">
                    <input value="<?= $emprestimo['data_inicio_formatada'] ?>" class='form-control' type="date"
                        id='data_inicio' name='data_inicio'>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-2">
                    <label for="data_prazo">Prazo:</label>
                </div>
                <div class="col-10">
                    <input value='<?= $emprestimo['data_prazo'] ?>' class='form-control' type="text" id='data_prazo'
                        name='data_prazo'>
                </div>
            </div>
            <div class="row p-2">
                <?php
                foreach ($listaObra as $obra) {
                    $obras[$obra['id']] = $obra['titulo'];
                }
                ?>
                <div class="col-2">
                    <label for="telefone">Livro:</label>
                </div>
                <div class="col-10">
                    <select class='form-select' name="id_livro" id="id_livro" required>
                        <?php
                        // Itera sobre a lista de livros para criar as opções do select
                        foreach ($listaLivro as $livro) {
                            // Verifica se o livro atual é o selecionado
                            $selected = ($livro['id'] == $emprestimo['id_livro']) ? 'selected' : '';
                            // Exibe o tombo e o título da obra no select
                            echo "<option value=\"{$livro['id']}\" $selected>{$livro['tombo']} - {$obras[$livro['id_obra']]}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-2">
                    <label for="telefone">Aluno:</label>
                </div>
                <div class="col-10">
                    <select class='form-select' name="id_aluno" id="id_aluno" require>
                        <option value="">Escolha um aluno (opcional)</option>
                        <?php foreach ($listaAluno as $aluno) : ?>
                            <!-- Define a opção como selecionada se o ID do aluno corresponde ao ID no empréstimo -->
                            <option value="<?= $aluno['id'] ?>"
                                <?= ($aluno['id'] == $emprestimo['id_aluno']) ? 'selected' : '' ?>>
                                <?= $aluno['nome'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-2">
                    <label for="telefone">Usuario:</label>
                </div>
                <div class="col-10">
                    <input type="text" class="form-control" name="nome_usuario" id="nome_usuario"
                        value="<?= session()->get('nome') ?>" readonly>
                    <input type="hidden" name="id_usuario" value="<?= session()->get('id') ?>">
                </div>
            </div>
            <div class="row p-4">
                <div class="col">
                    <div class="btn-group w-100" role="group">
                        <a href='<?= base_url('Emprestimo/index') ?>' class="btn btn-outline-secondary m-1">Cancelar</a>
                        <button type="submit" class="btn btn-outline-success m-1">Salvar</button>
                        <button type="button" class="btn btn-outline-danger m-1" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Excluir
                        </button>
                    </div>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<!-- Modal De Excluir-->
<?= form_open('Emprestimo/excluir') ?>
<input value='<?= $emprestimo['id'] ?>' class='form-control' type="hidden" id='id' name='id'>
<input value='<?= $emprestimo['id_livro'] ?>' type="hidden" name='id_livro' id='id_livro'>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Você tem certeza que deseja excluir
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-danger">Excluir</button>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>