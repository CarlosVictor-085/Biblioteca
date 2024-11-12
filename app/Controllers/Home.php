<?php

namespace App\Controllers;
use App\Models\LivroModel;
use App\Models\AlunoModel;
use App\Models\EmprestimoModel;
use App\Models\AutorModel; // Adicionando o modelo de Autor
use App\Models\EditoraModel; // Adicionando o modelo de Editora

class Home extends BaseController
{
    protected $livroModel;
    protected $alunoModel;
    protected $emprestimoModel;
    protected $autorModel; // Variável para o modelo de Autor
    protected $editoraModel; // Variável para o modelo de Editora

    public function __construct()
    {
        // Carregar os modelos necessários
        $this->livroModel = new LivroModel();
        $this->alunoModel = new AlunoModel();
        $this->emprestimoModel = new EmprestimoModel();
        $this->autorModel = new AutorModel(); // Inicializando o modelo de Autor
        $this->editoraModel = new EditoraModel(); // Inicializando o modelo de Editora
    }

    public function index()
    {
        // Estatísticas
        $livrosDisponiveis = $this->livroModel->countAllResults();
        $emprestimosDevolvidos = $this->emprestimoModel->where('data_fim IS NOT NULL')->countAllResults();
        $emprestimosNaoDevolvidos = $this->emprestimoModel->where('data_fim IS NULL')->countAllResults(); // Contagem de empréstimos não devolvidos
        $novosAlunos = $this->alunoModel->countAllResults();
        $totalAutores = $this->autorModel->countAllResults(); // Contagem total de autores
        $totalEditoras = $this->editoraModel->countAllResults(); // Contagem total de editoras
        // Noticias (substituindo por dados reais do banco de dados)
        $noticias =
        [
            [
                'titulo' => 'Biblioteca lança novo acervo digital',
                'descricao' => 'A biblioteca anunciou a chegada de novos títulos disponíveis no acervo digital. Explore novas obras diretamente de casa!',
                'imagem' => 'https://tribunadejundiai.com.br/wp-content/uploads/2024/06/Biblioteca-Municipal-de-Varzea-Paulista-recebe-acervo-com-200-novos-livros-1536x864.jpg', // Imagem de livros
                'link' => 'https://www.brasil.gov.br/cidadania-e-justica/2021/09/como-acessar-acervos-digitais-de-bibliotecas' // Exemplo de link real
            ],

            [
                'titulo' => 'Evento de leitura: Autor convidado',
                'descricao' => 'Participe do evento de leitura com o autor João Silva, que estará na biblioteca para uma conversa sobre seu novo livro.',
                'imagem' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBko9hI8RVuZko73pagyxAWpGecXtBbYqMAw&s', // Imagem de evento de leitura
                'link' => 'https://www.joaosilva.com.br/evento-leitura' // Exemplo de link real
            ],

            [
                'titulo' => 'Feira de livros usados',
                'descricao' => 'A feira anual de livros usados está de volta! Aproveite para adquirir livros a preços acessíveis e renovar sua coleção.',
                'imagem' => 'https://www.conexaoamsterdam.com.br/wp-content/uploads/2015/04/IMG_8131-e1429825087312-810x540.jpg', // Imagem de feira de livros
                'link' => 'https://www.feiradelivros.com.br/' // Exemplo de link real
            ],

            [
                'titulo' => 'Novos livros no acervo',
                'descricao' => 'Adicionamos novas obras ao nosso acervo! Confira os últimos lançamentos disponíveis.',
                'imagem' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR7FNU-14KutrPZanSpcTkEORbIuWMP2nQPQQ&s', // Imagem de novos livros
                'link' => 'https://www.livrosnovos.com.br/' // Exemplo de link real
            ],

            [
                'titulo' => 'Clube do Livro: Inscreva-se já!',
                'descricao' => 'Participe do nosso Clube do Livro e venha discutir obras com outros leitores apaixonados.',
                'imagem' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQsAIlA1Y_codDT5IzIIljKBNIJ4ftBXm64vw&s', // Imagem de clube do livro
                'link' => 'https://www.clubedolivro.com.br/' // Exemplo de link real
            ],

            [
                'titulo' => 'Promoção de férias na biblioteca!',
                'descricao' => 'Aproveite nossas promoções de férias em livros selecionados. Venha conferir!',
                'imagem' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTACgUJNTpUU86cJCX5GWwIMH72jcNx1wbZ3w&s', // Imagem de promoção de livros
                'link' => 'https://www.promocaolivros.com.br/' // Exemplo de link real
            ],

            [
                'titulo' => 'Autora premiada na biblioteca!',
                'descricao' => 'Venha conhecer a autora Ana Lima, que ganhará um prêmio por suas obras.',
                'imagem' => 'https://lh5.googleusercontent.com/proxy/uV0S_QiiaCqltlP6dTCn5A_Az0JJXTVOgyQqSWkF6FMCqehoX4HhBpeDfxyiAI97AwWX3yOLxY9NfaeQ9w-sfd8OdOZOM1M6hgE70qzs9vocxWvVJoznTObX7IDIJn6wUz7N80NjM2vbAZt5InHgfDyS-A', // Imagem de autora
                'link' => 'https://www.analis.com.br/premiacao' // Exemplo de link real
            ],

            [
                'titulo' => 'Dia do livro: Celebre conosco!',
                'descricao' => 'Participe da nossa comemoração do Dia do Livro com atividades e premiações.',
                'imagem' => 'https://s3.amazonaws.com/blog.dentrodahistoria.com.br/wp-content/uploads/2022/05/10161159/thumb-dentro-educa.jpg', // Imagem do dia do livro
                'link' => 'https://www.diadolivro.com.br/' // Exemplo de link real
            ],

            [
                'titulo' => 'Novas parcerias com editoras!',
                'descricao' => 'A biblioteca firmou novas parcerias com editoras para trazer mais títulos para vocês.',
                'imagem' => 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEi2ZrCYYcEXmq7Onvk8WZuMhKcSgBk-8XUP5PPzCv_w9m_i_otzLXT64xILqfLepoeK9hXqwdd5fue8ehrfwdbSMz23ONTkhyPfBflhhGKzkZpGWXkennkeoIp5Jkl7NAMijqzEzS8ehv2VE0I0IQPriOzf25SD7QMWyVcbwTSAM8V-acNl5Lls01Jg7XJS/w1200-h630-p-k-no-nu/parcerias%20com%20editoras.png', // Imagem de parceria
                'link' => 'https://www.parceriaseditoras.com.br/' // Exemplo de link real
            ],

            [
                'titulo' => 'Descubra novos autores!',
                'descricao' => 'Venha conhecer novos autores e suas obras na nossa biblioteca.',
                'imagem' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSV7-zIPi52DHrrR34qbkYBsHJw-WukaA4wIA&s', // Imagem de novos autores
                'link' => 'https://www.novosautores.com.br/' // Exemplo de link real
            ]

        ];
        // Carregar as views e passar os dados para a view 'home/index.php'
        echo view('_partials/header');
        echo view('_partials/navbar');
        echo view('home/index.php', [
            'livrosDisponiveis' => $livrosDisponiveis,
            'emprestimosDevolvidos' => $emprestimosDevolvidos,
            'emprestimosNaoDevolvidos' => $emprestimosNaoDevolvidos, // Passando a contagem de empréstimos não devolvidos
            'novosAlunos' => $novosAlunos,
            'noticias' => $noticias,
            'totalAutores' => $totalAutores, // Passando a contagem de autores
            'totalEditoras' => $totalEditoras // Passando a contagem de editoras
        ]);
        echo view('_partials/footer');
    }

}