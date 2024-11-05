<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Login Card -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <img src="<?= base_url('assets/img/sga.png') ?>" alt="Logo" class="me-3" width="50" height="50">
                        <span class="app-text demo menu-text fw-bolder fs-3">Biblioteca</span>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2">Bem Vindo à Biblioteca!</h4>
                    <p class="mb-4">Faça login para continuar</p>

                    <!-- Exibir alertas -->
                    <?php if (session()->has('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->get('success') ?>
                    </div>
                    <?php endif; ?>

                    <?php if (session()->has('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->get('error') ?>
                    </div>
                    <?php endif; ?>

                    <form action="<?php echo base_url('login/authenticate'); ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" class="form-control" placeholder="exemplo@gmail.com" id="email"
                                name="email" value="<?= old('email'); ?>" autofocus>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="senha">Senha</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    id="senha" name="senha">
                                <span class="input-group-text line" id="basic-default-password">
                                    <i class="bx bx-hide" id="btn-senha" onclick="mostrarSenha()" role="button"></i>
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary d-grid w-100">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Login Card -->
        </div>
    </div>
</div>