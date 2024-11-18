<div class="layout-wrapper layout-content-navbar">

    <div class="layout-container">

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme"
            style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">

            <div class="app-brand demo" style="margin-left">

                <a id="menuitem" href="#" class="d-flex align-items-center text-decoration-none ">

                    <img src="<?= base_url('assets/img/sga.png') ?>" alt="Logo"
                        class="me-3 img-fluid border border-primary rounded-5 border-2" width="50" height="50">

                    <span class="app-text demo menu-text fw-bolder fs-5 ">Biblioteca</span>

                </a>



                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">

                    <i class="bx bx-chevron-left bx-sm align-middle"></i>

                </a>

            </div>



            <div class="menu-inner-shadow"></div>



            <ul class="menu-inner py-1 overflow-auto">

                <!-- Dashboard -->



                <li class="menu-item" id="targetMenuItem">

                    <a href="<?= base_url('Home') ?>" class="menu-link">

                        <i class="menu-icon tf-icons bx bx-home-circle"></i>

                        <div data-i18n="Analytics">Home</div>

                    </a>

                </li>



                <li class="menu-item" id="targetMenuItem">

                    <a href="<?= base_url('Aluno') ?>" class="menu-link">

                        <i class="menu-icon tf-icons bx bx-id-card"></i>

                        <div data-i18n="Analytics">Aluno</div>

                    </a>

                </li>



                <li class="menu-item" id="targetMenuItem">

                    <a href="<?= base_url('Autor') ?>" class="menu-link">

                        <i class="menu-icon tf-icons bx bxs-book-reader"></i>

                        <div data-i18n="Analytics">Autor</div>

                    </a>

                </li>

                <?php if (session()->get('tipo_usuario') == 'Administrador'): ?>

                    <li class="menu-item" id="targetMenuItem">

                        <a href="<?= base_url('Usuario/index') ?>" class="menu-link">

                            <i class="menu-icon tf-icons bx bxs-user"></i>

                            <div data-i18n="Analytics">Usuario</div>

                        </a>

                    </li>

                <?php endif; ?>



                <li class="menu-item" id="targetMenuItem">

                    <a href="<?= base_url('Editora') ?>" class="menu-link">

                        <i class="menu-icon tf-icons bx bxs-message-square-edit"></i>

                        <div data-i18n="Analytics">Editora</div>

                    </a>

                </li>



                <li class="menu-item" id="targetMenuItem">

                    <a href="<?= base_url('Obra') ?>" class="menu-link">

                        <i class="menu-icon tf-icons bx bxs-book"></i>

                        <div data-i18n="Analytics">Obra</div>

                    </a>

                </li>



                <li class="menu-item" id="targetMenuItem">

                    <a href="<?= base_url('Livro') ?>" class="menu-link">

                        <i class="menu-icon tf-icons bx bxs-book-content"></i>

                        <div data-i18n="Analytics">Livro</div>

                    </a>

                </li>



                <li class="menu-item" id="targetMenuItem">

                    <a href="<?= base_url('Emprestimo') ?>" class="menu-link">

                        <i class="menu-icon tf-icons bx bxs-send"></i>

                        <div data-i18n="Analytics">Emprestimo</div>

                    </a>

                </li>
                <li class="menu-item">

                    <a href="<?= base_url('Relatorio') ?>" class="menu-link">

                        <i class="menu-icon tf-icons fas fa-file-pdf"></i>

                        <div data-i18n="Analytics">Relatorios</div>

                    </a>

                </li>
            </ul>

        </aside>

        <div class="layout-page">

            <!-- Navbar -->

            <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                id="layout-navbar">

                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">

                    <a id="menuToggle" class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">

                        <i class="bx bx-menu bx-sm"></i>

                    </a>

                </div>



                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

                    <!-- Search -->



                    <ul class="navbar-nav flex-row align-self-center mt-3">

                        <!-- Navegação do usuário -->

                        <li class="nav-item">

                            <ul class="breadcrumb" id="breadcrumb">

                                <!-- Os breadcrumbs serão inseridos aqui pelo JavaScript -->

                            </ul>

                        </li>

                    </ul>





                    <ul class="navbar-nav flex-row align-items-center ms-auto">

                        <!-- User -->

                        <li class="nav-item navbar-dropdown dropdown-user dropdown">

                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                aria-expanded="false">

                                <div class="avatar avatar-online">

                                    <img src="<?= base_url('assets/img/avatars/avatar.png') ?>" alt
                                        class="w-px-40 h-auto rounded-circle" />

                                </div>

                            </a>



                            <ul class="dropdown-menu dropdown-menu-end"
                                style="position: absolute; left: -250px; top: 100%; z-index: 1000;">



                                <!-- Itens do menu -->



                                <a class="dropdown-item"
                                    href="<?= base_url('Usuario/editar/' . session()->get('id')); ?>">

                                    <div class="d-flex">

                                        <div class="flex-shrink-0 me-3">

                                            <div class="avatar avatar-online">

                                                <img src="<?= base_url('assets/img/avatars/avatar.png') ?>" alt
                                                    class="w-px-40 h-auto rounded-circle" />

                                            </div>

                                        </div>

                                        <div class="flex-grow-1">

                                            <span
                                                class="fw-semibold d-block"><?php echo session()->get('nome'); ?></span>

                                            <small class="text-muted"><?php echo session()->get('email'); ?></small>

                                        </div>

                                    </div>

                                </a>

                                <li>

                                    <div class="dropdown-divider"></div>

                                </li>

                                <li>

                                    <a class="dropdown-item" href="<?php echo base_url('login/logout') ?>">

                                        <i class="bx bx-power-off me-2"></i>

                                        <span class="align-middle">Sair </span>

                                    </a>

                                </li>

                            </ul>

                        </li>

                        <!--/ User -->

                    </ul>

                </div>

            </nav>





            <!---Barra de Pesquisa e Navegação de usuario--->

            <!-- Core JS -->

            <!-- build:js assets/vendor/js/core.js -->

            <script src="<?= base_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>

            <script src="<?= base_url('assets/vendor/libs/popper/popper.js') ?>"></script>

            <script src="<?= base_url('assets/vendor/js/bootstrap.js') ?>"></script>

            <script src="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') ?>">

            </script>



            <script src="<?= base_url('assets/vendor/js/menu.js') ?>"></script>

            <!-- endbuild -->



            <!-- Vendors JS -->

            <script src="<?= base_url('assets/vendor/libs/apex-charts/apexcharts.js') ?>"></script>



            <!-- Main JS -->

            <script src="<?= base_url('assets/js/main.js') ?>"></script>



            <!-- Page JS -->

            <script src="<?= base_url('assets/js/dashboards-analytics.js') ?>"></script>



            <!-- Place this tag in your head or just before your close body tag. -->

            <script async defer src="https://buttons.github.io/buttons.js"></script>

            <script>
                var logoutUrl = "<?php echo base_url('login/logout'); ?>";

                var baseUrl = "<?php echo base_url(); ?>";
            </script>

            <script>
                var baseUrl2 = '<?php echo base_url(); ?>'; // Defina a variável baseUrl
            </script>

            <!-- Modal de Erro -->

            <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title" id="errorModalLabel">Erro</h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        </div>

                        <div class="modal-body" id="errorMessage">

                            <!-- Mensagem de erro aparecerá aqui -->

                        </div>

                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

                        </div>

                    </div>

                </div>

            </div>



            <script>
                // Função para formatar a primeira letra em maiúscula

                function capitalize(word) {

                    return word.charAt(0).toUpperCase() + word.slice(1);

                }



                // Obter o caminho da URL após "public" e dividi-lo em segmentos

                const pathArray = window.location.pathname.split('/').filter(segment => segment && segment !== 'public');



                // Selecionar o elemento do breadcrumb

                const breadcrumbContainer = document.getElementById('breadcrumb');



                // Adicionar "Biblioteca" como primeiro item

                const libraryItem = document.createElement('li');

                libraryItem.classList.add('breadcrumb-item', 'nav-item');

                libraryItem.textContent = 'Biblioteca';

                breadcrumbContainer.appendChild(libraryItem);



                // Verificar se a URL termina com "editar"

                const isEditing = pathArray.includes('editar');



                // Montar breadcrumbs com base nos segmentos da URL após "public"

                pathArray.forEach((segment, index) => {

                    const name = capitalize(segment);

                    const url = '/public/' + pathArray.slice(0, index + 1).join('/');



                    const listItem = document.createElement('li');

                    listItem.classList.add('breadcrumb-item', 'nav-item');



                    // Verificar se a URL é a página inicial (Home)

                    if (pathArray.length === 1 && pathArray[0] === 'Home') {

                        // Não adiciona nenhum outro item, pois já temos "Biblioteca"

                        return;

                    } else if (isEditing && index === pathArray.length - 1) {

                        // Para páginas de edição

                        listItem.classList.add('active');

                        listItem.setAttribute('aria-current', 'page');

                        listItem.textContent = name; // Exibe o nome do segmento

                    } else {

                        // Para outras páginas, substituir "index" por "Início"

                        if (name === 'Index') {

                            // Não faz nada para não adicionar "Início" no breadcrumb

                            return;

                        } else {

                            const link = document.createElement('a');

                            link.href = url;

                            link.textContent = name; // Mantém o nome formatado dos outros itens

                            listItem.appendChild(link);

                        }

                    }



                    breadcrumbContainer.appendChild(listItem);

                });
            </script>





            <br>