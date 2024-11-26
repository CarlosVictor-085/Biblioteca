<div class="container p-5">
    <div class="card shadow mb-4">
        <div class="card-body">
            <?= form_open('Usuario/salvar') ?>
            <input value='<?= $usuario['id'] ?>' class='form-control' type="hidden" id='id' name='id'>
            <div class="row p-2">
                <div class="col-2">
                    <label class="form-label" for="nome">Nome:</label>
                </div>
                <div class="col-10">
                    <input value='<?= $usuario['nome'] ?>' class='form-control' type="text" id='nome' name='nome'>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-2">
                    <label class="form-label" for="nome">Email:</label>
                </div>
                <div class="col-10">
                    <input value='<?= $usuario['email'] ?>' class='form-control' type="email" id='email' name='email'>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-2">
                    <label class="form-label" for="telefone">Telefone:</label>
                </div>
                <div class="col-10">
                    <input value='<?= $usuario['telefone'] ?>' class='form-control' type="text" id='telefone'
                        name='telefone'>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-2">
                    <label class="form-label" for="nome">Tipo De Usuario</label>
                </div>
                <div class="col-10">
                    <select class='form-select' name="tipo_usuario" id="tipo_usuario" required>
                        <?= $tipousuario[$usuario['tipo_usuario']] ?>
                        <?php foreach ($tipousuario as $chave => $valor) : ?>
                        <option value="<?= $chave ?>"><?= $valor ?></option>
                        <?php endforeach ?>
                        </option>
                    </select>
                </div>
            </div>
            <div class="row p-2">
                <div class="col-2">
                    <label class="form-label" for="telefone">Atualizar Senha:</label>
                </div>
                <div class="col-10">
                    <a href="<?= base_url('Usuario/senha/' . $usuario['id']) ?>" class="btn btn-primary">
                        Editar
                    </a>
                </div>
            </div>
            <div class="row p-4">
                <div class="col">
                    <div class="btn-group w-100" role="group">
                        <a href='<?= base_url('Usuario/index') ?>' class="btn btn-outline-secondary m-1">Cancelar</a>
                        <button type="submit" class="btn btn-outline-success m-1">Salvar</button>
                        <button type="button" class="btn btn-outline-danger m-1" id="openCard">
                            Excluir
                        </button>
                    </div>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
    <div class="card" id="deleteCard" style="display: none;">
        <h5 class="card-header">Deletar a Conta</h5>
        <div class="card-body">
            <div class="mb-3 col-12 mb-0">
                <div class="alert alert-warning">
                    <h6 class="alert-heading fw-bold mb-1">
                        Tem certeza de que deseja excluir a conta?
                    </h6>
                    <p class="mb-0">Depois de excluir a conta, não há como voltar atrás. Por favor, tenha certeza.</p>
                </div>
            </div>
            <form id="formAccountDeactivation" action="<?= base_url('Usuario/excluir') ?>" method="POST">
                <?= csrf_field() ?>
                <!-- Campo CSRF gerado automaticamente -->
                <!-- Campo oculto para o ID -->
                <input type="hidden" name="id" value="<?= $usuario['id'] ?>">
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
                    <label class="form-check-label" for="accountActivation">
                        Confirmo a desativação da minha conta</label>
                </div>
                <button type="submit" class="btn btn-danger deactivate-account disabled" id="deactivateButton"
                    style="pointer-events: none; opacity: 0.6;">
                    Desativar conta
                </button>
            </form>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const openCardButton = document.getElementById("openCard");
    const deleteCard = document.getElementById("deleteCard");
    const checkbox = document.getElementById("accountActivation");
    const deactivateButton = document.getElementById("deactivateButton");
    // Mostrar o card ao clicar no botão "Excluir"
    openCardButton.addEventListener("click", function() {
        deleteCard.style.display = "block";
    });
    // Habilitar/desabilitar o botão "Desativar conta" com base na checkbox
    checkbox.addEventListener("change", function() {
        if (checkbox.checked) {
            deactivateButton.classList.remove("disabled");
            deactivateButton.style.pointerEvents = "auto";
            deactivateButton.style.opacity = "1";
        } else {
            deactivateButton.classList.add("disabled");
            deactivateButton.style.pointerEvents = "none";
            deactivateButton.style.opacity = "0.6";
        }
    });
});
</script>