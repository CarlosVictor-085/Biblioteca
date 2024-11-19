<div class="container p-5">
    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_open('Obra/salvar') ?>
            <input value='<?= $obra['obra_id'] ?>' type="hidden" class='form-control' id='id' name='id'>
            <div class="row p-2">
                <div class="col-2">
                    <label class="form-label" for="nome">Titulo</label>
                </div>
                <div class="col-10">
                    <input value='<?= $obra['titulo'] ?>' class='form-control' type="text" id='titulo' name='titulo'
                        required>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-2">
                    <label class="form-label" for="nome">Categoria</label>
                </div>
                <div class="col-10">
                    <input value='<?= $obra['categoria'] ?>' class='form-control' type="text" id='categoria'
                        name='categoria' required>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-2">
                    <label class="form-label" for="nome">Ano</label>
                </div>
                <div class="col-10">
                    <input value='<?= $obra['ano_publicacao'] ?>' class='form-control' type="text" id='ano_publicacao'
                        name='ano_publicacao' required>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-2">
                    <label class="form-label" for="isbn">ISBN</label>
                </div>
                <div class="col-10">
                    <input value='<?= $obra['isbn'] ?>' class='form-control' type="text" id='isbn' name='isbn' required>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-2">
                    <label class="form-label" for="editora">Editora</label>
                </div>
                <div class="col-10">
                    <select class='form-select' name="id_editora" id="id_editora" required>
                        <option value="<?= $obra['id_editora'] ?>" hidden><?= $obra['nome'] ?></option>
                        <?php foreach ($editora as $ed) : ?>
                            <option value="<?= $ed['id'] ?>" <?= ($ed['id'] == $obra['id_editora']) ? 'selected' : '' ?>>
                                <?= $ed['nome'] ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="row p-2">
                <div class="col-2">
                    <label class="form-label" for="isbn">Quantidade</label>
                </div>
                <div class="col-10">
                    <input value='<?= $obra['quantidade'] ?>' class='form-control' type="number" id='quantidade'
                        name='quantidade' min="1" required>
                </div>
            </div>
            <div id="tomboContainer" class="row p-2"></div>
            <div class="col-10">
                <?php
                // Mapeia os autores por ID
                $autor = [];
                foreach ($listaAutor as $a) {
                    $autor[$a['id']] = $a['nome'];
                }
                ?>
                <div class="d-flex justify-content-center">
                    <div class="card mb-3" style="width: 70%; max-width: 700px;">
                        <div class="card-body">
                            <h5 class="card-title">Autores da Obra</h5>
                            <?php if (!empty($listaAutorObra)): ?>
                                <?php foreach ($listaAutorObra as $lao): ?>
                                    <?php if ($lao['id_obra'] == $obra['obra_id']): // Verifica se o id_obra corresponde 
                                    ?>
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div><?= htmlspecialchars($autor[$lao['id_autor']]) ?></div>
                                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal" data-id="<?= $lao['id'] ?>">
                                                Excluir
                                            </button>
                                        </div>
                                    <?php else: ?>
                                        <div id="noAuthorMessage" style="display: none;">
                                            <p>Nenhum autor encontrado para esta obra.</p>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Nenhum autor encontrado para esta obra.</p>
                            <?php endif; ?> <div class="mt-3">
                                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Adicionar...
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-4">
                <div class="col">
                    <div class="btn-group w-100" role="group">
                        <a href='<?= base_url('Obra/index') ?>' class="btn btn-outline-secondary m-1">Cancelar</a>
                        <button type="submit" class="btn btn-outline-success m-1">Salvar</button>
                        <button type="button" class="btn btn-outline-danger m-1" data-bs-toggle="modal"
                            data-bs-target="#exampleModalexcluir">
                            Excluir
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>

<!-- Modal De Excluir-->
<?= form_open('Obra/excluir') ?>
<input value='<?= $obra['obra_id'] ?>' class='form-control' type="hidden" id='id' name='id'>
<div class="modal fade" id="exampleModalexcluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Você tem certeza que deseja excluir: <br>ID: <?= $obra['obra_id'] ?><br>Titulo:
                <?= $obra['titulo'] ?><br>Ano: <?= $obra['ano_publicacao'] ?><br>ISBN:
                <?= $obra['isbn'] ?><br>
                Editora:
                <?= $obra['nome'] ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-outline-danger">Excluir</button>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>

