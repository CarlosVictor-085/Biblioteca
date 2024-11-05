<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php elseif (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="container p-5">
    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_open('Livro/salvar') ?>
            <input value='<?= $livro['id'] ?>' class='form-control' type="hidden" id='id' name='id'>
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
            <div class="row p-2">
                <div class="col-2">
                    <label class="form-label" for="nome">Tombamneto:</label>
                </div>
                <div class="col-10">
                    <input type="text" value="<?= $livro['tombo'] ?>" class="form-control" name="tombo" id="tombo">
                </div>
            </div>
            <div class="row p-2">
                <div class="col-2">
                    <label class="form-label" for="autores">Obra:</label>
                </div>
                <div class="col-10">
                    <select class='form-select' name="id_obra" id="id_obra" required>
                        <option value="<?= $livro['id_obra'] ?>" hidden><?= $livro['titulo'] ?></option>
                        <?php foreach ($obra as $ob) : ?>
                        <option value="<?= $ob['id'] ?>" <?= ($ob['id'] == $livro['id_obra']) ? 'selected' : '' ?>>
                            <?= $ob['titulo'] ?>
                        </option>
                        <?php endforeach ?>
                    </select>

                </div>
            </div>

            <div class="row p-4">
                <div class="col">
                    <div class="btn-group w-100" role="group">
                        <a href='<?= base_url('Livro/index') ?>' class="btn btn-outline-secondary m-1">Cancelar</a>
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
<?= form_open('Livro/excluir') ?>
<input value='<?= $livro['id'] ?>' class='form-control' type="hidden" id='id' name='id'>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Você tem certeza que deseja excluir: <br>ID: <?= $livro['id'] ?><br>Disponivel:
                <?= $livro['disponivel'] ?><br>Status: <?= $livro['status'] ?><br> Obra:
                <?= $livro['titulo'] ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-outline-danger">Excluir</button>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>
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