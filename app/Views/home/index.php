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

    <div class="row">
        <!-- Cards -->
        <div class="col-md-4 mb-4">
            <div class="card border-start border-5 border-primary">
                <div class="card-body text-center">
                    <i class="fas fa-book fa-2x mb-3" style="color: #007bff;"></i>
                    <h5 class="card-title">Livros Disponíveis</h5>
                    <h2 class="card-text"><?= $livrosDisponiveis ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-start border-5 border-success">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle fa-2x mb-3" style="color: #28a745;"></i>
                    <h5 class="card-title">Empréstimos Devolvidos</h5>
                    <h2 class="card-text"><?= $emprestimosDevolvidos ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-start border-5 border-danger">
                <div class="card-body text-center">
                    <i class="fas fa-times-circle fa-2x mb-3" style="color: #dc3545;"></i>
                    <h5 class="card-title">Empréstimos Não Devolvidos</h5>
                    <h2 class="card-text"><?= $emprestimosNaoDevolvidos ?></h2>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-4 mb-4">
            <div class="card border-start border-5 border-info">
                <div class="card-body text-center">
                    <i class="fas fa-user-graduate fa-2x mb-3" style="color: #17a2b8;"></i>
                    <h5 class="card-title">Total de Alunos</h5>
                    <h2 class="card-text"><?= $novosAlunos ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-start border-5 border-warning">
                <div class="card-body text-center">
                    <i class="fas fa-user-edit fa-2x mb-3" style="color: #ffc107;"></i>
                    <h5 class="card-title">Total de Autores</h5>
                    <h2 class="card-text"><?= $totalAutores ?></h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-start border-5 border-secondary">
                <div class="card-body text-center">
                    <i class="fas fa-building fa-2x mb-3" style="color: #6c757d;"></i>
                    <h5 class="card-title">Total de Editoras</h5>
                    <h2 class="card-text"><?= $totalEditoras ?></h2>
                </div>
            </div>
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

    <!-- Carrossel de Notícias -->
    <br>
    <h3>Últimas Notícias</h3>
    <div id="noticiasCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner text-center">
            <?php foreach ($noticias as $index => $noticia): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <img src="<?= $noticia['imagem'] ?>" class="card-img-top" alt="Imagem da Notícia">
                            <div class="card-body">
                                <h5 class="card-title"><?= $noticia['titulo'] ?></h5>
                                <p class="card-text"><?= $noticia['descricao'] ?></p>
                                <a href="<?= $noticia['link'] ?>" class="btn btn-primary">Leia mais</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#noticiasCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: purple;"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#noticiasCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: purple;"></span>
            <span class="visually-hidden">Próximo</span>
        </button>
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

/* Responsividade dos cards */
@media (max-width: 768px) {
    .card {
        margin-bottom: 20px;
    }

    canvas {
        height: 250px;
        /* Altura do gráfico em telas menores */
    }
}
</style>