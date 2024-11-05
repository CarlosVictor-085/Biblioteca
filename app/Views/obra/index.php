<div class="container">
    <h2>Obra</h2>
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
                        <td class="text-center">TÍTULO</td>
                        <td class="text-center">CATEGORIA</td>
                        <td class="text-center">ANO</td>
                        <td class="text-center">ISBN</td>
                        <td class="text-center">EDITORA</td>
                        <td class="text-center">QUANTIDADE</td>
                        <td class="text-center">AÇÕES</td> <!-- Coluna para ações -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listaObra as $ob) : ?>
                    <tr>
                        <td class="text-center"><?= $ob['id'] ?></td>
                        <td class="text-center"><?= $ob['titulo'] ?></td>
                        <td class="text-center"><?= $ob['categoria'] ?></td>
                        <td class="text-center"><?= $ob['ano_publicacao'] ?></td>
                        <td class="text-center"><?= $ob['isbn'] ?></td>
                        <td class="text-center"><?= $ob['nome'] ?></td>
                        <td class="text-center"><?= $ob['quantidade'] ?></td>
                        <td class="text-center">
                            <div class="dropdown">
                                <a class="text-primary" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-vertical-rounded'></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item text-info"
                                            href="<?= base_url('Obra/editar/' . $ob['id']) ?>">
                                            <i class="fas fa-pen"></i> Editar
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-danger delete-link" data-id="<?= $ob['id'] ?>"
                                            href="#">
                                            <i class="fas fa-trash"></i> Excluir
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-primary" href="#" data-bs-toggle="modal"
                                            data-bs-target="#modalAutores" data-id="<?= $ob['id'] ?>"
                                            onclick="setModalData(<?= $ob['id'] ?>)">
                                            <i class="fas fa-info-circle"></i> Detalhes sobre o Autor
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
        <?= form_open("Obra/cadastrar") ?>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nova Obra</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label" for="titulo">Titulo:</label>
                        <input class=' form-control' type="text" id='titulo' name='titulo' required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="categoria">Categoria:</label>
                        <input class='form-control' type="text" id='categoria' name='categoria' required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="ano">Ano:</label>
                        <input class='form-control' type="text" id='ano_publicacao' name='ano_publicacao' required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="isbn">ISBN:</label>
                        <input class='form-control' type="text" id='isbn' name='isbn' required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="telefone">EDITORA:</label>
                        <select class='form-select' name="id_editora" id="select-editor" required>
                            <?php foreach ($listaEditora as $ob) : ?>
                            <option value="<?= $ob['id'] ?>"><?= $ob['nome'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="isbn">Quantidade:</label>
                        <input class='form-control' type="number" id='quantidade' name='quantidade' min="1" max="100"
                            required>

                    </div>
                    <div class="form-group" id="tomboContainer"> </div>

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

<?php
// Mapeia os autores por ID
$autor = [];
foreach ($listaAutor as $a) {
    $autor[$a['id']] = $a['nome'];
}

// Mapeia os autores da obra
$autoresObra = [];
foreach ($listaAutorObra as $lao) {
    $autoresObra[] = [
        'id_autor' => $lao['id_autor'],
        'id_obra' => $lao['id_obra'],
        'id' => $lao['id'] // Presumindo que há um campo 'id' em autor_obra
    ];
}
?>

<!-- Modal para exibir os autores -->
<div class="modal fade" id="modalAutores" tabindex="-1" aria-labelledby="modalAutoresLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAutoresLabel">Autores da Obra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="obraId">
                <div id="listaAutoresModal"></div> <!-- Lista de autores que será preenchida via JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Formulário de exclusão -->
<?php echo form_open('Obra/excluir', ['id' => 'formExcluir']); ?>
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
                Tem certeza de que deseja excluir este obra?
            </div>
            <div class="modal-footer">
                <button type="button" id="confirmDeleteBtn" class="btn btn-outline-danger">Excluir</button>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<script>
function setModalData(id) {
    // Define o ID da obra no campo escondido
    document.getElementById('obraId').value = id;

    // Atualiza a lista de autores no modal
    const listaAutoresModal = document.getElementById('listaAutoresModal');
    listaAutoresModal.innerHTML = ''; // Limpa a lista antes de adicionar novos itens

    // Filtra e exibe os autores com base no ID da obra
    const autores = <?= json_encode($autoresObra) ?>; // Converte PHP para JavaScript
    const autorNome = <?= json_encode($autor) ?>; // Converte o mapeamento de autores para JavaScript

    // Filtra os autores que pertencem à obra com o ID fornecido
    let autoresEncontrados = autores.filter(lao => lao.id_obra == id);

    if (autoresEncontrados.length > 0) {
        autoresEncontrados.forEach(lao => {
            const div = document.createElement('div');
            div.classList.add('d-flex', 'justify-content-between', 'align-items-center', 'mb-2');
            div.innerHTML = `
                <div>${autorNome[lao.id_autor]}</div>
            `;
            listaAutoresModal.appendChild(div);
        });
    } else {
        listaAutoresModal.innerHTML = '<p>Nenhum autor encontrado para esta obra.</p>';
    }
}

// Adiciona um listener ao modal para definir os autores quando ele for aberto
$('#modalAutores').on('show.bs.modal', function(event) {
    const button = $(event.relatedTarget); // Botão que abriu o modal
    const id = button.data('id'); // Extraí o ID da obra do botão
    setModalData(id); // Define os dados do modal
});
</script>




<script>
document.getElementById('quantidade').addEventListener('input', function() {
    // Limitar a quantidade a um máximo de 100
    if (this.value > 100) {
        this.value = 100; // Define o valor máximo como 100
    }

    var quantidade = parseInt(this.value);
    var container = document.getElementById('tomboContainer');
    container.innerHTML = ''; // Limpa qualquer campo de tombo previamente adicionado

    if (!isNaN(quantidade) && quantidade > 0) {
        for (var i = 1; i <= quantidade; i++) {
            // Cria o rótulo do campo
            var label = document.createElement('label');
            label.className = 'form-label';
            label.setAttribute('for', 'tombo' + i);
            label.innerHTML = 'Tombamento ' + i + ':';

            // Cria o campo de input para o tombamento
            var input = document.createElement('input');
            input.className = 'form-control';
            input.type = 'text';
            input.name = 'tombo[]'; // Armazena os valores como um array
            input.id = 'tombo' + i;

            // Adiciona um evento de input para verificar duplicatas enquanto o usuário digita
            input.addEventListener('input', verificarDuplicatas);

            // Adiciona o campo de input ao container
            container.appendChild(label);
            container.appendChild(input);
        }
    }
});

// Função para verificar duplicatas de tombamento
function verificarDuplicatas() {
    var tombos = document.querySelectorAll("input[name='tombo[]']");
    var valores = [];
    var hasDuplicate = false;

    tombos.forEach(function(tombo) {
        var valor = tombo.value.trim();

        if (valor !== '' && valores.includes(valor)) {
            tombo.classList.add('is-invalid'); // Destaca o campo com duplicata
            hasDuplicate = true;
        } else {
            tombo.classList.remove('is-invalid'); // Remove o destaque se não for duplicata
            valores.push(valor);
        }
    });

    // Desabilita o botão de envio se houver duplicatas
    var submitButton = document.querySelector("button[type='submit']");
    submitButton.disabled = hasDuplicate;
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    var confirmModal = document.getElementById('confirmModal');
    var confirmDeleteButton = document.getElementById('confirmDelete');

    confirmModal.addEventListener('show.bs.modal', function(event) {
        // Link do botão que abriu o modal
        var button = event.relatedTarget;
        var url = button.getAttribute('data-url'); // Pega o URL do botão

        // Atualiza o link de exclusão no botão do modal
        confirmDeleteButton.setAttribute('href', url);
    });
});
</script>




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