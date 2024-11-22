<!DOCTYPE html>
<html
    lang="pt"
    class="light-style"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Biblioteca</title> 

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/sga.png') ?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Ícones. Descomente os ícones necessários -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/boxicons.css') ?>" />

    <!-- CSS Principal -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/core.css') ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/theme-default.css') ?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url('assets/css/demo.css') ?>" />

    <!-- CSS dos Fornecedores -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') ?>" />

    <!-- CSS da Página -->
    <!-- Página -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/pages/page-misc.css') ?>" />
    <!-- Helpers -->
    <script src="<?= base_url('assets/vendor/js/helpers.js') ?>"></script>

    <!--! O arquivo de personalização do template e configuração do tema DEVE ser incluído após os estilos principais e helpers.js na seção <head> -->
    <!--? Config: Arquivo de configuração obrigatório que contém variáveis globais e opções padrão do tema. Defina suas opções preferidas neste arquivo. -->
    <script src="<?= base_url('assets/js/config.js') ?>"></script>
</head>

<body>
    <!-- Conteúdo -->

    <!-- Erro -->
    <div class="container-xxl container-p-y">
        <div class="misc-wrapper">
            <h2 class="mb-2 mx-2">Página Não Encontrada :(</h2>
            <p class="mb-4 mx-2">Ops! 😖 A URL solicitada não foi encontrada neste servidor.</p>

            <!-- Exibindo a mensagem de erro condicionalmente -->
            <?php if (ENVIRONMENT !== 'production') : ?>
                <p><?= nl2br(esc($message)) ?></p>
            <?php else : ?>
                <p><?= lang('Errors.sorryCannotFind') ?></p>
            <?php endif; ?>

            <a href="<?= base_url('Home') ?>" class="btn btn-primary">Voltar para a página inicial</a>
            <div class="mt-3">
                <img
                    src="<?= base_url('assets/img/illustrations/page-misc-error-light.png') ?>"
                    alt="page-misc-error-light"
                    width="500"
                    class="img-fluid"
                    data-app-dark-img="illustrations/page-misc-error-dark.png"
                    data-app-light-img="illustrations/page-misc-error-light.png" />
            </div>
        </div>
    </div>
    <!-- /Erro -->

    <!-- / Conteúdo -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?= base_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/libs/popper/popper.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/js/bootstrap.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>

    <script src="<?= base_url('assets/vendor/js/menu.js') ?>"></script>
    <!-- endbuild -->

    <!-- JS dos Fornecedores -->

    <!-- JS Principal -->
    <script src="<?= base_url('assets/js/main.js') ?>"></script>

    <!-- JS da Página -->

    <!-- Coloque esta tag no seu <head> ou logo antes de fechar a tag <body>. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>