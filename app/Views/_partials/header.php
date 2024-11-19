<!DOCTYPE html>

<html lang="en">

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"

    data-template="vertical-menu-template-free" data-style="dark">



<meta charset="UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link rel="stylesheet" href="<?= base_url('/assets/bootstrap/css/bootstrap.css') ?>">

<link rel="icon" href="<?= base_url('assets/img/sga.png') ?>" class="img-thumbnail" sizes="32x32" type="image/png">

<!-- Favicon -->

<!-- Fonts -->

<link rel="preconnect" href="https://fonts.googleapis.com" />

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

<link

    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"

    rel="stylesheet" />



<!-- Icons. Uncomment required icon fonts -->

<link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/boxicons.css') ?>" />



<!-- Core CSS -->

<link rel="stylesheet" href="<?= base_url('assets/vendor/css/core.css') ?>" class="template-customizer-core-css" />

<link rel="stylesheet" href="<?= base_url('assets/vendor/css/theme-default.css') ?>"

    class="template-customizer-theme-css" />

<link rel="stylesheet" href="<?= base_url('assets/css/demo.css') ?>" />



<!-- Vendors CSS -->

<link rel="stylesheet" href="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') ?>" />



<!-- Page CSS -->

<!-- Page -->

<link rel="stylesheet" href="<?= base_url('assets/vendor/css/pages/page-auth.css') ?>" />

<!-- Helpers -->

<script src="<?= base_url('assets/vendor/js/helpers.js') ?>"></script>



<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

<script src="<?= base_url('assets/js/config.js') ?>"></script>

<!-- Favicon -->

<link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon/favicon.icon') ?>" />



<!-- Fonts -->

<link rel="preconnect" href="https://fonts.googleapis.com" />

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />

<link

    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"

    rel="stylesheet" />



<!-- Icons. Uncomment required icon fonts -->

<link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/boxicons.css') ?>" />



<!-- Core CSS -->

<link rel="stylesheet" href="<?= base_url('assets/vendor/css/core.css') ?>" class="template-customizer-core-css" />

<link id="dark-theme-stylesheet" rel="stylesheet" href="<?= base_url('assets/css/core-dark.css') ?>" disabled />

<link rel="stylesheet" href="<?= base_url('assets/vendor/css/theme-default.css') ?>"

    class="template-customizer-theme-css" />

<link rel="stylesheet" href="<?= base_url('assets/css/demo.css') ?>" />

<link id="theme-link" rel="stylesheet" href="<?= base_url('assets/css/light-theme.css'); ?>">

<!-- Vendors CSS -->

<link rel="stylesheet" href="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') ?>" />

<link rel="stylesheet" href="<?= base_url('assets/css/coluna.css') ?>" />

<link rel="stylesheet" href="<?= base_url('assets/css/alerta.css') ?>" />

<script src="<?= base_url('assets/vendor/js/helpers.js') ?>"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"

    integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM3xqq1ziBvJ6czN6kXslFtnQ9V7XK1GfH8X7G" crossorigin="anonymous">

<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

<script src="<?= base_url('assets/js/config.js') ?>"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="<?= base_url('assets/js/main_2.js') ?>"></script>

<link rel="stylesheet" href="<?= base_url('assets/css/barradecarregamento.css') ?>" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-5-theme/1.2.2/select2-bootstrap-5-theme.min.css"

    rel="stylesheet" />

<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.bootstrap5.css">

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.css">

<link rel="stylesheet" href="<?= base_url('assets/css/select2.css') ?>" />

<title>Biblioteca</title>

</head>


<body>

    <div id="alert-container" class="alert-container"></div>



    <!-- Variáveis JavaScript para passar as mensagens de sessão -->

    <script>
        var sessionSuccessMessage = <?= json_encode(session()->getFlashdata('success')) ?>;

        var sessionErrorMessage = <?= json_encode(session()->getFlashdata('error')) ?>;
    </script>

    <script>
        var seccioncarregada = <?= json_encode(session()->getFlashdata(

                                    'success',

                                    'Pagina carregada com sucesso.'

                                )) ?>;
    </script>