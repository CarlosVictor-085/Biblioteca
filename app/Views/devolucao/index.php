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