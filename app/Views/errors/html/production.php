<!DOCTYPE html>
<html lang="pt" class="light-style" dir="ltr" data-theme="theme-default" data-assets-path="<?= base_url('assets/') ?>" data-template="vertical-menu-template-free">

<head>
    <meta charset="UTF-8" />
    <meta name="robots" content="noindex" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title><?= lang('Errors.whoops') ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/sga.png') ?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/boxicons.css') ?>" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/core.css') ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/theme-default.css') ?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url('assets/css/demo.css') ?>" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/pages/page-misc.css') ?>" />

    <!-- Helpers -->
    <script src="<?= base_url('assets/vendor/js/helpers.js') ?>"></script>

    <!-- Config -->
    <script src="<?= base_url('assets/js/config.js') ?>"></script>
</head>

<body>

    <!-- Error Page -->
    <div class="container-xxl container-p-y">
        <div class="misc-wrapper text-center">
            <h2 class="mb-2"><?= lang('Errors.whoops') ?></h2>
            <p class="mb-4"><?= lang('Errors.weHitASnag') ?></p>

            <a href="<?= base_url(previous_url()) ?>" class="btn btn-primary">Voltar para a página inicial</a>

            <div class="mt-3">
                <img
                    src="<?= base_url('assets/img/illustrations/girl-doing-yoga-light.png') ?>"
                    alt="error-illustration"
                    width="500"
                    class="img-fluid"
                    data-app-dark-img="illustrations/page-misc-error-dark.png"
                    data-app-light-img="illustrations/page-misc-error-light.png" />
            </div>
        </div>
    </div>
    <!-- / Error Page -->

    <!-- Core JS -->
    <script src="<?= base_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/libs/popper/popper.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/js/bootstrap.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>

    <script src="<?= base_url('assets/vendor/js/menu.js') ?>"></script>
    <!-- endbuild -->

    <!-- JS Principal -->
    <script src="<?= base_url('assets/js/main.js') ?>"></script>

</body>

</html>