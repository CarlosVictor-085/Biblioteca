<div class="container">
    <!-- Card de Boas-Vindas -->
    <div class="row">
        <div class="col-md-12">
            <div class="card text-center mb-4">
                <div class="card-body">
                    <h5 class="card-title">Bem-vindo à Biblioteca <span
                            class="text-primary"><?php echo session()->get('nome'); ?></span>!</h5>
                    <p class="card-text">Aqui você pode gerenciar seus livros e empréstimos de forma eficiente.</p>
                    <p class="card-text">Você está como: <span
                            class="text-primary"><?php echo session()->get('tipo_usuario'); ?></span>.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">Estatísticas</h5>
            <ul class="list-group list-group-flush">
                <!-- Livros Disponíveis -->
                <li class="list-group-item">
                    <strong>Livros Disponíveis</strong>
                    <div class="progress mt-2" style="height: 30px;">
                        <div class="progress-bar" role="progressbar"
                            style="width: <?= ($livrosDisponiveis < 1 || (($livrosDisponiveis / $valorMaximo) * 100) < 1) ? $livrosDisponiveis : (($livrosDisponiveis / $valorMaximo) * 100); ?>%; background-color: rgba(11,78,146);"
                            aria-valuenow="<?= $livrosDisponiveis ?>" aria-valuemin="0"
                            aria-valuemax="<?= $valorMaximo ?>">
                            <?= $livrosDisponiveis > 0 ? $livrosDisponiveis : 'Disponível' ?>
                        </div>
                    </div>
                </li>

                <!-- Empréstimos Devolvidos -->
                <li class="list-group-item">
                    <strong>Empréstimos Devolvidos</strong>
                    <div class="progress mt-2" style="height: 30px;">
                        <div class="progress-bar" role="progressbar"
                            style="width: <?=($emprestimosDevolvidos < 1 || (($emprestimosDevolvidos / $valorMaximo) * 100) < 1) ? $emprestimosDevolvidos : (($emprestimosDevolvidos / $valorMaximo) * 100); ?>%; background-color: rgba(40, 167, 69, 1);"
                            aria-valuenow="<?= $emprestimosDevolvidos ?>" aria-valuemin="0"
                            aria-valuemax="<?= $valorMaximo ?>">
                            <?= $emprestimosDevolvidos ?>
                        </div>
                    </div>
                </li>

                <!-- Empréstimos Não Devolvidos -->
                <li class="list-group-item">
                    <strong>Empréstimos Não Devolvidos</strong>
                    <div class="progress mt-2" style="height: 30px;">
                        <div class="progress-bar" role="progressbar"
                            style="width: <?= ($emprestimosNaoDevolvidos < 1 || (($emprestimosNaoDevolvidos / $valorMaximo) * 100) < 1) ? $emprestimosNaoDevolvidos : (($emprestimosNaoDevolvidos / $valorMaximo) * 100); ?>%; background-color: rgba(220, 53, 69, 0.6);"
                            aria-valuenow="<?= $emprestimosNaoDevolvidos ?>" aria-valuemin="0"
                            aria-valuemax="<?= $valorMaximo ?>">
                            <?= $emprestimosNaoDevolvidos ?>
                        </div>
                    </div>
                </li>

                <!-- Novos Alunos -->
                <li class="list-group-item">
                    <strong>Total de Alunos</strong>
                    <div class="progress mt-2" style="height: 30px;">
                        <div class="progress-bar" role="progressbar"
                            style="width: <?= ($novosAlunos < 1 || (($novosAlunos / $valorMaximo) * 100) < 1) ? $novosAlunos : (($novosAlunos / $valorMaximo) * 100); ?>%; background-color: rgba(0, 123, 255, 0.6);"
                            aria-valuenow="<?= $novosAlunos ?>" aria-valuemin="0" aria-valuemax="<?= $valorMaximo ?>">
                            <?= $novosAlunos ?>
                        </div>
                    </div>
                </li>

                <!-- Total de Autores -->
                <li class="list-group-item">
                    <strong>Total de Autores</strong>
                    <div class="progress mt-2" style="height: 30px;">
                        <div class="progress-bar" role="progressbar"
                            style="width: <?= ($totalAutores < 1 || (($totalAutores / $valorMaximo) * 100) < 1) ? $totalAutores : (($totalAutores / $valorMaximo) * 100); ?>%; background-color: rgba(255, 193, 7, 0.6);"
                            aria-valuenow="<?= $totalAutores ?>" aria-valuemin="0" aria-valuemax="<?= $valorMaximo ?>">
                            <?= $totalAutores ?>
                        </div>
                    </div>
                </li>

                <!-- Total de Editoras -->
                <li class="list-group-item">
                    <strong>Total de Editoras</strong>
                    <div class="progress mt-2" style="height: 30px;">
                        <div class="progress-bar" role="progressbar"
                            style="width: <?= ($totalEditoras < 1 || (($totalEditoras / $valorMaximo) * 100) < 1) ? $totalEditoras : (($totalEditoras / $valorMaximo) * 100); ?>%; background-color: rgba(108, 117, 125, 0.6);"
                            aria-valuenow="<?= $totalEditoras ?>" aria-valuemin="0" aria-valuemax="<?= $valorMaximo ?>">
                            <?= $totalEditoras ?>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>


    <!-- Gráfico -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Estatísticas da Biblioteca</h5>
                    <canvas id="meuGrafico"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Botão para abrir o modal de cadastro de notícias -->
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadastroNoticiaModal">Cadastrar
                Notícia</button>
        </div>
    </div>

    <!-- Verificar se existem notícias, se não, não exibir a seção -->
    <h3 class="text-center mb-4">Últimas Notícias</h3>
    <div id="noticiasCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner text-center">
            <?php if (!empty($noticias)): // Verifica se existem notícias 
            ?>
            <?php foreach ($noticias as $index => $noticia): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <!-- Imagem da notícia -->
                            <img src="<?= base_url('uploads/noticias/' . $noticia['imagem']) ?>"
                                class="card-img-top img-fluid" alt="Imagem da Notícia">

                            <!-- Corpo da notícia -->
                            <div class="card-body">
                                <!-- Título da notícia -->
                                <h5 class="card-title mb-3 text-center"
                                    style="font-size: 1.5rem; color: #555; font-weight: bold;"><?= $noticia['titulo'] ?>
                                </h5>

                                <!-- Descrição -->
                                <p class="card-text mb-4"><?= $noticia['descricao'] ?></p>

                                <!-- Botões centralizados -->
                                <div class="d-flex justify-content-center gap-3">
                                    <a href="<?= $noticia['link'] ?>" class="btn btn-primary" target="_blank">Leia
                                        mais</a>
                                    <a href="<?= base_url('Home/excluir_noticia/' . $noticia['id']) ?>"
                                        class="btn btn-danger">Excluir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else: ?>
            <p class="text-center">Nenhuma notícia disponível no momento.</p>
            <?php endif; ?>
        </div>

        <!-- Controles do carrossel -->
        <button class="carousel-control-prev" type="button" data-bs-target="#noticiasCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(50%);">></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#noticiasCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(50%);">></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div>

    <!-- Modal de Cadastro de Notícia -->
    <div class="modal fade" id="cadastroNoticiaModal" tabindex="-1" aria-labelledby="cadastroNoticiaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cadastroNoticiaModalLabel">Cadastrar Nova Notícia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= form_open('Home/salvar_noticia', ['enctype' => 'multipart/form-data']) ?>
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imagem" class="form-label">Imagem</label>
                        <input type="file" class="form-control" id="imagem" name="imagem" required>
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Link</label>
                        <input type="url" class="form-control" id="link" name="link" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const ctx = document.getElementById('meuGrafico').getContext('2d');
    const meuGrafico = new Chart(ctx, {
        type: 'bar', // ou 'line', 'pie', etc.
        data: {
            labels: ['Total de Alunos', 'Total de Autores', 'Total de Editoras', 'Livros Disponíveis',
                'Empréstimos Devolvidos', 'Empréstimos Não Devolvidos'
            ],
            datasets: [{
                label: 'Estatísticas da Biblioteca',
                data: [<?= $novosAlunos ?>, <?= $totalAutores ?>, <?= $totalEditoras ?>,
                    <?= $livrosDisponiveis ?>,
                    <?= $emprestimosDevolvidos ?>, <?= $emprestimosNaoDevolvidos ?>
                ],
                backgroundColor: [
                    'rgba(0, 123, 255, 0.6)', // Azul para Total de Alunos
                    'rgba(255, 193, 7, 0.6)', // Amarelo para Total de Autores
                    'rgba(108, 117, 125, 0.6)', // Cinza para Total de Editoras
                    'rgba(0, 123, 255, 0.6)', // Azul para Livros Disponíveis
                    'rgba(40, 167, 69, 0.6)', // Verde para Empréstimos Devolvidos
                    'rgba(220, 53, 69, 0.6)' // Vermelho para Empréstimos Não Devolvidos
                ],
                borderColor: [
                    'rgba(0, 123, 255, 1)', // Azul para Total de Alunos
                    'rgba(255, 193, 7, 1)', // Amarelo para Total de Autores
                    'rgba(108, 117, 125, 1)', // Cinza para Total de Editoras
                    'rgba(0, 123, 255, 1)', // Azul para Livros Disponíveis
                    'rgba(40, 167, 69, 1)', // Verde para Empréstimos Devolvidos
                    'rgba(220, 53, 69, 1)' // Vermelho para Empréstimos Não Devolvidos
                ],
                rderWidth: 5,
                borderRadius: 10,
                barThickness: 60
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true, // Mantém a proporção
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    },
                    ticks: {
                        color: '#666',
                        font: {
                            size: 12
                        }
                    }
                },
                x: {
                    ticks: {
                        color: '#666',
                        autoSkip: false,
                        autoSkip: false,
                        maxRotation: 0, // Garante que o texto fique reto
                        minRotation: 0
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)'
                    }
                }
            },
            plugins: {
                legend: {
                    labels: {
                        color: '#333',
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });
    </script>

    <style>
    .card {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .row {
        margin-top: 20px;
    }

    @media (max-width: 768px) {
        .card {
            margin-bottom: 20px;
        }

        canvas {
            height: 250px;
        }
    }
    </style>