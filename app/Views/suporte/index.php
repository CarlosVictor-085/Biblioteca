<div class="container">
    <h1>Formulario De Suporte</h1>
    <br>
    <div class="card shadow mb-4">
        <div class="card-body">
            <!-- Formulário para enviar mensagem de suporte -->
            <?= form_open('Suporte/enviar') ?>

            <!-- Campo oculto para ID do usuário (opcional) --

            <!-- Campo para Nome -->
            <div class="row p-2">
                <div class="col-2">
                    <label class="form-label" for="nome">Nome</label>
                </div>
                <div class="col-10">
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
            </div>

            <!-- Campo para Email -->
            <div class="row p-2">
                <div class="col-2">
                    <label class="form-label" for="email">Email</label>
                </div>
                <div class="col-10">
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>

            <!-- Campo para Assunto -->
            <div class="row p-2">
                <div class="col-2">
                    <label class="form-label" for="assunto">Assunto</label>
                </div>
                <div class="col-10">
                    <input type="text" class="form-control" id="assunto" name="assunto" required>
                </div>
            </div>

            <!-- Campo para Mensagem -->
            <div class="row p-2">
                <div class="col-2">
                    <label class="form-label" for="mensagem">Mensagem</label>
                </div>
                <div class="col-10">
                    <textarea class="form-control" id="mensagem" name="mensagem" rows="5" required></textarea>
                </div>
            </div>

            <!-- Botões de ação -->
            <div class="row p-4">
                <div class="col">
                    <div class="btn-group w-100" role="group">
                        <a href='<?=previous_url()?>' class="btn btn-outline-secondary m-1">Cancelar</a>
                        <button type="submit" class="btn btn-outline-success m-1">Enviar</button>
                    </div>
                </div>
            </div>

            <?= form_close() ?>
        </div>
    </div>
</div>