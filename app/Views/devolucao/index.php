<div class="container p-5">
    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_open('Emprestimo/salvardev') ?>
            <input value='<?= $emprestimo['id'] ?>' class='form-control' type="hidden" id='id' name='id'>
            <div class="row p-2">
                <div class="col-2">
                    <label for="data_fim">Data do Fim:</label>
                </div>
                <div class="col-10">
                    <input required value='<?= $emprestimo['data_fim'] ?>' class='form-control' type="date"
                        id='data_fim' name='data_fim'>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-2">
                    <label for="telefone">Livro:</label>
                </div>
                <div class="col-10">
                    <select class='form-select' name="id_livro" id="id_livro">
                        <?php
                // Cria um array associativo de ID para título de obra
                $obras = [];
                foreach ($listaObra as $obra) {
                    $obras[$obra['id']] = $obra['titulo'];
                }
                // Itera sobre a lista de livros para criar as opções do select
                foreach ($Livro as $livro) {
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
                    <label class="form-label" for="nome">Status</label>
                </div>

                <div class="col-10">
                    <select class='form-select' name="status" id="status" required>
                        <option value="<?= $livro['status'] ?>" hidden><?= $status[$livro['status']] ?>
                            <?php foreach ($status as $chave => $valor) : ?>
                        <option value="<?= $chave ?>"><?= $valor ?></option>
                        <?php endforeach ?>
                        </option>
                    </select>
                </div>
            </div>
            <div class="row p-4">
                <div class="col">
                    <div class="btn-group w-100" role="group">
                        <a href='<?= base_url('Emprestimo/index') ?>' class="btn btn-outline-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-outline-success">Salvar</button>
                    </div>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
// Desabilita a interação do usuário
document.getElementById('id_livro').addEventListener('mousedown', function(event) {
    event.preventDefault(); // Impede a interação
});
</script>