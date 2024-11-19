<div class="container">
    <h1> Relatórios</h1><br>

    <div class="row">
        <!-- Card: Relatório de Empréstimos Não Devolvidos -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="fas fa-file-pdf fa-2x text-danger mb-3"></i>
                    <h5 class="card-title">Relatório de Empréstimos Não Devolvidos</h5>
                    <p class="card-text">Visualize todos os empréstimos pendentes de devolução.</p>
                    <a href="<?= base_url('Emprestimo/relatorioPendencias') ?>" target="_blank"
                        class="btn btn-outline-primary">Abrir Relatório</a>
                </div>
            </div>
        </div>

        <!-- Card: Relatório de Todas as Obras -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="fas fa-file-pdf fa-2x text-danger mb-3"></i>
                    <h5 class="card-title">Relatório de Todas as Obras</h5>
                    <p class="card-text">Veja um relatório detalhado de todas as obras cadastradas.</p>
                    <a href="<?= base_url('Obra/gerarRelatorioPDF') ?>" target="_blank"
                        class="btn btn-outline-primary">Abrir Relatório</a>
                </div>
            </div>
        </div>

        <!-- Card: Relatório de Empréstimos Devolvidos -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="fas fa-file-pdf fa-2x text-danger mb-3"></i>
                    <h5 class="card-title">Relatório de Empréstimos Devolvidos</h5>
                    <p class="card-text">Consulte os empréstimos que já foram devolvidos.</p>
                    <a href="<?= base_url('Emprestimo/relatorioDevolvidos') ?>" target="_blank"
                        class="btn btn-outline-primary">Abrir Relatório</a>
                </div>
            </div>
        </div>

        <!-- Card: Relatório de Livros Perdidos -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="fas fa-file-pdf fa-2x text-danger mb-3"></i>
                    <h5 class="card-title">Relatório de Livros Perdidos</h5>
                    <p class="card-text">Veja a lista de livros marcados como perdidos.</p>
                    <a href="<?= base_url('Livro/relatorioLivrosPerdidos') ?>" target="_blank"
                        class="btn btn-outline-primary">Abrir Relatório</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="fas fa-file-pdf fa-2x text-danger mb-3"></i>
                    <h5 class="card-title">Relatório de Livros Danificados</h5>
                    <p class="card-text">Veja a lista de livros marcados como danificados.</p>
                    <a href="<?= base_url('Livro/relatorioLivrosDanificados') ?>" target="_blank"
                        class="btn btn-outline-primary">Abrir Relatório</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="fas fa-file-pdf fa-2x text-danger mb-3"></i>
                    <h5 class="card-title">Relatório de Livros Disponiveis</h5>
                    <p class="card-text">Veja a lista de livros marcados como disponiveis.</p>
                    <a href="<?= base_url('Livro/relatorioLivrosDisponiveis') ?>" target="_blank"
                        class="btn btn-outline-primary">Abrir Relatório</a>
                </div>
            </div>
        </div>
    </div>
</div>