<!-- Modal De Autores-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?= form_open('Obra/adicionarAutor') ?>
    <input value='<?= $obra['obra_id'] ?>' class='form-control' type="hidden" id='id_obra' name='id_obra'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Lista de Autores</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="autor">Autores:</label>
                    <select class='form-select' name="id_autor" id="id_autor" required>
                        <option>Selecione</option>
                        <?php foreach ($listaAutor as $autor) : ?>
                            <option value="<?= $autor['id'] ?>"><?= $autor['nome'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-outline-success">Salvar</button>
            </div>
        </div>
    </div>
    <?= form_close() ?>
</div>
<!-- Modal de Confirmação de Exclusão -->
<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmação de Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza que deseja excluir este autor?
            </div>
            <div class="modal-footer">
                <?= form_open('Obra/excluir_autor') ?>
                <!-- Ajuste para a rota que vai realizar a exclusão -->
                <input type="hidden" name="id" id="deleteId"> <!-- Input oculto para o ID genérico -->
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-outline-danger">Excluir</button>
                <?= form_close() ?>
                <!-- Fechamento do formulário -->
            </div>
        </div>
    </div>
</div>

<script>
    // Passa a quantidade de livros existentes e tombos existentes do PHP para o JavaScript
    var livrosExistentes = <?= isset($quantidadeExistente) ? $quantidadeExistente : 0 ?>;
    var tombosExistentes = <?= json_encode($tombosExistentes) ?>; // Se você também tem os tombos existentes
    document.addEventListener('DOMContentLoaded', function() {
        var quantidadeInput = document.getElementById('quantidade');

        var container = document.getElementById('tomboContainer');



        if (quantidadeInput) {

            quantidadeInput.addEventListener('input', function() {

                var quantidadeTotal = parseInt(this.value);

                var quantidadeFaltante = quantidadeTotal -

                    livrosExistentes; // livrosExistentes agora está definido



                // Limpa os campos de tombo anteriores

                container.innerHTML = '';



                if (!isNaN(quantidadeFaltante) && quantidadeFaltante > 0) {

                    for (var i = 1; i <= quantidadeFaltante; i++) {

                        // Cria o div row p-2 fora do container principal

                        var rowDiv = document.createElement('div');

                        rowDiv.className = 'row p-2';



                        // Cria o label para o campo de tombo

                        var labelDiv = document.createElement('div');

                        labelDiv.className = 'col-2';



                        var label = document.createElement('label');

                        label.className = 'form-label';

                        label.setAttribute('for', 'tombo' + i);

                        label.innerHTML = 'Tombamento ' + (i + livrosExistentes) + ':';



                        labelDiv.appendChild(label);



                        // Cria o input para o tombo

                        var inputDiv = document.createElement('div');

                        inputDiv.className = 'col-10';



                        var input = document.createElement('input');

                        input.className = 'form-control';

                        input.type = 'text';

                        input.name = 'tombo[]';

                        input.id = 'tombo' + i;



                        // Adiciona o evento de input para verificar duplicatas

                        input.addEventListener('input', verificarDuplicatas);



                        inputDiv.appendChild(input);



                        // Adiciona o label e o input ao div row

                        rowDiv.appendChild(labelDiv);

                        rowDiv.appendChild(inputDiv);



                        // Adiciona o rowDiv ao container principal

                        container.appendChild(rowDiv);

                    }

                }

            });

        } else {

            console.error('Elemento #quantidade não encontrado.');

        }



        // Função para verificar duplicatas de tombamento

        function verificarDuplicatas() {

            var tombos = document.querySelectorAll("input[name='tombo[]']");

            var valoresDigitados = [];

            var hasDuplicate = false;



            tombos.forEach(function(tombo) {

                var valor = tombo.value.trim();



                // Verifica se o valor é duplicado ou já existe no banco

                if (valor !== '' && (valoresDigitados.includes(valor) || tombosExistentes

                        .includes(

                            valor))) {

                    tombo.classList.add('is-invalid'); // Destaca o campo com duplicata

                    hasDuplicate = true;

                } else {

                    tombo.classList.remove(

                        'is-invalid'); // Remove o destaque se não for duplicata

                    valoresDigitados.push(

                        valor); // Adiciona o valor ao array de valores digitados

                }

            });



            // Desabilita o botão de envio se houver duplicatas

            var submitButton = document.querySelector("button[type='submit']");

            if (submitButton) {

                submitButton.disabled = hasDuplicate;

            } else {

                console.error('Botão de envio não encontrado.');

            }

        }



        // Debugging - Verificando os valores passados pelo PHP

        console.log('Tombos Existentes:', tombosExistentes);

        console.log('Quantidade Existente:', livrosExistentes);

    });
</script>

<script>
    // Script para passar o ID genérico para o formulário de exclusão

    const confirmDeleteModal = document.getElementById('confirmDeleteModal');

    confirmDeleteModal.addEventListener('show.bs.modal', event => {

        const button = event.relatedTarget; // Botão que acionou o modal

        const id = button.getAttribute('data-id'); // Extrai o ID (genérico)

        const deleteId = document.getElementById('deleteId'); // Campo oculto no modal

        deleteId.value = id; // Define o valor do ID genérico

    });
</script>

<script>
    $(document).ready(function() {

        // Verifica se há algum autor

        var hasAuthors = <?= json_encode(isset($lao['id_obra']) && $lao['id_obra'] == $obra['obra_id']) ?>;



        if (!hasAuthors) {

            $('#noAuthorMessage').show(); // Mostra a mensagem se não houver autores

        }

    });
</script>