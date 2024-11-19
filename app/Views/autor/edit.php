<div class="container p-5">
    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_open('Autor/salvar') ?>
            <input value='<?= $autor['id'] ?>' class='form-control' type="hidden" id='id' name='id'>
            <div class="row p-2">
                <div class="col-2">
                    <label class="form-label" for="nome">Nome:</label>
                </div>
                <div class="col-10">
                    <input value='<?= $autor['nome'] ?>' class='form-control' type="text" id='nome' name='nome'>
                </div>
            </div>
            <div class="row p-4">
                <div class="col form-group">
                    <div class="btn-group w-100" role="group">
                        <a href='<?= base_url('Autor') ?>' class="btn btn-outline-secondary m-1">Cancelar</a>
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

<!-- Modal de Exclusao de autor-->
<?= form_open('Autor/excluir') ?>
<input value='<?= $autor['id'] ?>' class='form-control' type="hidden" id='id' name='id'>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Excluir</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Você tem certeza que deseja excluir: <br>ID: <?= $autor['id'] ?><br>Nome: <?= $autor['nome'] ?>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-danger">Excluir</button>
                </div>
            </div>
        </div>
    </div>