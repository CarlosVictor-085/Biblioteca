<nav class="navbar navbar-expand-lg border-bottom border-body  mb-3" data-bs-theme="white">
  <div class="container">    
    <a class="navbar-brand" href="<?=base_url("Home/index")?>">
      <img src="<?=base_url("assets/img/sga2rf.png")?>" alt="Bootstrap" width=22" height="22">
    </a>
    <?=anchor("#","Biblioteca",['class' => 'navbar-brand'])?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="nav nav-tabs me-auto mb-2 mb-lg-0">
        <li class="nav-item">
        <a href='<?=base_url('Aluno/index')?>'class="nav-link text-black aria-current">Aluno</a>
        </li>
        <li class="nav-item">
        <a href='<?=base_url('Autor/index')?>'class="nav-link text-black aria-current">Autor</a>
        </li>
        <li class="nav-item">
        <a href='<?=base_url('Usuario/index')?>'class="nav-link text-black aria-current">Usuario</a>
        </li>
        <li class="nav-item">
          <a href='<?=base_url('Editora/index')?>'class="nav-link text-black aria-current">Editora</a>
        </li>
        <li class="nav-item">
          <a href='<?=base_url('Obra/index')?>'class="nav-link text-black aria-current">Obra</a>
        </li>
        <li class="nav-item">
          <a href='<?=base_url('Livro/index')?>'class="nav-link text-black aria-current">Livro</a>
        </li>
        <li class="nav-item">
          <a href='<?=base_url('Emprestimo/index')?>'class="nav-link text-black aria-current">Emprestimo</a>
        </li>
        <li class="nav-item ml-auto">
      </ul>
      <li class="nav-link active aria-current m-2 ">
            Ola, <?php
            echo session()->get('email');
            ?>
      </li>
      
       <button class="btn btn-outline-danger pull-left" onclick="location.href='<?php echo base_url('login/logout') ?>'">
            <i class="fas fa-sign-out-alt"></i> Sair
          </button>
        </li>
    </div>
  </div>
</nav>
