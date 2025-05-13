<style>
    html {
    scroll-behavior: smooth;
}


    .ftco-navbar-light{
        background: rgba(0, 0, 0, 0.5) !important;
    }

    .navbar-brand span {
        font-size: 25px;
        text-transform: none;
        display: inline;
        color: #00AAFF;
    }

    .nav-link{
        transition: 1s;
        color: #fff !important;
    }

    .active .nav-link{
        color: #00AAFF !important;
    } 

    .active .nav-link:hover{
        color: #fff !important;
    } 

    .nav-link:hover{
        color: #00AAFF !important;
    }

    .ftco-navbar-light.scrolled .nav-item.active > a {
      color: #00AAFF !important; }
    .ftco-navbar-light.scrolled .nav-item.active > a:hover {
      color: #000 !important; }

    .ftco-navbar-light.scrolled .nav-link:hover{
      color: #00AAFF !important; }

    .icones{
        margin-left: 100px;
        margin-top: 10px;
    }

    .icones i{
        font-size: 30px;
        margin-left: 10px;
        color: #fff;
        cursor: pointer;
        transition: 1s;
    }

    .icones i:hover{
        color: #00AAFF;
    }

    .ftco-navbar-light.scrolled i {
        color: #00AAFF !important;
    }

    .ftco-navbar-light.scrolled .preto {
        color: #000 !important;
    }
    .ftco-navbar-light.scrolled .preto:hover {
        color: #00AAFF !important;
    }

    .dropdown {
    position: relative;
    display: inline-block;
}

/* Estilo do menu do dropdown */
.dropdown-menu {
    display: none; /* Oculto por padrão */
    position: absolute;
    top: 80% !important; /* Ajuste do valor para deslocar mais para baixo */
    margin-top: 5px; 
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 5px;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
    z-index: 9999; /* Coloca o dropdown acima de outros elementos */
    min-width: 110px !important;
}

/* Estilo para os itens do dropdown */
.dropdown-item {
    padding: 8px 10px;
    text-decoration: none;
    display: block;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin: 5px 0;
    background-color: #dc3545 !important; 
    color: #fff !important;
    width: 80%;
    text-align: center;
}

.dropdown-item2 {
    padding: 8px 10px;
    text-decoration: none;
    display: block;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin: 5px 0;
    color: #fff !important;
    width: 80%;
    text-align: center;
}

.dropdown-item:hover {
    background-color: #e9ecef;
}

/* Quando o dropdown estiver visível */
.dropdown.show .dropdown-menu {
    display: block;
}
</style>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="./#home">Sports<span>Map<i class="bi bi-geo-alt-fill"></i></span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="./#home" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="./#sobre" class="nav-link">Sobre</a></li>
                <li class="nav-item"><a href="./#local" class="nav-link">Localizações</a></li>
                <li class="nav-item"><a href="./#avaliacao" class="nav-link">Avaliações</a></li>
                <li class="nav-item"><a href="./#evento" class="nav-link">Eventos</a></li>
            </ul>
        </div>

        <div class="icones">
            <a href="tela-login/login.php">
                <i class="bi bi-suit-heart-fill preto"></i>
            </a>

            <div class="dropdown">
                <a href="#" id="loginIcon">
                    <i class="bi bi-person-circle preto"></i>
                </a>
                <div class="dropdown-menu">
                    <a href="conta.php" class="dropdown-item2 btn btn-primary">Conta</a>
                    <a href="logout.php" class="dropdown-item btn btn-danger">Sair</a>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- END nav -->